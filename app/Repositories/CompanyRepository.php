<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Company;
use App\Repositories\UtilityRepository;

class CompanyRepository {

	public function __construct(Company $company) {
		$this->company = $company;
	}

	public function getInfoCompany(){
		return $this->company->join('tb_user','tb_user.user_id','=','tb_info_company.updated_user_id')->first();
	}

	public function update($data){
		$this->company->where('company_id',1)->update($data);
	}

}