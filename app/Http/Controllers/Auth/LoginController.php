<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Games;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /*protected function redirectTo()
    {

        if($this->playRedirect)
        {
            return '/play';
        }
        else
        {
            return '/';
        }
    }*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */

   /* public function redirectTo()
    {
        if ($this->request->has('previous')) {
            $this->redirectTo = $this->request->get('previous');
        }

        return $this->redirectTo ?? '/home';
    }*/


    public function __construct()
    {
        $this->middleware('guest')->except('logout');



    }

    public function showLoginForm()
    {
        /*session(['nickname' => "exist"]);*/
        Session(['link' => url()->previous()]);
        //Session::put('backUrl', url::previous());
        return view('auth.login');
    }


    protected function authenticated(Request $request, $user)
    {
        $data = $request->all();
        $userCommunityID = Auth::user()->community_id ?? 0;
        // dd($userCommunityID);

        if(!empty($userCommunityID)){
            if ($userCommunityID == returnConfig("community.rcb")){
                $communityID = $userCommunityID;
            }
            elseif ($userCommunityID == returnConfig("community.arsenal")){
                $communityID = $userCommunityID;
            }

            $onetimequiz = Games::where('community_id', '=', $communityID)->select('slug')->first();
            $url = route("game-detail",[$onetimequiz->slug]);
            $redirectlink = $url;
        }
        else{
            if(!empty($data['redirect']))
            {

                return redirect()->route($data['redirect'],[Auth::id()]);

            }

            redirect(session('link'));
            $redirectlink = session('link');
        }

        if(empty(Auth::user()->nickname)){
            session(['username' => "notexist"]);
        }


        $status = 1;
        return ['status'=> $status,'redirectlink' => $redirectlink ];

    }
}
