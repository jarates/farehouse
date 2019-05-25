<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Product;
use App\Models\Typeproduct;
use App\Models\Brandproduct;
use App\Models\Categoryproduct;
use App\Models\Supplier;
use App\Repositories\UtilityRepository;

class ProductRepository {

	public function __construct(Product $product, Typeproduct $typeproduct, Brandproduct $brandproduct, Categoryproduct $cateproduct, Supplier $supplier) {
		$this->product = $product;
		$this->typeproduct = $typeproduct;
		$this->brandproduct = $brandproduct;
		$this->cateproduct = $cateproduct;
		$this->supplier = $supplier;
	}

	public function save($data){
		$this->product->insert($data);
	}

	public function getById($product_id){
		return $this->product->where('product_id',$product_id)->first();
	}

	public function getByBarcode($product_barcode){
		return $this->product->where('product_barcode',$product_barcode)->first();
	}

	public function getAll($perPage,$q=null, $search_by=null){
		if(!empty($q)){

			if($search_by == 'id' || $search_by == 'name'){

				if($search_by == 'id'){
					$field = 'product_id';
				}else if($search_by == 'name'){
					$field = 'product_name';
				}

				return $this->product->whereNull('tb_products.product_deleted_date')
						->where('tb_products.'.$field,'like',"%$q%")
						->orderBy('tb_products.product_created_date','desc')
						->join('tb_supplier','tb_supplier.supplier_id','=','tb_products.supplier_id')
						->join('tb_type_product','tb_type_product.type_product_id','=','tb_products.type_product_id')
						->join('tb_brand_product','tb_brand_product.brand_product_id','=','tb_products.brand_product_id')
						->join('tb_category_product','tb_category_product.category_product_id','=','tb_products.category_product_id')
						->paginate($perPage);

			}else{

				if($search_by == 'type'){
				
					$q = $this->typeproduct->whereNull('type_product_deleted_date')
											->where('type_product_name','like',"%$q%")
											->get();
					$arrs = [];
					foreach ($q as $key => $value) {
						$arrs[] = $value->type_product_id;
					}
					$field = 'type_product_id';

				}else if($search_by == 'category'){
					
					$q = $this->cateproduct->whereNull('category_product_deleted_date')
											->where('category_product_name','like',"%$q%")
											->get();
					$arrs = [];
					foreach ($q as $key => $value) {
						$arrs[] = $value->category_product_id;
					}
					$field = 'category_product_id';

				}else if($search_by == 'brand'){
					
					$q = $this->brandproduct->whereNull('brand_product_deleted_date')
											->where('brand_product_name','like',"%$q%")
											->get();
					$arrs = [];
					foreach ($q as $key => $value) {
						$arrs[] = $value->brand_product_id;
					}
					$field = 'brand_product_id';

				}else if($search_by == 'supplier'){
					
					$q = $this->supplier->whereNull('deleted_date')
											->where('supplier_name','like',"%$q%")
											->get();
					$arrs = [];
					foreach ($q as $key => $value) {
						$arrs[] = $value->supplier_id;
					}
					$field = 'supplier_id';

				}

				return $this->product->whereNull('tb_products.product_deleted_date')
						->whereIn('tb_products.'.$field,$arrs)
						->orderBy('tb_products.product_created_date','desc')
						->join('tb_supplier','tb_supplier.supplier_id','=','tb_products.supplier_id')
						->join('tb_type_product','tb_type_product.type_product_id','=','tb_products.type_product_id')
						->join('tb_brand_product','tb_brand_product.brand_product_id','=','tb_products.brand_product_id')
						->join('tb_category_product','tb_category_product.category_product_id','=','tb_products.category_product_id')
						->paginate($perPage);

			}

			


		}else{

			return $this->product->whereNull('tb_products.product_deleted_date')
							->orderBy('tb_products.product_created_date','desc')
							->join('tb_supplier','tb_supplier.supplier_id','=','tb_products.supplier_id')
							->join('tb_type_product','tb_type_product.type_product_id','=','tb_products.type_product_id')
							->join('tb_brand_product','tb_brand_product.brand_product_id','=','tb_products.brand_product_id')
							->join('tb_category_product','tb_category_product.category_product_id','=','tb_products.category_product_id')
							->paginate($perPage);

		}
		
	}

}