<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{

    protected $table = 'store_categories';

    public function childs() {

        return $this->hasMany('App\Model\StoreCategory','parent_id','id') ;

    }

}
