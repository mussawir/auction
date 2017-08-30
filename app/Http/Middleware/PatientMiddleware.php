<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PatientMiddleware
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
            if(Auth::user()->role == '4'){
                return $next($request);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }


    }

}