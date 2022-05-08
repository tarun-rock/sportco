<?php

namespace App\Http\Controllers;

use App\Model\Answers;
use App\Model\Contest;
use App\Model\ContestParticipants;
use App\Model\ContestUserAnswers;
use App\Model\GameQuestionsMap;
use App\Model\Games;
use App\Model\GameSessions;
use App\Model\GamesParticipants;
use App\Model\MasterRewards;
use App\Model\MediaLink;
use App\Model\Posts;
use App\Model\PriceDistribution;
use App\Model\UserGameAnswers;
use App\Model\SportsgramMedia;
use App\Model\UserEvents;
use App\Model\UserRewards;
use App\Notifications\PostApproved;
use App\User;
use Carbon\Carbon;
use App\Model\Sports;
use App\Model\Tags;
use App\Model\PostTags;
use App\Model\TempTags;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Illuminate\Http\Request;
use Imagick as imgick;
use ReCaptcha\RequestMethod\Post;


class PublisherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('check_access');
    }

    public function post()
    {

        // if($request->ajax())

        $authorID = auth::id();
        $authorFirstPost = userFirstPost($authorID);
        $eventresult = usereventsearch($authorID, returnConfig("publish_first_post_loaded"));

            // dd($eventresult);

        if (empty($authorFirstPost) && empty($eventresult)) {

            UserEvents::insert([
                "user_id" => $authorID,
                "event_id" => returnConfig("publish_first_post_loaded"),
                "active" => isActive(),
                "created_at" => Carbon::now(),
            ]);

            $result = 1;

        }


        $sports = Sports::select(['name', 'id'])->where(['active' => 1])
            ->get();



        return view('front.post')->with(
            [
                'sports' => $sports,
                'publishfirstpostload' => $result ?? 0,
            ]
        );


    }

    public function postSubmit(Request $request , $edit = 0)
    {
        // dd("hello");
         // dd($request->title);

        $response = postSubmit($request , $edit);

        return $response;


    }

    /**
     * @param Request $request
     * @return array
     * @throws \ImagickException
     */
    public function articleImageUpload(Request $request)
    {


        //print_r($request->getBody()); die;


        $imagePath = base_path('public/images/post/');


        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");

        $temp = explode(".", $_FILES["upload"]["name"]);


        $extension = end($temp);

        //Check write Access to Directory


        if (!is_writable($imagePath)) {

            $response = [
                "status" => 'error',
                "message" => 'Can`t upload File; no write Access'
            ];

            return $response;
        }


        if (in_array($extension, $allowedExts)) {
            if ($_FILES["upload"]["error"] > 0) {
                $response = array(
                    "status" => 'error',
                    "message" => 'ERROR Return Code: ' . $_FILES["upload"]["error"],
                );

                return $response;

            } else {

                $filename = $_FILES["upload"]["tmp_name"];

                list($width, $height) = getimagesize($filename);

                // Create new imagick object

                $media = uploadFile($request->file('upload'), 'images/post');


                $im = new imgick(base_path("public/images/post/" . $media['name']));


                $im->scaleImage(650, 367, true);

                $im->writeImages($imagePath . $media['name'], true);

                //move_uploaded_file($filename, $imagePath . $reuse);


                return [
                    "uploaded" => 1,
                    "filenaeme" => $media['path'],
                    "url" => url('images/post/' . $media['name'])
                ];

            }
        }
    }

    public function editPost(Request $request , $id)
    {


        if ($request->ajax()) {

            return $this->postSubmit($request , $id);
        }

        $data = getPost($id, returnConfig("draft"));

        if (empty($data['content'])) {

            return redirect()->back();

        }

        return view('front.post')->with(
            [
                'sports' => $data['sport'],
                'content' => $data['content'],
                'edit' => 1,
                'publishfirstpostload' => 0,

            ]
        );


    }

    public function uploadSportsgramImage(Request $request)
    {

        $cropimg = $request->get("cropimg");
         // dd($cropimg);
        $pid = $request->get("pid");


        if (!empty($cropimg)) {
            $imgid = $request->get("imgid");
            $wid = $request->get("width");
            $hei = $request->get("height");
            $rot = $request->get("rotate");
            $x = $request->get("x");
            $y = $request->get('y');
            $ow = $request->get('ow');
            $oh = $request->get('oh');
            $url = $request->get('url');

            $data = getTableData(MediaLink::class, [
                "select" => [
                    "media_url",
                ],
                "joins" => [
                    [
                        "table" => "sportsgram_media",
                        "type" => returnConfig("left_join"),
                        "left_condition" => "sportsgram_media.media_id",
                        "right_condition" => "media_link.id"
                    ]
                ],
                "where" => [
                    "sportsgram_media.media_id" => $imgid,
                    "sportsgram_media.post_id" => $pid,
                ],
                "active" => 1,
                "single" => 1
            ]);

            if (!empty($data->media_url)) {
                $url = $data->media_url;
                $urlarray = explode("/", $url);
                $mediaName = $urlarray[count($urlarray) - 1];
                $val = img_crop($wid, $hei, $ow, $oh, $mediaName, $x, $y, $rot, 1);
                $imageurl = $val['url'];
                $status = 1;
            } else {
                $status = 0;
            }
            return ['status' => $status, 'imageurl' => $imageurl];
        } else {

            $file = $request->file('file');
            
            $imagePath = base_path('public/images/temp_sportsgram');
            $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            //Check write Access to Directory
            if (!is_writable($imagePath)) {

                $response = [
                    "status" => 'error',
                    "message" => 'Can`t upload File; no write Access'
                ];

                return $response;
            }

            if (in_array($extension, $allowedExts)) {


                if ($_FILES["file"]["error"] > 0) {
                    
                    $response = array(
                        "status" => 'error',
                        "message" => 'ERROR Return Code: ' . $_FILES["file"]["error"],
                    );

                    return $response;


                }else{

                    $imageupload = uploadFile($file, 'images/temp_sportsgram');

                } 
            }
               

            // dd($file);
            //$imageupload = uploadFile($file, 'images/temp_sportsgram', ["no" => 1]);


            if (empty($request->postid)) {


                $postID = Posts::insertGetId([
                    "media_id" => 0,
                    "title" => '',
                    "description" => '',
                    "status" => 0,
                    "sports_id" => 0,
                    "category_id" => "",
                    "type" => returnConfig("sportsgramtype"),
                    "created_by" => Auth::id(),
                    "active" => 0,
                    "section_id" => 0,
                    "created_at" => currentTime()
                ]);

            } else {
                $postID = $request->postid;
            }

            $imagePath = base_path('public/images/temp_sportsgram/');
            $im = new imgick($imagePath . $imageupload['name']);
            $im->resizeImage(1000, 750, imgick::FILTER_LANCZOS, 1, true);
            //$im->scaleImage(800, 450, true);
            $im->setImageCompressionQuality(85);
            $im->writeImages($imagePath . $imageupload['name'], true);


            $extra = [
                "data" => [
                    "post_id" => $postID,
                    "media_id" => $imageupload['id'] ?? 0,
                    "active" => isActive(),
                    "created_at" => currentTime()
                ]
            ];

            insertData(SportsgramMedia::class, $extra);


            return ["status" => 1, "imageId" => $imageupload['id'], "imageName" => $imageupload['name'], "postid" => $postID];

        }
        ///uploadImageAndPath($file,$path);
        //imageresize($file);
    }

    public function deleteSportsgramImage(Request $request)
    {
        // dd($postId); 
        $imageid = $request->imageid;
        $postId = $request->postId;

        // print_r($imageid);


        $extra = [
            "where" => [
                "media_id" => $imageid,
                //"post_id" => $postId,
                "post_id" => $postId,
            ],
            "update" => [
                "active" => 0,
                "updated_at" => currentTime()
            ]
        ];

        $deleteImgstatus = updateData(SportsgramMedia::class, $extra);

        if (empty($deleteImgstatus)) {
            $status = 0;
        } else {
            $status = 1;
        }


        return ['status' => $status];

    }

    public function imagePostSubmit(Request $request)
    {
        // dd("hy");
        $type = $request->get("type");
        $pid = $request->get("pid");
        $title = $request->get("title");
        $sports = $request->get("sports");

        // dd($pid);

        if ($type == 1 || $type == 3) {
            $validate = [
                'title' => 'required|min:5|max:100',
                'sports' => 'required|int',
            ];

            $msg = [];

            $msg['title.required'] = 'title is required!';
            $validate['title'] = 'required|min:5|max:100';
            $msg['title.min'] = 'Please enter a Title for your post - minimum 5 characters.';
            $msg['title.max'] = 'Please enter a Title for your post - maximum 100 characters.';
            $msg['sports.required'] = 'Please select a relevant Sport from the dropdown, as per your post.';
            $request->validate($validate, $msg);
        }

        if ($type == 1) {

            $data = getTableData(SportsgramMedia::class, [
                "select" => [
                    "media_id"
                ],
                "where" => [
                    "post_id" => $pid
                ],
                "active" => isActive()

            ])->toArray();

            if (!empty($data)) {
                foreach ($data as $d) {
                    $imgid = $d['media_id'];
                    $data = getTableData(MediaLink::class, [
                        "select" => [
                            "media_url",
                        ],
                        "where" => [
                            "media_link.id" => $imgid,
                        ],
                        "active" => 1,
                        "single" => 1
                    ]);
                    $url = $data['media_url'];
                    $imgarray = explode("/", $url);
                    $imgname = $imgarray[count($imgarray) - 1];
                    //$oldimageurl = url('/temp_sportsgram/')."/".$imgname;
                    $newurl = url('/images/sportsgram/') . "/" . $imgname;
                    rename(base_path("public/images/temp_sportsgram") . '/' . $imgname, base_path("public/images/sportsgram") . '/' . $imgname);
                    updateData(MediaLink::class, [
                        "update" => [
                            "media_url" => $newurl,
                        ],
                        "where" => [
                            "id" => $imgid,
                        ]
                    ]);

                }

                $loggedID = Auth::id();
                $authorFirstPost = userFirstPost($loggedID);

                // dd($authorFirstPost);

                if (empty($authorFirstPost)) {
                    $firstarticlesubmitted = 1;
                }

                $data1 = updateData(Posts::class, [
                    "update" => [
                        "title" => $title,
                        "status" => returnConfig("pending_post"),
                        "sports_id" => $sports,
                        "created_by" => Auth::id() ?? 0,
                        "active" => isActive(),
                        "created_at" => Carbon::now(),
                    ],
                    "where" => [
                        "id" => $pid,

                    ],
                    "na" => 1,
                ]);
                $status = 1;

                send_to_slack_channel(Auth::user()->name . ' / New Post / Image / ' . $title, 'sportco_activity');


            } else {
                $status = 2;
            }


            return ["status" => $status, "firstarticlesubmitted" => $firstarticlesubmitted ?? 0,];


        } elseif ($type == 3) {


            $detail = getTableData(Posts::class, [
                "select" => [
                    "title",
                    "users.name",
                    "users.id as u_id",
                    "users.community_id",
                    "referred_by"
                ],
                "where" => [
                    "posts.id" => $pid
                ],
                "single" => isActive(),
                "joins" => [
                    [
                        "type" => returnConfig("inner_join"),
                        "table" => "users",
                        "left_condition" => "posts.created_by",
                        "right_condition" => "users.id",
                    ],
                ]
            ]);

            $authorID = $detail->u_id;
            $referredID = $detail->referred_by ?? 0;
            $userCommunityID = $detail->community_id;
            $authorFirstPost = userFirstPost($authorID);
            $influencer = getIsInfluencer($referredID);

            if (!empty($userCommunityID)){

                switch ($userCommunityID)
                {
                    case 1:
                        $update["section_id"] = returnConfig("RCB_section");
                        break;

                    case 2:
                        $update["section_id"] = returnConfig("arsenal_Id");
                        break;

                    default:
                        break;
                }
            }




            if (!empty($detail->referred_by) && empty($authorFirstPost)) {
                $Userfirstpost = 1;
            }

            if (empty($authorFirstPost)) {

                if (empty($influencer->reward)) {
                    $earnTokenValue = getTableData(MasterRewards::class, [
                        "select" => [
                            "name",
                            "tokens",
                            "id"
                        ],
                        "where" => [
                            "active" => 1,
                            "type" => 1,
                            "id" => returnConfig('first_post_tokens'),
                        ],
                        "single" => 1

                    ]);
                    $extra = [
                        "data" => [
                            'user_id' => $detail->referred_by,
                            'reward_id' => returnConfig('first_post_tokens'),
                            'tokens' => $earnTokenValue['tokens'],
                            'active' => isActive(),
                            'created_at' => currentTime(),
                            'link_id' => $authorID,
                        ]
                    ];
                    insertData(UserRewards::class, $extra);
                }

                $firstarticleapproved = 1;
            }


            $seotitle = $request->get('seotitle');
            $seoslug = $request->get('seoslug');
            $meta_description = $request->get('meta_description');
            $focusKeywordFieldvalue = $request->get('focusKeywordFieldvalue');

            $update["meta_title"] = $seotitle;
            $update["slug"] = str_slug($seoslug) . "-" . rand(100000, 999999);
            $update["meta_description"] = $meta_description;
            $update["meta_keyword"] = $focusKeywordFieldvalue;
            $update["status"] = returnConfig("accepted_post");
            $update["publish_utc"] = Carbon::now();
            $update["category_id"] = $request->get('cat');
            $whereCond["id"] = $pid;

            if (!empty($request->get('acceptpostedit'))) {
                $update["title"] = $title;
                $update["sports_id"] = $sports;
            }


            $validate = [
                'seotitle' => 'required_if:type,3',
                'seoslug' => 'required_if:type,3',
                'meta_description' => 'required_if:type,3',
                'focusKeywordFieldvalue' => 'required_if:type,3',
                'imagetoken' => 'required'
            ];

            $request->validate($validate);
            Posts::where($whereCond)->update($update);

            $rewardID = returnConfig("sportsgram_approve_token");

            $tokenValue = getImageToken($request->get("imagetoken"));
            $authorID = getAuthorFromPost($pid);
            createUserReward($authorID, $rewardID, $tokenValue, $pid);
            $status = 1;


            $postname['title'] = $title;
            $postname['feedback'] = $request->get("feedback");
            if (empty($request->get("feedback"))) {
                $postname['feedback'] = "";
            } else {
                $postname['feedback'] = $request->get("feedback");
            }


            $Userinfo = User::find($authorID);


            $Userinfo->notify(new PostApproved($postname));

            $slackMsg = $detail->name ?? "";

            $slackMsg .= ' / Approved / Image / ' . $title;

            send_to_slack_channel($slackMsg, 'sportco_activity');


            //send_to_slack_channel($detail->name?? "".' / Approved / Image / '.$detail->title ?? "",'sportco_activity');


            return [
                "status" => $status,
                "userfirstpost" => $Userfirstpost ?? 0,
                "firstarticleapproved" => $firstarticleapproved ?? 0,
            ];

        }


    }

    public function contestDetail($id)
    {

        $detail = contestQuestionDetails($id);

        if (empty($detail)) {

            abort(403, "Please enter the contest first!");

        }

        insertContestQuestion($detail->question_id);

        return view("front.contest_detail")->with([
            "detail" => $detail,
            "play_head" => 1
        ]);


    }

    public function saveContestAnswer(Request $request)
    {

        if ($request->ajax()) {

            $data = $request->all();

            $questionID = $data["q_id"];

            $contestID = $data["contest_id"];

            $optionID = $data["option_id"];

            $time = $data["time"];


            $select = [
                'score'
            ];


            $extra = [
                "select" => $select,
                "where" => [
                    "id" => $contestID
                ],
                "single" => 1,
            ];

            $contestData = getTableData(Contest::class, $extra);

            $extra = [
                "select" => [
                    "id"
                ],
                "where" => [
                    "question_id" => $questionID,
                    "id" => $optionID,
                    "correct" => 1
                ],
                "single" => 1,
            ];

            $answerCheck = getTableData(Answers::class, $extra);

            $score = $correct = 0;

            if (!empty($answerCheck->id)) {

                $score = $contestData->score;


                $correct = 1;

            }

            $extra = [
                "where" => [
                    "question_id" => $questionID,
                    "user_id" => Auth::id(),
                    "option_id" => 0
                ],
                "update" => [
                    "option_id" => $optionID,
                    "time" => $time,
                    "correct" => $correct,
                    "score" => $score
                ]
            ];


            $status = updateData(ContestUserAnswers::class, $extra);

            if (empty($status)) {
                return ["status" => 0, "message" => "Already answered/Wrong Question"];

            }

            $detail = contestQuestionDetails($contestID);

            if (!empty($detail->question_id)) {

                insertContestQuestion($detail->question_id);

            } else {

//                $res

            }


            return ["status" => 1, "data" => $detail];

        }


    }

    public function enterContest($id)
    {

        $userID = Auth::id();

        $contest = Contest::leftJoin('contest_participants', function ($query) use ($userID) {
            $query->on('contest_participants.contest_id', '=', 'contest.id');
            $query->on('contest_participants.active', DB::raw(isActive()));
            $query->on('contest_participants.user_id', DB::raw($userID));
        })
            ->where("end_utc", ">", currentTime())
            ->where("start_utc", "<", currentTime())
            ->where([
                "contest.id" => $id,
                "contest.active" => isActive()
            ])
            ->first([
                "contest_participants.id as participated"
            ]);

        if (!empty($contest->participated)) {

            abort(403, "You have already entered!");

        }

        $extra = [
            "data" => [
                "contest_id" => $id,
                "user_id" => Auth::id(),
                "entry" => 0,
                "active" => isActive(),
                "created_at" => currentTime()
            ]
        ];

        insertData(ContestParticipants::class, $extra);


        return redirect("contest-detail/$id");

    }

    public function enterGame($slug)
    {
        // dd("hello");

        $id = getGameIDFromSlug($slug);

        $userID = Auth::id();



        $contest = gameEntryCheck($id, $userID);

        if (empty($contest)) {

            abort(403, "Wait for the game to start!");

        }

        if (!empty($contest->participated)) {

            abort(403, "You have already entered!");

        }

        $extra = [
            "data" => [
                "game_id" => $id,
                "user_id" => Auth::id(),
                "entry" => $contest->entry,
                "active" => isActive(),
                "created_at" => currentTime()
            ]
        ];

        insertData(GamesParticipants::class, $extra);


        return redirect("play/game/start/$slug");

    }

    public function startGame($slug)
    {

        $id = getGameIDFromSlug($slug);

        $userID = Auth::id();

        $U_communityId = Auth::user()->community_id ?? 0;

        $gamedata = getTableData(Games::class,[
            "select" => ["games.id", "played","community_id"],
            "where" => [
                "games.id" => $id
            ],
            "single" => 1,
        ]);
        $Communityid = $gamedata->community_id ?? 0;

        if($U_communityId != $Communityid && !empty($Communityid)){
            abort(403, 'You Cannot Play this game.');
        }


        $gameCheck = getTableData(Games::class, [
            "select" => ["games.id", "played","games.community_id"],
            "where" => [
                "games.id" => $id
            ],
            "whereOperand" => [
                [
                    "column" => "start_utc",
                    "operand" => "<",
                    "value" => currentTime()
                ]
            ],
            "single" => 1,
            "joins" => [
                [
                    "type" => returnConfig("inner_join"),
                    "table" => "games_participants",
                    "left_condition" => "games_participants.game_id",
                    "right_condition" => "games.id",
                    "conditions" => [
                        "games_participants.user_id" => $userID
                    ]
                ],
            ]
        ]);



        if (empty($gameCheck->id)) {

            abort(401, "Wait for the game to start");

        }


        $extra = [
            "select" => [
                "id",
                "completed"
            ],
            "where" => [
                "user_id" => $userID,
            ],
            "order" => [
                "id" => "DESC"
            ],
            "single" => 1
        ];

        $count = getTableData(GameSessions::class, $extra);


        $extra["where"]["game_id"] = $id;
        $extra["where"]["completed"] = 0;

        if (!empty($gameCheck->played)) {
            $extra["where"]["completed"] = 1;
            $completStatus = getTableData(GameSessions::class, $extra);
            if (!empty($completStatus->id)) {
                return abort(403, 'You have already completed this game.');
            }
        }

        $prevSession = getTableData(GameSessions::class, $extra);


        $sessionID = $prevSession->id ?? 0;

        if (empty($prevSession->id)) {

            $insert = [
                "data" => [
                    "user_id" => $userID,
                    "game_id" => $id,
                    "score" => 0,
                    "time" => 0,
                    "completed" => 0,
                    "active" => isActive(),
                    "created_at" => currentTime()
                ],
                "id" => 1
            ];

            $sessionID = insertData(GameSessions::class, $insert);

        }

        $detail = gameQuestionDetails($id, $sessionID);

        if (empty($detail) && !empty($sessionID)) {

            $insert = [
                "data" => [
                    "user_id" => $userID,
                    "game_id" => $id,
                    "score" => 0,
                    "time" => 0,
                    "completed" => 0,
                    "active" => isActive(),
                    "created_at" => currentTime()
                ],
                "id" => 1
            ];

            $sessionID = insertData(GameSessions::class, $insert);

            $detail = gameQuestionDetails($id, $sessionID);

        }

        insertGameQuestion($detail->question_id, $sessionID);

        return view("front.contest_detail")->with([
            "detail" => $detail,
            "type" => 1,
            "id" => $slug,
            "sessionID" => $sessionID,
            "play_head" => 1,
            "count" => $count->id ?? 0
        ]);


    }

    public function saveGameAnswer(Request $request)
    {

        if ($request->ajax()) {

            $data = $request->all();

            // dd($data);

            $questionID = $data["q_id"];
            $gameslug = $data["id"];

            $contestID = $data["contest_id"];

            $sessionID = $data["session_id"];

            $optionID = $data["option_id"];
            $time = $data["time"];


            $select = [
                'score',
                'completion_token',
                'played'
            ];


            $extra = [
                "select" => $select,
                "where" => [
                    "id" => $contestID
                ],
                "single" => 1,
            ];

            $contestData = getTableData(Games::class, $extra);

            // dd($contestData);
            
            $extra = [
                "select" => [
                    "id"
                ],
                "where" => [
                    "question_id" => $questionID,
                    "id" => $optionID,
                    "correct" => 1
                ],
                "single" => 1,
            ];

            $answerCheck = getTableData(Answers::class, $extra);

            // dd($answerCheck);
            Log::debug($answerCheck);


            $score = $correct = 0;

            if (!empty($answerCheck->id)) {

                $score = $contestData->score;


                $correct = 1;

            }
            $extra = [
                "where" => [
                    "question_id" => $questionID,
                    "session_id" => $sessionID,
                    "option_id" => 0
                ],
                "update" => [
                    "option_id" => $optionID,
                    "time" => $time,
                    "correct" => $correct,
                    "score" => $score
                ]
            ];


            $status = updateData(UserGameAnswers::class, $extra);

            if (empty($status)) {
                return ["status" => 0, "message" => "Already answered/Wrong Question"];

            }
            $completed = 0;

            $extra = [
                "where" => [
                    "id" => $sessionID,
                    "completed" => $completed
                ],
                "update" => [
                    "time" => DB::raw("time + $time"),
                    "score" => DB::raw("score + $score"),
                ]
            ];

            updateData(GameSessions::class, $extra);

            $detail = gameQuestionDetails($contestID, $sessionID);


            if (!empty($detail->question_id)) {
                insertGameQuestion($detail->question_id, $sessionID);
            }

            if (empty($detail)) {
                $completed = 1;
                $extra = [
                    "where" => [
                        "id" => $sessionID,
                    ],
                    "update" => [
                        "completed" => $completed
                    ]
                ];
                $gamesstatus = updateData(GameSessions::class, $extra);

                if ($contestData->completion_token >= 1 && !empty($contestData->played)){
                    $rewarddata = [
                        "data" => [
                            "user_id" => Auth::id() ?? 0,
                            "reward_id" => returnConfig("onetime_play_tokens"),
                            "tokens" => $contestData->completion_token,
                            "active" => isActive(),
                            "created_at" => currentTime()
                        ]
                    ];

                    insertData(UserRewards::class, $rewarddata);

                    $referredID = Auth()->user()->referred_by ?? 0;
                    $influencer = getIsInfluencer($referredID);
                    if (!empty($influencer) && !empty($contestData->played)) {
                        session()->put('onetime_play_tokens', 1);
                    }
                }


                return ["completed" => 1 , "correct" => $correct];

            }

            $optionIDs = explode(returnConfig("column_separator"), $detail->option_id);

            $optionIDsOrder = implode(',', $optionIDs);

            $options = DB::table('answers')
                            ->whereIn('id', $optionIDs)
                            ->orderByRaw(DB::raw("FIELD(id, " . $optionIDsOrder . " )"))
                            ->get('option');

                       // dd($options);     

            /*print_r($detail.'outer');die;*/
            return ["status" => 1, "data" => $detail, "correct" => $correct , "options" => $options];


        }


    }

    public function gameLeaderboard($gameID = 0)
    {


        $id = getGameIDFromSlug($gameID);


        $where = [
            "game_sessions.completed" => 1
        ];

        $userCommunityID = Auth::user()->community_id ?? 0;
        $rcbUser = "";

        if (!empty($userCommunityID)){
            $rcbUser = 1;
        }

        if (!empty($gameID)) {
            $firstgamecheck = gameSessions(auth::id());

            if ($firstgamecheck->count() == 1) {
                session()->put('first_game_finished', 1);
            }

            $contest = gameEntryCheck($id, Auth::id());


            if (empty($contest->participated)) {

                abort(403, "You haven't participated!");

            }


            $where["game_sessions.game_id"] = $id;
        }


        $rankers = UsersRank(100, $where);


        $select = [
            "users.name",
            "users.id",
            "game_sessions.id as g_id",
            "game_sessions.score",
            "game_sessions.time",
            "game_sessions.updated_at",
            DB::raw('COUNT(user_game_answers.question_id) as ques_count'),
            DB::raw('SUM(user_game_answers.correct) as correct_ans_count'),
            DB::raw('SUM(user_game_answers.score) as correct_ans_score'),
        ];
        $joins = [
            [
                "type" => returnConfig("inner_join"),
                "table" => "users",
                "left_condition" => "game_sessions.user_id",
                "right_condition" => "users.id",
            ],
            [
                "type" => returnConfig("inner_join"),
                "table" => "games",
                "left_condition" => "game_sessions.game_id",
                "right_condition" => "games.id",
            ],
            [
                "type" => returnConfig("inner_join"),
                "table" => "user_game_answers",
                "left_condition" => "game_sessions.id",
                "right_condition" => "user_game_answers.session_id",
            ]
        ];
        $where['users.id'] = Auth::id();

        $latestplay = getTableData(GameSessions::Class, [
            "select" => $select,
            "where" => $where,
            "joins" => $joins,
            "order" => [
                "game_sessions.updated_at" => "DESC",
            ],
            "group" => ["game_sessions.id"],
            "single" => 1
        ]);

        if (empty($latestplay)) {

            abort(403, "You need to complete first session in order to view leaderboard!");

        }

        $topscorevalue = getTableData(GameSessions::Class, [
            "select" => $select,
            "where" => $where,
            "joins" => $joins,
            "order" => [
                "game_sessions.score" => "DESC",
                "game_sessions.time" => "ASC",

            ],
            "single" => 1

        ]);

        $newrank = $rankers->toArray();


        $filtered = array_filter($newrank, function ($var) use ($latestplay) {
            return ($var['g_id'] == $latestplay->g_id);
        });


        $comparetopscore = array_filter($newrank, function ($var) use ($topscorevalue) {
            return ($var['g_id'] == $topscorevalue->g_id);
        });


        $sameEntry = 0;
        if ($topscorevalue->g_id == $latestplay->g_id && $topscorevalue->score == $latestplay->score) {
            $sameEntry = 1;
        }


        $topscore = array_values($comparetopscore);
        $arrayval = array_values($filtered);


        $active = 0;
        if (empty($filtered)) {
            $active = 1;
            $arrayval = $latestplay->toArray();

        } else {

            $arrayval = $arrayval[0] ?? [];

        }


        $topactive = 0;

        if (empty($comparetopscore)) {
            $topactive = 1;
            $topscore = $topscorevalue->toArray();


        }


        if (empty($rankers->count())) {
            abort(403, "Leaderboard is currently empty. Nothing to display yet!");

        }
        $relatedQuiz = playQuiz();


        return view("front.leaderBoard")->with([
            "rankers" => $rankers,
            "gameID" => $gameID,
            "play_head" => 1,
            "quizs" => $relatedQuiz,
            "latestplay" => $arrayval,
            "latestplayadd" => $active,
            "topscore" => $topscore,
            "topscoreactive" => $topactive,
            "sameentry" => $sameEntry,
            "gamestats" => $latestplay,
            "rcbUser" => $rcbUser,


        ]);

    }

    public function winnerLeaderboard($gameID = 0)
    {

        $id = getGameIDFromSlug($gameID);
        $filterResp = $extra = [];
        $userID = Auth::id();
        $type = getTableData(PriceDistribution::class, [
            "select" => [
                DB::raw("SUM(count) as limiter")
            ],
            "single" => 1
        ]);
        $limit = $type->limiter ?? 0;
        if (!empty($limit)) {
            $where = [
                "game_sessions.completed" => 1,
                "game_sessions.game_id" => $id
            ];
            $response = UsersRank($limit, $where);

        }


        return view("front.winnerLeaderboard")->with([
            "rankers" => $response
        ]);

    }

}
