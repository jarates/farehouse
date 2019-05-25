<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Province;
use App\Models\Amphur;
use App\Models\District;
use App\Repositories\UtilityRepository;

class ProvinceRepository {

	public function __construct(Province $province,Amphur $amphur,District $district) {
		$this->province = $province;
		$this->amphur = $amphur;
		$this->district = $district;
	}

	public function getAmphurByProvince($province_id){
		return $this->amphur->where('province_id',$province_id)->get();
	}

	public function getDistrictByAmphur($amphur_id){
		return $this->district->where('amphure_id',$amphur_id)->get();
	}

}