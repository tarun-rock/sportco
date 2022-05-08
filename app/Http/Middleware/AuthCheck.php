<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!Auth::check())
        {

            return $next($request);

        }

        $id = Auth::user()->type;

        $starter = $request->route()->getAction('prefix');

        $admin = '/dashboard';

        $user = "";

        if($id == config('constant.user'))
        {

            if(auth()->user()->active != 1)
            {

                Auth::logout();

                return redirect("/");

            }

            if($starter == $admin)
            {

                return redirect($user);
            }
           /* if(!empty(session()->has('verified_email')))
            {


                session()->remove('verified_email');

            }*/


            if(!empty(session()->has('joinedviarefferal')))
            {


                session()->remove('joinedviarefferal');

            }

        }
        else if($id == config('constant.admin'))
        {

            if($starter != $admin)
            {
//                return redirect($admin);
            }

        }
        else
        {
            abort(404);
        }

        return $next($request);
    }
}
