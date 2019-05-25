<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\User;
use App\Repositories\UtilityRepository;

class AuthenticationRepository {

	public function __construct(User $user) {
		$this->user = $user;
	}

    public function doLogin($user_name, $user_pass) {

        $validator = $this->validateCredentials(["user_name" => $user_name, "user_pass" => $user_pass]);

        if ($validator->fails()) {

            $message = ['message' => 'กรุณาใส่ข้อมูลให้ถูกต้อง'];
            return $this->redirect_to_login_with_errormsg($message);
        }
       
        if (!($user = $this->findByUsername($user_name))) {

            $message = ['message' => $user_name.' ชื่อผู้ใช้ไม่ถูกต้อง'];
            return $this->redirect_to_login_with_errormsg($message);
        
        }else{

            if( $this->verify_password($user_pass, $user->user_pass)){

                $this->storeAdminData([
                    'user_role'           => $user->user_role,
                    'user_id'       => $user->user_id,
                    'user_name' => $user->user_name
                ]);
                
                if($user->user_role == 'admin'){
                    return redirect()->intended('/setting/supplier');
                }

            } 
            else{

                $message = ['message' => 'รหัสผ่านไม่ถูกต้อง'];
                return $this->redirect_to_login_with_errormsg($message);
            }
        }
    }

    public function findByUsername ($user_name) {
        return $this->user->where('user_name', $user_name)->first();
    }

    protected function validateCredentials ($request_data) {

        return Validator::make($request_data, [
            'user_name' => 'required',
            'user_pass' => 'required',
        ]);


    }

	public function doLogout(){

		session()->forget('user_role');
        session()->forget('user_id');
        session()->forget('user_name');
        return true;

	}

    public function redirect_to_login_with_errormsg ($msg = []) {

        $url = '/login';
        return $this->redirectWithErrors($url, $msg);

    }

    public function redirectWithErrors ($url, $message = []) {

        return redirect($url)->withErrors($message);

    }

    public function verify_password ($pass1, $pass2) {

        return password_verify($pass1, $pass2);

    }

	public function storeAdminData ($data = []){

        foreach ($data as $key => $value) {
            UtilityRepository::session_set($key, $value);
        }

    }

}