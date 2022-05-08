<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Users;
use App\User;
use DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

	


class TestController extends Controller
{
    public function registerUserLoign(Request $request){

        $data= $request->all();

        // dd($data);
        $founduser = DB::table('users')->where('email', $data['email'])->first();

       
        if($founduser){

            return ["error" => 'This email is is taken Please try another email id'];
        }

        $referredUser = getTableData(User::class,[
            "select" => [
                "id"
            ],
            "where" => [
                "app_id" => $data["ref_id"]
            ],
            "single" => 1
        ]);

        // dd($referredUser['id']);

        $username = strtolower(preg_replace('/\s+/', '', $data['nickname']));
        $user = new User;
        $user->name = $data['name'];
        $user->nickname = $username;
        $user->email = $data['email'];
        $user->country_id = $data['country_id'];
        $user->password = Hash::make($data['password']);
        $user->type = returnConfig("user");
        $user->w_id = 0;
        $user->active = isActive();
        $user->app_id = getToken(8);
        $user->referred_by = $referredUser['id'] ?? 0;
        $user->save();



        event(new Registered($user));

                Auth::login($user);

        // Auth::loginUsingId($user->id);
        return ["status" => 1];

    }
}
