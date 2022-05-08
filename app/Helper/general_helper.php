<?php

use App\Model\ContestQuestionsMap;
use App\Model\ContestUserAnswers;
use App\Model\Currency;
use App\Model\GameQuestionsMap;
use App\Model\Games;
use App\Model\GameSessions;
use App\Model\InfluencersCommunities;
use App\Model\MasterRewards;
use App\Model\Posts;
use App\Model\PostSections;
use App\Model\PostStats;
use App\Model\SiteMeta;
use App\Model\UserGameAnswers;
use App\Model\UserRewards;
use App\Model\PostTokens;
use App\Model\Sports;
use App\Model\Tags;
use App\Model\PostTags;
use App\Model\TempTags;
use App\Model\Users;
use App\Model\Transactions;
use App\Model\Category;
use App\Model\Communities;
use App\Model\UserEvents;
use App\Model\SportsgramTokens;
use App\Model\MediaLink;
use App\Model\Notification;
use App\Model\NotificationStatus;
use App\Notifications\FirstPostToken;
use App\Notifications\PostApproved;
use Carbon\Carbon;
use App\User;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Imagick as imgick;
/*use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;*/

use Automattic\WooCommerce\Client;

function dateTime()
{
    return new Carbon;
}

function fetchPost($cat_id, $limit, $orderBy = 0, $type = 0, $sport_id = 0, $else = true, $paginate = 0, $date = "", $where_add = [], $popularpost = "",$communityID = "")
{

    $select = [
        'posts.id as id',
        'posts.slug',
        'title',
        'description',
        'category.name as cat_name',
        'category.id as cat_id',
        'sports.id as sports_id',
        'sports.name as sports_name',
        "media_data.media_url as sportsgram_url",
        'posts.created_at',
        'posts.section_id',
        'users.name as user_name',
        'users.nickname as user_id',
        //'users.id as user_id',
        'media_link.media_url',
        'posts.type as type',
        DB::raw('DATE_FORMAT(posts.publish_utc, "%d-%M-%Y") as publish_utc'),
        DB::raw("SUM(post_stats.likes) as postlike"),
        DB::raw("SUM(post_stats.views) as views"),
        DB::raw("SUM(post_stats.shares) as shares"),
    ];

    $where = [
        'posts.active' => 1,
        'posts.status' => returnConfig("accepted_post"),
        'sports.active' => 1
    ];

    if (empty($orderBy) && $else) {

        $where['posts.category_id'] = $cat_id;

    }

    if (!empty($type)) {
        $where['posts.type'] = returnConfig("type");
    }


    if (!empty($sport_id)) {
        $where['posts.sports_id'] = $sport_id;
    }




    if (!empty($where_add)) {

        $where[] = $where_add;

    }


    $return = [];

    $posts = Posts::join('sports', 'sports.id', '=', 'posts.sports_id')
        ->join('users', 'users.id', '=', 'posts.created_by')
        ->leftjoin('media_link', 'media_link.id', '=', 'posts.media_id')
        ->leftjoin('category', 'category.id', '=', 'posts.category_id')
        ->leftjoin('post_stats', 'post_stats.post_id', '=', 'posts.id')
        ->leftjoin('sportsgram_media', 'sportsgram_media.post_id', '=', 'posts.id')
        ->leftjoin("media_link as media_data", function ($query) {
            $query->on("media_data.id", "=", "sportsgram_media.media_id");
        })
        ->where($where)
        ->groupBy('posts.id');


    if (empty($communityID)){

        $posts->where('section_id', '!=', returnConfig("RCB_section"));
    }
    if ($orderBy != returnConfig("orderBy")) {

        $posts->orderBy('posts.created_at', "DESC");

    }

    if (!empty($date)) {

        $posts->where('posts.created_at', '>=', $date);

    }

    if (!empty($popularpost)) {
        $posts->whereNotIn('posts.id', $popularpost);

    }

    if (empty($paginate)) {

        $posts->limit($limit);

    }


    if (!empty($orderBy)) {

        $factor = "views";
        if ($orderBy == returnConfig("orderBy")) {


            $possasss = $posts->whereNotNull('post_stats.likes')->orderBy('postlike', "DESC");


        } else if ($orderBy == returnConfig('orderByLatest')) {
            $posts->orderBy('posts.created_at', "DESC");
        } else if ($orderBy == returnConfig('type')) {
            $posts->where('posts.type', '=', $orderBy);
        } else {
            $posts->orderBy($factor, "DESC");
        }


    }

    if (!empty($paginate)) {

        $return = $posts->select($select)->paginate($paginate);

    } else {

        if ($limit == 1) {

            $return = $posts->first($select);

        } else {

            $return = $posts->get($select);

        }

    }

    return $return;
}

function returnConfig($name)
{

    return config("constant.$name");

}


function parsePostDate($createdAt)
{

    $humanDays = Carbon::createFromTimeStamp(strtotime($createdAt))->diffForHumans();

    return $humanDays;

}


function img_crop($width, $height, $ow, $oh, $imgname, $x, $y, $rot, $imagepost = "")
{


    if (!empty($imagepost)) {
        $baseurl = base_path("public/images/temp_sportsgram/");
        $urlpath = url('images/temp_sportsgram/');
    } else {
        $baseurl = base_path("public/images/post/");
        $urlpath = url('images/post/');
    }

    $imgUrl = $baseurl . $imgname;

    // original sizes
    $imgInitW = $ow;
    $imgInitH = $oh;
    // resized sizes
    $imgW = $ow;
    $imgH = $oh;
    // offsets
    $imgY1 = $y + 1;
    $imgX1 = $x + 1;
    // crop box
    $cropW = $width - 3;
    $cropH = $height - 3;
    // rotation angle
    $angle = $rot;

    $jpeg_quality = 80;
    // $final_filename = "croppedImg_" . rand();
    $final_filename = $imgname;
    $output_filename = $baseurl . $final_filename;

    // uncomment line below to save the cropped image in the same location as the original image.
    //$output_filename = dirname($imgUrl). "/croppedImg_".rand();

    //print_r($imgUrl);die;

    $what = getimagesize($imgUrl);
    //  print_r($what);die;

    switch (strtolower($what['mime'])) {
        case 'image/png':
            $img_r = \imagecreatefrompng($imgUrl);
            $source_image = \imagecreatefrompng($imgUrl);
            $type = '.png';
            break;
        case 'image/jpeg':
            // $img_r = \imagecreatefromjpeg($imgUrl);
            $source_image = \imagecreatefromjpeg($imgUrl);

            $type = '.jpeg';
            break;
        case 'image/gif':
            $img_r = \imagecreatefromgif($imgUrl);
            $source_image = \imagecreatefromgif($imgUrl);
            $type = '.gif';
            break;
        default:
            die('image type not supported');
    }


    // print_r($source_image);die;

    //Check write Access to Directory


    if (!is_writable(dirname($output_filename))) {

        $response = Array(
            "status" => 'error',
            "message" => 'Can`t write cropped File'
        );
    } else {

        // resize the original image to size of editor
        $resizedImage = \imagecreatetruecolor($imgW, $imgH);
        \imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
        // rotate the rezized image
        $rotated_image = \imagerotate($resizedImage, -$angle, 0);
        // find new width & height of rotated image
        $rotated_width = \imagesx($rotated_image);
        $rotated_height = \imagesy($rotated_image);
        // diff between rotated & original sizes
        $dx = $rotated_width - $imgW;
        $dy = $rotated_height - $imgH;
        // crop rotated image to fit into original rezized rectangle
        $cropped_rotated_image = \imagecreatetruecolor($imgW, $imgH);
        \imagecolortransparent($cropped_rotated_image, \imagecolorallocate($cropped_rotated_image, 0, 0, 0));
        \imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
        // crop image into selected area

        $final_image = \imagecreatetruecolor($cropW, $cropH);
        \imagecolortransparent($final_image, \imagecolorallocate($final_image, 0, 0, 0));
        \imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
        // finally output png image
        //imagepng($final_image, $output_filename.$type, $png_quality);
        imagejpeg($final_image, $output_filename, $jpeg_quality);
        $response = Array(
            "status" => 'success',
            "url" => $urlpath . ('/') . $final_filename,
            "imgname" => $final_filename
        );
    }
    return $response;


}

function autoViews($postID)
{

    $userID = Auth::id() ?? 0;

    $check = PostStats::where([
        "user_id" => $userID,
        "post_id" => $postID,
        "active" => 1
    ])->first([
        "id"
    ]);

    if (!empty($check->id)) {

        PostStats::where([
            "user_id" => $userID,
            "post_id" => $postID,
            "active" => 1
        ])->increment("views", 1);

    } else {

        PostStats::insert([
            "post_id" => $postID,
            "user_id" => $userID,
            "views" => 1,
            "active" => 1,
            "created_at" => Carbon::now()
        ]);

    }

}


function autoLikes($postID, $unlike = 0)
{

    $userID = Auth::id();

    $check = PostStats::where([
        "user_id" => $userID,
        "post_id" => $postID,
        "active" => 1
    ])->first([
        "id",
        "likes"
    ]);

    if (!empty($check->id)) {


        $liker = PostStats::where([
            "user_id" => $userID,
            "post_id" => $postID,
            "active" => 1
        ]);

        if (!empty($unlike)) {

            if ($check->likes == 1) {

                $liker->decrement("likes", 1);

            }

        } else {

            if ($check->likes == 0) {

                $liker->increment("likes", 1);

            }

        }


    } else {

        PostStats::insert([
            "post_id" => $postID,
            "user_id" => $userID,
            "likes" => 1,
            "active" => 1,
            "created_at" => Carbon::now()
        ]);

    }

}

function autoFav($postID, $unlike = 0)
{

    $userID = Auth::id();

    $check = PostStats::where([
        "user_id" => $userID,
        "post_id" => $postID,
        "active" => 1
    ])->first([
        "id",
        "fav"
    ]);

    if (!empty($check->id)) {


        $liker = PostStats::where([
            "user_id" => $userID,
            "post_id" => $postID,
            "active" => 1
        ]);

        if (!empty($unlike)) {

            if ($check->fav == 1) {

                $liker->decrement("fav", 1);

            }

        } else {

            if ($check->fav == 0) {

                $liker->increment("fav", 1);

            }

        }


    } else {

        PostStats::insert([
            "post_id" => $postID,
            "user_id" => $userID,
            "fav" => 1,
            "active" => 1,
            "created_at" => Carbon::now()
        ]);

    }

}

function getSports()
{
    $sports = Cache::remember('sports', 3600, function () {
        return Sports::join("posts", function ($query) {
            $query->on("posts.sports_id", "=", "sports.id");

        })->where([
            'posts.active' => 1
        ])
            ->orderBy("priority")
            ->groupBy("sports.id")
            ->get(['name', 'sports.id']);
    });

    return $sports;

}

function getCategory($id)
{

    return Category::where(['active' => 1, 'id' => $id])->first(['name']);

}

function getSport($id)
{

    return Sports::where(['active' => 1, 'id' => $id])->first(['name']);

}


function addSubscriber($data)
{

    $array = [
        "email_address" => $data["email"],
        "status" => "subscribed",
        "merge_fields" => [
            "MMPLATFORM" => $data["platform"],
            "MMSOURCE" => $data["source"],
            "MMREG" => $data["dor"],
            "MMNAME" => $data["name"],
        ]
    ];

    $json = json_encode($array);

    $ch = curl_init("https://us17.api.mailchimp.com/3.0/lists/f9dcef4bd7/members");

    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . env("MAILCHIMP_KEY"));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);
    $resultD = json_decode($result);
    /*$resultD->title;*/

    $status = ["status" => 1];


    if ($resultD->status == 400) {

        $status = ["status" => 0, "msg" => $data['email'] . " is already a listed member."];

    }

    return $status;
}

/*function articleLimiter($value, $limit = 100, $end = '...')
{
    $limit = $limit - mb_strlen($end);
    $valuelen = mb_strlen($value);
    return $limit < $valuelen ? mb_substr($value, 0, mb_strrpos($value, ' ', $limit - $valuelen)) . $end : $value;
}*/

function authorPic($pic)
{

    if (empty($pic)) {

        $pic = asset('img/content/single/author1.jpg');

    }


    return $pic;
}

function getPostSection($id)
{

    return PostSections::where(['active' => 1, 'id' => $id])
        ->first(['name']);

}

function articleLimiter($text, $length = 70, $ending = '...', $exact = false, $considerHtml = true)
{
    if ($considerHtml) {
        // if the plain text is shorter than the maximum length, return the whole text
        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }
        // splits all html-tags to scanable lines
        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

        $total_length = strlen($ending);

        $open_tags = array();
        $truncate = '';

        foreach ($lines as $line_matchings) {
            // if there is any html-tag in this line, handle it and add it (uncounted) to the output
            if (!empty($line_matchings[1])) {
                // if it's an "empty element" with or without xhtml-conform closing slash
                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                   // print_r("in");
                    // do nothing
                    // if tag is a closing tag
                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                   // print_r("in2");
                    // delete tag from $open_tags list
                    $pos = array_search($tag_matchings[1], $open_tags);
                    if ($pos !== false) {
                        unset($open_tags[$pos]);
                    }
                    // if tag is an opening tag
                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                   // print_r("in3");
                    // add tag to the beginning of $open_tags list
                    array_unshift($open_tags, strtolower($tag_matchings[1]));
                }
                //die;
                // add html-tag to $truncate'd text
                $truncate .= $line_matchings[1];
            }
            // calculate the length of the plain text part of the line; handle entities as one character
            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
            if ($total_length + $content_length > $length) {
                // the number of characters which are left
                $left = $length - $total_length;
                $entities_length = 0;
                // search for html entities
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                    // calculate the real length of all entities in the legal range
                    foreach ($entities[0] as $entity) {
                        if ($entity[1] + 1 - $entities_length <= $left) {
                            $left--;
                            $entities_length += strlen($entity[0]);
                        } else {
                            // no more characters left
                            break;
                        }
                    }
                }
                $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
                // maximum lenght is reached, so get off the loop
                break;
            } else {
                $truncate .= $line_matchings[2];
                $total_length += $content_length;
            }
            // if the maximum length is reached, get off the loop
            if ($total_length >= $length) {
                break;
            }
        }
    } else {
        if (strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = substr($text, 0, $length - strlen($ending));
        }
    }
    // if the words shouldn't be cut in the middle...
    if (!$exact) {
        // ...search the last occurance of a space...
        $spacepos = strrpos($truncate, ' ');
        if (isset($spacepos)) {
            // ...and cut the text in this position
            $truncate = substr($truncate, 0, $spacepos);
        }
    }
    // add the defined ending to the text
    $truncate .= $ending;

    if ($considerHtml) {
        // close all unclosed html-tags
        foreach ($open_tags as $tag) {
            $truncate .= '</' . $tag . '>';
        }
    }

   
    return $truncate;
}

function getPost($id, $status)
{


    $sports = Sports::select(['name', 'id'])->where(['active' => 1])
        ->get();


    $where = [
        "posts.id" => $id,
        "status" => $status,
        "posts.active" => 1
    ];

    if (Auth::user()->type == returnConfig("user")) {

        $where["posts.created_by"] = Auth::id();

    }

    $content = Posts::leftjoin("media_link", function ($query) {

        $query->on("media_link.id", "=", "posts.media_id");
        $query->on("media_link.active", DB::raw("1"));

    })->leftjoin("post_tags", function ($query) {

        $query->on("post_tags.post_id", "=", "posts.id");
        $query->on("post_tags.active", DB::raw("1"));

    })
        ->leftjoin("tags", function ($query) {

            $query->on("post_tags.tag_id", "=", "tags.id");
            $query->on("tags.active", DB::raw("1"));

        })->leftjoin("temp_tags", function ($query) {

            $query->on("temp_tags.post_id", "=", "posts.id");
            $query->on("temp_tags.active", DB::raw("1"));

        })->where($where)
        ->groupBy("post_tags.post_id")
        ->first([
            "title",
            "media_url",
            "description",
            "meta_title",
            "meta_description",
            "slug",
            "meta_keyword",
            DB::raw('group_concat(DISTINCT temp_tags.name) as temp_name'),
            DB::raw('group_concat(DISTINCT tags.id) as tag_id'),
            DB::raw('group_concat(DISTINCT tags.name ORDER BY tag_id ASC) as tag_name'),
            "sports_id"
        ]);

    return ['sport' => $sports, 'content' => $content];


}


function postSubmit(Request $request , $edit = 0)
{


    // dd($edit);

    $approvededit = $request->get("acceptpostedit");
    $wid = $request->get("width");
    $title = trim($request->get("title"));
    $desc = $request->post("article");

    // dd($desc);

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


                    $tokenValue = getRewardToken($rewardID);

                    $authorID = getAuthorFromPost($edit);


                    if (empty($request->get('acceptpostedit')) && $section != returnConfig("fanscorner_sectionid")) {
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


                if (empty($checkpostcount->toArray())) {


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

                        $authorFirstPost = userFirstPost($authorID);


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
                            $Userfirstpost = 1;
                            $toUser->notify(new FirstPostToken($emaildata));

                            insertData(UserRewards::class, $extra);
                        }

                    }
                }



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
function sendMessage($title,$metadesc,$url) {

    if(isProd())
    {
        $content = array(
            "en" => $metadesc
        );
        $hashes_array = array();
        $fields = array(
            'app_id' => env("ONESIGNAL_APP_ID"),
            'included_segments' => array(
                'All'
            ),
            'data' =>  (object) [],
            "url" => $url,
            "headings" => (array) ["en"=>$title],
            "contents"=> (array) $content
        );
        $fields = json_encode($fields);


        /*print("\nJSON sent:\n");
        print($fields);*/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.env("ONESIGNAL_SECRET_KEY")
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);

        curl_close($ch);
        return $response;
    }

}


function uploadImage($image)
{
    //$image = $request->image;  // your base64 encoded

    $image = str_replace('data:image/jpeg;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageName = str_random(10) . '.' . 'png';
    \File::put(public_path() . '/images/profile/' . $imageName, base64_decode($image));

    //print_r($image);die;
    return [
        "name" => $imageName,
        "url" => asset("images/profile/") . "/" . $imageName
    ];

}

function uploadImageAndPath($image, $path)
{
    //$image = $request->image;  // your base64 encoded
    $imagepath = $path;
    $image = str_replace('data:image/jpeg;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageName = str_random(10) . '.' . 'png';
    \File::put($imagepath . $imageName, base64_decode($image));

    //print_r($image);die;
    return [
        "name" => $imageName,
        "url" => $imagepath . "/" . $imageName
    ];

}

function createSitemap()
{

    $sitemap = App::make("sitemap");

    $posts = Posts::where([
        "status" => returnConfig("accepted_post"),
        "active" => 1,
    ])->orderBy('updated_at', 'desc')
        ->get([
            "slug"
        ]);

    foreach ($posts as $post) {
        $sitemap->add(
            url("article") . "/" . $post->slug,
            $post->updated_at,
            '1.0', 'daily'
        );
    }

    $sitemap->store('xml', 'sitemap');

}

function sportsUrl($sportName)
{

    return url("sport") . "/" . strtolower($sportName);

}

function sectionUrl($type)
{

    if ($type == returnConfig('orderByLatest')) {

        $sectionName = "latest-posts";

    } else if ($type == returnConfig('orderBy')) {

        $sectionName = "people-choice";

    }

    return url("section") . "/" . $sectionName;

}

function sectionsUrl($type)
{

    if ($type == returnConfig('editors_choice')) {

        $sectionName = "editor-choice";

    }



    return url("sections") . "/" . $sectionName;

}

function categoryUrl($type)
{

    if ($type == returnConfig('editor desk')) {

        $categoryName = "editor-desk";

    }


    return url("category") . "/" . $categoryName;

}

function getRewardToken($id)
{
    $token = MasterRewards::where([
        'id' => $id,
        'active' => 1
    ])->first(['tokens']);

    return $token->tokens ?? 0;

}

function getImageToken($id)
{
    $token = SportsgramTokens::where([
        'id' => $id,
        'active' => 1
    ])->first(['tokens']);

    return $token->tokens ?? 0;

}


function getAuthorFromPost($edit)
{

    $authorID = Posts::where([
        'id' => $edit,
        'active' => 1
    ])->first(['created_by']);

    return $authorID->created_by ?? 0;

}

function createUserReward($authorID, $rewardID, $tokenValue, $edit)
{

    $insertId = UserRewards::insertGetId([
        "user_id" => $authorID,
        "reward_id" => $rewardID,
        "tokens" => $tokenValue,
        "active" => 1,
        "created_at" => Carbon::now()
    ]);


    PostTokens::insert([
        "post_id" => $edit,
        "link_id" => $insertId,
        "active" => 1,
        "created_at" => Carbon::now(),

    ]);


}

function userTokens($id)
{

    //TODO : Singular query for both earn and redeem

    $earned = UserRewards::join('master_rewards', function ($query) {
        $query->on('master_rewards.id', '=', 'user_rewards.reward_id');
        $query->on('master_rewards.type', DB::raw("1"));
        $query->on('master_rewards.active', DB::raw("1"));
    })->where([
        "user_id" => $id,
        'user_rewards.active' => '1',

    ])
        ->sum('user_rewards.tokens');


    $redeemed = UserRewards::join('master_rewards', function ($query) {
        $query->on('master_rewards.id', '=', 'user_rewards.reward_id');
        $query->on('master_rewards.type', DB::raw("2"));
        $query->on('master_rewards.active', DB::raw("1"));
    })->where([
        "user_id" => $id,
        'user_rewards.active' => '1',
    ])
        ->sum('user_rewards.tokens');

    $onHold = getTableData(Transactions::class, [
        "select" => [
            DB::raw("SUM(tokens) as token")
        ],
        "where" => [
            "user_id" => $id,
            "status" => 0,
        ],
        "single" => 1
    ]);

    $onHoldAmount = $onHold->token ?? 0;

    $balance = $earned - $redeemed - $onHoldAmount;

    return $balance;

}

function notification()
{

    $notification = Notification::select([
        'id',
        'notification',
        'created_at'
    ])->get();


    return $notification;

//    print_r($notification);die;

}

function menuPosts($sporstID)
{
    //Cache::flush();
    //print_r($sporstID);die;

    $posts = Cache::remember('post_for_sportID' . $sporstID, 3600, function () use ($sporstID) {
        return fetchPost(1, 4, 0, 0, $sporstID, false,"");
    });

    return $posts;


}

function menuOptionsFetch()
{
    //Cache::flush();
    $html = Cache::remember('megaMenuNav', 3600, function () {

        $sportsTotal = getSports();


        $getcommunities = getTableData(Communities::class,[
            "select" =>[
                "name","id"
            ]
        ]);

        $cacheHtml = '';
        $cacheHtml2 = '';
        $cacheHtml3 = '';
        $sport = $sportsTotal;
        /*$sports = $sportsTotal->slice(0, 4);*/

        $total = $sport->count();

        for ($i = 0; $i < 4; $i++) {
            $sportid = $sport[$i]['id'];
            /*DB::enableQueryLog();*/


            $posts = menuPosts($sportid);
            /*print_r(DB::getQueryLog());die;*/
            if (empty($posts->count())) {
                continue;
            }

            $cacheHtml .= '<li class="nav__dropdown">
                                <a href="' . sportsUrl($sport[$i]->name) . '">' . $sport[$i]->name . '</a>
                            <ul class="nav__dropdown-menu nav__megamenu">
                                <li>
                                    <div class="nav__megamenu-wrap">
                                    <div class="row">';


            if (!empty(count($posts))) {
                foreach ($posts as $post) {
                    if (empty($post->sportsgram_url)) {
                        $url = url("article");
                        $imgurl = $post->media_url;
                    } else {
                        $url = url("sportsgram");
                        $imgurl = $post->sportsgram_url;
                    }


                    $cacheHtml .= ' <div class="col nav__megamenu-item">
                                <article class="entry">
                                    <div class="entry__img-holder">
                                        <a href="' . $url . '/' . $post->slug . '">
                                            <img src="' . $imgurl . '" alt=""
                                                 class="entry__img">
                                        </a>
                                        <a href="' . sportsUrl($post->sports_name) . '"
                                           class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet">' . $post->sports_name . '</a>
                                    </div>

                                    <div class="entry__body">
                                        <h2 class="entry__title">
                                            <a href="' . $url . '/' . $post->slug . '">' . $post->title . '</a>
                                        </h2>
                                    </div>
                                </article>
                            </div>';

                }

            } else {

                $cacheHtml .= '<center>No content available!</center>';

            }

            $cacheHtml .= ' </div>
                </div>
            </li>
        </ul>
    </li>';
        }
        //print_r($cacheHtml);die;
        $cacheHtml2 .= '<li class="nav__dropdown">
                                <a href="#">More</a><ul class="nav__dropdown-menu">';
        for ($i = 4; $i < $total; $i++) {

            $cacheHtml2 .= '<li>
                                <a href="' . sportsUrl($sport[$i]->name) . '">' . $sport[$i]->name . '</a>';
            $cacheHtml2 .= '</li>';


        }
        $cacheHtml2 .= '</ul></li>';

        $cacheHtml3 .='<li class="nav__dropdown"><a href="#">Community</a><ul class="nav__dropdown-menu">';


            foreach ($getcommunities as $getcommunity) {

                $cacheHtml3 .= '<li>
                                <a href="' .url("sections/") .'/'.$getcommunity->name. '">' . $getcommunity->name . '</a>';
                $cacheHtml3 .= '</li>';


            }
        $cacheHtml3 .= '</ul></li>';

        $mergecache = $cacheHtml . $cacheHtml2;

        return $mergecache;

    });

    return $html;

}

function trendingFooter()
{
//    Cache::flush();
    $html = Cache::remember("trendingFooter", 3600, function () {

        $cacheHtml = '';

        $most_populars = fetchPost('', 2, returnConfig('orderByViews'), 0, 0, true, 0, date('Y-m-d', strtotime('-7 days')));

        if (empty($most_populars->count())) {

            $most_populars = fetchPost('', 2, returnConfig('orderByViews'), 0, 0, true, 0, date('Y-m-d', strtotime('-365 days')));


        }

        foreach ($most_populars as $key => $value) {

            if ($key == 2) {

                break;

            }
            if (empty($value->sportsgram_url)) {
                $url = url('article');
                $imgurl = $value->media_url;
            } else {
                $url = url('sportsgram');
                $imgurl = $value->sportsgram_url;
            }

            $cacheHtml .= '<li class="post-list-small__item">
                              <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                  <div class="thumb-container">
                                    <a href="' . $url . '/' . $value->slug . '">
                                    <img data-src="' . $imgurl . '" src="' . $imgurl . '" alt="" 
                                    class="post-list-small__img--rounded lazyloaded">
                                    </a>
                                  </div>
                                </div>
                                <div class="post-list-small__body">
                                  <h3 class="post-list-small__entry-title">
                                    <a href="' . $url . '/' . $value->slug . '">' . $value->title . '</a>
                                  </h3>
                                  <ul class="entry__meta">
                                    <li class="entry__meta-author">
                                      <span>by</span>
                                      <a href="' . url('profile') . '/' . $value->user_id . '">' . $value->user_name . '</a>
                                    </li>
                                    <li class="entry__meta-date">' . $value->publish_utc . '</li>
                                  </ul>
                                </div>                  
                              </article>
                            </li>';
        }

        return $cacheHtml;


    });


    return $html;

}

function mostPopularSidebar()
{


    $html = Cache::remember("mostPopularRightSide", 3600, function () {

        $most_populars = fetchPost('', 5, returnConfig('orderByViews'));

        $cacheHtml = "";

        foreach ($most_populars as $key => $value) {

            if (empty($value->sportsgram_url)) {
                $url = url("article");
                $imgurl = $value->media_url;
            } else {
                $url = url("sportsgram");
                $imgurl = $value->sportsgram_url;
            }


            $cacheHtml .= '<article class="entry ratio16-9">
                <div class="entry__img-holder">
                    <a href="' . $url . '/' . $value->slug . '">
                        <div class="thumb-container">
                            <img data-src="' . $imgurl . '" src="' . asset('images/empty.png') . '" class="entry__img lazyload" alt="">
                        </div>
                    </a>';
            /*{{-- <div class="entry__play-time">'.$value->sports_name.'{{}}</div> --}}*/
            $cacheHtml .= '</div>
                <div class="entry__body">
                    <div class="entry__header">
                        <h2 class="entry__title">
                            <a href="' . $url . '/' . $value->slug . '">' . $value->title . '</a>
                        </h2>
                    </div>
                </div>
            </article>';

        }

        return $cacheHtml;

    });

    return $html;


}

function isActive()
{

    return returnConfig("active");

}

function uploadFile($file, $path, $extra = [])
{


    if (!empty($file)) {

        $destination = base_path("public/" . $path);

        $ext = strtolower($file->getClientOriginalExtension());

        $name = str_random(2) . "_" . time() . "." . $ext;

        $file->move($destination, $name);

        $links = $destination . "/" . $name;

        $imagesize = getimagesize($links);
        $urlpath = url("") . "/" . $path;

        if (empty($extra["no"]) && !empty($imagesize)) {

            $insert = [
                "media_url" => $urlpath . "/" . $name,
                "type" => 1,
                "active" => 1,
                "created_at" => currentTime()
            ];

            $mediaID = MediaLink::insertGetId($insert);

        }


        return ["name" => $name, "path" => $links, "id" => $mediaID ?? 0];

    }
}

function currentTime()
{

    return \Carbon\Carbon::now();

}

function contestQuestionDetails($id)
{
    $userID = Auth::id() ?? 0;

    return ContestQuestionsMap::join("contest", function ($query) use ($id) {
        $query->on("contest.id", "=", "contest_questions_map.contest_id");
        $query->on("contest.id", "=", DB::raw($id));
        $query->on("contest.active", "=", DB::raw(isActive()));
    })->join("questions", function ($query) {
        $query->on("questions.id", "=", "contest_questions_map.question_id");
        $query->on("questions.active", "=", DB::raw(isActive()));
    })->join("answers", function ($query) {
        $query->on("questions.id", "=", "answers.question_id");
        $query->on("answers.active", "=", DB::raw(isActive()));
    })
        ->join("contest_participants", function ($query) use ($userID) {
            $query->on("contest_participants.contest_id", "=", "contest.id");
            $query->on("contest_participants.active", DB::raw(isActive()));
            $query->on("contest_participants.user_id", DB::raw($userID));
        })
        ->leftJoin("user_contest_answers", function ($query) use ($userID) {
            $query->on("user_contest_answers.question_id", "=", "contest_questions_map.question_id");
            $query->on("user_contest_answers.active", DB::raw(isActive()));
            $query->on("user_contest_answers.user_id", DB::raw($userID));
        })
        ->leftJoin("media_link as contest_media", function ($query) {
            $query->on("contest_media.id", "contest.media_id");
            $query->on("contest_media.active", DB::raw(isActive()));
        })
        ->leftJoin("media_link as question_media", function ($query) {
            $query->on("question_media.id", "=", "questions.media_id");
            $query->on("question_media.active", DB::raw(isActive()));
        })
        ->join("contest_questions_map as question_count", function ($query) use ($id) {
            $query->on("contest.id", "=", "question_count.contest_id");
            $query->on("contest.id", DB::raw($id));
            $query->on("contest.active", DB::raw(isActive()));
        })
        ->leftJoin("user_contest_answers as answer_count", function ($query) use ($id) {
            $query->on("question_count.question_id", "=", "answer_count.question_id");
            $query->on("answer_count.active", DB::raw(isActive()));
        })
        ->where([
            "contest_questions_map.contest_id" => $id,
            "contest_questions_map.active" => isActive()
        ])
        ->groupBy(["questions.id"])
        ->havingRaw("MAX(user_contest_answers.id) IS NULL")
        ->inRandomOrder()
        ->first([
            "contest.name as contest_name",
            "contest.id as contest_id",
            "contest_media.media_url as contest_image",
            "question_media.media_url as question_image",
            "contest.description as contest_description",
            "questions.id as question_id",
            "questions.name as question",
            DB::raw("GROUP_CONCAT(DISTINCT answers.id SEPARATOR '" . returnConfig("column_separator") . "') as option_id,
    GROUP_CONCAT(DISTINCT answers.option SEPARATOR '" . returnConfig("column_separator") . "') as option_name,
            COUNT(DISTINCT question_count.id) as total_questions,
            COUNT(DISTINCT answer_count.id) as answered,
            SUM(answer_count.score) as scored
            ")
        ]);

}

function insertContestQuestion($questionID)
{

    $extra = [
        "data" => [
            "user_id" => Auth::id(),
            "question_id" => $questionID,
            "correct" => 0,
            "score" => 0,
            "time" => 0,
            "active" => isActive(),
            "option_id" => 0,
            "created_at" => currentTime()
        ]
    ];

    insertData(ContestUserAnswers::class, $extra);

}

function insertGameQuestion($questionID, $sessionID)
{

    $extra = [
        "data" => [
            "session_id" => $sessionID,
            "question_id" => $questionID,
            "correct" => 0,
            "score" => 0,
            "time" => 0,
            "active" => isActive(),
            "option_id" => 0,
            "created_at" => currentTime()
        ]
    ];

    insertData(UserGameAnswers::class, $extra);

}

function gameQuestionDetails($id, $sessionID = 0)
{

    $userID = Auth::id() ?? 0;

    return GameQuestionsMap::join("games", function ($query) use ($id) {
        $query->on("games.id", "=", "game_questions_map.game_id");
        $query->on("games.id", "=", DB::raw($id));
        $query->on("games.active", "=", DB::raw(isActive()));
    })->join("questions", function ($query) {
        $query->on("questions.id", "=", "game_questions_map.question_id");
        $query->on("questions.active", "=", DB::raw(isActive()));
    })->join("answers", function ($query) {
        $query->on("questions.id", "=", "answers.question_id");
        $query->on("answers.active", "=", DB::raw(isActive()));
    })
        ->join("games_participants", function ($query) use ($userID) {
            $query->on("games_participants.game_id", "=", "games.id");
            $query->on("games_participants.active", DB::raw(isActive()));
            $query->on("games_participants.user_id", DB::raw($userID));
        })
        ->leftJoin("user_game_answers", function ($query) use ($userID, $sessionID) {
            $query->on("user_game_answers.question_id", "=", "game_questions_map.question_id");
            $query->on("user_game_answers.active", DB::raw(isActive()));
            $query->on("user_game_answers.session_id", DB::raw($sessionID));
        })
        ->leftJoin("media_link as contest_media", function ($query) {
            $query->on("contest_media.id", "games.media_id");
            $query->on("contest_media.active", DB::raw(isActive()));
        })
        ->leftJoin("media_link as question_media", function ($query) {
            $query->on("question_media.id", "=", "questions.media_id");
            $query->on("question_media.active", DB::raw(isActive()));
        })
        ->join("game_questions_map as question_count", function ($query) use ($id) {
            $query->on("games.id", "=", "question_count.game_id");
            $query->on("games.id", DB::raw($id));
            $query->on("games.active", DB::raw(isActive()));
            $query->on("question_count.active", DB::raw(isActive()));
        })
        ->leftJoin("user_game_answers as answer_count", function ($query) use ($id, $sessionID) {
            $query->on("question_count.question_id", "=", "answer_count.question_id");
            $query->on("answer_count.active", DB::raw(isActive()));
            $query->on("answer_count.session_id", DB::raw($sessionID));
        })
        ->leftJoin("game_sessions", function ($query) use ($id, $sessionID) {
            $query->on("games.id", "=", "game_sessions.game_id");
            $query->on("game_sessions.active", DB::raw(isActive()));
            $query->on("game_sessions.id", DB::raw($sessionID));
        })
        ->where([
            "game_questions_map.game_id" => $id,
            "game_questions_map.active" => isActive()
        ])
        ->groupBy(["questions.id"])
        // ->where('questions.id' , 288)
        ->havingRaw("MAX(user_game_answers.id) IS NULL")
        // ->inRandomOrder()
        // ->orderBy('answers.option','asc')
        ->first([
            "games.name as contest_name",
            "games.id as contest_id",
            "games.start_utc as start_utc",
            "contest_media.media_url as contest_image",
            "question_media.media_url as question_image",
            "games.description as contest_description",
            "questions.id as question_id",
            "games.community_id",
            "questions.name as question",
            DB::raw("GROUP_CONCAT(DISTINCT answers.id SEPARATOR '" . returnConfig("column_separator") . "') as option_id"),

            DB::raw("GROUP_CONCAT(DISTINCT answers.option SEPARATOR '" . returnConfig("column_separator") . "') as option_name,
            COUNT(DISTINCT question_count.id) as total_questions,
            COUNT(DISTINCT answer_count.id) as answered,
            game_sessions.score as scored
            ")


        ]);


}

function gameEntryCheck($id, $userID)
{


    $contest = Games::leftJoin('games_participants', function ($query) use ($userID) {
        $query->on('games_participants.game_id', '=', 'games.id');
        $query->on('games_participants.active', DB::raw(isActive()));
        $query->on('games_participants.user_id', DB::raw($userID));
    })
        ->where("start_utc", "<", currentTime())
        ->where([
            "games.id" => $id,
            "games.active" => isActive()
        ])
        ->first([
            "games_participants.id as participated",
            "games.entry"
        ]);

    return $contest;

}

function playQuiz()
{

    $userCommunityID = Auth::user()->community_id ?? 0;
    $where = [0];

    if(!empty($userCommunityID))
    {

        $where[] = $userCommunityID;
    }


    $relatedQuiz = getTableData(Games::class, [
        "select" => [
            "games.name",
            "games.slug",
            "media_url",
            "games.id"
        ],
        "joins" => [
            [
                "type" => returnConfig("inner_join"),
                "table" => "sports",
                "left_condition" => "sports.id",
                "right_condition" => "games.sport_id",

            ],
            [
                "type" => returnConfig("left_join"),
                "table" => "media_link",
                "left_condition" => "media_link.id",
                "right_condition" => "games.media_id",
            ],
            [
                "type" => returnConfig("left_join"),
                "table" => "games_participants",
                "left_condition" => "games_participants.game_id",
                "right_condition" => "games.id",
                "conditions" => [
                    "games_participants.user_id" => Auth::id() ?? 0
                ]
            ]
        ],
            "whereIn" => ["games.community_id" => $where],
        "whereNull" => [
            "games_participants.id"
        ],
        "random" => 1,
        "limit" => 3
    ]);

    return $relatedQuiz;
}

function getGameIDFromSlug($slug): int
{


    $data = getTableData(Games::class, [
        "select" => [
            "id"
        ],
        "where" => [
            "slug" => $slug
        ],
        "single" => 1
    ]);


    return $data->id ?? 0;
}

function getCurrencies()
{

    $currencies = Cache::remember('masterCurrency', 10800, function () {

        return getTableData(Currency::class, [
            "select" => ["id", "name", "sign"]
        ]);

    });
    /*Cache::flush();*/
    return $currencies;
}

function oauth()
{
    /*$stack = HandlerStack::create();
    $middleware = new Oauth1([
        'consumer_key'    => 'ck_9686042d5451324ca0af8ca0c2cc1a6d900a48c0',
        'consumer_secret' => 'cs_f47186373556db96e1ccdd78cd7f1638c0003052',
        'token'           => '',
        'token_secret'    => ''
    ]);
    $stack->push($middleware);
    $client = new Client([
        'base_uri' => 'http://localhost/web_sportco_publish/public/wordpress/',
        'handler' => $stack,
        'auth' => 'oauth'
    ]);*/

    $woocommerce = new Client(
    /*'http://52.66.6.131/web_sportco_publish/public/wordpress', // Your store URL
    'ck_93340098fa25ee3ba506b404cf12ae9f5b4ced7b', // Your consumer key
    'cs_fc56951be527ea12d1f45af7fc0cea7e73749d97', // Your consumer secret
    'HMAC-SHA1',*/

        url('') . '/wordpress', // Your store URL
        returnConfig('wordpress_consumer_key'), // Your consumer key
        returnConfig('wordpress_consumer_secret'), // Your consumer secret
        'HMAC-SHA1',

        [
            'wp_api' => true, // Enable the WP REST API integration
            'version' => 'wc/v3' // WooCommerce WP REST API version

        ]
    );


    return $woocommerce;
}

function cartauth()
{
    $stack = HandlerStack::create();

    $middleware = new Oauth1([

        /*live
         * 'consumer_key'    => 'ck_93340098fa25ee3ba506b404cf12ae9f5b4ced7b',
        'consumer_secret' => 'cs_fc56951be527ea12d1f45af7fc0cea7e73749d97',*/

        'consumer_key' => returnConfig('wordpress_consumer_key'),
        'consumer_secret' => returnConfig('wordpress_consumer_secret'),
        'token' => '',
        'token_secret' => ''

    ]);

    $stack->push($middleware);

    $client = new \GuzzleHttp\Client([
        'base_uri' => url('') . '/wordpress/wp-json/wc/v3/',
        'handler' => $stack,
        'auth' => 'oauth'
    ]);


    return $client;
}

function PopularContest()
{
    $userID = Auth::id() ?? 0;


    $referredID = Auth()->user()->referred_by ?? 0;
    $influencer = getIsInfluencer($referredID);
    $userCommunityID = Auth::user()->community_id ?? 0;
   /* if ($userCommunityID == returnConfig("community.rcb")){
        $play = [0,1]; #single and multiple played games
    }
    else{
        $play = [0]; #single played games

    }*/
    $play = [0];
    if(!empty($userCommunityID))
    {

        $play[] = $userCommunityID;
    }
    $livecontest = Games::leftjoin('media_link', 'media_link.id', '=', 'games.media_id')
        ->join('sports', function ($query) {
            $query->on('sports.id', '=', 'games.sport_id');
            $query->on('sports.active', DB::raw(isActive()));
        })
        ->leftJoin('game_sessions', function ($query) use ($userID) {
            $query->on('games.id', '=', 'game_sessions.game_id');

        })
        ->leftJoin('games_participants', function ($query) use ($userID) {
            $query->on('games_participants.game_id', '=', 'games.id');
            $query->on('games_participants.active', DB::raw(isActive()));
            $query->on('games_participants.user_id', DB::raw($userID));
        })
        ->where("start_utc", "<", currentTime())
        ->where("games.active", 1)
        ->whereIn("games.community_id", $play)
        /*->whereNull("games_participants.id")*/
        ->orderBy("playcount", "DESC")
        ->orderBy("start_utc", "DESC")
        ->groupBy(["games.id"])
        ->limit(10)
        ->get([
            "games.id",
            "games.name as name",
            "games.entry",
            "games.slug",
            "sports.name as sport",
            "description",
            "start_utc",
            "media_url",
            "played",
            DB::raw('count(game_sessions.user_id) as playcount')

        ]);
    return $livecontest;

}

function proiflesidebar($id)
{


    $user = User::leftjoin('user_details', function ($join) {
        $join->on('user_details.user_id', '=', 'users.id');
        $join->on('user_details.active', DB::raw("1"));

    })
        ->where([
            "users.id" => $id,
            "users.active" => 1,
        ])->first([
            "name as name",
            "nickname as u_name",
            "description",
            "email",
            "pic",
            "users.id",
            "app_id"
        ]);


    if (empty($user->u_name)) {
        $user['u_name'] = $user->name;
    }
    return $user;
}


function crypto_rand_secure($min, $max)
{

    $range = $max - $min;

    if ($range < 1) return $min; // not so random...

    $log = ceil(log($range, 2));

    $bytes = (int)($log / 8) + 1; // length in bytes

    $bits = (int)$log + 1; // length in bits

    $filter = (int)(1 << $bits) - 1; // set all lower bits to 1

    do {

        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

        $rnd = $rnd & $filter; // discard irrelevant bits

    } while ($rnd > $range);

    return $min + $rnd;

}


# Function to generate token by length

function getToken($length)
{
    $token = "";

    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";

    $codeAlphabet .= "0123456789";

    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {

        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];

    }

    return $token;
}

function getbasevalue($id)
{

    $tokenValue = getTableData(SiteMeta::class, [
        "select" => [
            "id",
            "name",
            "value"
        ],
        "where" => [
            "id" => $id
        ],
        "single" => 1,
        "active" => 1,
    ]);
    return $tokenValue;

}

function tokenvalue($value)
{
    /*$ETHusdvalue = getETHinUSD();*/
    /*print_r($ETHusdvalue);die;*/

    $sportcoTokenUSD = getbasevalue(returnConfig('Sportco_token_usd'));
    $ETHvalue = $value;
    $EthTransctionFee = getbasevalue(returnConfig('transaction_fee_ETH'));
    $MinTransctionFeeETH = getbasevalue(returnConfig('min_trasaction_amount'));
    $adminemail = getbasevalue(returnConfig('admin_email'))->value;

    $transactionfee = $EthTransctionFee->value;


    $ETHfee_token = round($ETHvalue * $EthTransctionFee->value / $sportcoTokenUSD->value, 4);
    $mintrasanction_token = number_format($ETHvalue * $MinTransctionFeeETH->value / $sportcoTokenUSD->value);


    $ETHinToken = $mintrasanction_token / $sportcoTokenUSD->value;

    return [
        'ETH_token_Fee' => $ETHfee_token,
        'min_transaction_token' => $mintrasanction_token,
        "ETHintoken" => $ETHinToken,
        "trasactionfee" => $transactionfee,
        "admin_email" => $adminemail,
        "ETHvalue_USD" => $ETHvalue,


    ];

}

function getETHinUSD()
{
    # This example requires curl is enabled in php.ini
    $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?symbol=ETH&convert=USD';
    /*$parameters = [

        'start' => '1',
        'limit' => '5000',
        'convert'=> 'USD',
    ];*/

    $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: 6da918f7-65a1-4ca4-83b9-fb3893042688'
    ];
    //$qs = http_build_query($parameters);
    $request = "{$url}"; // create the request URL


    $curl = curl_init(); // Get cURL resource
// Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => $request,            // set the request URL
        CURLOPT_HTTPHEADER => $headers,     // set the headers
        CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
    ));

    $response = curl_exec($curl); // Send the request, save the response
    $jsondecode = json_decode($response); // print json decoded response
    $ETHUSDvalue = $jsondecode->data->ETH->quote->USD->price;
    return $ETHUSDvalue;

    curl_close($curl); // Close request
}

function getUserId($id)
{


    $UserIdObj = getTableData(users::class, [
        "select" => [
            "id"
        ],
        "where" => [
            "active" => 1,
            "nickname" => $id,
        ],
        "single" => 1
    ]);


    $UserID = $UserIdObj->id;


    return $UserID;
}

function send_to_slack_channel($msg, $channel)
{

    if (isProd() == 1) {

        $cmd = 'curl -X POST --data-urlencode "payload={\"channel\": \"#' . $channel . '\", \"username\": \"Reporter\", \"text\": \"' . $msg . '\"}" https://hooks.slack.com/services/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';

        return shell_exec($cmd);

    }

}


function UserLatestPost($userID)
{


    $userlatestpost = getTableData(Posts::class, [
        "select" => [
            "title",
            "posts.slug",
            "category_id",
            "media_data.media_url as sportsgram_url",
            "description",
            "posts.type",
            "media_link.media_url as media_url",
            "users.name",
            "users.nickname",
            DB::raw('DATE_FORMAT(posts.publish_utc, "%d-%M-%Y") as date')
        ],
        "joins" => [
            [
                "type" => returnConfig("left_join"),
                "table" => "media_link",
                "left_condition" => "posts.media_id",
                "right_condition" => "media_link.id",
            ],
            [
                "type" => returnConfig("left_join"),
                "table" => "users",
                "left_condition" => "posts.created_by",
                "right_condition" => "users.id",
            ],
            [
                "type" => returnConfig("left_join"),
                "table" => "sportsgram_media",
                "left_condition" => "sportsgram_media.post_id",
                "right_condition" => "posts.id",
            ],
            [
                "type" => returnConfig("left_join"),
                "table" => "media_data",
                "alias" => "media_link as media_data",
                "left_condition" => "media_data.id",
                "right_condition" => "sportsgram_media.media_id",
            ],
        ],
        "where" => [
            "posts.created_by" => $userID,
            "posts.status" => 1,
            "posts.active" => 1,
        ],
        'group' => [
            "posts.id"
        ],
        "order" => [
            "publish_utc" => "DESC"
        ],
        "limit" => 2

    ]);

    return $userlatestpost;
}

function isProd()
{
    return returnConfig('isprod');
}

function profileLeftbar($userID)
{


    $TokenValue = getTableData(SiteMeta::class, [
        "select" => [
            "name",
            "value",
            "id"
        ],
        "where" => [
            "active" => 1,
            "id" => returnConfig('referred_token_master_value'),
        ],
        "single" => 1

    ]);


    $wherIn = [returnConfig("referred_token"), returnConfig("first_post_tokens")];



    $masterRewardTokens = getTableData(MasterRewards::class, [
        "select" => [
            "name",
            "tokens",
            "id"
        ],
        "whereIn" => ["id" => $wherIn],
    ]);


    $referreduser = UserRewards::select([
        "user_rewards.link_id",
        DB::raw("SUM(tokens) as tokens"),
        "name",
        "users.created_at"

    ])
        ->leftJoin('users', function ($query) {
            $query->on('user_rewards.link_id', '=', 'users.id');
            $query->on('user_rewards.active', DB::raw(isActive()));
            $query->on('users.active', DB::raw(isActive()));
        })
        ->where([
            "user_id" => $userID
        ])
        ->whereIn("user_rewards.reward_id", $wherIn)
        ->whereNotNull("email_verified_at")
        ->orderBy("users.created_at", "DESC")
        ->groupBy("users.id")
        ->paginate(10, ["*"], "rfredusrs");


    $game = gameSessions($userID);

    $postQuery = Posts::leftjoin('post_tokens', function ($join) {
        $join->on('posts.id', '=', 'post_tokens.post_id');
        $join->on('post_tokens.active', DB::raw("1"));
    })
        ->leftjoin('user_rewards as normal', function ($join) {
            $join->on('normal.id', '=', 'post_tokens.link_id');
            $join->on('post_tokens.active', DB::raw("1"));
            $join->on('normal.reward_id', "!=", DB::raw("7"));


        })
        ->leftjoin('user_rewards as bonus', function ($join) {
            $join->on('bonus.id', '=', 'post_tokens.link_id');
            $join->on('post_tokens.active', DB::raw("1"));
            $join->on('bonus.reward_id', DB::raw("7"));
        })->where([
            "created_by" => $userID,
            "posts.active" => 1,

        ]);

    if ($userID != Auth::id()) {

        $postQuery->where("posts.status", "!=", returnConfig("draft"));

    }


    $posts = $postQuery
        ->leftjoin('post_stats', 'post_stats.post_id', '=', 'posts.id')
        ->orderBy("posts.created_at", "DESC")
        ->groupBy('posts.id')->select([
            "title",
            "posts.id",
            DB::raw("(CAST(SUM(normal.tokens) * IFNULL((COUNT(normal.id) / COUNT(bonus.id)),1) / COUNT(normal.id) AS  DECIMAL(10,2))) as normal_tokens,
(CAST(SUM(bonus.tokens) / COUNT(bonus.id) AS DECIMAL(10,2))) as bonus_tokens"),
            //DB::raw("SUM(bonus.tokens) as bonus_tokens"),
            DB::raw("SUM(DISTINCT post_stats.likes) as likes"),
            DB::raw("SUM(DISTINCT post_stats.views) as views"),
            DB::raw('DATE_FORMAT(posts.publish_utc, "%d-%M-%Y") as date'),
            "posts.created_at",
            "posts.status"
        ])->paginate(10, ["*"], "post");
    /*->toSql();*/


    return [
        "posts" => $posts,
        "games" => $game,
        "referredusers" => $referreduser,
        "ReferredTokenValue" => $TokenValue,
        "masterRewardTokens" => $masterRewardTokens,
    ];
}

function imageresize($file)
{
    $imgname = $file->getClientOriginalName();
    $imageSize = getimagesize($file);

    $newfile = base_path("public/images/post/" . $imgname);

    list($width, $height) = $imageSize;
    $imageFileType = $imageSize['mime'] ?? "";
    $ratio = $width / $height;
    if ($ratio > 1) {
        $resized_width = 500; //suppose 500 is max width or height
        $resized_height = 500 / $ratio;
    } else {
        $resized_width = 500 * $ratio;
        $resized_height = 500;
    }

    if ($imageFileType == 'png') {
        $image = imagecreatefrompng($newfile);
    } else if ($imageFileType == 'gif') {
        $image = imagecreatefromgif($newfile);
    } else {
        $image = imagecreatefromjpeg($newfile);
    }

    $resized_image = imagecreatetruecolor($resized_width, $resized_height);
    imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $resized_width, $resized_height, $width, $height);
}

function imageUrl($imgid, $pid)
{
    getTableData(MediaLink::class, [
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
    return;
}

function globalSeparator()
{
    return returnConfig("column_separator");
}

function sportsgramFetch($limit, $paginate = 0,$communityID = "")
{

    if (!empty($communityID)){
        $sectionid = returnConfig("RCB_section");
    }
    else{
        $sectionid = "";
    }

    $posts = getTableData(Posts::class, [
        "select" => [
            "title",
            "sports.name as s_name",
            "users.id as user_id",
            "users.name",
            "users.nickname",
            "posts.created_at",
            DB::raw('DATE_FORMAT(posts.publish_utc, "%d-%M-%Y") as publish_utc'),
            "media_url",
            "slug",
            /*DB::raw("GROUP_CONCAT(media_link.media_url separator '" . globalSeparator() . "') as media_data")*/
            DB::raw('count(media_link.media_url) as media_count')
        ],
        "joins" => [
            [
                "table" => "users",
                "type" => returnConfig("left_join"),
                "left_condition" => "users.id",
                "right_condition" => "posts.created_by"
            ],
            [
                "table" => "sports",
                "type" => returnConfig("left_join"),
                "left_condition" => "sports.id",
                "right_condition" => "posts.sports_id"
            ],
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
            ]
        ],
        "where" => [
            "posts.type" => returnConfig("sportsgramtype"),
            "status" => returnConfig("accepted_post"),
            "section_id" => $sectionid
        ],
        "group" => [
            "posts.id"
        ],
        "order" => [
            "posts.publish_utc" => "DESC"
        ],
        "limit" => $limit,
        "paginate" => $paginate
    ]);

    return $posts;
}

function postDetail($slug)
{
    $select = [
        'posts.id as id',
        'title',
        DB::raw('group_concat(DISTINCT tags.name) as tag_name'),
        'posts.description',
        'posts.meta_description',
        'posts.meta_title',
        'posts.meta_keyword',
        'posts.publish_utc',
        'sports.name as sports_name',
        'category.name as cat_name',
        'category.id as cat_id',
        'posts.created_at',
        DB::raw('DATE_FORMAT(posts.publish_utc, "%d-%M-%Y") as date'),
        'users.name as user_name',
        //'users.id as user_id',
        'users.nickname as user_id',
        'user_details.description as user_desc',
        'user_details.pic as user_pic',
        'media_url',
        'posts.type as type',
        'sports.id as sports_id',
        'userstat.likes as iliked',
        'userstat.fav as ifav',
        DB::raw("SUM(DISTINCT post_stats.likes) as likes"),
        DB::raw("SUM(DISTINCT post_stats.views) as views"),
        DB::raw("SUM(DISTINCT post_stats.shares) as shares"),
    ];


    $where = [
        'posts.active' => 1,
        'posts.status' => returnConfig("accepted_post"),
        'sports.active' => 1,
        'posts.slug' => $slug,
    ];
    $post = Posts::join('sports', 'sports.id', '=', 'posts.sports_id')
        ->leftjoin('category', 'category.id', '=', 'posts.category_id')
        ->join('users', 'users.id', '=', 'posts.created_by')
        ->leftjoin('post_tags', function ($query) {
            $query->on('posts.id', '=', 'post_tags.post_id');
            $query->on('post_tags.active', DB::raw("1"));

        })
        ->leftjoin('tags', 'post_tags.tag_id', '=', 'tags.id')
        ->leftjoin('media_link', 'media_link.id', '=', 'posts.media_id')
        ->leftjoin('post_stats', 'post_stats.post_id', '=', 'posts.id')
        ->leftJoin('post_stats as userstat', function ($join) {

            $join->on('userstat.post_id', '=', 'posts.id');
            $join->on('userstat.user_id', DB::raw(Auth::id() ?? 0));
        })
        ->leftjoin('user_details', function ($join) {
            $join->on('user_details.user_id', '=', 'users.id');
            $join->on('user_details.active', DB::raw("1"));

        })
        ->where($where)
        ->first($select);

    $id = $post->id;

    $prev = DB::select("(SELECT slug as prev,null as next,type, title FROM posts WHERE status = 1 and active = 1 AND id < ? ORDER BY id DESC limit 1)
                                       UNION ALL
                                 (SELECT NUll as col1, slug as next,type,title FROM posts WHERE status = 1 and active = 1 AND id > ? limit 1)", [$id, $id]);


    return [
        "post" => $post,
        "prev" => $prev
    ];
}

function userFirstPost($id)
{
    $authorID = $id;
    $userfirstpost = Posts::where([
        'created_by' => $authorID,
        'active' => '1',
        'status' => '1'
    ])
        ->count();


    return $userfirstpost;

}

function usereventsearch($userid, $eventid)
{

    $eventexit = UserEvents::where([
        "user_id" => $userid,
        "event_id" => $eventid,
        "active" => isActive()
    ])->count();

    return $eventexit;

}

function gameSessions($id)
{
    $userID = $id;
    $data = getTableData(GameSessions::class, [
        "select" => [
            "games.name",
            "game_sessions.score",
            "time",
            "completed",
        ],
        "joins" => [
            [
                "type" => returnConfig("inner_join"),
                "table" => "games",
                "left_condition" => "game_sessions.game_id",
                "right_condition" => "games.id",
                "conditions" => [
                    "game_sessions.user_id" => $userID,
                    "game_sessions.completed" => 1
                ]
            ],
        ],
        "order" => [
            "game_sessions.created_at" => "DESC",
        ],
        "paginate" => 10
    ]);
    return $data;
}

function userTokenDetails($id)
{

    //TODO : Singular query for both earn and redeem

    $earned = UserRewards::join('master_rewards', function ($query) {
        $query->on('master_rewards.id', '=', 'user_rewards.reward_id');
        $query->on('master_rewards.type', DB::raw("1"));
        $query->on('master_rewards.active', DB::raw("1"));
    })->where([
        "user_id" => $id,
        'user_rewards.active' => '1',

    ])
        ->sum('user_rewards.tokens');


    $redeemed = UserRewards::join('master_rewards', function ($query) {
        $query->on('master_rewards.id', '=', 'user_rewards.reward_id');
        $query->on('master_rewards.type', DB::raw("2"));
        $query->on('master_rewards.active', DB::raw("1"));
    })->where([
        "user_id" => $id,
        'user_rewards.active' => '1',
    ])
        ->sum('user_rewards.tokens');

    $onHold = getTableData(Transactions::class, [
        "select" => [
            DB::raw("SUM(tokens) as token")
        ],
        "where" => [
            "user_id" => $id,
            "status" => 0,
        ],
        "single" => 1
    ]);

    $onHoldAmount = $onHold->token ?? 0;

    //$balance = $earned - $redeemed - $onHoldAmount;

    return ['earned' => $earned, 'redeemed' => $redeemed];

}

function getIsInfluencer($id)
{

    return getTableData(InfluencersCommunities::class, [
        "select" => [
            "reward",
            "community_id",
            "user_id",
            "activate"
        ],
        "where" => [
            "user_id" => $id
        ],
        "single" => 1
    ]);

}

function UsersRank($limit, $where = "")
{
    $rankers = getTableData(GameSessions::class, [
        "select" => [
            "users.name",
            "users.id",
            "game_sessions.user_id",
            "game_sessions.score",
            "game_sessions.id as g_id",
            "game_sessions.time",
            "game_sessions.updated_at",
            "games.name as game_name",
            "games.played",
            "games.completion_token",
            "games.description as game_description",
            "media_link.media_url",
        ],
        "where" => $where,
        "joins" => [
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
        ],
        "order" => [
            "game_sessions.score" => "DESC",
            "game_sessions.time" => "ASC",
        ],
        "limit" => $limit
    ]);
    return $rankers;
}
function getUserName($id){
    $UsersName = User::where('id', '=', $id)->select('name')->first();
    return $UsersName->name;

}

