<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class PractitionerMiddleware
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
            if(Auth::user()->role == '3'){
				$practitionerId = DB::table('practitioners')->where('user_id',Auth::user()->user_id)->first();
				
				if($practitionerId){
				DB::INSERT('INSERT INTO Practitioner_product (store_id,product_id,discountP,discountAmount,start_date,end_date,pra_price,increased_percentage)
				SELECT '.$practitionerId->pra_id.',products_id,0,0,NULL,NULL,products.map,0 FROM products WHERE products_id NOT IN (SELECT product_id FROM Practitioner_product WHERE store_id = '.$practitionerId->pra_id.')');
				
				if($practitionerId->inactive == 1)
				{
					return redirect ('/errorpage');
				}
                return $next($request);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }


    }

}
}