<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Validator;
//use Hash;
use App\Repositories\ProductpictureRepository;
use \Illuminate\Database\QueryException;
use Carbon\Carbon;

class ProductpictureController extends Controller {

    public function __construct (ProductpictureRepository $repoProductpic) {
    	$this->repoProductpic = $repoProductpic;
    }

    public function saveProductpicture(Request $request){
    	if(!empty($request)){
    		$jdata = ['status' => 'error','msg' => '','time' => ''];

    		$time = $request->time;
    		$path = public_path().'/uploads/products/';
    		foreach ($request->product_picture_name as $key => $value) {
    			$product_picture_name = $request->product_picture_name[$key];
    			$product_picture_name = $this->repoProductpic->uploadPicture('product',$product_picture_name,$path);
    			$data = [
    				'pt_time' => $time,
    				'product_picture_name' => $product_picture_name
    			];
    			$this->repoProductpic->save($data);
    		}

    		$jdata = ['status' => 'success','msg' => '','time' => $time];

    		return response()->json($jdata);
    	}
    }

    public function uploadPreview(Request $request){
    	if(!empty($request)){
    		$time = $request->time;
            $product_id = $request->product_id;
    		$jdata = ['status' => 'error', 'data' => []];
    		$pics = $this->repoProductpic->getPictureByTime($time, $product_id);
    		$datas = [];
    		foreach ($pics as $key => $value) {
    			$datas[] = (object)[
    				'id' => $value->product_picture_id,
    				'img' => url('public/uploads/products/').'/'.$value->product_picture_name,
    				'name' => $value->product_picture_name
    			];
    		}
    		$jdata = ['status' => 'success', 'data' => $datas];
    		return response()->json($jdata);
    	}
    }

    public function delUploadPreview(Request $request){
    	if(!empty($request)){
    		$jdata = ['status' => 'error', 'msg' => ''];
    		$id = $request->id;
    		$this->repoProductpic->delPictureById($id);
    		$jdata = ['status' => 'success', 'msg' => ''];
    		return response()->json($jdata);
    	}
    }

}