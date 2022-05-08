<?php
/**
 * Created by PhpStorm.
 * User: kinshuk
 * Date: 21/2/19
 * Time: 3:12 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class countries extends Model
{
    protected $table = 'countries';

    // protected $appends= ["plans"];

    public function users()
    {
        return $this->hasMany('App\Model\User');
    }


    public function plans(){
        return $this->hasMany('App\Model\Plans', 'country_id');
    }
}