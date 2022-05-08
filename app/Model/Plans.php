<?php
/**
 * Created by PhpStorm.
 * User: kinshuk
 * Date: 21/2/19
 * Time: 3:12 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
	/*
     * @function ChapterModel
     *
     * @table
     * define
     *
     * @author
     * Prema Ramachandra
     */
    protected $table = 'plans';
    public $timestamps = false;

    public function country(){
        return $this->belongsTo('App\Model\countries');
    }

    public static function getSubjectAttribute($value){
        if($value !=null){
            return ucfirst($value);
        }
        return $value;

    }
}