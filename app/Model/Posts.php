<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Posts extends Model implements Feedable
{
    protected $table = 'posts';

    public function toFeedItem()
    {
        if ($this->type == returnConfig("sportsgramtype")) {
            $link = "sportsgram/" . $this->slug;
        } else {
            $link = "article/" . $this->slug;
        }


        return FeedItem::create([
            'id' => $link,
            'title' => $this->title,
            'summary' => articleLimiter($this->description,150)."<br> <a href='".url($link)."'>Read More</a>",
            'updated' => $this->updated_at,
            'link' => $link,
            'author' => getUserName($this->created_by),
        ]);
    }

    public static function getFeedItems($id)
    {

        $where = [
            "active" => 1,
            "status" => 1
        ];

        if(!empty($id))
        {
            $where["rss_id"] = $id;
        }

        return Posts::where($where)->orderBy("publish_utc", "DESC")->limit(100)->get();
    }

}


