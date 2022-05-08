<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tags;
// use illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

class OtherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    
    }
    
    public function getTags(Request $request)
    {


        // $tags = Tags::where(['active'=>1])->pluck("name")->toArray();
        $tags = Tags::select(['text' => 'name', 'id'])->where("name", "like", "%" . trim($request->post('q')) . "%")
            ->where(['active' => 1])->get();
        return ["data" => $tags, "total_count" => count($tags)];

    }

}
