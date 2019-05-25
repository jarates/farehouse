<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Supplier;
use App\Repositories\UtilityRepository;

class SupplierRepository {

	public function __construct(Supplier $supplier) {
		$this->supplier = $supplier;
	}

	public function getAll(){
		if(!empty($q)){
			return Supplier::where('supplier_name','like',"%$q%")
									->whereNull('deleted_date')
									->orderBy('supplier_id','desc')
									//->paginate($perPage);
									->join('tb_user','tb_user.user_id','=','tb_supplier.updated_user_id')
									->get();
		}else{
			return Supplier::whereNull('deleted_date')->orderBy('supplier_id','desc')
													  //->paginate($perPage);
													  ->join('tb_user','tb_user.user_id','=','tb_supplier.updated_user_id')
													  ->get();
		}
		
	}

	public function getAllBySelect(){
		return $this->supplier->whereNull('deleted_date')->orderBy('supplier_id','desc')->get();
	}

	public function getById($supplier_id){
		return $this->supplier->where('supplier_id',$supplier_id)->first();
	}

	public function save($data){
		$this->supplier->insert($data);
	}

	public function update($supplier_id,$data){
		$this->supplier->where('supplier_id',$supplier_id)->update($data);
	}

}