<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Categoryproduct;
use App\Repositories\UtilityRepository;

class CategoryproductRepository {

	public function __construct(Categoryproduct $cateProduct) {
		$this->cateProduct = $cateProduct;
	}

	public function getAll(){
		return $this->cateProduct->whereNull('category_product_deleted_date')
								 ->join('tb_user','tb_user.user_id','=','tb_category_product.category_product_created_user_id')
								 ->orderBy('category_product_id','DESC')->get();
	}

	public function getById($category_product_id){
		return $this->cateProduct->where('category_product_id',$category_product_id)->first();
	}

	public function save($data){
		$this->cateProduct->insert($data);
	}

	public function update($category_product_id, $data){
		$this->cateProduct->where('category_product_id',$category_product_id)->update($data);
	}

}