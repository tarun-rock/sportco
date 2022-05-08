<?php

namespace App\Http\Controllers;

use App\Model\Answers;
use App\Model\ContestQuestionsMap;
use App\Model\ContestUserAnswers;
use App\Model\Games;
use App\Model\GameSessions;
use App\Model\InfluencersCommunities;
use App\Model\MasterRewards;
use App\Model\Posts;
use App\Model\PostStats;
use App\Model\PriceDistribution;
use App\Model\Users;
use App\Model\Transactions;

use Illuminate\Support\Str;


use App\Model\SiteMeta;
use App\Model\Sports;
use App\Message;
use App\Model\Otp;
use App\Model\Wallet;
use App\Notifications\AdminNotification;
use App\Notifications\TransactionProcessed;
use App\Notifications\AuthorizationCode;
use App\Model\GameQuestionsMap;
/*use App\Transactions;*/


use Gloudemans\Shoppingcart\Facades\Cart;
use Notification;
use App\Model\NotificationStatus;

/*use App\Model\Products;*/

/*use Illuminate\Pagination\Paginator;*/

/*use Illuminate\Support\Facades\Paginator;*/

use \Illuminate\Pagination\LengthAwarePaginator;
use App\Model\UserDetails;
use App\Model\TermsHistory;
use App\Model\Contest;
use App\Model\UserRewards;
use App\User;
use Carbon\Carbon;
use DB;
use function foo\func;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Method;


/*var WAValidator = require('wallet-address-validator');*/


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check_access');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd("hello");

        $id = Auth::id();
        $userposts = Posts::where([
            'created_by' => $id,
            'active' => '1',
            'status' => '1'
        ])->first();

        //Cache::flush();


        $data = '';
        /*if(get::get('ajax')==1) {
            $data = Posts::where([
                'posts.active' => 1,
                'posts.status' => returnConfig("accepted_post"),])
                ->join('users', 'users.id', '=', 'posts.created_by')
                ->leftjoin('media_link', 'media_link.id', '=', 'posts.media_id')
//            ->limit(5)
                ->orderBy("posts.publish_utc", "DESC")
                ->select(['posts.title', "posts.id", 'media_url', 'users.name as user_name', 'posts.publish_utc',
                    'users.id as user_id', 'posts.slug', 'posts.description'
                ])->paginate(4);

            return $data;
        }*/
        $sportsgram = sportsgramFetch(7, "");

        
        //$sportsgram = fetchPost("","7","",returnConfig("sportsgramtype"));


        //$r = explode('!--!',$sportsgram[0]->media_data);


        $db_nickname = 0; // nickname not exist
        if (Auth::user()) {
            $userinfo = Users::where([
                "id" => $id,
                "active" => 1
            ])->first();
            if (!empty($userinfo->nickname)) {
                $db_nickname = 1; // have nickname
            }
        }
        $livecontest = PopularContest();

        if (Cache::has('posts')) {
            $data = Cache::get('posts');
            // return $data;
        }
        // dd($data);
        $data = Posts::where([
            'posts.active' => 1,
            'posts.status' => returnConfig("accepted_post"),])
            ->join('users', 'users.id', '=', 'posts.created_by')
            ->leftjoin('media_link', 'media_link.id', '=', 'posts.media_id')
            ->leftjoin('sportsgram_media', 'sportsgram_media.post_id', '=', 'posts.id')
            ->leftjoin("media_link as media_data", function ($query) {
                $query->on("media_data.id", "=", "sportsgram_media.media_id");
            })
            ->whereNotIn("section_id", [returnConfig("RCB_section"),returnConfig("arsenal_Id")])
           // ->whereNotIn("section_id", [returnConfig("arsenal_Id")])

            ->orderBy("posts.publish_utc", "DESC")
            ->select(['posts.title', "posts.id", 'media_link.media_url', 'users.name as user_name', DB::raw('DATE_FORMAT(posts.publish_utc, "%d-%M  -%Y") as publish_utc'),
                /*'users.id as user_id', */ 'users.nickname as user_id', 'posts.slug', 'posts.description',
                "media_data.media_url as sportsgram_url",
            ])->paginate(4);

            Cache::put('posts', $data, 3600);


            // dd($data);
        return view('front.index')->with(
            [
                'data' => $data,
                'sportsgram' => $sportsgram,
                "nickname" => $db_nickname,
                'livecontests' => $livecontest,
                'userpost' => $userposts
            ]
        );

    }

    public function paginationview(Request $request)
    {
        $articles = $this->articles->latest('created_at')->paginate(5);

        if ($request->ajax()) {
            return view('articles.load', ['articles' => $articles])->render();
        }

        return view('front.partials.index', compact('articles'));

    }

    public function homeBackground()
    {

      Cache::flush();


        $response = Cache::remember("homeBackground", 3600, function () {

            $sportsgram = fetchPost("", "", "", returnConfig("sportsgramtype"));

            $editordesk = fetchPost(returnConfig('editor desk'), 5);

            $editor_choice = fetchPost(0, 4, 0, 0, 0, false, 0, "",
                [
                    "section_id", returnConfig('editors_choice')
                ]);

            $videos = fetchPost(returnConfig('videos'), 2);

            $featured_post = fetchPost(0, 4, 0, 0, 0, false, 0, "", [
                "section_id", returnConfig("featured_post")
            ]);

            $sports = getSports();

            $people_choice = fetchPost('', 5, (returnConfig('orderBy')));

            $fan = fetchPost("", 10, "", "", "", "", "", "", ["section_id", (returnConfig('fanscorner_sectionid'))]);


            $lastDate = date('Y-m-d', strtotime('-7 days'));

            $most_popular = fetchPost('', 5, returnConfig('orderByViews'), 0, 0, true, 0, $lastDate);

            $counting = array_column($most_popular->toArray(), 'id');


            if ($most_popular->count() < 5) {

                $lastDate = date('Y-m-d', strtotime('-365 days'));

                $most_popularold = fetchPost('', 5 - $most_popular->count(), returnConfig('orderByViews'), 0, 0, true, 0, $lastDate, [], $counting);

                if (5 - $most_popular->count() == 1) {

                    $merged = $most_popular;

                    $merged->push($most_popularold);

                } else {

                    $merged = $most_popular->merge($most_popularold);
                }


            } else {

                $merged = $most_popular;

            }


            return [
                'sportsgrams' => $sportsgram,
                'videos' => $videos,
                'editor_choices' => $editor_choice,
                'people_choices' => $people_choice,
                'featured_posts' => $featured_post,
                'fans' => $fan,
                'most_populars' => $merged,
                'sports' => $sports,
                'editordesks' => $editordesk
            ];

        });

        return $response;


    }

    /**
     * @param $slug
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function article($slug, Request $request)
    {

        $user = Auth::user();
        // dd($user);
        DB::enableQueryLog();

        $articlearray = postDetail($slug);
        $post = $articlearray['post'];

        $relatedQuiz = playQuiz();

        $id = $post->id ?? 0;

        if (empty($id)) {

            abort(404);
        }

        if (empty($request->get("ajax")) && !empty($id)) {

            autoViews($id);
        }

        if ($request->get("ajax") == 1 && Auth::check() && !empty($id)) {
            
            autoLikes($id, $request->get('type'));
            return ["status" => 1];
        }

        if ($request->get("ajax") == 2 && Auth::check() && !empty($id)) {
            
            autoFav($id, $request->get('type'));
            return ["status" => 1];
        }


        $previous = $articlearray['prev'];

        $sports_id = $articlearray['post']->sports_id;

        $category_wise_data = fetchPost('', 8, '', '', $sports_id, false, 0, "", [
            "posts.id", "!=", $id
        ]);
         
        return view('front.article')->with(
            [
                'data' => $post,
                'related' => $category_wise_data,
                'previous' => $previous,
                "quizs" => $relatedQuiz
            ]
        );

    }

    public function clearGuest(){
            
        $data = DB::table('users')
            ->where('name', 'like', 'guest%')
            ->get();

        if(count($data) > 0){

            for ($i = 0; $i <= sizeof($data) - 1; $i++) {

                DB::table('users')->where('id', $data[$i]->id)->delete();   

            }
            return "Guest User data cleared";
        }
            return "No Guest User Available";
        
    }


    public function category($name)
    {
        if ($name == "editor-desk") {

            $id = returnConfig("editor desk");
            $name = 'Editor\'s Desk';
            $metainfo = new \stdClass();
            $metainfo->title = 'Editor’s Desk | SportCo';
            $metainfo->desc = 'Are you an avid fan who is too passionate about sports? Get expert opinions about and insights into the latest sporting events. Navigate through the latest stories related to your favorite games with SportCo.';


        }
        $posts = fetchPost($id, 4, 0, 0, 0, true, 4);

        // $name = getCategory($id);

        return view('front.category')->with(
            [
                'posts' => $posts,
                'name' => $name,
                'sport'=>$metainfo
            ]
        );
    }

    public function sectionBasedPosts($name)
    {

        if ($name == "latest-posts") {

            $id = returnConfig("orderByLatest");
            $name = 'Latest Post';

        } else if ($name == "people-choice") {
            $id = returnConfig('orderBy');
            $name = "People's Choice";
            $metainfo = new \stdClass();
            $metainfo->title = 'People’s Choice | SportCo';
            $metainfo->desc = 'Absolutely passionate about sports? Put your love and knowledge about sports into words and publish your sports blogs on SportCo. Get SportCo tokens for every sports blog published.';

        }


        $posts = fetchPost('', 4, $id, 0, 0, true, 4); /*id for latest post is 10*/

        /* value  for latest post is 10 */


//        if($id == returnConfig('type'))
//        {
//            $name = 'Fans Corner';
//        }


        return view('front.category')->with(
            [
                'posts' => $posts,
                'name' => $name,
                'sport'=>$metainfo
            ]
        );
    }

    public function sportsBasedPosts($name)
    {


        $sport = Sports::where([
            "active" => 1
        ])->where("name", "like", "%" . $name . "%")
            ->first([
                "id",
                "meta-title as title",
                "meta-description as desc"
            ]);


        if (empty($sport->id)) {

            return redirect()->back();

        }


        $posts = fetchPost('', 10, 0, 0, $sport->id, false, 10);


        return view('front.category')->with(
            [
                'posts' => $posts,
                'name' => $name,
                "sport"=>$sport
            ]
        );
    }

    public function sectionListing($name)
    {
        $communityID = "";
        $metainfo = new \stdClass();
        if ($name == "RCB") {

            $id = returnConfig("RCB_section");

            $name = "RCB";

            $communityID = 1;
        }
        elseif( $name == "Arsenal"){
            $id = returnConfig("arsenal_Id");

            $name = "Arsenal";

            $communityID = 2;
        }
        /*elseif ()*/



        if ($name == "editor-choice") {

            $id = returnConfig("editors_choice");

            $name = "Editor's Choice";

            $metainfo->title = 'Editor’s Choice | SportCo';
            $metainfo->desc = 'Offering the perfect package of sports coverage, sport opinion pieces and sport predictions about your favorite teams and games. Get all the latest sports stories about football, tennis, basketball and many more games.';


        }

        $posts = fetchPost('', 4, 0, 0, 0, false, 4, "", [
            "posts.section_id", $id
        ],"","$communityID");

        return view('front.category')->with([
            'posts' => $posts,
            'name' => $name,
            'sport'=>$metainfo
        ]);
    }

    public function subscribeMailChimp(Request $request)
    {

        $data = $request->all();

        $mailchimp = [
            "email" => $data["email"],
            "name" => $data["name"],
            "platform" => "WEB",
            "source" => "SportCo Publish",
            "dor" => date("Y-m-d"),
        ];

        $status = addSubscriber($mailchimp);

        return $status;

    }

    public function search(Request $request)
    {
        $for = $request->get("term");
        // dd($for);

        if (!empty($for)) {

            $select["playd"] = 1;
            $select = [
                'posts.id as id',
                'posts.category_id as cat_id',
                'title',
                'posts.slug as slug',
                "media_data.media_url as sportsgram_url",
                /*DB::raw('"playd" as value'),*/
                /*DB::raw("NULL as value"),*/
                'posts.description',
                'sports.name as sports_name',
                DB::raw('DATE_FORMAT(posts.publish_utc, "%d-%M-%Y") as publish_utc'),
                'users.name as user_name',
                'users.nickname as user_nickname',
                'users.id as user_id',
                'media_link.media_url',
                'posts.type as type',
                'sports.id as sports_id',
            ];
            $playselect["playd"] = 2;
            $playselect = [
                'games.id as id',
                DB::raw("NULL as cat_id"),
                'games.name as title',
                'games.slug',
                DB::raw('null as sportsgram_url'),
                /*DB::raw('"playddddd" as value'),*/
                'games.description',
                'sports.name as sports_name',
                'games.created_at as publish_utc',
                DB::raw("NULL as user_name"),
                DB::raw("NULL as user_nickname"),
                DB::raw("NULL as user_id"),
                'media_link.media_url',
                DB::raw("NULL as type"),
                'sports.id as sports_id',
            ];

            $where = [
                'posts.active' => 1,
                'posts.status' => returnConfig("accepted_post"),
                'sports.active' => 1
            ];


            $post = Posts::join('sports', 'sports.id', '=', 'posts.sports_id')
                ->join('users', 'users.id', '=', 'posts.created_by')
                ->leftjoin('media_link', 'media_link.id', '=', 'posts.media_id')
                ->leftjoin('sportsgram_media', 'sportsgram_media.post_id', '=', 'posts.id')
                ->leftjoin("media_link as media_data", function ($query) {
                    $query->on("media_data.id", "=", "sportsgram_media.media_id");
                })
                ->where($where)
                ->where("posts.title", "like", "%" . $for . "%")
                ->select($select);


            $play = Games::join('sports', 'sports.id', '=', 'games.sport_id')
                ->leftjoin('media_link', 'games.media_id', '=', 'media_link.id')
                ->where('games.active', '=', 1)
                ->where("games.name", "like", "%" . $for . "%")
                ->select($playselect);


            $data = $play->union($post)->get();
            /*print_r($data->count());die;*/
            /*print_r($play->count() . " " . $post->count());*/
            // print_r($data);die;
            $page = $request->get('page', 1);
            $paginate = 6;

            //$result = $data->paginate(5);
            // print_r($result);die;
            $offSet = ($page * $paginate) - $paginate;

            /*$slice = array_slice($data->toArray(), $paginate * ($page - 1), $paginate);*/
            $slice = array_slice($data->toArray(), $offSet, $paginate, true);
            $result = new LengthAwarePaginator($slice, count($data), $paginate, $page);
            /*$result = Paginator::make(count($data), $paginate);*/
            //$result = $result->toArray();
            /*
            */


            /*$post->setPath(url("search") . "?term=$for");*/
            $result->setPath(url("search") . "?term=$for");


            return view("front.search")->with([
                "matches" => $result,
                "term" => $for
            ]);
        }

    }


    public function profile(Request $request, $id)
    {
        $userID = getUserId($id);

        $userData= Auth::User();

        if(isset($userData)){

            $currentTime = Carbon::now()->toDateTimeString();

            // dd($currentTime);
            
            $payments = DB::table('payment')->where('user_id', $userID)->where('active', 1)->select('*')->get();
            
            $paymentDetails = [];
            
            $dayCount = 0;

            if ($payments) {
                for ($i = 0; $i <= (sizeof($payments) - 1); $i++) {
                    if ($payments[$i]->start_time < $currentTime and $payments[$i]->end_time > $currentTime) {
                            $count = sizeof($payments) - 1;
                            // dd($count);
                            if($count > 0){
                                if($payments[$i]->payment_status != 0){
                                    array_push($paymentDetails, $payments[$i]);
                                }

                            }else{
                                    array_push($paymentDetails, $payments[$i]);

                            }

                            $date = date("d M Y H:ia", strtotime($payments[$i]->end_time));
                            $startDate =  \Carbon\Carbon::now();

                            $datetime1 = new \DateTime($startDate);
                            $datetime2 = new \DateTime($payments[$i]->end_time);

                            $interval = $datetime1->diff($datetime2);
                            $days = $interval->days;
                            $dayCount  += $days;
                            
                    }
                }
            }
            // dd($paymentDetails);
        }

        $user = proiflesidebar($userID);
        $profileleftbar = profileLeftbar($userID);

        // dd($profileleftbar);
        $tokenHistory = Transactions::select([
            "tokens",
            "withdrawalToken",
            "spco_tokenval",
            "user_id",
            "created_at",
            "status",
            "id"

        ])->where([
            "user_id" => Auth::id(),
        ])->orderBy("created_at", "DESC")
          ->paginate(10, ["*"], "history");


        // print_r($profileleftbar);die;


        $posts = $profileleftbar['posts'];
        // dd($posts);
        $game = $profileleftbar['games'];
        $referreduser = $profileleftbar['referredusers'];
        $TokenValue = $profileleftbar['ReferredTokenValue'];
        $masterRewardTokens = $profileleftbar['masterRewardTokens'];


        $userlatestpost = UserLatestPost($userID);


        if ($request->isMethod('post')) {
            $type = $request->get('type');

            if ($type == "post") {
                return view("front.postactivity")->with([
                    "posts" => $posts
                ]);
            } elseif ($type == "page") {
                return view("front.playactivity")->with([
                    "games" => $game
                ]);

            } elseif ($type == "rfredusrs") {
                return view("front.referredUsers")->with([
                    "referredusers" => $referreduser
                ]);

            } elseif ($type == "history") {
                return view("front.TokenHistory")->with([
                    "tokenshisotry" => $tokenHistory,
                    /*"tokenfee" => $tokenvalue*/
                ]);
            }

        }


        $userTokens = userTokens($id);



        return view("front.profile")->with([
            "user" => $user,
            "posts" => $posts,
            "tokenshisotry" => $tokenHistory,
            "user_tokens" => $userTokens,
            "games" => $game,
            "ReferredTokenValue" => $TokenValue,
            "referredusers" => $referreduser,
            "userlatestposts" => $userlatestpost,
            "masterRewardTokens" => $masterRewardTokens,
            "view" => 1,
            "paymentDetails" => $paymentDetails ?? '',
            "dayCount" => $dayCount ?? ''
            

        ]);


    }


    public function username(Request $request)
    {

        $id = Auth::id();
        $data = $request->get();

        if ($request->isMethod("post")) {

            $validator = Validator::make($request->all(), [
                'username' => 'required|string|min:5|max:12|unique:users,nickname',
            ]);

            if ($validator->fails()) {
                return response()->json(["message" => $validator->errors()->first()], 422);
            }
        }


        if (!empty($data['username'])) {

            $nickname = Users::where([
                "id" => $id,
                "active" => 1
            ])->update([
                "nickname" => $data['username'],

            ]);
            $status = 1;

        }
        return $status;


    }

    public function usernamevalidate(Request $request)
    {
        $data = $request->all();

        $username = $data['username'] ?? "";

        $data['username'] = preg_replace('/\s+/', '', $username);

        if ($request->isMethod("post")) {

            $validator = Validator::make($data, [
                'username' => 'required|string|min:5|max:12|unique:users,nickname',
            ]);

            if ($validator->fails()) {
                return response()->json(["message" => $validator->errors()->first()], 422);
            }
        }
        $status = 1;
        return $status;
    }

    public function updateProfile(Request $request)
    {

        $id = Auth::id();

        $data = $request->all();


        $profile = UserDetails::where([
            "user_id" => $id,
            "active" => 1
        ])->first(["id"]);

        if (!empty($data['nickname'])) {

            $nickname = Users::where([
                "id" => $id,
                "active" => 1
            ])->update([
                "nickname" => $data['nickname'],

            ]);

        }


        $status = ["status" => 1];


        $update = [];

        if (!empty($data["type"]) && $data["type"] == 1 && !empty($data["data"])) {

            $imageName = uploadImage($data["data"]);

            $update["pic"] = $imageName["url"];
            $status["pic"] = $imageName["url"];
        } else if (!empty($data["bio"])) {

            $update["description"] = $data["bio"];
            $status["text"] = $data["bio"];
        }


        if (!empty($profile->id)) {
            $update["updated_at"] = Carbon::now();

            UserDetails::where([
                "id" => $profile->id
            ])->update($update);


        } else {

            $update["user_id"] = $id;
            $update["active"] = 1;
            $update["created_at"] = Carbon::now();


            UserDetails::insert($update);
        }

        return $status;

    }

    public function acceptTerms(Request $request)
    {
        $type = $request->type;
        $ip = \Request::ip();
        $terms_history = new TermsHistory();
        if ($type == '1') {
            $terms_history->type = '1';
        }
        if ($type == '2') {
            $terms_history->type = '2';
            $terms_history->user_id = Auth::id();
        }
        $terms_history->ip = $ip;
        $terms_history->save();
    }

    public function loadMenu()
    {

        $menu = Cache::remember('users', 3600, function () {
            return View::make('front.partials.mega_menu')->render();
        });

        return $menu;

    }

    public function contest()
    {
        $userID = Auth::id() ?? 0;

        $data = Contest::leftjoin('media_link', 'media_link.id', '=', 'contest.media_id')
            ->leftJoin('contest_participants', function ($query) use ($userID) {
                $query->on('contest_participants.contest_id', '=', 'contest.id');
                $query->on('contest_participants.active', DB::raw(isActive()));
                $query->on('contest_participants.user_id', DB::raw($userID));
            })
            ->orderBy("start_utc", "DESC")
            ->where("end_utc", ">", currentTime())
            ->where("start_utc", "<", currentTime())
            ->where("contest.active", 1)
            ->limit(4)
            ->get([
                "contest.id",
                "name",
                "description",
                "contest_participants.id as participated",
                "start_utc",
                "media_url"
            ]);

        $upcoming = Contest::leftjoin('media_link', 'media_link.id', '=', 'contest.media_id')
            ->where("start_utc", ">", Carbon::now())
            ->where("contest.active", 1)
            ->orderBy("start_utc", "DESC")
            ->get([
                "contest.id",
                "name",
                "description",
                "start_utc",
                "media_url"
            ]);

        $livecontest = Contest::leftjoin('media_link', 'media_link.id', '=', 'contest.media_id')
            ->where("end_utc", "<", currentTime())
            ->where("start_utc", ">", currentTime())
            ->where("contest.active", 1)
            ->orderBy("start_utc", "DESC")
            ->get([
                "contest.id",
                "name",
                "description",
                "start_utc",
                "media_url"
            ]);

        return view("front.contest")->with(
            [
                'datas' => $data,
                'play_head' => 1,
                'upcomings' => $upcoming,
                'livecontests' => $livecontest,
            ]
        );

    }

    public function games(Request $request)
    {


        //Cache::flush();
       /* print_r(returnConfig("community.rcb"));die;*/

        $request->session()->put('mode', 'play');

        $userID = Auth::id() ?? 0;

        if ($userID != 0) {
                        
            $data = DB::table('users')
            ->where('name', 'like', 'guest%')
            ->where('id', $userID)
            ->first();
            
            if($data){
                Auth::logout();
            }
            
        }
        $userCommunityID = Auth::user()->community_id ?? 0;

        $where = [0];

        if(!empty($userCommunityID))
        {

            $where[] = $userCommunityID;
        }



        /*$influencer = getIsInfluencer(Auth::user()->referred_by ?? 0);*/



        $data = Games::leftjoin('media_link', 'media_link.id', '=', 'games.media_id')
            /*->leftJoin('games_participants', function($query) use ($userID){
                $query->on('games_participants.game_id', '=', 'games.id');
                $query->on('games_participants.active', DB::raw(isActive()));
                $query->on('games_participants.user_id', DB::raw($userID));
            })*/
            /* ->leftJoin('game_sessions', function ($query) use ($userID){
                 $query->on('game_sessions.game_id', '=', 'games.id');
                 $query->on('game_sessions.id', '=', DB::raw("(
     SELECT MAX(id)
     FROM game_sessions
     WHERE game_sessions.active = ".DB::raw(isActive())." AND game_sessions.user_id = ".DB::raw($userID)."
     LIMIT 1
 )"));
                 $query->on('game_sessions.active', DB::raw(isActive()));
                 $query->on('game_sessions.user_id', DB::raw($userID));
             })*/
            ->leftJoin('game_sessions as game_sess', function ($query) {
                $query->on('game_sess.game_id', '=', 'games.id');
                $query->on('game_sess.active', DB::raw(isActive()));
            })
            ->leftJoin('game_sessions as game_sess2', function ($query) {
                $query->on('game_sess2.game_id', '=', 'games.id');
                $query->on('game_sess2.active', DB::raw(isActive()));
                $query->on('game_sess2.user_id', DB::raw(Auth::user()->id ?? 0));
                $query->on('game_sess2.completed', DB::raw(isActive()));
            })
            ->orderBy("games.start_utc", "DESC")
            ->groupBy("games.id")
            ->where("games.active", 1)
            ->whereIn("games.community_id", $where)
            ->limit(4)
            ->get([
                "games.id",
                "name",
                "slug",
                "games.entry",
                "description",
                "start_utc",
                "media_url",
                "played",
                DB::raw('count(game_sess.id) as playcount, count(DISTINCT game_sess2.id) as completecount'),
            ]);


        $upcoming = Games::leftjoin('media_link', 'media_link.id', '=', 'games.media_id')
            ->where("start_utc", ">", currentTime())
            ->where("games.active", 1)
            ->whereIn("games.community_id", $where)
            ->orderBy("start_utc", "DESC")
            ->get([
                "games.id",
                "name",
                "slug",
                "description",
                "start_utc",
                "media_url"
            ]);

        $livecontest = PopularContest();


        $mostPlayLatestGames = "";
        $latestSportGames = "";
        if (!empty(Auth::id())) {


            $userletestastplaysport = getTableData(GameSessions::class, [
                "select" => [
                    "game_id",
                    "sports.id as s_id",
                    "sports.name as s_name",
                ],
                "joins" => [
                    [
                        "type" => returnConfig("left_join"),
                        "table" => "games",
                        "left_condition" => "game_sessions.game_id",
                        "right_condition" => "games.id",
                    ],
                    [
                        "type" => returnConfig("left_join"),
                        "table" => "sports",
                        "left_condition" => "games.sport_id",
                        "right_condition" => "sports.id",
                    ]
                ],
                "where" => [
                    "completed" => 1,
                    "games.active" => 1,
                    "user_id" => $userID

                ],
                "order" => [
                    "game_sessions.created_at" => "DESC",
                ],
                "single" => 1
            ]);


            $mostPlaySport = getTableData(GameSessions::class, [
                "select" => [
                    DB::raw("count(game_sessions.id) as gamecount"),
                    "sport_id",
                    "sports.name as s_name"
                ],
                "joins" => [
                    [
                        "type" => returnConfig("left_join"),
                        "table" => "games",
                        "left_condition" => "game_sessions.game_id",
                        "right_condition" => "games.id",
                    ],
                    [
                        "type" => returnConfig("left_join"),
                        "table" => "sports",
                        "left_condition" => "games.sport_id",
                        "right_condition" => "sports.id",
                    ]

                ],
                "where" => [
                    "completed" => 1,
                    "user_id" => $userID
                ],
                "group" => ["game_id"],
                "order" => [
                    "games.created_at" => "ASC",
                ],
                "single" => 1
            ]);

            if (!empty($mostPlaySport)) {

                $mostPlayLatestGames = Games::leftjoin('media_link', 'media_link.id', '=', 'games.media_id')
                    ->leftJoin('games_participants', function ($query) use ($userID) {
                        $query->on('games_participants.game_id', '=', 'games.id');
                        $query->on('games_participants.active', DB::raw(isActive()));
                        $query->on('games_participants.user_id', DB::raw($userID));
                    })
                    ->leftjoin('game_sessions', 'game_sessions.game_id', '=', 'games.id')
                    ->join('sports', function ($query) {
                        $query->on('sports.id', '=', 'games.sport_id');
                        $query->on('sports.active', DB::raw(isActive()));
                    })
                    ->where(
                        "games.sport_id", "=", $mostPlaySport->sport_id
                    )
                    ->where("games.active", 1)
                    ->orderBy("games.created_at", "ASC")
                    ->whereIn("games.community_id", $where)
                    ->groupBy('games.id')
                    ->select(
                        'sports.id as s_id',
                        'sports.name as s_name',
                        'media_link.media_url',
                        'games.entry',
                        "games.slug",
                        'games.name as g_name',
                        DB::raw('count(game_sessions.user_id) as playcount')
                    );

            }

            if (!empty($userletestastplaysport)) {

                $latestSportGames = Games::leftjoin('media_link', 'media_link.id', '=', 'games.media_id')
                    ->join('sports', function ($query) {
                        $query->on('sports.id', '=', 'games.sport_id');
                        $query->on('sports.active', DB::raw(isActive()));
                    })
                    ->leftjoin('game_sessions', 'game_sessions.game_id', '=', 'games.id')
                    ->leftJoin('games_participants', function ($query) use ($userID) {
                        $query->on('games_participants.game_id', '=', 'games.id');
                        $query->on('games_participants.active', DB::raw(isActive()));
                        $query->on('games_participants.user_id', DB::raw($userID));
                    })
                    ->where(
                        "games.sport_id", "=", $userletestastplaysport->s_id
                    /*"game_sessions.user_id" , "!=" , $userID*/
                    /*"game_sessions.user_id" , "!=" , $userID*/
                    /*"" , "!=" , $userID*/


                    )
                    ->where("games.active", 1)
                    ->orderBy("games.created_at", "DESC")
                    ->whereIn("games.community_id", $where)
                    ->groupBy('games.id')
                    ->union($mostPlayLatestGames)
                    /*->whereNotIn(
                        "game_sessions.user_id" , "!=" , $userID
                    )*/
                    ->whereNull("games_participants.id")
                    ->select(
                        'sports.id as s_id',
                        'sports.name as s_name',
                        'media_link.media_url',
                        'games.entry',
                        "games.slug",
                        'games.name as g_name',
                        DB::raw('count(game_sessions.user_id) as playcount')
                    )->get();

                //  print_r($latestSportGames);die;
            }


            /* if ($latestSportGames[0]->s_id == $mostPlayLatestGames[0]->s_id){

             };*/


        }


        $myContest = Games::leftjoin('media_link', 'media_link.id', '=', 'games.media_id')
            ->join('sports', function ($query) {
                $query->on('sports.id', '=', 'games.sport_id');
                $query->on('sports.active', DB::raw(isActive()));
            })
            ->leftJoin('games_participants', function ($query) use ($userID) {
                $query->on('games_participants.game_id', '=', 'games.id');
                $query->on('games_participants.active', DB::raw(isActive()));
                $query->on('games_participants.user_id', DB::raw($userID));
            })
            ->leftJoin('game_sessions', function ($query) use ($userID) {
                $query->on('games.id', '=', 'game_sessions.game_id')
                    ->whereRaw('game_sessions.id = (SELECT MAX(id) FROM game_sessions WHERE game_id = games.id)');
                $query->on('game_sessions.active', DB::raw(isActive()));
            })
            ->leftJoin('game_sessions as total_session', function ($query) use ($userID) {
                $query->on('games.id', '=', 'total_session.game_id');
                $query->on('total_session.active', DB::raw(isActive()));
            })
            ->where("start_utc", "<", currentTime())
            ->where("games.active", 1)
            ->whereNotNull("games_participants.id")
            ->groupBy(["games.id"])
            ->whereIn("games.community_id", $where)
            ->orderBy("game-enter", "DESC")
            ->limit(10)
            ->get([
                "games.id",
                "games.name as name",
                "games.entry",
                "games.slug",
                "sports.name as sport",
                "description",
                "start_utc",
                "game_sessions.created_at as game-enter",
                "media_url",
                DB::raw('count(total_session.id) as playcount')
            ]);

        return view("front.contest")->with(
            [
                'datas' => $data,
                'play_head' => 1,
                'game' => 1,
                'upcomings' => $upcoming,
                'livecontests' => $livecontest,
                'myContest' => $myContest,
                'recommendedgames' => $latestSportGames
            ]
        );

    }

    public function gameDetail($slug)
    {

        // dd("helo");
        $userID = Auth::id() ?? 0;
        $userCommunityID = Auth::user()->community_id ?? 0;


        $id = getGameIDFromSlug($slug);

        // dd($id);


        $data = Games::leftjoin('media_link', 'media_link.id', '=', 'games.media_id')
            ->leftJoin('games_participants', function ($query) use ($userID) {
                $query->on('games_participants.game_id', '=', 'games.id');
                $query->on('games_participants.active', DB::raw(isActive()));
                $query->on('games_participants.user_id', DB::raw($userID));
            })
            ->leftJoin('game_sessions', function ($query) use ($userID, $id) {
                $query->on('game_sessions.game_id', '=', 'games.id');
                $query->on('game_sessions.id', '=', DB::raw("(
                                                        SELECT MAX(id)
                                                        FROM game_sessions 
                                                        WHERE game_sessions.active = " . DB::raw(isActive()) . " AND game_sessions.game_id = $id AND game_sessions.user_id = " . DB::raw($userID) . "  
                                                        LIMIT 1
                                                    )"));
                $query->on('game_sessions.active', DB::raw(isActive()));
                $query->on('game_sessions.user_id', DB::raw($userID));
            })
            ->orderBy("start_utc", "DESC")
            ->orderBy("game_sessions.id", "DESC")
            ->groupBy("games.id")
//            ->where("start_utc", "<" , currentTime())
            ->where("games.active", 1)
            ->where("games.id", $id)
            ->first([
                "games.id",
                "name",
                "slug",
                "games.entry",
                "description",
                "games_participants.id as participated",
                "start_utc",
                "played",
                "media_url",
                "game_sessions.completed",
                "community_id"
            ]);

        // dd($data);
        $rankers = [];
        $latestplay = [];



        $Communityid = $data->community_id ?? 0;

        if($userCommunityID != $Communityid && !empty($Communityid)){
            abort(403, 'You Cannot Play this game.');
        }




        if (!empty($data->participated) && $data->completed >= 0) {

            $select = [
                "users.name",
                "users.id",
                "game_sessions.id as g_id",
                "game_sessions.user_id",
                "game_sessions.score",
                "game_sessions.time",
                "game_sessions.updated_at",
                "games.name as game_name",
                "games.description as game_description",
                "media_link.media_url",
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
                    "type" => returnConfig("left_join"),
                    "table" => "media_link",
                    "left_condition" => "games.media_id",
                    "right_condition" => "media_link.id",
                ]
            ];
            $where = [
                "game_sessions.completed" => 1,
                "games.id" => $id
            ];

            $rankers = getTableData(GameSessions::class, [
                "select" => $select,
                "joins" => $joins,
                "where" => $where,
                "order" => [
                    "game_sessions.score" => "DESC",
                    "game_sessions.time" => "ASC",
                ],
                "limit" => 100
            ]);
            // dd($rankers);   
            $where['users.id'] = Auth::id();

            $latestplayarray = getTableData(GameSessions::Class, [
                "select" => $select,
                "where" => $where,
                "joins" => $joins,
                "order" => [
                    "game_sessions.updated_at" => "DESC",
                ],
                "single" => 1
            ]);

            if (!empty($latestplayarray)) {

                $latestplay = $latestplayarray->toArray();
            }

            /*$latestplay['g_id'])) && $latestplay['g_id'] == $rank->g_id*/

        }

        // $detail = gameQuestionDetails($id);

    $detail = GameQuestionsMap::join('games', 'game_questions_map.game_id' , '=', 'games.id')
        ->where('game_questions_map.active' , 1)
        ->where('game_questions_map.game_id' , $id)
        ->first([
            
            "game_questions_map.question_id",
            "game_questions_map.id",
            
        ]);

        // dd($game);

            /*$arr = [
                "rankers" => $rankers,
                "gameID" => $id,
                'game' => 1,
                "data" => $data,
                "play_head" => 1,
                "latestplay" => $latestplay,
                "detail" => $detail ?? [],
            ];

            dd($arr);*/

        return view("front.gamedetail")->with([
            "rankers" => $rankers,
            "gameID" => $id,
            'game' => 1,
            "data" => $data,
            "play_head" => 1,
            "latestplay" => $latestplay,
            "detail" => $detail ?? [],
        ]);

    }

    function fetchProduct(Request $request)
    {


        /*        $jsondata = getTableData(products::class, [
                    "select" => [
                        "products.id",
                        "name",
                        "slug",
                        "quantity",
                        "media_url",
                        "price"
                    ],
                    "joins" => [
                        [
                            "type" => returnConfig("left_join"),
                            "table" => "media_link",
                            "left_condition" => "media_link.id",
                            "right_condition" => "products.media_id",
                        ],
                    ]
                ]);*/


        $woocommerce = cartauth();
        $res = $woocommerce->get('products');

        $response = $res->getBody()->getContents();


        $jsondata = json_decode($response);
        /*foreach ($jsondata as $key => $value){

            if(empty($value['price'])){
                print_r($key);
            }
        }
die;*/

        $collection = collect($jsondata);
        $pricearray = $collection->where("price", ">", 0)->where("stock_quantity",">=",1);

        return view("front.merchandise")->with([
            "datas" => $pricearray,
            "store" => 1
        ]);
    }

    public function ProductDetail($id)
    {
        $woocommerce = cartauth();
        //$res = $woocommerce->get('orders/169');
        $res = $woocommerce->get('products/' . $id);
        //$res = $woocommerce->get('customers/9');

        //$res = $woocommerce->get('orders/162');
        /*$zone_data = $woocommerce->get('shipping/zones');*/


        $response = $res->getBody()->getContents();
        /*$zone_available = $zone_data->getBody()->getContents();*/
        $jsondata = json_decode($response);
        //print_r($jsondata);die;

        /*$zone_jsondata = json_decode($zone_available);*/

        //print_r($jsondata);die;


        //print_r($jsondata);die;


        return view("front.merchandiseDetail")->with([
            "datas" => $jsondata,
            "store" => 1
        ]);

    }

    public function Checkout(Request $request)
    {


        /*if ($request->isMethod("post")) {
            $data = get::get();

        }*/


        //$woocommerce = cartauth();
        //$jsondata = $woocommerce->get('/cart/add');

        return view("front.checkout");
    }

    public function addtoCart(Request $request)
    {


        $data = $request->get();
        $woocommerce = cartauth();


        $res = $woocommerce->get('products/' . $data['product_id'] . '/');

        $response = $res->getBody()->getContents();
        //print_r($response);die;
        $jsondata = json_decode($response);

        if ($data['quantity'] <= $jsondata->stock_quantity) {

            Cart::add([
                'id' => $jsondata->id,
                'name' => $jsondata->name,
                'qty' => $data['quantity'],
                'price' => $data['tokenvalue'],
                'weight' => "0",
                'options' => ['virtual' => $jsondata->virtual]

            ]);
            /*->associate('App/product');*/
            session(['success_message' => 'Item was Added to your Cart']);
            $status = 1;
        } else {
            $status = "out of Stock";
        }


        /*
        $response = $request->getStatusCode();
       /*
        $session = json_decode($client->request('GET' .$data['product_id']));*/
        /*
        echo $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'*/
        //
        /* $duplicate = Cart::search(function($cartItem, $rowId) use ($jsondata){
             return $cartItem->id === $jsondata->id;
         });
        // print_r($cartItem->id);die;
         if (!empty($duplicate)){

             //session(['success_message' => 'Item is already in your Cart']);
             //return redirect()->route('cartDetail')->with('success_message','Item is already in your Cart');
             $status = 2;

         }*/


        return $status;


        //return redirect()->route('Cart')->with('success_message','Item was Added to your Cart');


    }

    public function cartDetail()
    {
        //session::flush();
        //Cart::destroy();


        return view("front.cart")->with([
            "store" => 1
        ]);
        /*return $status = 1;*/
    }

    public function destory($id)
    {
        Cart::remove($id);

        return back()->with('success_message', 'Item was been removed!');
    }

    public function PlaceOrderByToken()
    {

        $data = Cart::content();
        $userID = Auth::id() ?? 0;
        $user = User::find($userID);
        //print_r($user);die;


        $status = 0;
        if (Auth::user() && (Cart::count() > 0)) {
            foreach ($data as $items) {

                $quantity = $items->qty;
                $productid = $items->id;

                /* if ($data['stock'] == 0) {
                     return 'No Stock';

                 } elseif ($quantity > $data["stock"]) {
                     $quantity = $data['stock'];
                 }*/
                $value = $items->price;
                $dataitems[] = [
                    'product_id' => $productid,
                    'quantity' => $quantity];

                /*$meta_data[] = [
                    'id' => $productid,
                    'key' =>  "_download_permissions_granted",
                    'value' =>  "yes"
                ];*/

            }

            if (Cart::total() <= userTokens($userID)) {

                $update['user_id'] = $userID;
                $update['reward_id'] = returnConfig("tokenRedeem");
                $update['tokens'] = $value * $quantity;
                $update['active'] = 1;
                $update["created_at"] = Carbon::now();


                $data = [
                    'payment_method' => 'bacs',
                    'payment_method_title' => 'Direct Bank Transfer',
                    'set_paid' => true,
                    'status' => 'completed',
                    'customer_id' => $user->w_id,
                    "virtual" => true,

                    "customer_note" => "Token",
                    'line_items' =>
                        $dataitems


                ];


                $woocommerce = oauth();
                $jsondata = $woocommerce->post('orders', $data);

                UserRewards::insert($update);

                $status = 1;
                Cart::destroy();

            } else {
                $status = [
                    "status" => 0,
                    "message" => "You do not have sufficient tokens to purchase this product."
                ];
            }

        } else {
            return redirect()->route('store');
        }


        return $status;


    }

    public function placeOrder($id)
    {
        /*$data = [
                    'customer' => '2'
                ];
        $jsondata = $woocommerce->get('orders', $data);*/


        /*$res = $woocommerce->post('wp-json/wc/v2/orders/',
            [
                'form_params' =>  $data
            ]
        );*/


        /*print_r($res->post('orders', $data));*/


        //$jsondata = json_decode($res->getBody());
        /*print_r($jsondata);die;*/

    }

    public function orderSuccess()
    {

        return view("front.orderSuccess");
    }

    public function otpRequest(Request $request)
    {

        $userid = Auth::id() ?? 0;
        $usersName = User::where('id', '=', $userid)->select('name')->first();
        $user = $usersName->name;
        $userTokens = userTokens($userid);

        if ($userTokens == 0) {
            //return $status =  "Insufficient Tokens";
            return abort(403, 'You do not have sufficient tokens to withdraw.');
        }


        $toUser = User::find($userid);


        $rand = rand(100000, 999999);
        $toUser->notify(new AuthorizationCode($rand, $user));
        // Otp table insert
        $update['otp_number'] = $rand;
        $update['user_id'] = $userid;
        $update['expiry_time'] = Carbon::now()->addMinutes(5);;
        $update['created_at'] = Carbon::now();
        $update['active'] = DB::raw(isActive());
        Otp::insert($update);

        return $status = 1;
        /*}*/

        /*return view("front.withdrawalToken")->with([

        ]);*/

    }

    public function withdrawalToken(Request $request)
    {
        $userID = Auth::id();

        $profileleftbar = profileLeftbar($userID);
        $posts = $profileleftbar['posts'];
        $game = $profileleftbar['games'];
        $userlatestpost = UserLatestPost($userID);
        $referreduser = $profileleftbar['referredusers'];
        $TokenValue = $profileleftbar['ReferredTokenValue'];
        $masterRewardTokens = $profileleftbar['masterRewardTokens'];
        $ETH_usd = round(getETHinUSD(), 4);


        $ETHvalue = Cache::put('ETHValue', $ETH_usd, now()->addMinutes(5));


        $tokenvalue = tokenvalue($ETH_usd);


        $userid = Auth::id() ?? 0;
        $user = proiflesidebar($userid);
        $userTokens = userTokens($userid);
        if ($userid == 0) {
            return abort(403, 'No User Register');
        } else {
            $otp = DB::table('otp')
                ->join('users', 'users.id', '=', 'otp.user_id')
                ->where(
                    'user_id', $userid
                )
                ->select(
                    'users.name',
                    'otp_number',
                    'otp.created_at',
                    'password',
                    'expiry_time'
                )
                ->orderBy('created_at', 'DESC')
                ->first();
        }

        $status = 0;
        $mintransactionToken = $tokenvalue['min_transaction_token'] + $tokenvalue['ETH_token_Fee'];
        if ($request->isMethod("post")) {


            $data = $request->get();
            $validatedData = $request->validate([
                'otp' => 'required|numeric|digits:6',
                'token' => 'required|numeric',
                'wallet_address' => 'required|string',
            ]);

            if ($data['token'] > $userTokens) {
                //return $status =  "Insufficient Tokens";
                return abort(403, 'You do not have sufficient tokens to withdraw.');
            }
            if ($data['token'] < $mintransactionToken) {
                //return $status =  "Insufficient Tokens";
                return abort(403, 'Please choose greater then ' . ceil($mintransactionToken) . ' tokens');
            }

            if ($data['otp'] == $otp->otp_number) {

                if ($otp->expiry_time <= Carbon::now()) {
                    //return abort(403, 'Your OTP is Expired');
                    $status = 3;


                } else {

                    $user = User::find(auth()->user()->id);
                    if (Hash::check($data['password'], $user->password)) {

                        $value = Cache::pull('ETHValue');

                        $tokenvalue = tokenvalue($value);


                        $update = [
                            'user_id' => $userid,
                            'wallet_address' => $data['wallet_address'],
                            'created_at' => Carbon::now(),
                            'active' => DB::raw(isActive()),


                        ];

                        $WalletId = Wallet::insertGetId($update);


                        $transacion_id = getToken(12);

                        $withdrawalToken = $data['token'] - $tokenvalue['ETH_token_Fee'] ?? 0;

                        $update = [
                            "transaction_id" => $transacion_id,
                            "user_id" => $userid,
                            "wallet_id" => $WalletId,
                            "reason" => "",
                            "status" => 0,
                            "tokens" => $data['token'],
                            "active" => DB::raw(isActive()),
                            "created_at" => Carbon::now(),
                            "eth_usd" => $value,
                            "min_transactiontoken" => $tokenvalue['min_transaction_token'],
                            "transaction_fee" => $tokenvalue['trasactionfee'],
                            "spco_tokenval" => $tokenvalue['ETH_token_Fee'],
                            "withdrawalToken" => $withdrawalToken,


                        ];
                        Transactions::insert($update);

                        $datetime = Carbon::now();


                        $emaildata = [
                            'transactionID' => $transacion_id,
                            'useremail' => Auth::user()->email,
                            'username' => Auth::user()->name,
                            'wallet_address' => $data['wallet_address'],
                            'Amount_requested' => $data['token'],
                            'transaction_fee' => $tokenvalue['ETH_token_Fee'],
                            'amount_receivable' => $withdrawalToken,
                            'carbondate' => $datetime->toFormattedDateString(),
                            'carbontime' => $datetime->toTimeString()
                        ];


                        $admin = $tokenvalue['admin_email'];


                        //print_r($admin2);die;


                        /*$admin->notify(new AdminNotification($emaildata));*/
                        Notification::route('mail', $admin)->notify(new AdminNotification($emaildata));
                        $status = 1;
                    }
                    //return $status = "OTP Expeir";
                    //
                    else {

                        return abort(403, 'Password Not Match.');
                    }

                }


            } else {
                return abort(403, 'Incorrect OTP.');
                /*return $status = "";*/
            }
            return $status;


        }
        $userTokens = userTokens($userid);
        // print_r($tokenvalue);die;


        return view("front.withdrawalToken")->with([
            "user" => $user,
            "posts" => $posts,
            "games" => $game,
            "userlatestposts" => $userlatestpost,
            "min_token_value" => $tokenvalue,
            "referredusers" => $referreduser,
            "ReferredTokenValue" => $TokenValue,
            "masterRewardTokens" => $masterRewardTokens,
            "view" => 2

        ]);
        return $status;
    }

    public function wpUserCreate()
    {


        $users = getTableData(User::class, [
            "select" => [
                "name",
                "nickname",
                "email",
                "id"
            ],
            "whereNotIn" => [
                "id" => [1]
            ],
            "where" => [
                "type" => 1
            ]
        ]);

        foreach ($users as $user) {

            $nick = preg_replace('/\s+/', '', $user->name);

            /* $w_data = [
                 "email" => $user->email,
                 "first_name"=> $user->name,
                 "last_name"=> "",
                 "username"=> $user->nickname ?? $nick,
                 "password" => Hash::make(getToken(12)),
                 "billing" => [
                     "first_name"=> $user->name,
                     "last_name"=> "",
                     "company"=> "",
                     "address_1"=> "",
                     "address_2"=> "",
                     "city"=> "",
                     "state"=> "",
                     "postcode"=> "",
                     "country"=> "",
                     "email"=> $user->email,
                     "phone"=> ""
                 ],
                 "shipping" => [
                     "first_name"=> $user->name,
                     "last_name"=> "",
                     "company"=> "",
                     "address_1"=> "",
                     "address_2"=> "",
                     "city"=> "",
                     "state"=> "",
                     "postcode"=> "",
                     "country"=> ""
                 ]
             ];*/

            //$woocommerce = oauth();
            /*$res = $woocommerce->get('customers/');*/
            //$jsondata = $woocommerce->post('customers/', $w_data);

            updateData(User::class, [
                "update" => [
                    //"w_id" => $jsondata->id
                    "app_id" => getToken('8')
                ],
                "where" => [
                    "id" => $user->id
                ],
            ]);


        }


    }

    public function inviteFriend($id)
    {

        $refID = $id;

        if (empty($refID)) {

            return redirect()->route("index");

        }

        $user = getTableData(User::class, [
            "select" => [
                "name"
            ],
            "where" => [
                "app_id" => $refID
            ],
            "single" => 1
        ]);


        return view("front.referralUser")->with([
            "refID" => $refID,
            "name" => $user->name
        ]);
    }

    public function referTerms()
    {
        return view("front.refer_terms");
    }


    public function imagePostDetail(Request $request , $slug)
    {



        $articlearray = postDetail($slug);


        $post = $articlearray['post'];
        $postId = $post->id ?? 0;


        if (empty($request->get("ajax")) && !empty($postId)) {

            autoViews($postId);

        }

        if ($request->get("ajax") == 1 && Auth::check() && !empty($postId)) {

            autoLikes($postId, $request->get("type"));

            return ["status" => 1];

        }

        if ($request->get("ajax") == 2 && Auth::check() && !empty($postId)) {
            autoFav($postId, $request->get("type"));

            return ["status" => 1];

        }


        $mediaData = getTableData(Posts::class, [
            "select" =>
                [
                    DB::raw("GROUP_CONCAT(media_link.media_url separator '" . globalSeparator() . "') as media_data")

                ],
            "joins" => [

                [
                    "table" => "sportsgram_media",
                    "type" => returnConfig("left_join"),
                    "left_condition" => "sportsgram_media.post_id",
                    "right_condition" => "posts.id"
                ],
                [
                    "table" => "media_link",
                    "type" => returnConfig("left_join"),
                    "left_condition" => "media_link.id",
                    "right_condition" => "sportsgram_media.media_id"
                ],
            ],
            "group" => [
                "posts.id",
            ],
            "where" => [
                "posts.id" => $postId,
            ], "single" => 1

        ]);
        $mediaUrl = explode('!--!', $mediaData['media_data']);
        $previous = $articlearray['prev'];

         $user = Auth::user();
        
        /*one article one day*/
        if($user){

            if(
               $user->email == "nikesh@sportswizzleague.com" OR
               $user->email == "amaansiddiqui123@gmail.com" OR
               $user->email == "jackshukla10@gmail.com" OR
               $user->email == "nikhil.dbc@gmail.com" OR
               $user->email == "ishaandj20@gmail.com" OR
               $user->email == "admin@sportco.io"
            ){

            }
            else
            {

                $currentTime = Carbon::now()->toDateTimeString();
                
                $payments = DB::table('payment')->where('user_id', $user->id)->where('active', 1)->select('start_time', 'end_time')->get();
               
                if ($payments) {
                    for ($i = 0; $i <= (sizeof($payments) - 1); $i++) {
                        if ($payments[$i]->start_time < $currentTime and $payments[$i]->end_time > $currentTime) {
                                
                                return view("front.imgarticle")->with([
                                    "post" => $post,
                                    "mediaUrl" => $mediaUrl,
                                    "previous" => $previous
                                ]);
                        }
                    }
                }

                if($user->is_seen == 1){
       
                    $from   = Carbon::now();
                    $today = date("d-m-y", strtotime($from));

                    $tom = date("d-m-y", strtotime($user->is_seen_created_at));  
                    
                    if($today == $tom){

                        return view('front.payment');
                    
                    }else{
                        $user->is_seen_created_at = Carbon::now();
                        $user->save();
                    }


                }else{
                    $user->is_seen = 1;
                    $user->is_seen_created_at = Carbon::now();
                    $user->save();
                } 
            }   

        }else{

            $random = mt_rand(100000, 999999);
            
            $username = strtolower(preg_replace('/\s+/', '', 'guest-'.$random));
            $user = new User;
            $user->name = 'guest-'.$random;
            $user->nickname = $username;
            $user->email = 'guest'.$random.'@1';
            $user->password = Hash::make('guest-'.$random);
            $user->type = 1;
            $user->w_id = 0;
            $user->is_seen = 1;
            $user->is_seen_created_at = Carbon::now();
            $user->active = isActive();
            $user->app_id = getToken(8);
            $user->referred_by = 0;
            $user->save();

            Auth::login($user);

        }
        /*--------*/
        


        return view("front.imgarticle")->with([
            "post" => $post,
            "mediaUrl" => $mediaUrl,
            "previous" => $previous
        ]);

    }

    public function sportsgram()
    {
        
        $posts = sportsgramFetch("", 7);

        return view("front.sportsgram")->with([
            "posts" => $posts,

        ]);
    }
    public function athleteRegistration()
    {

        return view("front.athlete_Registration");
    }
    public function guideLines()
    {

        return view("front.guidelines");
    }

    public function routeTest()
    {
        return view('mastercard');
    }




}

/*prformance difficulty*/