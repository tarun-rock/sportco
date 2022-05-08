<?php

namespace App\Http\Middleware;


use Closure;



class PlaySessionCheck
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


        if ($request->session()->has('play')) {

            $request->session()->forget('play');

        }

        return $next($request);

    }
}
