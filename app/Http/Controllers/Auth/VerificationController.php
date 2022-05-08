<?php

namespace App\Http\Controllers\Auth;

use App\Model\Games;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be resent if the user did not receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    //protected $playRedirect = false;

    protected function redirectTo()
    {
        // dd("helo");
        $userCommunityID = Auth::user()->community_id ?? 0;
        if ($userCommunityID == returnConfig("community.rcb")){
            $onetimequiz = Games::where('played', '=', 1)->select('slug')->first();
            return route("game-detail",[$onetimequiz->slug]);
        }
        else if ($userCommunityID == returnConfig("community.arsenal")){
            $onetimequiz = Games::where('community_id', returnConfig("community.arsenal"))->select('slug')->first();
            return route("game-detail",[$onetimequiz->slug]);
        }
        else
        {
            return '/';
        }

        /*if($this->playRedirect)
        {
            return '/play';
        }
        else
        {
            return '/';
        }*/
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {


        /*if(!empty($request->get('mode')) && $request->get('mode') == "play")
        {
            $this->playRedirect = true;

        }*/
        // dd("befd");

        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

}
