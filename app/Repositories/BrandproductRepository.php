<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Brandproduct;
use App\Repositories\UtilityRepository;

class BrandproductRepository {

	public function __construct(Brandproduct $brandProduct) {
		$this->brandProduct = $brandProduct;
	}

	public function getAll(){
		return $this->brandProduct->whereNull('brand_product_deleted_date')
								 ->join('tb_user','tb_user.user_id','=','tb_brand_product.brand_product_created_user_id')
								 ->orderBy('brand_product_id','DESC')->get();
	}

	public function getById($brand_product_id){
		return $this->brandProduct->where('brand_product_id',$brand_product_id)->first();
	}

	public function save($data){
		$this->brandProduct->insert($data);
	}

	public function update($brand_product_id, $data){
		$this->brandProduct->where('brand_product_id',$brand_product_id)->update($data);
	}

}