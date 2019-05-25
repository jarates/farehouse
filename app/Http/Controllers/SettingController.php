<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Validator;
//use Hash;
use App\Repositories\SupplierRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\TypeproductRepository;
use App\Repositories\CategoryproductRepository;
use App\Repositories\BrandproductRepository;
use App\Repositories\UserRepository;
use \Illuminate\Database\QueryException;
use Carbon\Carbon;

class SettingController extends Controller {

    public function __construct (SupplierRepository $repoSupplier,CompanyRepository $repoCompany, TypeproductRepository $repoTypeProduct, CategoryproductRepository $repoCateProduct, BrandproductRepository $repoBrandProduct, UserRepository $repoUser){
    	$this->repoSupplier = $repoSupplier;
        $this->repoCompany = $repoCompany;
        $this->repoTypeProduct = $repoTypeProduct;
        $this->repoCateProduct = $repoCateProduct;
        $this->repoBrandProduct = $repoBrandProduct;
        $this->repoUser = $repoUser;

    }

    public function company(){

        $info_company = $this->repoCompany->getInfoCompany();
        $data = ['info_company' => $info_company];
    	return view('setting.company', $data);

    }

    public function saveCompany(Request $request){

        if(!empty($request)){
            $action = $request->action;
            $jdata = ['status' => 'error','msg' => ''];

            $use_address = 0;
            if(isset($request->use_address)){
                $use_address = $request->use_address;
            }
            $data = [

                'name' => $request->name,
                'address' => $request->address,
                'address_province_id' => $request->address_province_id,
                'address_amphur_id' => $request->address_amphur_id,
                'address_district_id' => $request->address_district_id,
                'address_zip_code' => $request->address_zip_code,
                'address_tel' => $request->address_tel,
                'address_tel_next' => $request->address_tel_next,
                'tax_number' => $request->tax_number,
                'address_delivery' => $request->address_delivery,
                'address_delivery_province_id' => $request->address_delivery_province_id,
                'address_delivery_amphur_id' => $request->address_delivery_amphur_id,
                'address_delivery_district_id' => $request->address_delivery_district_id,
                'address_delivery_zip_code' => $request->address_delivery_zip_code,
                'address_delivery_tel' => $request->address_delivery_tel,
                'address_delivery_tel_next' => $request->address_delivery_tel_next,
                'use_address' => $use_address,
                'updated_user_id' => session()->get('user_id'),
                'updated_date' => Carbon::now()

            ];
            try{
                $this->repoCompany->update($data);
                $jdata = ['status' => 'success', 'msg' => ''];

            }catch (\Exception $e) {
                //echo 'error';
            }
            return response()->json($jdata);

        }

    }

    public function supplier(Request $request){

    	//$perPage = 10;
    	//$q = $request->q;
    	$suppliers = $this->repoSupplier->getAll();

        $tab = '';
        if(isset($request->tab)){
            $tab = $request->tab;
        }

    	$data = [
    		'suppliers' => $suppliers,
    		'countSupplier' => count($suppliers),
            'tab' => $tab
    	];
    	return view('setting.supplier', $data);
    }

    public function saveSupplier(Request $request){
    	if(!empty($request)){

    		$jdata = ['status' => 'error','msg' => ''];
    		try{

                $data = [
                    'supplier_name' => $request->supplier_name,
                    'supplier_name_en' => $request->supplier_name_en,
                    'supplier_address' => $request->supplier_address,
                    'province_id' => $request->province_id,
                    'amphur_id' => $request->amphur_id,
                    'district_id' => $request->district_id,
                    'zip_code' => $request->zip_code,
                    'tel' => $request->tel,
                    'tel_next' => $request->tel_next,
                    'fax' => $request->fax,
                    'contact_name' => $request->contact_name,
                    'contact_position' => $request->contact_position,
                    'contact_tel' => $request->contact_tel,
                    'contact_fax' => $request->contact_fax,
                    'contact_email' => $request->contact_email,
                    'payment_method' => $request->payment_method,
                    'payment_bank' => $request->payment_bank,
                    'payment_bank_number' => $request->payment_bank_number,
                    'payment_bank_type' => $request->payment_bank_type,
                    'payment_bank_name' => $request->payment_bank_name,
                    'payment_bank_branch' => $request->payment_bank_branch,
                    'payment_commercial_expenses' => $request->payment_commercial_expenses,
                    'supplier_tax_number' => $request->supplier_tax_number,
                    'supplier_tax_system' => $request->supplier_tax_system,
                    'supplier_note_payment' => $request->supplier_note_payment,
                    'updated_user_id' => session()->get('user_id'),
                    'updated_date' => Carbon::now(),
                ];

    			if($request->action == 'add'){
    				$this->repoSupplier->save($data);
    			}else{

    				$supplier_id = $request->supplier_id;
		    		$this->repoSupplier->update($supplier_id,$data);

    			}

    			$jdata = ['status' => 'success','msg' => ''];

    		}catch (\Exception $e) {
                //echo 'error';
            }
    		
    		return response()->json($jdata);

    	}
    }

    public function editSupplier(Request $request){
    	if(!empty($request)){
    		$jdata = ['status' => 'error','data' => [],'msg' => ''];
    		$supplier_id = $request->supplier_id;
    		$supplier = $this->repoSupplier->getById($supplier_id);
    		if($supplier){
    			$data = (object) $supplier;
    			$jdata = ['status' => 'success','data' => $data,'msg' => ''];
    		}
    		return response()->json($jdata);
    	}
    }

    public function delSupplier(Request $request){
    	if(!empty($request)){
    		$jdata = ['status' => 'error','msg' => ''];

    		$supplier_id = $request->supplier_id;
	    	$deleted_user_id = session()->get('user_id');
	    	$deleted_date = Carbon::now();
	    	$data = [
	    		'deleted_user_id' => $deleted_user_id,
	    		'deleted_date' => $deleted_date
	    	];

    		try{

    			$this->repoSupplier->update($supplier_id,$data);
    			$jdata = ['status' => 'success','msg' => ''];

    		}catch (\Exception $e) {
                //echo 'error';
            }

            return response()->json($jdata);

    	}
    }

    public function typeProduct(Request $request){

        $types = $this->repoTypeProduct->getAll();
        $arrs = [];
        foreach ($types as $key => $value) {

            $getUser = $this->repoUser->getById($value->type_product_updated_user_id);
            if(isset($getUser)){
                $update_date = $value->type_product_updated_date;
                $update_user = $getUser->user_fullname;
            }else{
                $update_date = $value->type_product_created_date;
                $update_user = $value->user_fullname;
            }

            $arrs[] = (object) [
                'type_product_id' => $value->type_product_id,
                'type_product_name' => $value->type_product_name,
                'update_date' => $update_date,
                'update_user' => $update_user
            ];

        }


        $tab = '';
        if(isset($request->tab)){
            $tab = $request->tab;
        }

        $data = [
            'types' => $arrs,
            'tab' => $tab
        ];
        return view('setting.typeproduct', $data);
    }

    public function saveTypeProduct(Request $request){
        if(!empty($request)){
            $jdata = ['status' => 'error','msg' => ''];

            $action = $request->action;
            $type_product_name = $request->type_product_name;
            $type_product_created_date = Carbon::now();
            $type_product_created_user_id = session()->get('user_id');

            if($action == 'add'){
                $data = [
                    'type_product_name' => $type_product_name,
                    'type_product_created_date' => $type_product_created_date,
                    'type_product_created_user_id' => $type_product_created_user_id
                ];
                $this->repoTypeProduct->save($data);
                $jdata = ['status' => 'success','msg' => ''];
            }else if($action == 'edit'){
                $type_product_id = $request->type_product_id;
                $type_product_updated_date = Carbon::now();
                $type_product_updated_user_id = session()->get('user_id');

                $data = [
                    'type_product_name' => $type_product_name,
                    'type_product_updated_date' => $type_product_updated_date,
                    'type_product_updated_user_id' => $type_product_updated_user_id
                ];
                $this->repoTypeProduct->update($type_product_id,$data);
                $jdata = ['status' => 'success','msg' => ''];
            }

            return response()->json($jdata);

        }
    }

    public function categoryProduct(Request $request){

        $cates = $this->repoCateProduct->getAll();
        $arrs = [];
        foreach ($cates as $key => $value) {

            $getUser = $this->repoUser->getById($value->category_product_updated_user_id);
            if(isset($getUser)){
                $update_date = $value->category_product_updated_date;
                $update_user = $getUser->user_fullname;
            }else{
                $update_date = $value->category_product_created_date;
                $update_user = $value->user_fullname;
            }

            $arrs[] = (object) [
                'category_product_id' => $value->category_product_id,
                'category_product_name' => $value->category_product_name,
                'update_date' => $update_date,
                'update_user' => $update_user
            ];

        }

        $tab = '';
        if(isset($request->tab)){
            $tab = $request->tab;
        }

        $data = [
            'cates' => $arrs,
            'tab' => $tab
        ];

        return view('setting.categoryproduct', $data);

    }

    public function saveCategoryProduct(Request $request){
        if(!empty($request)){
            $jdata = ['status' => 'error','msg' => ''];

            $action = $request->action;
            $category_product_name = $request->category_product_name;
            $category_product_created_date = Carbon::now();
            $category_product_created_user_id = session()->get('user_id');

            if($action == 'add'){
                $data = [
                    'category_product_name' => $category_product_name,
                    'category_product_created_date' => $category_product_created_date,
                    'category_product_created_user_id' => $category_product_created_user_id
                ];
                $this->repoCateProduct->save($data);
                $jdata = ['status' => 'success','msg' => ''];
            }else if($action == 'edit'){
                $category_product_id = $request->category_product_id;
                $category_product_updated_date = Carbon::now();
                $category_product_updated_user_id = session()->get('user_id');

                $data = [
                    'category_product_name' => $category_product_name,
                    'category_product_updated_date' => $category_product_updated_date,
                    'category_product_updated_user_id' => $category_product_updated_user_id
                ];
                $this->repoCateProduct->update($category_product_id,$data);
                $jdata = ['status' => 'success','msg' => ''];
            }

            return response()->json($jdata);

        }
    }

    public function brandProduct(Request $request){
        
        $brands = $this->repoBrandProduct->getAll();

        $arrs = [];
        foreach ($brands as $key => $value) {

            $getUser = $this->repoUser->getById($value->brand_product_updated_user_id);
            if(isset($getUser)){
                $update_date = $value->brand_product_updated_date;
                $update_user = $getUser->user_fullname;
            }else{
                $update_date = $value->brand_product_created_date;
                $update_user = $value->user_fullname;
            }

            $arrs[] = (object) [
                'brand_product_id' => $value->brand_product_id,
                'brand_product_name' => $value->brand_product_name,
                'update_date' => $update_date,
                'update_user' => $update_user
            ];

        }

        $tab = '';
        if(isset($request->tab)){
            $tab = $request->tab;
        }

        $data = [
            'brands' => $arrs,
            'tab' => $tab
        ];

        return view('setting.brandproduct', $data);

    }

    public function saveBrandProductt(Request $request){
        if(!empty($request)){
            $jdata = ['status' => 'error','msg' => ''];

            $action = $request->action;
            $brand_product_name = $request->brand_product_name;
            $brand_product_created_date = Carbon::now();
            $brand_product_created_user_id = session()->get('user_id');

            if($action == 'add'){
                $data = [
                    'brand_product_name' => $brand_product_name,
                    'brand_product_created_date' => $brand_product_created_date,
                    'brand_product_created_user_id' => $brand_product_created_user_id
                ];
                $this->repoBrandProduct->save($data);
                $jdata = ['status' => 'success','msg' => ''];
            }else if($action == 'edit'){
                $brand_product_id = $request->brand_product_id;
                $brand_product_updated_date = Carbon::now();
                $brand_product_updated_user_id = session()->get('user_id');

                $data = [
                    'brand_product_name' => $brand_product_name,
                    'brand_product_updated_date' => $brand_product_updated_date,
                    'brand_product_updated_user_id' => $brand_product_updated_user_id
                ];
                $this->repoBrandProduct->update($brand_product_id,$data);
                $jdata = ['status' => 'success','msg' => ''];
            }

            return response()->json($jdata);

        }
    }

}