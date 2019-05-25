<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\User;
use App\Repositories\UtilityRepository;

class UserRepository {

	public function __construct(User $user) {
		$this->user = $user;
	}

	public function getById($user_id){
		return $this->user->where('user_id',$user_id)->first();
	}

}