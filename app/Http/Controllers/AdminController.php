<?php

namespace App\Http\Controllers;

use App\Model\Answers;
use App\Model\Category;
use App\Model\ContestQuestionsMap;
use App\Model\GameQuestionsMap;
use App\Model\Games;
use App\Model\GameTags;
use App\Model\MediaLink;
use App\Model\NotificationStatus;
use App\Model\PostFeedback;
use App\Model\Posts;
use App\Model\PostStats;
use App\Model\PostSections;
use App\Model\Products;
use App\Model\ProductTags;
use App\Model\Questions;
use App\Model\SiteMeta;
use App\Model\Sports;
use App\Model\SportsgramMedia;
use App\Model\SportsgramTokens;
use App\Model\StoreCategory;
use App\Model\Tags;
use App\Model\PostTags;
use App\Model\Contest;
use App\Model\TempTags;
use App\Model\Transactions;
use App\Model\UserRewards;
use App\Model\Users;
use App\Model\Wallet;
use App\Notifications\PostRejected;
use App\Notifications\TransactionProcessed;
use App\Notifications\TokenApproved;
use App\Notifications\TokenDeclined;
use Carbon\Carbon;
use App\Model\Notification;
use App\User;
use function foo\func;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PhpParser\Node\Expr\Print_;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Imagick as imgick;
use App\Model\MasterRewards;
use App\Notifications\PostApproved;
use App\Notifications\FirstPostToken;
// use Illuminate\Support\Facades\Request;



// use Automattic\WooCommerce\HttpClient\HttpClientException;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Support\Facades\Session;
// use App\Providers\RouteServiceProvider;













class AdminController extends Controller
{

    private $viewFolder = "admin";

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_access');
    }

    public function index()
    {

        $totalUsers = Users::select([
            "name"
        ])->count();


        $todayUsers = Users::select([
            "id"
        ])
            ->whereDate(
                'created_at', Carbon::today()
            )->get()->count();


        $tokenRadeem = UserRewards::select([
            "user_rewards.tokens"
        ])
            ->join('master_rewards', function ($query) {
                $query->on('master_rewards.id', '=', 'user_rewards.reward_id');
            })->whereDate('user_rewards.created_at', Carbon::today())
            ->sum("user_rewards.tokens");


        $tokenAwarded = UserRewards::select([
            "user_rewards.tokens"
        ])
            ->join('master_rewards', function ($query) {
                $query->on('master_rewards.id', '=', 'user_rewards.reward_id');
                $query->on('master_rewards.type', DB::raw("1"));
            })
            ->sum("user_rewards.tokens");


        $totalPosts = Posts::select([
            "id"
        ])->count();

        $pendingPost = Posts::where([
            "status" => returnConfig("pending_post"),
            "active" => 1
        ])->count();

        /*DB::enableQueryLog();
        $referredUser = getTableData(users::class,[
            "select" => [
                "users.name as u_name",
                "users.created_at as u_date",
                "users.nickname as u_nickname",
            ],
            "joins" => [
                [
                    "type" => returnConfig("inner_join"),
                    "table" => "users as r_users",
                    "left_condition" => "r_users.referred_by",
                    "right_condition" => "users.id",
                ],
            ],
            "order" => [
                "users.created_at" => "DESC",
            ]
        ]);
        print_r(DB::getQueryLog());die;*/


        return view("$this->viewFolder.index")->with([
            "pendingPost" => $pendingPost,
            "totalUsers" => $totalUsers,
            "totalPosts" => $totalPosts,
            "todayUsers" => $todayUsers,
            "tokenAwarded" => $tokenAwarded,
            "tokenRadeem" => $tokenRadeem
        ]);

    }

    public function postPending(Request $request)
    {

        return view("$this->viewFolder.post_pending");

    }

    public function PendingAjax(Request $request){


        $ajax = $request->get("ajax") ?? 0;

        if ($ajax == 1) {


            $get = [
                "title",
                "sports.name as s_name",
                'users.name', "posts.id",
                "users.id as u_id",
                "post_type.name as p_type",
                /*"posts.created_at",*/
                DB::raw('DATE_FORMAT(posts.created_at, "%d-%M-%Y") as date')
            ];

            $post = Posts::join("users", "users.id", "=", "posts.created_by")
                ->join("sports", "sports.id", "=", "posts.sports_id")
                ->join("post_type", "post_type.id", "=", "posts.type")
                ->where([
                    'posts.status' => returnConfig("pending_post"),
                    'posts.active' => 1
                ])
                ->orderBy('posts.created_at', 'DESC')
                /*->selectRaw("DATE_FORMAT('posts.created_at', '%d/%l/%Y') as date,")*/
                ->get($get);

            $data = Datatables::of($post)->addColumn('details', function ($post) {


                $html = '<button type="button" class="btn btn-danger reject" data-target="#modalReject" data-toggle="modal" data-uid='.$post->u_id.' data-id= ' . $post->id . '>Reject</button>&nbsp;&nbsp;';
                $html .= '<a target="_blank" href="' . url("dashboard/preview-post") . '/' . $post->id . '" class="btn btn-info">Preview</a>&nbsp;&nbsp;';
                $html .= '<a target="_blank" href="' . url("dashboard/edit-post") . '/' . $post->id . '" class="btn btn-warning">Approve</a>';


                return $html;
            })
                ->rawColumns(['details'])
                ->make(true);




            return $data;

        }

        if ($ajax == 2) {
            // dd('hlfddo');

            $data = $request->get();


            $tempTags = TempTags::where([
                "post_id" => $data["id"],
                "active" => 1
            ])->get(["name", "id"]);


            Posts::where([
                "id" => $data["id"],
                "status" => returnConfig("pending_post")
            ])->update([
                "status" => returnConfig("accepted_post"),
                "updated_at" => Carbon::now(),
                "section_id" => $data["section"] ?? 0,
                "category_id" => $data["cat"]
            ]);

            $ids = [];

            foreach ($tempTags as $tag) {

                $tags = [
                    "name" => $tag->name,
                    "active" => 1,
                    "created_at" => Carbon::now()
                ];

                $tagID = Tags::insertGetId($tags);

                PostTags::insert([
                    "post_id" => $data["id"],
                    "tag_id" => $tagID,
                    "active" => 1,
                    "created_at" => Carbon::now()
                ]);

                $ids[] = $tag->id;

            }

            if (!empty($ids)) {

                TempTags::whereIn("id", $ids)
                    ->update([
                        "active" => 0,
                        "updated_at" => Carbon::now()
                    ]);

            }

            return ["status" => 1];


        }

        if ($ajax == 3) {

            // dd('hlo');

            $data = $request->all();

            // dd($data['feedback']);

            if (empty($data['feedback'])){
                $data['feedback'] = "";
            }


            PostFeedback::insert([
                "post_id"=>$data["id"],
                "type" => returnConfig('rejected_post'),
                "feedback" => $data['feedback'] ?? null,
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now()
            ]);

            $postdataarray = Posts::find($data["id"]);
            $postdata['title'] = $postdataarray['title'];
            $postdata['feedback'] = $data["feedback"];

            $toUser = User::find($data["uid"]);
            $toUser->notify(new PostRejected($postdata));


            Posts::where([
                "id" => $data["id"],
                "status" => returnConfig("pending_post")
            ])->update([
                "status" => returnConfig("rejected_post"),
                "updated_at" => Carbon::now()
            ]);

            return ["status" => 1];


        }else{
            return 3;
        }

    }

    public function previewPost($id)
    {


        $select = [
            'posts.id as id',
            'title',
            'description',
            DB::raw('group_concat(DISTINCT tags.name) as tag_name'),
            DB::raw('group_concat(DISTINCT temp_tags.name) as temp_name'),
            'sports.name as sports_name',
            'category.name as cat_name',
            'category.id as cat_id',
            'posts.created_at',
            'users.name as user_name',
            'media_url',
            'posts.type as type',
            'sports.id as sports_id',
            'userstat.likes as iliked',
            'userstat.fav as ifav',
            DB::raw("SUM(post_stats.likes) as likes"),
            DB::raw("SUM(post_stats.views) as views"),
            DB::raw("SUM(post_stats.shares) as shares"),
        ];

        $where = [
            'posts.active' => 1,
            'posts.status' => returnConfig("pending_post"),
            'sports.active' => 1,
            'posts.id' => $id,
        ];


        $post = Posts::join('sports', 'sports.id', '=', 'posts.sports_id')
            ->leftjoin('category', 'category.id', '=', 'posts.category_id')
            ->join('users', 'users.id', '=', 'posts.created_by')
            ->leftjoin('post_tags', function ($query) {
                $query->on('post_tags.post_id', '=', 'posts.id');
                $query->on('post_tags.active', DB::raw("1"));

            })
            ->leftjoin('tags', 'post_tags.tag_id', '=', 'tags.id')
            ->leftjoin('temp_tags', function ($query) {
                $query->on('temp_tags.post_id', '=', 'posts.id');
                $query->on('temp_tags.active', DB::raw("1"));

            })
            ->leftjoin('media_link', 'media_link.id', '=', 'posts.media_id')
            ->leftjoin('post_stats', 'post_stats.post_id', '=', 'posts.id')
            ->leftJoin('post_stats as userstat', function ($join) {

                $join->on('userstat.post_id', '=', 'posts.id');
                $join->on('userstat.user_id', DB::raw(0));
            })
            ->where($where)
            ->first($select);


        $previous = DB::select("(SELECT id as prev,type,null as next, title FROM posts WHERE status = 1 and active = 1 AND id < ? ORDER BY id DESC limit 1)
                                       UNION ALL
                                 (SELECT NUll as col1,type, id as next,title FROM posts WHERE status = 1 and active = 1 AND id > ? limit 1)", [$id, $id]);



        if (empty($post->id)) {

            abort(404);

        }

        $sports_id = $post->sports_id;

        $category_wise_data = fetchPost('', 8, '', '', $sports_id, false);

        if ($post->cat_id ==1){

            $mediaData = getTableData(Posts::class,[
                "select"=>
                    [
                        DB::raw("GROUP_CONCAT(media_link.media_url separator '" . globalSeparator() . "') as media_data")

                    ],
                "joins" => [

                    [
                        "table" =>"sportsgram_media",
                        "type" => returnConfig("left_join"),
                        "left_condition" => "sportsgram_media.post_id",
                        "right_condition" => "posts.id"
                    ],
                    [
                        "table" =>"media_link",
                        "type" => returnConfig("left_join"),
                        "left_condition" => "media_link.id",
                        "right_condition" => "sportsgram_media.media_id"
                    ],
                ],
                "group"=>[
                    "posts.id",
                ],
                "where" =>[
                    "posts.id" => $id,
                ],"single"=>1

            ]);
            $mediaUrl = explode('!--!', $mediaData['media_data']);


            return view('front.imgarticle')->with(
                [
                    "post"=>$post,
                    "mediaUrl"=>$mediaUrl,
                    "previous"=>$previous
                ]
            );
        }
        else{

            // dd($post);
            return view('front.article')->with(
                [
                    'data' => $post,
                    'related' => $category_wise_data,
                    'previous' => $previous,
                ]
            );
        }





    }

    public function postSubmit($edit = 0, Request $request)
    {
        // dd($request->all());
        $response = postSubmit($request , $edit);

        return $response;


    }

    public function editPost($edit, Request $request)
    {


        if ($request->ajax()) {

            // dd("hy");

            // return $this->postSubmit($id, $request);


    $approvededit = $request->get("acceptpostedit");
    $wid = $request->get("width");
    $title = trim($request->get("title"));
    $desc = $request->post("article");

    // dd($approvededit);

    //$desc = clean($orgArticle);

    $sport = $request->get("sport");
    $tags = array_unique(explode(",", trim($request->get("tags"))));
    $temp_Tag = array_unique(explode(";", trim($request->get("tempTag"))));
    $tempTags = array_values(array_filter($temp_Tag));
    $type = $request->get("type");
    $hei = $request->get("height");
    $imgDone = $request->get("img_done");
    $rot = $request->get("rotate");
    $x = $request->get("x");
    $y = $request->get('y');
    $ow = $request->get('ow');
    $oh = $request->get('oh');
    $url = $request->get('url');


    $seotitle = $request->get('seotitle');
    $seoslug = $request->get('seoslug');
    $meta_description = $request->get('meta_description');
    $focusKeywordFieldvalue = $request->get('focusKeywordFieldvalue');
    $cat = $request->get('cat');
    $section = $request->get('section');
    $rssid = $request->get('rssid');

    $validate = [
        'title' => 'required|min:5|max:100',
        'type' => 'required|int',
        'sport' => 'required|int',
        //'article' => 'required|min:300|max:50000',
        'seotitle' => 'required_if:type,3',
        'seoslug' => 'required_if:type,3',
        'meta_description' => 'required_if:type,3',
        'focusKeywordFieldvalue' => 'required_if:type,3'
    ];

    //print_r(Input::all());die;
    $rssid = $request->get('rssid');

    // dd($rssid);



    $msg = [];

    $msg['title.required'] = 'title is required!';
    $validate['title'] = 'required|min:5|max:100';
    $msg['title.min'] = 'Please enter a Title for your post - minimum 5 characters.';
    $msg['title.max'] = 'Please enter a Title for your post - minimum 100 characters.';
    $msg['sport.required'] = 'Please select a relevant Sport from the dropdown, as per your post.';

    /*print_r("dasdfasd");die;*/
    if (!empty($imgDone)) {

        if ($type != 3) {

            $validate['img'] = 'mimes:jpeg,jpg,png,gif|max:13000|dimensions:min_width=800,min_height=400';


            //$validate['img'] = 'required| mimes:jpeg,jpg,png,gif|max:1024|dimensions:min_width=800,min_height=400';

            /*$msg['img.required'] = 'Image is required!';*/
            $msg['img.mimes'] = 'The feature image must be a file of type -  jpeg, jpg, png, gif.';
            $msg['img.max'] = 'The feature image should be less than 12 MB in size. Current image is greater than 12MB';
            $msg['img.dimensions'] = 'The feature image has invalid image dimensions - It should be minimum 800px  x 400px.';
        }


    } else {

        if ($type == 3) {

            $validate['img'] = 'mimes:jpeg,jpg,png,gif|max:13000|dimensions:min_width=800,min_height=400';
            $validate['img'] = 'required|' . $validate['img'];
            $msg['img.required'] = 'Image is required!';


            //$validate['img'] = 'required| mimes:jpeg,jpg,png,gif|max:1024|dimensions:min_width=800,min_height=400';

            /*$msg['img.required'] = 'Image is required!';*/
            $msg['img.mimes'] = 'The feature image must be a file of type -  jpeg, jpg, png, gif.';
            $msg['img.max'] = 'The feature image should be less than 12 MB in size. Current image is greater than 12MB';
            $msg['img.dimensions'] = 'The feature image has invalid image dimensions - It should be minimum 800px  x 400px.';

        }

    }


    //print_r($msg);die;
    // dd($type);

    if ($type == 1 || $type == 3) {


        //$validate['sport'] = 'required|integer';


        $articleLength = strlen($desc);


        $str2 = 'img';

        $str1 = 'oembed';
        $content = strip_tags($desc);

        $contentLength = strlen($content);

        $insiderImage = strpos($desc, $str2);

        $insiderVideo = strpos($desc, $str1);
        $newLength = strlen($desc) + 1;

        if ($insiderVideo != false) {
            if ($contentLength <= 300) {
                $validate['article'] = 'required|min:' . $newLength . '|max:50000';

                $msg = [
                    'article.min' => 'Your post text should be a minimum of 300 characters.'
                ];
            }

        } else if ($insiderImage != false) {
            if ($contentLength <= 400) {
                $validate['article'] = 'required|min:' . $newLength . '|max:50000';
                $msg['article.min'] = 'Your post text should be a minimum of 400 characters.';

            }

        } else {
            if ($contentLength <= 400) {
                $validate['article'] = 'required|min:400|max:50000';
                $msg['article.min'] = 'Your post text should be a minimum of 400 characters.';
            }

        }


    }


    $status = returnConfig("pending_post");

    if ($type == 2) {

        $status = returnConfig("draft");

        if (Auth::user()->type == returnConfig("user")) {

            $loggedID = Auth::id();
            $authorFirstPost = userFirstPost($loggedID);

            if (empty($authorFirstPost)) {
                $firstarticledrafted = 1;
            }

        }


    }
    $validatedData = $request->validate($validate, $msg);


    if (!empty($_FILES)) {

        $imagePath = base_path('public/images/post/');
        // dd($imagePath);
        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
        $temp = explode(".", $_FILES["img"]["name"]);
        $extension = end($temp);
        //Check write Access to Directory
        // print_r($tagname);die;
        if (!is_writable($imagePath)) {

            $response = [
                "status" => 'error',
                "message" => 'Can`t upload File; no write Access'
            ];

            return $response;
        }


        if (in_array($extension, $allowedExts)) {


            if ($_FILES["img"]["error"] > 0) {
                /*print_r($request->file('img')->getErrorMessage());
                print_r($_FILES["img"]);die;*/
                $response = array(
                    "status" => 'error',
                    "message" => 'ERROR Return Code: ' . $_FILES["img"]["error"],
                );

                return $response;


            } else {


                $filename = $_FILES["img"]["tmp_name"];


                list($width, $height) = getimagesize($filename);

                $reuse = $_FILES["img"]["name"];

    //                move_uploaded_file($filename, $imagePath . $reuse);


                $media = uploadFile($request->file('img'), 'images/post');

                $val = img_crop($wid, $hei, $ow, $oh, $media['name'], $x, $y, $rot);
                $imagePath = base_path('public/images/post/');


                //print_r($imagePath);die;
                $im = new imgick($imagePath . $val['imgname']);


                $im->scaleImage(1218, 685, true);

                $im->setImageCompressionQuality(85);

                $im->writeImages($imagePath . $val['imgname'], true);


                // $val = img_crop($wid, $hei, $ow, $oh, url("images/post/" . rawurlencode($_FILES["img"]["name"])), $x, $y, $rot);
                // $val = img_crop($wid, $hei, $ow, $oh, url("images/post/" . rawurlencode($_FILES["img"]["name"])), $x, $y, $rot);

                $mediaID = $media['id'];

                /*$mediaID = MediaLink::insertGetId([
                    "media_url" => $val["url"], //url("images/post/" . rawurlencode($_FILES["img"]["name"])),
                    "type" => 1, //TODO config constant for type
                    "active" => 1,
                    "created_at" => Carbon::now()
                ]);*/


            }
        } else {

            $response = [
                "status" => 'error',
                "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
            ];

            return $response;

        }

    }

    if (!empty($edit)) {


        $update = [
            "title" => $title,
            "description" => $desc,
            "updated_at" => Carbon::now()
        ];

        if (!empty($mediaID)) {

            $update["media_id"] = $mediaID;

        }

        if (!empty($sport)) {

            $update["sports_id"] = $sport;

        }

        if ($type == 1) {

            $update["status"] = returnConfig("pending_post");

        }


        $whereCond = [
            "id" => $edit,
            "active" => 1
        ];

        if (Auth::user()->type == returnConfig("admin")) {



            $update["meta_title"] = $seotitle;
            $update["meta_description"] = $meta_description;
            $update["meta_keyword"] = $focusKeywordFieldvalue;

            $update["rss_id"] = $rssid;


            if (empty($approvededit)) {
                $seoslug = str_slug($seoslug) . "-" . rand(100000, 999999);
                $update["slug"] = $seoslug;
            }

            if ($type == 3) {

                $articleLength = strlen($desc);


                if ($articleLength >= 300) {

                    $str2 = 'img';

                    $str1 = 'oembed';

                    $insiderImage = strpos($desc, $str2);

                    $insiderVideo = strpos($desc, $str1);


                    if ($insiderVideo != false) {

                        $rewardID = returnConfig("video_approve_token");

                    } else if ($insiderImage != false) {

                        $rewardID = returnConfig("img_approve_token");


                    } else {

                        $rewardID = returnConfig("article_approve_token");

                    }
                    // dd($tokenValue);

                    $tokenValue = getRewardToken($rewardID);

                    $authorID = getAuthorFromPost($edit);




                    if (empty($request->get('acceptpostedit')) && $section != returnConfig("fanscorner_sectionid")) {
                        // dd($tokenValue);
                        createUserReward($authorID, $rewardID, $tokenValue, $edit);
                    }



                    if (date("M") == "Apr" && !empty($tokenValue)) {


                        $rewardID = returnConfig("bonus_percentage_token");

                        $tokenValueBonus = (getRewardToken($rewardID) / 100) * $tokenValue;


                        if (empty($request->get('acceptpostedit')) && $section != returnConfig("fanscorner_sectionid")) {

                            createUserReward($authorID, $rewardID, $tokenValueBonus, $edit);

                        }

                    }



                }
                //section 1
                if ($section == 2) {

                    if ($insiderVideo != false) {
                        $rewardID = returnConfig("editor_choice_video_token");
                    } else if ($insiderImage != false) {

                        $rewardID = returnConfig("editor_choice_img_token");


                    } else {
                        $rewardID = returnConfig("editor_choice_article_token");

                    }

                    $tokenValue = getRewardToken($rewardID);

                    $authorID = getAuthorFromPost($edit);
                    if (empty($request->get('acceptpostedit'))) {
                        createUserReward($authorID, $rewardID, $tokenValue, $edit);
                    }

                    if (date("Y") == "2019" && !empty($tokenValue)) {

                        $rewardID = returnConfig("bonus_percentage_token");

                        $tokenValueBonus = (getRewardToken($rewardID) / 100) * $tokenValue;

                        if (empty($request->get('acceptpostedit'))) {
                            createUserReward($authorID, $rewardID, $tokenValueBonus, $edit);
                        }

                    }

                }


                if (empty($approvededit)) {
                    $update["category_id"] = $cat;
                    $update["status"] = returnConfig("accepted_post");
                    $update["publish_utc"] = Carbon::now();
                    $Userinfo = User::find($authorID);
                    $referredID = $Userinfo->referred_by;
                    $userCommunityID = $Userinfo->community_id ?? 0;
                    $influencer = getIsInfluencer($referredID);


                    // dd($userCommunityID);

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
                    }else{
                        if ($section == "undefined" ){
                            $update["section_id"] = 0;
                        }
                        else{
                            $update["section_id"] = $section;
                        }

                    }

                }

                $tempTags = TempTags::where([
                    "post_id" => $edit,
                    "active" => 1
                ])->get([
                    DB::raw("UPPER(name) as uname"),
                    "name",
                    "id"]);

                $ids = [];



                $existingTagss = Tags::select([
                    DB::raw("UPPER(name) as name"),
                     "id"

                    ])->where([
                    "active" => 1
                ])->get()->toArray();

                $existingTags = array_column($existingTagss, "name");
                $existingTagsID = array_column($existingTagss, "id");
    
                PostTags::where([
                    "post_id" => $edit,
                ])->update([
                    "active"=> 0
                ]);

                foreach ($tags as $key => $tag) {
                    $tagsupper = strtoupper($tag);

                    if (in_array($tag, $existingTagsID)){

                        $insert[] = [
                            "tag_id" => $tag,
                            "active" => isActive(),
                            "post_id" => $edit,
                            "created_at" => currentTime()
                        ];

                    }elseif (in_array($tagsupper, $existingTags)){
                        $tagsupper = strtoupper($tag);
                        $tagindexid = array_search($tagsupper,$existingTags);
                        $searchID =  $existingTagsID[$tagindexid];

                        $insert[] = [
                            "tag_id" => $searchID,
                            "active" => isActive(),
                            "post_id" => $edit,
                            "created_at" => currentTime()
                        ];

                        unset($tags[$key]);
                    }
                    else{

                        $extra = [
                            "data" =>[
                                "name" => trim($tag),
                                "active"=> isActive()
                            ],
                            "id"=> 1
                        ];
                        $tagID = insertData(Tags::class, $extra);
                        $insert[] = [
                            "tag_id" => $tagID,
                            "active" => isActive(),
                            "post_id" => $edit,
                            "created_at" => currentTime()
                        ];
                        unset($tags[$key]);
                    }

                }




                if (!empty($insert)) {

                    PostTags::insert($insert);

                }



                if (!empty($ids)) {

                    TempTags::whereIn("id", $ids)
                        ->update([
                            "active" => 0,
                            "updated_at" => Carbon::now()
                        ]);

                }

                $authorFirstPost = userFirstPost($authorID);

                if (empty($authorFirstPost)) {
                    $firstarticleapproved = 1;
                }


                $checkpostcount = UserLatestPost(Auth::id());

                // dd($checkpostcount);

                if (empty($checkpostcount->toArray())) {

                    // dd("hello");
                    $linkid = getTableData(users::class, [
                        "select" => [
                            "referred_by",
                        ],
                        "where" => [
                            "active" => 1,
                            "type" => 1,
                            "id" => $authorID,
                        ],
                        "single" => 1

                    ]);
                    $influencer = getIsInfluencer($linkid['referred_by']);


                    if (!empty($linkid['referred_by'] && empty($influencer->reward))) {

                    // dd("BVBV");

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
                        // dd($earnTokenValue);

                        $authorFirstPost = userFirstPost($authorID);

                        // dd($authorFirstPost);


                        $extra = [
                            "data" => [
                                'user_id' => $linkid['referred_by'],
                                'reward_id' => returnConfig('first_post_tokens'),
                                'tokens' => $earnTokenValue['tokens'],
                                'active' => isActive(),
                                'created_at' => currentTime(),
                                'link_id' => $authorID,
                            ]
                        ];
                        $referredUser = User::where('id', $authorID)->first(['name']);
                        $toUser = User::find($linkid['referred_by']);
                        $emaildata = [
                            "firstPostToken" => $earnTokenValue['tokens'],
                            "fromUser" => $referredUser->name ?? "",
                        ];
                        /*if (empty($request->get('acceptpostedit'))) {

                        }*/
                        if (empty($authorFirstPost)) {
                            // dd("empty");
                            $Userfirstpost = 1;
                            $toUser->notify(new FirstPostToken($emaildata));

                            insertData(UserRewards::class, $extra);
                        }

                    }
                }

                    // dd("hello");


                $detail = getTableData(Posts::class, [
                    "select" => [
                        "users.name"
                    ],
                    "where" => [
                        "posts.id" => $edit
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

                $slackMsg = $detail->name ?? "";

                $slackMsg .= ' / Approved / Article / ' . $title;


                if (empty($request->get('acceptpostedit'))) {
                    send_to_slack_channel($slackMsg, 'sportco_activity');
                    $response = sendMessage($title,$meta_description,route("view.article", $seoslug));
                    /*$return["allresponses"] = $response;
                    $return = json_encode($return);
                    $data = json_decode($response, true);
                    print_r($data);
                    $id = $data['id'];
                    print_r($id);
                    print("\n\nJSON received:\n");
                    print($return);
                    print("\n");*/
                }
                $postname['title'] = $title;

                if (empty($request->get("feedback"))) {
                    $data['feedback'] = "";
                } else {
                    $postname['feedback'] = $request->get("feedback");
                }


                $Userinfo = User::find($authorID);
                if (empty($request->get('acceptpostedit'))) {
                    $Userinfo->notify(new PostApproved($postname));
                }

            }


            if (empty($request->get('acceptpostedit'))) {
                $whereCond["status"] = returnConfig("pending_post");
            } else {
                $whereCond["status"] = returnConfig("accepted_post");
            }


        } else {

            $whereCond["status"] = returnConfig("draft");
            $whereCond["created_by"] = Auth::id();

        }
        if (Auth::user()->type == returnConfig("user")) {

            $loggedID = Auth::id();
            $authorFirstPost = userFirstPost($loggedID);

            if (empty($authorFirstPost)) {
                $firstarticlesubmitted = 1;
            }

        }


        Posts::where($whereCond)->update($update);


        if ($type != 3) {


            PostTags::where([
                "post_id" => $edit,
                "active" => 1
            ])->update([
                "active" => 0,
                "updated_at" => Carbon::now()
            ]);

            TempTags::where([
                "post_id" => $edit,
                "active" => 1
            ])->update([
                "active" => 0,
                "updated_at" => Carbon::now()
            ]);


            $insert = [];

            $existingTags =  Tags::select([
                DB::raw("UPPER(name) as name"),
                "id"

            ])->where([
                "active" => 1
            ])->get()->toArray();

            $existingTagsname = array_column($existingTags, "name");
            $existingTagsID = array_column($existingTags, "id");


            foreach ($tags as $key => $tag) {
                $tagsupper = strtoupper($tag);
                if (in_array($tag, $existingTagsID)) {

                    $insert[] = [
                        "tag_id" => $tag,
                        "active" => 1,
                        "post_id" => $edit,
                        "created_at" => Carbon::now()
                    ];

                    unset($tags[$key]);

                }
                elseif (in_array($tagsupper, $existingTagsname)){
                    $tagindexid = array_search($tagsupper,$existingTagsname);
                    $searchID =  $existingTagsID[$tagindexid];

                    $insert[] = [
                        "tag_id" => $searchID,
                        "active" => isActive(),
                        "post_id" => $edit,
                        "created_at" => currentTime()
                    ];
                    unset($tags[$key]);

                }

            }


            $tempTags = array_values($tags);



            if (!empty($insert)) {

                PostTags::insert($insert);

            }

            $tamptags = [];

            $existingTags =  Tags::select([
                DB::raw("UPPER(name) as name"),
                "id"

            ])->where([
                "active" => 1
            ])->get()->toArray();

            foreach ($tempTags as $tempTag) {
                $tagsupper = strtoupper($tempTag);

                if (!in_array($tagsupper, $existingTags)) {

                    $tamptags[] = [
                        "name" => $tempTag,
                        "post_id" => $edit,
                        "active" => 1,
                        "created_at" => Carbon::now()
                    ];
                }
            }


            if (!empty($tamptags)) {

                TempTags::insert($tamptags);

            }
        } else {

            if (Auth::user()->type == returnConfig("admin")) {

                createSitemap();

            }



        }

    } else {


        if (Auth::user()->type == returnConfig("user")) {

            $loggedID = Auth::id();
            $authorFirstPost = userFirstPost($loggedID);


            if (empty($authorFirstPost)) {
                $firstarticlesubmitted = 1;
            }

        }


        $postID = Posts::insertGetId([
            "title" => $title,
            "media_id" => $mediaID ?? 0,
            "description" => $desc,
            "status" => $status,
            "sports_id" => $sport ?? 0,
            "category_id" => 0,
            "type" => returnConfig("type"),
            "created_by" => Auth::id(),
            "active" => isActive(),
            "created_at" => currentTime()
        ]);



        $insert = [];
        $existingTagss = Tags::where([
            "active" => 1
        ])->get(["id","name"])->toArray();

        $existingTagsname = array_column($existingTagss, "name");
        $existingTagsID = array_column($existingTagss, "id");
        $existingTagsupper = array_map('strtoupper', $existingTagsname);

        foreach ($tags as $key => $tag) {
            $tagsupper = strtoupper($tag);
            if (in_array($tag, $existingTagsID) ) {
                $insert[] = [
                    "tag_id" => $tag,
                    "active" => isActive(),
                    "post_id" => $postID,
                    "created_at" => currentTime()
                ];
                unset($tags[$key]);
            }
            elseif (in_array($tagsupper, $existingTagsupper)){
                $tagindexid = array_search($tag,$existingTagsname);
                $searchID =  $existingTagsID[$tagindexid];
                $insert[] = [
                    "tag_id" => $searchID,
                    "active" => isActive(),
                    "post_id" => $postID,
                    "created_at" => currentTime()
                ];
                unset($tags[$key]);

            }

        }

        $tempTags = array_values($tags);
        if (!empty($insert)) {

            PostTags::insert($insert);

        }

        $tamptags = [];

        $existingTags = Tags::where([
            "active" => 1
        ])->pluck("name")->toArray();


        foreach ($tempTags as $tempTag) {

            if (!in_array($tempTag, $existingTags)) {
                $tamptags[] = [
                    "name" => $tempTag,
                    "post_id" => $postID,
                    "active" => isActive(),
                    "created_at" => currentTime()
                ];
            }
        }


        if (!empty($tamptags)) {

            TempTags::insert($tamptags);

        }
        if ($type == 1) {

            if (empty($request->get('acceptpostedit'))) {
                send_to_slack_channel(Auth::user()->name . ' / New Post / Article / ' . $title, 'sportco_activity');
            }

        }
    }


    $response = [
        "status" => 1,
        "userfirstpost" => $Userfirstpost ?? 0,
        "firstarticledrafted" => $firstarticledrafted ?? 0,
        "firstarticlesubmitted" => $firstarticlesubmitted ?? 0,
        "firstarticleapproved" => $firstarticleapproved ?? 0,
    ];


    $notificationId = Notification::insertGetId([
        "notification" => "New Post Submit",
        "active" => isActive(),
        "created_at" => currentTime()

    ]);

    NotificationStatus::insert([
        "notification_id" => $notificationId,
        "user_id" => Auth::id("admin"),
        "status" => 0,
        "active" => isActive(),
        "created_at" => currentTime()
    ]);


    return $response;




        }

        $data = getPost($edit, returnConfig("pending_post"));
        $acceptpostedit = "";
        if (empty($data['content'])){
            $data = getPost($edit, returnConfig("accepted_post"));
            $acceptpostedit = 1;
        }

        $sportsgram = getTableData(Posts::class,[
            "select"=>
                [
                    "posts.id",
                    "title",
                    "sports.name",
                    "posts.category_id as cat_id",
                    "posts.type",
                    //DB::raw("GROUP_CONCAT(media_link.id separator '" . globalSeparator() . "') as media_id"),
                    //DB::raw("GROUP_CONCAT(media_link.media_url separator '" . globalSeparator() . "') as media_data"),
                    DB::raw("GROUP_CONCAT(media_link.id separator '" . globalSeparator() . "') as media_id"),
                    DB::raw("GROUP_CONCAT(media_link.media_url separator '" . globalSeparator() . "') as media_data")
                    //DB::raw("GROUP_CONCAT(media_link.id ,',',media_link.media_url separator '" . globalSeparator() . "') as media_data")

                ],
            "joins" => [
                [
                    "table" =>"sports",
                    "type" => returnConfig("left_join"),
                    "left_condition" => "sports.id",
                    "right_condition" => "posts.sports_id"
                ],

                [
                    "table" =>"sportsgram_media",
                    "type" => returnConfig("left_join"),
                    "left_condition" => "sportsgram_media.post_id",
                    "right_condition" => "posts.id"
                ],
                [
                    "table" =>"media_link",
                    "type" => returnConfig("left_join"),
                    "left_condition" => "media_link.id",
                    "right_condition" => "sportsgram_media.media_id"
                ],
            ],
            "group"=>[
                "posts.id",
            ],
            "where" =>[
                "posts.id" => $edit,
                "sportsgram_media.active"=> isActive()

            ],"single"=>1

        ]);



        $mediaUrl = explode('!--!', $sportsgram['media_data']);
        $mediaID = explode('!--!', $sportsgram['media_id']);

        $results = array_map(function ($mediaID, $mediaUrl) {
            return array_combine(
                ['id', 'url'],
                [$mediaID, $mediaUrl]
            );
        }, $mediaID, $mediaUrl);



        $categories = Category::where([
            "active" => 1
        ])->get([
            "name",
            "id"
        ]);
        $ImageTokens = SportsgramTokens::where([
            "active"=>isActive(),
        ])->get([
            "id",
            "title",
            "tokens"
        ]);

        $sections = PostSections::where([
            "active" => 1
        ])->whereNotIn("id",[4,5])
            ->get([
                "name",
                "id"
            ]);


        $rssids = returnConfig("rss");

        // dd($sportsgram);

        return view('front.post')->with(
            [
                'sports' => $data['sport'],
                "sections" => $sections,
                'sportsgram' =>$sportsgram,
                'results' => $results,
                "categories" => $categories,
                'content' => $data['content'],
                'imagetokens' =>$ImageTokens,
                'edit' => 1,
                'acceptpostedit'=>$acceptpostedit,
                'rssids' =>$rssids
            ]
        );


    }

    public function users(Request $request)
    {

        $ajax = $request->get("ajax") ?? 0;

        if ($ajax == 1) {

            $get = ["name", "email", 'type'];


            $users = Users::where([
                'active' => 1
            ])
                ->orderBy('created_at', 'ASC')
                ->get($get);

            $data = Datatables::of($users)->editColumn('name', function ($users) {

                $case = $users->name;

                if ($users->type == returnConfig("admin")) {
                    $case .= " <span class=\"badge badge-success\">Admin</span></h1>";

                }
                return $case;

            })
                ->rawColumns(['name'])
                ->make(true);

            return $data;
        }
        return view("$this->viewFolder/pages.users")->with([]);
    }


    public function newPost(Request $request)
    {
//        $data = $request->all();
        $data = $request->all();

//        $data =  json_decode($request->getContent(), true);
        // print_r($data);die;
//        foreach ($data as $key)
//        {
//            $notificationUpdate = NotificationStatus::where([
//                "notification_id" => $data["id"],
//            ])->update([
//                "status" => 1,
//                "created_at" => Carbon::now(),
//            ]);
//
//
//        }
        // print_r("$data");die;


    }

    public function postListing(Request $request)
    {

        $ajax = $request->get("ajax") ?? 0;

        if ($ajax == 1) {


            $get = [
                "title",
                "sports.name as s_name",
                'users.name',
                "post_type.name as p_type",
                "posts.id as p_id",
                "posts.created_at",
                'posts.updated_at',
                "posts.publish_utc",
                DB::raw("SUM(DISTINCT post_stats.likes) as likes"),
                DB::raw("SUM(DISTINCT post_stats.views) as views"),

            ];

            $post = Posts::join("users", "users.id", "=", "posts.created_by")
                ->join("sports", "sports.id", "=", "posts.sports_id")
                ->join("post_type", "post_type.id", "=", "posts.type")
                ->leftjoin('post_stats', 'post_stats.post_id', '=', 'posts.id')
                ->where([
                    'posts.status' => returnConfig("accepted_post"),
                    'posts.active' => 1
                ])
                ->orderBy('posts.created_at', 'DESC')
                ->groupBy('post_stats.post_id')
                ->get($get);
            /*print_r($post->count());die;*/

//            print_r($post[19]->publish_utc);die;


            $data = Datatables::of($post)
                ->addColumn('created_at', function ($post) {

                    return date("d/m/Y H:i:s", strtotime($post->created_at));

                })
                ->addColumn('timeGap', function ($post) {
                    $publishDate = date_create($post->publish_utc);
                    $createdDate = date_create($post->created_at);
                    $diff=date_diff($publishDate,$createdDate);
                    return $diff->format("%d days ,%i min");

                })
                ->addColumn('action', function ($post) {

                    $html = '<a href="' . url("dashboard/edit-post") .'/'. $post->p_id.'" target="_blank" class="btn btn-primary">Edit Post</a>';

                    return $html;
                })
                ->editColumn('publish_utc', function ($post) {

                    return date("d/m/Y H:i:s", strtotime($post->publish_utc));

                })
                ->rawColumns(['created_at', 'publish_utc','action'])
                ->make(true);

            return $data;

        }


        return view("$this->viewFolder/pages.postlisting")->with([]);


    }

    public function contest(Request $request)
    {

        /*$get = [
                "name", "start_utc", 'end_utc', "total", "contest.id",
                DB::raw("COUNT(contest_participants.id) as participants")
            ];

            $contests = Contest::leftJoin("contest_participants", function ($query) {
                $query->on("contest.id", "=", "contest_participants.contest_id");
                $query->on("contest_participants.active", DB::raw("1"));

            })
                ->where([
                    'contest.active' => 1
                ])
                ->orderBy('contest.created_at', 'DESC')
                ->groupBy('contest.id')
                ->get($get);


        dd($contests);*/



        return view("$this->viewFolder/pages.contest");
    }

    public function contestAjax(Request $request){

        // dd("hello");

        $get = [
                "name", "start_utc", 'end_utc', "total", "contest.id",
                DB::raw("COUNT(contest_participants.id) as participants")
            ];

            $contests = Contest::leftJoin("contest_participants", function ($query) {
                $query->on("contest.id", "=", "contest_participants.contest_id");
                $query->on("contest_participants.active", DB::raw("1"));

            })
                ->where([
                    'contest.active' => 1
                ])
                ->orderBy('contest.created_at', 'DESC')
                ->groupBy('contest.id')
                ->get($get);


            $data = Datatables::of($contests)->addColumn('details', function ($contests) {
                $html = '<a target="_blank" href="' . url("dashboard/view-questions") . '/' . $contests->id . '" class="btn btn-info">Questions</a>&nbsp;&nbsp;';
                $html .= '<a href="' . url("dashboard/edit-contest") . '/' . $contests->id . '" class="btn btn-warning">Edit</a>';

                return $html;
            })->addColumn('status', function ($contests) {

                $html = '<label class="label label-primary">Live</label>';

                if ($contests->start_utc > currentTime()) {
                    $html = '<label class="label label-warning">Upcoming</label>';

                } else {

                    if ($contests->end_utc < currentTime()) {

                        $html = '<label class="label label-danger">Over</label>';

                    }

                }

                return $html;

            })->addColumn('slots', function ($contests) {

                return $contests->participants . "/" . $contests->total;

            })
                ->rawColumns(['details', 'status'])
                ->make(true);

            return $data;

    }


    public function addContest(Request $request, $id = 0)
    {

        if ($request->post()) {


            $required = [
                "c_name" => "required|min:3|max:40",
                "des_name" => "required|min:10|max:200",
                "userslot" => "required|integer|min:1|max:2000",
                "entry_token" => "required|numeric",
                "contestscore" => "required|integer|min:1",
                "daterangepicker" => "required"
            ];

            if (empty($id)) {
                $required ["image"] = 'required| mimes:jpeg,jpg,png';

            }

            $validatedData = $request->validate($required);

            $data = $request->all();

            $quizName = $data["c_name"];
            $quizDesc = $data["des_name"];
            $quizToken = $data["entry_token"];
            $quizslots = $data["userslot"];
            $daterange = $data["daterangepicker"];
            $contestscore = $data["contestscore"];

            $daterangearray = explode('-', $daterange);


            $oldstartdate = "$daterangearray[0]";
            $startutc = date("Y-m-d h:i:s", strtotime($oldstartdate));

            $oldenddate = "$daterangearray[1]";
            $endutc = date("Y-m-d h:i:s", strtotime($oldenddate));

            if ($request->hasFile('image')) {

                $media = uploadFile($request->file('image'), 'img/contest');

            }


            $common = [
                "name" => $quizName,
                "description" => $quizDesc,
                "entry" => $quizToken,
                "total" => $quizslots,
                "start_utc" => $startutc,
                "end_utc" => $endutc,
                "score" => $contestscore,
            ];


            if (!empty($media['id'])) {

                $common['media_id'] = $media['id'];

            }

            if (!empty($id)) {

                $common['updated_at'] = currentTime();

                Contest::where([
                    "id" => $id,
                    "active" => isActive()
                ])->update($common);

            } else {

                $common['created_at'] = currentTime();
                $common['active'] = isActive();

                Contest::insert($common);

            }


            return redirect("/dashboard/contest");

        }

        $contest = '';

        if (!empty($id)) {

            $contest = Contest::join("media_link", function ($query) {
                $query->on("media_link.id", "=", "contest.media_id");
                $query->on("media_link.active", DB::raw(isActive()));
            })->where([
                "contest.id" => $id,
                "contest.active" => isActive()
            ])->first([
                "name",
                "description",
                "start_utc",
                "end_utc",
                "media_url",
                "entry",
                "score",
                "total"
            ]);

        }

        return view("$this->viewFolder/pages.add_contest")->with([
            "editContest" => $contest
        ]);
    }

    public function editContest(Request $request, $id)
    {

        return $this->addContest($request, $id);

    }

    public function viewQuestions(Request $request , $id)
    {

        $ajax = $request->get("ajax") ?? 0;

        if ($ajax == 1) {

            $questions = ContestQuestionsMap::join("questions", function ($query) {
                $query->on("questions.id", "=", "contest_questions_map.question_id");
                $query->on("questions.active", DB::raw(isActive()));
            })->where([
                "contest_id" => $id,
                "contest_questions_map.active" => 1
            ])->get([
                "name",
                "questions.id"
            ]);


            $data = Datatables::of($questions)->addColumn('details', function ($questions) {

                $html = '<a href="' . url("dashboard/edit-question") . '/' . $questions->id . '" class="btn btn-warning">Edit</a>';

                return $html;
            })
                ->rawColumns(['details'])
                ->make(true);

            return $data;

        }

        return view($this->viewFolder . '.view_question')->with([
            "id" => $id
        ]);

    }

    public function addSpecificQuestions(Request $request, $id, $edit = 0)
    {
        $question = [];
        $answer = [];
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                "questions.*" => "required|min:5",
                "option" => "required",
                "is_correct" => "required",
                "image.*" => "mimes:jpeg,jpg,png"


            ]);

            $data = $request->all();


            //$validatedData["image"] = 'mimes:jpeg,jpg,png';


            foreach ($data["questions"] as $key => $question) {

                $insert = [
                    "name" => trim($question),
                    "active" => 1,
                    "created_at" => currentTime()
                ];

                $media = "";

                if (!empty($request->file('image')[$key])) {

                    $media = uploadFile($request->file('image')[$key], 'img/questions');

                }

                if (!empty($media['id'])) {

                    $insert['media_id'] = $media['id'];

                } else {
                    $insert['media_id'] = 0;
                }

                $extra = [
                    "data" => $insert,
                    "id" => 1
                ];

                $questionID = insertData(Questions::class, $extra);


                $insert = [];

                foreach ($data["option"][$key] as $k => $option) {

                    $isCorrect = 0;

                    if ($data["is_correct"][$key][0] == $k) {

                        $isCorrect = 1;

                    }

                    $insert[] = [
                        "option" => trim($option),
                        "correct" => $isCorrect,
                        "question_id" => $questionID,
                        "active" => isActive(),
                        "created_at" => currentTime()
                    ];


                }


                $extra = [
                    "data" => $insert,
                ];

                insertData(Answers::class, $extra);


                $mapperInsert[] = [
                    "contest_id" => $id,
                    "question_id" => $questionID,
                    "active" => isActive(),
                    "created_at" => currentTime()
                ];


            }


            if (!empty($mapperInsert)) {

                $extra = [
                    "data" => $mapperInsert,
                ];

                insertData(ContestQuestionsMap::class, $extra);
            }


            return redirect("dashboard/view-questions/$id");
        }


        /*        if ($edit== 1){





                    $question = Questions::join("media_link", function($query){
                        $query->on("media_link.id","=","questions.media_id");
                        $query->on("media_link.active", DB::raw(isActive()));
                    })->where([
                        "questions.id" => $id,
                        "questions.active" => isActive()
                    ])->get([
                        "name",
                    ]);


                    /*$question = Questions::join("media_link",function($query){
                        $query->on("media_link.id","=","questions.media_id");
                        $query->on("media_link.active", DB::raw(isActive()));
                    })->where([
                        "questions.id" => $id,
                        "questions.active" => 1
                    ])->get([
                        "name",
                    ]);*/
        /*

                    $question = Questions::select(
                        "name",
                        "media_url",
                        "option"

                    )->join("answers", function($query){
                        $query->on("answers.question_id","=","questions.id");

                    })->leftjoin("media_link", function($query){
                        $query->on("media_link.id","=","questions.media_id");
                        $query->on("media_link.active", DB::raw(isActive()));
                    })->where([
                        "questions.id" => $id,
                        "questions.active" => isActive()
                    ])->get();*/


        /*

                }*/

        return view($this->viewFolder . ".add_specific_questions")->with([
            "questions" => $question,
            "answers" => $answer,
            'edit' => $edit
        ]);


    }

    public function editSpecificQuestion(Request $request, $id, $edit = 1)
    {

        $question = Questions::select(
            "name",
            "questions.id",
            'media_url'
        )->leftjoin("media_link", function ($query) {
            $query->on("media_link.id", "=", "questions.media_id");
            $query->on("media_link.active", DB::raw(isActive()));
        })
            ->where([
                "questions.id" => $id,
                "questions.active" => isActive()
            ])->first();

        $questionmap = ContestQuestionsMap::select([
            'contest_id',

        ])->leftjoin("questions", function ($query) {
            $query->on("questions.id", "=", "contest_questions_map.question_id");
            $query->on("questions.active", DB::raw(isActive()));
        })->where([
            "question_id" => $id,
            "questions.active" => isActive()
        ])
            ->first();


        $answer = Answers::select('option', 'correct')->where([
            "question_id" => $id,
            "active" => isActive()
        ])->get()->toArray();

        if ($request->isMethod('post')) {

            $validatedData = $request->validate([
                "questions.*" => "required|min:5",
                "option" => "required",
                "is_correct" => "required",
                "image.*" => "mimes:jpeg,jpg,png"


            ]);

            $data = $request->all();

            $question = $data["questions"];
            $update = [
                "name" => trim($question),
                "active" => 1,
                "updated_at" => currentTime()
            ];

            $media = "";


            if (!empty($request->file('image')[0])) {

                $media = uploadFile($request->file('image')[0], 'img/questions');


            }

            if (!empty($media['id'])) {

                $update['media_id'] = $media['id'];

            }

            Questions::where([
                "id" => $id,
                "active" => 1
            ])->update($update);


            Answers::where([
                'active' => 1,
                'question_id' => $id
            ])
                ->update(['active' => 0]);


            foreach ($data["option"][0] as $k => $option) {

                $isCorrect = 0;

                if ($data["is_correct"][0][0] == $k) {

                    $isCorrect = 1;

                }

                $insert[] = [
                    "option" => $option,
                    "correct" => $isCorrect,
                    "question_id" => $id,
                    "active" => isActive(),
                    "created_at" => currentTime()
                ];

            }


            $extra = [
                "data" => $insert,
            ];

            insertData(Answers::class, $extra);


            return redirect("dashboard/view-questions/$questionmap->contest_id");
        }

        return view($this->viewFolder . ".add_specific_questions")->with([
            "questions" => $question,
            "answers" => $answer,
            'edit' => $edit
        ]);


        //return $this->addSpecificQuestions($request, $id, 1);

    }

    public function game()
    {



        /*$contest = Games::select(["name", "start_utc", "games.id",
                    DB::raw("CAST(IFNULL(SUM(game_sessions.time) / (COUNT(DISTINCT games_participants.id) * COUNT(DISTINCT game_sessions.id)), 0) AS UNSIGNED) as timeframe"),
                    DB::raw("COUNT(DISTINCT games_participants.id) as participants"),
                    DB::raw("MAX(game_sessions.score) as highest_sore"),
                    DB::raw("COUNT(DISTINCT game_sessions.user_id) as user_count")])
                    ->join('game_sessions' , 'game_sessions.game_id' , '=', 'games.id')
                    ->join('games_participants' , 'games_participants.game_id' , '=', 'games.id')
                    ->where("game_sessions.active", DB::raw("1"))
                    ->where("game_sessions.completed", DB::raw("1"))
                    ->where("games.active", DB::raw("1"))
                    ->where("games_participants.active", DB::raw("1"))
                    ->where('games.active' , 1)
                    ->orderBy('games.created_at', 'DESC')
                    ->groupBy('games.id')
                    ->get();*/

                    // dd($contest);


                    /*$get = [
                "name", "start_utc", "games.id",
                DB::raw("CAST(IFNULL(SUM(game_sessions.time) / (COUNT(DISTINCT games_participants.id) * COUNT(DISTINCT g_sessions.id)), 0) AS UNSIGNED) as timeframe"),
                DB::raw("COUNT(DISTINCT games_participants.id) as participants"),
                DB::raw("MAX(game_sessions.score) as highest_sore"),
                DB::raw("COUNT(DISTINCT g_sessions.user_id) as user_count")
            ];

            $contests = Games::Join("game_sessions",function ($query){
                $query->on("game_sessions.game_id" , "=", "games.id" );
                $query->on("game_sessions.active", DB::raw("1"));
            })
                ->Join("game_sessions as g_sessions",function ($query){
                    $query->on("g_sessions.game_id" , "=", "games.id" );
                    $query->on("g_sessions.active", DB::raw("1"));
                    $query->on("g_sessions.completed", DB::raw("1"));
                })
                ->Join("games_participants", function ($query) {
                    $query->on("games.id", "=", "games_participants.game_id");
                    $query->on("games_participants.active", DB::raw("1"));

                })
                ->where([
                    'games.active' => isActive()
                ])
                ->orderBy('games.created_at', 'DESC')
                ->groupBy('games.id')
                ->get($get);
                
                dd($contests);*/

        return view("$this->viewFolder.game");
    }

    public function gameGet(Request $request){

        /*$get = [
                "name", "start_utc", "games.id",
                DB::raw("CAST(IFNULL(SUM(game_sessions.time) / (COUNT(DISTINCT games_participants.id) * COUNT(DISTINCT g_sessions.id)), 0) AS UNSIGNED) as timeframe"),
                DB::raw("COUNT(DISTINCT games_participants.id) as participants"),
                DB::raw("MAX(game_sessions.score) as highest_sore"),
                DB::raw("COUNT(DISTINCT g_sessions.user_id) as user_count")
            ];*/

            /*$contests = Games::select(

                [
                    "name", "start_utc", "games.id",
                    DB::raw("CAST(IFNULL(SUM(game_sessions.time) / (COUNT(DISTINCT games_participants.id) * COUNT(DISTINCT g_sessions.id)), 0) AS UNSIGNED) as timeframe"),
                    DB::raw("COUNT(DISTINCT games_participants.id) as participants"),
                    DB::raw("MAX(game_sessions.score) as highest_sore"),
                    DB::raw("COUNT(DISTINCT g_sessions.user_id) as user_count")
                ]
            )->leftJoin("game_sessions",function ($query){
                $query->on("game_sessions.game_id" , "=", "games.id" );
                // $query->on("game_sessions.active", DB::raw("1"));
            })
                ->leftJoin("game_sessions as g_sessions",function ($query){
                    $query->on("g_sessions.game_id" , "=", "games.id" );
                    // $query->on("g_sessions.active", DB::raw("1"));
                    // $query->on("g_sessions.completed", DB::raw("1"));
                })
                ->leftJoin("games_participants", function ($query) {
                    $query->on("games.id", "=", "games_participants.game_id");
                    // $query->on("games_participants.active", DB::raw("1"));

                })
                ->where([
                    'games.active' => isActive()
                ])
                ->orderBy('games.created_at', 'DESC')
                ->groupBy('games.id')
                ->get();*/

                

                    $contests = Games::select(["name", "start_utc", "games.id",
                    DB::raw("CAST(IFNULL(SUM(game_sessions.time) / (COUNT(DISTINCT games_participants.id) * COUNT(DISTINCT game_sessions.id)), 0) AS UNSIGNED) as timeframe"),
                    DB::raw("COUNT(DISTINCT games_participants.id) as participants"),
                    DB::raw("MAX(game_sessions.score) as highest_sore"),
                    DB::raw("COUNT(DISTINCT game_sessions.user_id) as user_count")])
                    ->leftjoin('game_sessions' , 'game_sessions.game_id' , '=', 'games.id')
                    ->leftjoin('games_participants' , 'games_participants.game_id' , '=', 'games.id')
                    // ->where("game_sessions.active", DB::raw("1"))
                    // ->where("game_sessions.completed", DB::raw("1"))
                    // ->where("games_participants.active", DB::raw("1"))
                    ->where('games.active' , 1)
                    ->orderBy('games.created_at', 'DESC')
                    ->groupBy('games.id')
                    ->get();


            $data = Datatables::of($contests)->addColumn('details', function ($contests) {

                // dd($contests->id);
                $html = '<a target="_blank" href="' . url("dashboard/view-game-questions") . '/' . $contests->id . '" class="btn btn-info">Questions</a>&nbsp;&nbsp;';
                $html .= '<a href="' . url("dashboard/edit-game") . '/' . $contests->id . '" class="btn btn-warning">Edit</a>';

                return $html;
            })->addColumn('status', function ($contests) {

                $html = '<label class="label label-primary">Live</label>';

                if ($contests->start_utc > currentTime()) {
                    $html = '<label class="label label-warning">Upcoming</label>';

                } 

                return $html;

            })
                ->rawColumns(['details', 'status'])
                ->make(true);

                // dd($data);

            return $data;
        
    }






    public function editGame(Request $request, $id)
    {
        return $this->addGames($request, $id);

    }


    public function addGames(Request $request, $id = 0)
    {


        if ($request->isMethod('post')) {
        
            // dd("hello");

            $required = [
                "c_name" => "required|min:3|max:40",
                "sports" => "required",
                "des_name" => "required|min:10|max:200",
                "entry_token" => "required|numeric",
                "contestscore" => "required|integer|min:1",
                "start_date" => "required",
                "start_time" => "required",
                "tags" => "required"
            ];


            if (empty($id)) {
                $required["image"] = 'required';

            }


            $validatedData = $request->validate($required);


            $data = $request->post();

            $quizName = $data["c_name"];
            $slug = implode("-", explode(" ", $quizName)) . "-" . rand(100000, 999999);
            $sports = $data["sports"];
            $quizDesc = $data["des_name"];
            $quizToken = $data["entry_token"];

            $tags = $request->get("tags");

            $startDate = date("Y-m-d", strtotime($data["start_date"]));
            $startTime = date("H:i:s", strtotime($data["start_time"]));
            $contestscore = $data["contestscore"];

            $startutc = $startDate . " " . $startTime;

            if ($request->hasFile('image')) {

                $media = uploadFile($request->file('image'), 'img/game');

            }


            $common = [
                "name" => $quizName,
                "description" => $quizDesc,
                "entry" => $quizToken,
                "start_utc" => $startutc,
                "sport_id" => $sports,
                "score" => $contestscore,
                "slug" => $slug
            ];


            if (!empty($media['id'])) {

                $common['media_id'] = $media['id'];

            }

            if (!empty($id)) {

                $common['updated_at'] = currentTime();

                Games::where([
                    "id" => $id,
                    "active" => isActive()
                ])->update($common);


                GameTags::where([
                    "game_id" => $id,
                    "active" => isActive()
                ])->update([
                    "active" => 0,
                    "updated_at" => currentTime()
                ]);

                $gameID = $id;

            } else {

                $common['created_at'] = currentTime();
                $common['active'] = isActive();

                $gameID = Games::insertGetId($common);

            }

            if (!empty($gameID) && !empty($tags)) {

                $existingTags = Tags::where([
                    "active" => 1
                ])->whereIn("id", $tags)->get(["name", "id"])->toArray();

                $tagName = array_column($existingTags, "name");
                $tagIDs = array_column($existingTags, "id");

                foreach ($tags as $tag) {

                    if (!in_array($tag, $tagName) && !in_array($tag, $tagIDs)) {

                        $tags = [
                            "name" => $tag,
                            "active" => isActive(),
                            "created_at" => currentTime()
                        ];

                        $tagID = Tags::insertGetId($tags);
                    } elseif (in_array($tag, $tagIDs)) {

                        $tagID = $tag;

                    }

                    GameTags::insert([
                        "game_id" => $gameID,
                        "tag_id" => $tagID,
                        "active" => 1,
                        "created_at" => Carbon::now()
                    ]);
                }

            }

            return redirect("/dashboard/game");

        }

        $contest = '';

        if (!empty($id)) {

            $contest = Games::join("media_link", function ($query) {
                $query->on("media_link.id", "=", "games.media_id");
                $query->on("media_link.active", DB::raw(isActive()));
            })->leftJoin("game_tags", function ($query) {
                $query->on("game_tags.game_id", "=", "games.id");
                $query->on("game_tags.active", DB::raw(isActive()));
            })->leftJoin("tags", function ($query) {
                $query->on("game_tags.tag_id", "=", "tags.id");
                $query->on("tags.active", DB::raw(isActive()));
            })
                ->where([
                    "games.id" => $id,
                    "games.active" => isActive()
                ])->first([
                    "games.name",
                    "sport_id",
                    "description",
                    "start_utc",
                    "media_url",
                    "entry",
                    "score",
                    DB::raw("group_concat(DISTINCT tags.name SEPARATOR '" . returnConfig("column_separator") . "')  as tag_name, 
                group_concat(DISTINCT tags.id SEPARATOR '" . returnConfig("column_separator") . "')  as tag_id"),
                ]);

        }

        $sports = getTableData(Sports::class, [
            "select" => [
                "id",
                "name"
            ],
            "order" => [
                "name" => "ASC"
            ]
        ]);

        return view("$this->viewFolder.add_game")->with([
            "editContest" => $contest,
            "sports" => $sports
        ]);
    }

    

    public function viewGameQuestions(Request $request , $id)
    {

        $ajax = $request->ajax() ?? 0;

        if ($ajax == 1) {

            $questions = GameQuestionsMap::join("questions", function ($query) {
                $query->on("questions.id", "=", "game_questions_map.question_id");
                $query->on("questions.active", DB::raw(isActive()));
            })->where([
                "game_id" => $id,
                "game_questions_map.active" => 1
            ])->get([
                "name",
                "questions.id"
            ]);


            $data = Datatables::of($questions)->addColumn('details', function ($questions) {

                $html = '<a href="' . url("dashboard/edit-game-question") . '/' . $questions->id . '" class="btn btn-warning">Edit</a>';

                return $html;
            })
                ->rawColumns(['details'])
                ->make(true);

            return $data;

        }

        return view($this->viewFolder . '.view_question')->with([
            "id" => $id,
            "type" => 1
        ]);

    }

    public function addGameQuestions(Request $request, $id, $edit = 0)
    {
        $question = [];
        $answer = [];
        if ($request->isMethod('post')) {
            
            $validatedData = $request->validate([
                "questions.*" => "required|min:5|max:150",
                "option" => "required",
                "is_correct" => "required",
                "image.*" => "mimes:jpeg,jpg,png"
            ]);

            $data = $request->post();

            //$validatedData["image"] = 'mimes:jpeg,jpg,png';


            foreach ($data["questions"] as $key => $question) {

                $insert = [
                    "name" => trim($question),
                    "active" => 1,
                    "created_at" => currentTime()
                ];

                $media = "";

                if (!empty($request->file('image')[$key])) {

                    $media = uploadFile($request->file('image')[$key], 'img/questions');

                }

                if (!empty($media['id'])) {

                    $insert['media_id'] = $media['id'];

                } else {
                    $insert['media_id'] = 0;
                }

                $extra = [
                    "data" => $insert,
                    "id" => 1
                ];

                $questionID = insertData(Questions::class, $extra);


                $insert = [];

                foreach ($data["option"][$key] as $k => $option) {

                    $isCorrect = 0;

                    if ($data["is_correct"][$key][0] == $k) {

                        $isCorrect = 1;

                    }

                    $insert[] = [
                        "option" => trim($option),
                        "correct" => $isCorrect,
                        "question_id" => $questionID,
                        "active" => isActive(),
                        "created_at" => currentTime()
                    ];

                }

                $extra = [
                    "data" => $insert,
                ];

                insertData(Answers::class, $extra);


                $mapperInsert[] = [
                    "game_id" => $id,
                    "question_id" => $questionID,
                    "active" => isActive(),
                    "created_at" => currentTime()
                ];

            }

            if (!empty($mapperInsert)) {

                $extra = [
                    "data" => $mapperInsert,
                ];

                insertData(GameQuestionsMap::class, $extra);
            }


            return redirect("dashboard/view-game-questions/$id");
        }


        /*        if ($edit== 1){





                    $question = Questions::join("media_link", function($query){
                        $query->on("media_link.id","=","questions.media_id");
                        $query->on("media_link.active", DB::raw(isActive()));
                    })->where([
                        "questions.id" => $id,
                        "questions.active" => isActive()
                    ])->get([
                        "name",
                    ]);


                    /*$question = Questions::join("media_link",function($query){
                        $query->on("media_link.id","=","questions.media_id");
                        $query->on("media_link.active", DB::raw(isActive()));
                    })->where([
                        "questions.id" => $id,
                        "questions.active" => 1
                    ])->get([
                        "name",
                    ]);*/
        /*

                    $question = Questions::select(
                        "name",
                        "media_url",
                        "option"

                    )->join("answers", function($query){
                        $query->on("answers.question_id","=","questions.id");

                    })->leftjoin("media_link", function($query){
                        $query->on("media_link.id","=","questions.media_id");
                        $query->on("media_link.active", DB::raw(isActive()));
                    })->where([
                        "questions.id" => $id,
                        "questions.active" => isActive()
                    ])->get();*/


        /*

                }*/

        return view($this->viewFolder . ".add_specific_questions")->with([
            "questions" => $question,
            "answers" => $answer,
            'edit' => $edit
        ]);

    }
    

    public function editGameQuestion(Request $request, $id, $edit = 1)
    {

        $question = Questions::select(
            "name",
            "questions.id",
            'media_url'
        )->leftjoin("media_link", function ($query) {
            $query->on("media_link.id", "=", "questions.media_id");
            $query->on("media_link.active", DB::raw(isActive()));
        })
            ->where([
                "questions.id" => $id,
                "questions.active" => isActive()
            ])->first();


        $questionmap = GameQuestionsMap::select([
            'game_id as contest_id',

        ])->leftjoin("questions", function ($query) {
            $query->on("questions.id", "=", "game_questions_map.question_id");
            $query->on("questions.active", DB::raw(isActive()));
        })->where([
            "question_id" => $id,
            "questions.active" => isActive()
        ])
            ->first();


        $answer = Answers::select('option', 'correct')->where([
            "question_id" => $id,
            "active" => isActive()
        ])->get()->toArray();
            // dd($answer);

        if ($request->isMethod('post')) {

            $validatedData = $request->validate([
                "questions.*" => "required|min:5",
                "option" => "required",
                "is_correct" => "required",
                "image.*" => "mimes:jpeg,jpg,png"


            ]);

            $data = $request->post()/*->ajax()*/;

            $question = $data["questions"];
            // dd($question);
            $update = [
                "name" => trim($question),
                "active" => 1,
                "updated_at" => currentTime()
            ];

            $media = "";


            if (!empty($request->file('image')[0])) {

                $media = uploadFile($request->file('image')[0], 'img/questions');


            }

            if (!empty($media['id'])) {

                $update['media_id'] = $media['id'];

            }

            Questions::where([
                "id" => $id,
                "active" => 1
            ])->update($update);


            Answers::where([
                'active' => 1,
                'question_id' => $id
            ])
                ->update(['active' => 0]);


            foreach ($data["option"][0] as $k => $option) {

                $isCorrect = 0;

                if ($data["is_correct"][0][0] == $k) {

                    $isCorrect = 1;

                }

                $insert[] = [
                    "option" => $option,
                    "correct" => $isCorrect,
                    "question_id" => $id,
                    "active" => isActive(),
                    "created_at" => currentTime()
                ];

            }


            $extra = [
                "data" => $insert,
            ];

            insertData(Answers::class, $extra);


            return redirect("dashboard/view-game-questions/$questionmap->contest_id");
        }

        return view($this->viewFolder . ".add_specific_questions")->with([
            "questions" => $question,
            "answers" => $answer,
            'edit' => $edit
        ]);


        //return $this->addSpecificQuestions($request, $id, 1);

    }

    public function importGameQuestions(Request $request, $id)
    {
        // dd($id);
        if ($request->isMethod("post")) {

            $up = uploadFile($request->file('image'), 'csv/games');


            $handle = fopen(public_path('csv/games/' . $up["name"]), "r");

            $i = 0;

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                if ($i > 0) {
                    $sports = trim($data[1]);

                    $category = trim($data[2]);
                    $topic = trim($data[3]);
                    $question_title = trim($data[5]);

                    if (empty($question_title)) {

                        continue;

                    }


                    $level = trim($data[7]);

                    $a1 = trim($data[8]);
                    $a2 = trim($data[9]);
                    $a3 = trim($data[10]);
                    $a4 = trim($data[11]);

                    $correct_a = trim($data[12]);

                    switch ($correct_a) {
                        case 'A':
                            $final_answer = 1;
                            break;
                        case 'B':
                            $final_answer = 2;
                            break;
                        case 'C':
                            $final_answer = 3;
                            break;
                        case 'D':
                            $final_answer = 4;
                            break;
                        default:
                            break;
                    }


                    $right_answer = trim($data[13]);

                    $after_taste = trim($data[14]);

                    $hint = trim($data[15]);

                    /*       $check = getTableData(Sports::class,[
                               "select" => [
                                   "id"
                               ],
                               "whereOperand" => [
                                   [
                                       "column" => "name",
                                       "operand" => "like",
                                       "value" => "%". $sports . "%"
                                   ]
                               ],
                               "single" => 1
                           ]);

                           if (!empty($check->xid)) {

                               $insert_sports_id = $check->id;

                           } else {


                               $insert_sports_id = insertData(Sports::class,[
                                   "data" => [
                                       "name" => $sports,
                                       "active" => isActive(),
                                       "created_at" => currentTime()
                                   ],
                                   "id"   => 1
                               ]);

                           }*/


                    $questionID = insertData(Questions::class, ["data" => [
                        "name" => $question_title,
                        "media_id" => 0,
                        "type" => 0,
                        "active" => isActive(),
                        "created_at" => currentTime()
                    ], "id" => 1]);

                    $answers = [];

                    for ($j = 1; $j <= 4; $j++) {

                        $is_correct_answer = ($final_answer == $j) ? 1 : 0;

                        $answers[] = [
                            "question_id" => $questionID,
                            "option" => ${'a' . $j},
                            "correct" => $is_correct_answer,
                            "active" => isActive(),
                            "created_at" => currentTime()
                        ];


                    }

                    if (!empty($answers)) {

                        insertData(Answers::class, [
                            "data" => $answers
                        ]);

                    }

                    $map[] = [
                        "game_id" => $id,
                        "question_id" => $questionID,
                        "active" => isActive(),
                        "created_at" => currentTime()
                    ];


                }

                $i = 1;

            }


            if (!empty($map)) {

                insertData(GameQuestionsMap::class, [
                    "data" => $map
                ]);

            }

            return redirect('dashboard/view-game-questions/' . $id);


        }

        return view($this->viewFolder . ".import_game_questions");

    }

    public function products(Request $request)
    {

        $ajax = $request->get("ajax") ?? 0;

        if ($ajax == 1) {


            $get = ["products.name", "quantity", "products.id", "published", "token", "price", "currency.sign"];

            $products = getTableData(Products::class, [
                "select" => $get,
                "joins" => [
                    [
                        "table" => "currency",
                        "type" => returnConfig("left_join"),
                        "left_condition" => "currency.id",
                        "right_condition" => "products.currency_id"
                    ]
                ]
            ]);

            $data = Datatables::of($products)->addColumn('details', function ($products) {


                $html = '<a target="_blank" href="' . url("dashboard/products/edit", [$products->id]) . '" class="btn btn-warning">Edit</a>';


                return $html;
            })
                ->addColumn('money', function ($products) {


                    return $products->sign . $products->price;

                })
                ->editColumn('published', function ($products) {


                    $html = '<label class="label label-success">Published</label>';

                    if (empty($products->published)) {

                        $html = '<label class="label label-danger">Not Published</label>';

                    }


                    return $html;
                })
                ->rawColumns(['details', 'published','money'])
                ->make(true);

            return $data;

        }

        return view("$this->viewFolder.products");

    }

    public function addProduct(Request $request, $id = 0)
    {

        if ($request->post()) {


            $required = [
                "name" => "required|min:3|max:40",
                "des_name" => "required|min:10|max:200",
                "token" => "required_unless:type,0|nullable|numeric",
                "currency" => "required|integer",
                "quantity" => "required|integer",
                "category" => "required|integer",
                "price" => "required|numeric",
                "tags" => "required",
                "publish" => "required",
                "type" => "required|integer|min:0|max:2"
            ];

            if (empty($id)) {

                $required ["image"] = 'required|mimes:jpeg,jpg,png';

            }

            $validatedData = $request->validate($required);

            $data = $request->get();


            $name = $data["name"];


            $slug = implode("-", explode(" ", $name)) . "-" . rand(100000, 999999);

            $desc = $data["des_name"];

            $token = $data["token"] ?? 0;

            $tags = $request->get("tags");

            $currency = $data["currency"];

            $price = $data["price"];

            $publish = ($data["publish"] == "on") ? 1 : 0;

            $type = $data["type"];

            $category = $data["category"];

            $quantity = $data["quantity"];

            if ($request->hasFile('image')) {

                $media = uploadFile($request->file('image'), 'img/product');

            }


            $common = [
                "name" => $name,
                "description" => $desc,
                "token" => $token,
                "currency_id" => $currency,
                "category_id" => $category,
                "price" => $price,
                "type" => $type,
                "quantity" => $quantity,
                "slug" => $slug,
                "published" => $publish
            ];


            if (!empty($media['id'])) {

                $common['media_id'] = $media['id'];

            }

            if (!empty($id)) {

                $common['updated_at'] = currentTime();

                updateData(Products::class, [
                    "update" => $common,
                    "where" => [
                        "id" => $id,
                    ]
                ]);

                updateData(ProductTags::class, [
                    "update" => [
                        "active" => 0
                    ],
                    "where" => [
                        "product_id" => $id,
                    ]
                ]);

                $productID = $id;

            } else {

                $common['created_at'] = currentTime();

                $common['active'] = isActive();

                $productID = insertData(Products::class, [
                    "data" => $common,
                    "id" => 1
                ]);

            }

            if (!empty($productID) && !empty($tags)) {

                $existingTags = getTableData(Tags::class, [
                    "select" => ["name", "id"],
                    "whereIn" => [
                        "id" => $tags
                    ]
                ])->toArray();

                $tagName = array_column($existingTags, "name");
                $tagIDs = array_column($existingTags, "id");

                foreach ($tags as $tag) {

                    if (!in_array($tag, $tagName) && !in_array($tag, $tagIDs)) {

                        $tags = [
                            "name" => $tag,
                            "active" => isActive(),
                            "created_at" => currentTime()
                        ];

                        $tagID = insertData(Tags::class, [
                            "data" => $tags,
                            "id" => 1
                        ]);
                    } elseif (in_array($tag, $tagIDs)) {

                        $tagID = $tag;

                    }

                    insertData(ProductTags::class, [
                        "data" => [
                            "product_id" => $productID,
                            "tag_id" => $tagID,
                            "active" => 1,
                            "created_at" => currentTime()
                        ]
                    ]);
                }

            }

            return redirect("/dashboard/products");

        }

        $currencies = getCurrencies();


        $edit = '';

        if (!empty($id)) {

            $edit = getTableData(Products::class, [
                "select" => [
                    "products.name",
                    "description",
                    "quantity",
                    "currency_id",
                    "category_id",
                    "store_categories.name as cat_name",
                    "token",
                    "price",
                    "products.type",
                    "published",
                    "media_link.media_url",
                    DB::raw("group_concat(DISTINCT tags.name SEPARATOR '" . returnConfig("column_separator") . "')  as tag_name, 
                group_concat(DISTINCT tags.id SEPARATOR '" . returnConfig("column_separator") . "')  as tag_id"),
                ],
                "joins" => [
                    [
                        "table" => "media_link",
                        "type" => returnConfig("inner_join"),
                        "left_condition" => "media_link.id",
                        "right_condition" => "products.media_id",
                    ],
                    [
                        "table" => "product_tags",
                        "type" => returnConfig("left_join"),
                        "left_condition" => "product_tags.product_id",
                        "right_condition" => "products.id",
                    ],
                    [
                        "table" => "tags",
                        "type" => returnConfig("inner_join"),
                        "left_condition" => "product_tags.tag_id",
                        "right_condition" => "tags.id",
                    ],
                    [
                        "table" => "store_categories",
                        "type" => returnConfig("inner_join"),
                        "left_condition" => "store_categories.id",
                        "right_condition" => "products.category_id",
                    ]
                ],
                "where" => [
                    "products.id" => $id
                ],
                "single" => 1
            ]);

        }

        return view("$this->viewFolder.add_product")->with([
            'currencies' => $currencies,
            'edit' => $edit
        ]);

    }

    public function editProduct(Request $request, $id)
    {

        return $this->addProduct($request, $id);


    }

    public function storeCategory(Request $request)
    {

        if ($request->isMethod("post")) {

            $required = [
                "name" => "required|min:3|max:40",
            ];

            $validatedData = $request->validate($required);

            $data = $request->  get();

            $parentID = $data['parent_category'] ?? 0;

            $name = $data['name'];

            insertData(StoreCategory::class, [
                "data" => [
                    'name' => $name,
                    'parent_id' => $parentID,
                    'active' => isActive(),
                    'created_at' => currentTime()
                ]
            ]);

        }


        $category = getTableData(StoreCategory::class, [
            "select" => ["name", "id"],
            "where" => ["parent_id" => 0]
        ]);

        return view("$this->viewFolder.store_category")->with("categories", $category);

    }

    public function searchStoreCategory(Request $request)
    {

        if ($request->isMethod("get")) {


            $categories = getTableData(StoreCategory::class, [
                "select" => ['text' => 'name', 'id'],
                "whereOperand" => [[
                    "column" => "name",
                    "operand" => "like",
                    "value" => "%" . trim($request->get('q')) . "%"
                ]]
            ]);

            return ["data" => $categories, "total_count" => $categories->count()];

        }

    }

    public function tokenRequest()
    {
        $userlist = getTableData(Transactions::class, [
            "select" => [
                "transactions.created_at",
                "tokens",
                "users.id as user_id",
                "name",
                "email",
                "transaction_id",
                "spco_tokenval",
                "withdrawalToken",
                "eth_usd",
                "wallet_address"
            ],
            "joins" => [
                [
                    "table" => "users",
                    "type" => returnConfig("inner_join"),
                    "left_condition" => "transactions.user_id",
                    "right_condition" => "users.id",

                ],
                [
                    "table" => "wallet",
                    "type" => returnConfig("inner_join"),
                    "left_condition" => "transactions.wallet_id",
                    "right_condition" => "wallet.id",

                ],

            ],
            "where" => [
                "transactions.status" => 0,
            ],
            "order" => [
                "transactions.created_at" => "DESC"
            ]


        ]);


        /*print_r($userlist);die;*/
        return view("$this->viewFolder.withdrawal_token")->with
        (
            "UsersRequestLists", $userlist
        );
    }

    public function tokenApprove(Request $request)
    {
        /*print_r("sadfasd");die;*/

        $status = "";
        if ($request->isMethod('post')) {
            $data = $request->all();
        


            $datetime = Carbon::now();
            $toUser = User::find($data['userId']);
            $balanceToken = userTokens($data['userId'] ?? 0) + $data['token'];
            $emaildata = [
                'username' => $data['username'],
                'transactionID' => $data['transactionID'],
                'Amount_requested' => $data['token'],
                'reason' => $data['reason'],
                'balaceToken' => $balanceToken,
                'transaction_fee' => $data['transactionfee'],
                'amount_receivable' => $data['wdtoken'],
                'carbondate' => $datetime->toFormattedDateString(),
                'carbontime' => $datetime->toTimeString()
            ];

            /*$update['active'] = 1;*/

            if ($data['type'] == 1) {

                DB::table('transactions')
                    ->where('transaction_id', $data['transactionID'])
                    ->update([
                        'status' => 1,
                        'updated_at' => Carbon::now()
                    ]);

                $update = [
                    'user_id' => $data['userId'] ?? 0,
                    'reward_id' => returnConfig('tokenRedeem'),
                    'tokens' => $data['token'],
                    'active' => DB::raw(isActive()),
                    'created_at' => Carbon::now(),
                ];
                UserRewards::insert($update);
                $toUser->notify(new TransactionProcessed($emaildata));
                $status = 1;

            } elseif ($data['type'] == 2) {

                //print_r($data['value']);die;

                $required = [
                    "reason" => "required",
                ];
                $validatedData = $request->validate($required);

                DB::table('transactions')
                    ->where('transaction_id', $data['transactionID'])
                    ->update([
                        'status' => 2,
                        'updated_at' => Carbon::now(),
                        "reason" => $data['reason']

                    ]);

                $toUser->notify(new TokenDeclined($emaildata));

            }

            $status = 1;

        }

        return $status;

    }

    public function siteSetting(Request $request)
    {
        $ETHUSDValue = getETHinUSD();
        $tokenvalue = tokenvalue($ETHUSDValue);



        $users = users::all();
        $email = [];
        foreach ($users as $user) {
            $email[] = $user->email;
        }


        if ($request->isMethod('post')) {


            $formdata = $request->all();

            /*print_r($formdata );die;*/
            /*print_r($formdata['admin_id'] );die;*/
            /*$extra = [
                "data" => [
                    "email"=> $formdata['admin_email'],
                ]
            ];

            insertData(SiteMeta::class,$extra);*/


            $required = [
                "1_s" => "required|numeric",
                "2_s" => "required|numeric"
            ];
            $messages = array(
                'numeric' => 'The input field must be a number.',
                'required' => 'Both field are required'

            );


            $validatedData = $request->validate($required,$messages);
            /*
            print_r($key);die;*/


            foreach ($formdata as $key => $d) {
                $newkey = str_replace("_s", "",$key );



                if ($newkey  == "_token") {
                    continue;
                }

                updateData(SiteMeta::class, [
                    "update" => [
                        "value" => $d,
                    ],
                    "where" => [
                        "id" => $newkey
                    ]
                ]);
            }

        }

        $data = getTableData(SiteMeta::class, [
            "select" => [
                "name",
                "value",
                "id"
            ],
            "active" => 1,
        ]);

        return view("$this->viewFolder.token_setting")->with([
            "datas" => $data,
            "email" => $email,
            "ETHUSD" => $ETHUSDValue,
            "meta_info" =>$tokenvalue,
        ]);
    }
    public  function communityUsers(Request $request){

        return view("$this->viewFolder.communityUser");
    }

    public  function communityUsersAjax(Request $request){


        $user = getTableData(User::class,[
                "select" => [
                    DB::raw("DATE_FORMAT(DATE(created_at), \"%d-%M-%Y\") as date, COUNT(id) as count"),
                ],
                "where" => [
                    "referred_by" => 273
                ],
                "group" => [
                    DB::raw('DATE(created_at)')
                ]
            ]);

            $data = Datatables::of($user)->make(true);

            return $data;
    }

    

}













