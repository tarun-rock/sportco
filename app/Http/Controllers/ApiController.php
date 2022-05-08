<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //
    public  function register(Request $request){

        $referraluser = $request->user()->id;
        //$datetime = Carbon::now();

        //$datetime->toTimeString();
        //print_r($datetime->toFormattedDateString());die;


        $status = 0;
        if($request->isMethod("post"))
        {


             $data = $request->all();
            $username = $data['nickname'] ?? "";
            $data['nickname'] = preg_replace('/\s+/', '', $username);
            //print_r($data );die;
            /*$validation = $request->validate([*/
            $validation = Validator::make($data, [
                'name' => 'required|string|max:255',
                'nickname' => 'required|string|min:5|max:12|unique:users,nickname',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',

            ]);
            if ($validation->fails()) {

                return response()->json([
                    "status" => 429,
                    "message" => "failed",
                    "data" => ["error" => $validation->errors()]

                ]);
            }

            User::create([
                'name' => $data['name'],
                'nickname' => $data['nickname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'email_verified_at' => Carbon::now(),
                'type' => 1,
                'created_by' => $referraluser,
                'active' => isActive()
            ]);

            $status = array(
                "status" => 200,
                "message" => "success",
                "data" =>  json_decode('{}')
            );

        }
        return $status;

    }
}
