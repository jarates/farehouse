<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Validator;
//use Hash;
use App\Repositories\ProvinceRepository;
use \Illuminate\Database\QueryException;
use Carbon\Carbon;

class ProvinceController extends Controller {

    public function __construct (ProvinceRepository $repoProvince) {
    	$this->repoProvince = $repoProvince;
    }

    public function ajaxGetAmphurByProvince(Request $request){
    	if(!empty($request)){

    		$jdata = ['status' => 'error','data' => [],'msg' => ''];

    		$province_id = $request->province_id;
    		$amphurs = $this->repoProvince->getAmphurByProvince($province_id);
    		if($amphurs){

    			$data = [];
    			foreach ($amphurs as $key => $value) {
    				$data[] = (object)[
    					'name_th' => $value->name_th,
    					'id' => $value->id
    				];
    			}

    			$jdata = ['status' => 'success','data' => $data,'msg' => ''];
    		}
    		return response()->json($jdata);

    	}
    }

    public function ajaxGetDistrictByAmphur(Request $request){
    	if(!empty($request)){

    		$jdata = ['status' => 'error','data' => [],'msg' => ''];

    		$amphur_id = $request->amphur_id;
    		$districts = $this->repoProvince->getDistrictByAmphur($amphur_id);
    		if($districts){

    			$data = [];
    			foreach ($districts as $key => $value) {
    				$data[] = (object)[
    					'name_th' => $value->name_th,
    					'id' => $value->id,
    					'zip_code' => $value->zip_code
    				];
    			}

    			$jdata = ['status' => 'success','data' => $data,'msg' => ''];
    		}
    		return response()->json($jdata);

    	}
    }

}