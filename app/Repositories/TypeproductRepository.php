<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Typeproduct;
use App\Repositories\UtilityRepository;

class TypeproductRepository {

	public function __construct(Typeproduct $typeProduct) {
		$this->typeProduct = $typeProduct;
	}

	public function getAll(){
		return $this->typeProduct->whereNull('type_product_deleted_date')
								 ->join('tb_user','tb_user.user_id','=','tb_type_product.type_product_created_user_id')
								 ->orderBy('type_product_id','DESC')->get();
	}

	public function getById($type_product_id){
		return $this->typeProduct->where('type_product_id',$type_product_id)->first();
	}

	public function save($data){
		$this->typeProduct->insert($data);
	}

	public function update($type_product_id, $data){
		$this->typeProduct->where('type_product_id',$type_product_id)->update($data);
	}

}