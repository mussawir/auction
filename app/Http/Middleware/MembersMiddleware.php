<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MembersMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if(Auth::user()->role == '5'){
                return $next($request);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }

    }

}