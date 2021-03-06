<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class UserMiddleware{

	public function handle($request, Closure $next){

        if(session()->has('user_role')){
        	
            if(url('login') === $request->url()){
                if(session('user_role') === 'admin'){
                    return redirect('/setting/supplier');
                }
            	
            }

            if(session('user_role') === 'admin'){
            	return $this->nocache($next($request));
            }
                     
        }else{

            return redirect()->guest('login');

        }
        
    }


    protected function nocache($response)
    {
        $response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        $response->headers->set('Pragma','no-cache');

        return $response;
    }

}