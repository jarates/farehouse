<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuthenticationRepository;



class AuthenticationController extends Controller {

	public function __construct (AuthenticationRepository $authRepo) {

        $this->authRepo = $authRepo;

    }

    public function showLogin() {

    	return view('login');

    }

    public function doLogin(Request $request){

    	if($request){
    		return $this->authRepo->doLogin($request->user_name, $request->user_pass);
    	}

    }

    public function doLogout() {
        
        $this->authRepo->doLogout();
        return redirect('login');
        
    }

}