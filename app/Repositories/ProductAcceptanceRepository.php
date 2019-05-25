<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Productacceptance;
use App\Models\Productacceptanceitem;
use App\Repositories\UtilityRepository;
use Illuminate\Pagination\Paginator;

class ProductAcceptanceRepository {

	public function __construct(Productacceptance $productacceptance,Productacceptanceitem $productacceptanceitem) {
		$this->productacceptance = $productacceptance;
		$this->productacceptanceitem = $productacceptanceitem;
	}

	public function getAllProductAcceptance($perPage,$search_keyword,$search_by_keyword,$search_status,$search_date,$search_by_date){

		if($search_keyword != null || $search_by_keyword != null || $search_status != null || $search_date != null || $search_by_date != null){

			$sql = "SELECT * FROM tb_product_acceptance ";
			if($search_keyword != null){
				if($search_by_keyword == 'id'){
					$field = 'acceptance_id';
				}else if($search_by_keyword == 'invoice'){
					$field = 'invoice_number';
				}else if($search_by_keyword == 'po'){
					$field = 'po_number';
				}

				$sql .= " WHERE $field LIKE '%".$search_keyword."%' ";
				if($search_status != null){
					$sql .= " AND acceptance_status = '$search_status' ";
				}
				if($search_date != null){
					if($search_by_date == 'date_create'){
						$field = 'acceptance_date_create';
					}else if($search_by_date == 'date_due'){
						$field = 'due_date_pay';
					}else if($search_by_date == 'date_update'){
						$field = 'acceptance_date_update';
					}
					$sql .= " AND DATE($field) = '".$search_date."' ";
				}

			}else if($search_status != null){
				$sql .= " WHERE acceptance_status = '$search_status' ";
				if($search_date != null){
					if($search_by_date == 'date_create'){
						$field = 'acceptance_date_create';
					}else if($search_by_date == 'date_due'){
						$field = 'due_date_pay';
					}else if($search_by_date == 'date_update'){
						$field = 'acceptance_date_update';
					}
					$sql .= " AND DATE($field) = '".$search_date."' ";
				}
			}else if($search_date != null){
				if($search_by_date == 'date_create'){
					$field = 'acceptance_date_create';
				}else if($search_by_date == 'date_due'){
					$field = 'due_date_pay';
				}else if($search_by_date == 'date_update'){
					$field = 'acceptance_date_update';
				}
				$sql .= " WHERE DATE($field) = '".$search_date."' ";
			}

			$sql .= " ORDER BY acceptance_date_create DESC ";
			$raw_query = DB::select(DB::raw($sql));
			return new Paginator($raw_query, count($raw_query), $perPage);


		}else{

			return $this->productacceptance->orderBy('tb_product_acceptance.acceptance_date_create','desc')
										   ->paginate($perPage);

		}

	}

	public function saveProductAcceptance($data){
		$id = $this->productacceptance->insertGetId($data);
		return $id;
	}

	public function updateProductAcceptance($acceptance_id, $data){
		$this->productacceptance->where('acceptance_id',$acceptance_id)->update($data);
	}

	public function saveProductAcceptanceItem($data){
		$this->productacceptanceitem->insert($data);
	}

	public function deleteAllProductAcceptanceItem($acceptance_id){
		$this->productacceptanceitem->where('acceptance_id',$acceptance_id)->delete();
	}

}