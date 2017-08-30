<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use File;
use Illuminate\Support\Facades\Session;

class SupplierMiddleware
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
            if(Auth::user()->role == '6'){
                return $next($request);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }


    }

}