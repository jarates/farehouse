<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Validator;
//use Hash;
use App\Repositories\ProductRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\ProductpictureRepository;
use App\Repositories\TypeproductRepository;
use App\Repositories\CategoryproductRepository;
use App\Repositories\BrandproductRepository;
use App\Repositories\FaqRepository;
use App\Repositories\ProductAcceptanceRepository;
use \Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\Components\Theme;

class ProductController extends Controller {

    public function __construct (ProductRepository $repoProduct, SupplierRepository $repoSupplier, ProductpictureRepository $repoProductpic, TypeproductRepository $repoTypePro, CategoryproductRepository $repoCatePro, BrandproductRepository $repoBrandPro, FaqRepository $repoFaq, ProductAcceptanceRepository $repoProductAcc) {
    	$this->repoProduct = $repoProduct;
    	$this->repoSupplier = $repoSupplier;
    	$this->repoProductpic = $repoProductpic;
        $this->repoTypePro = $repoTypePro;
        $this->repoCatePro = $repoCatePro;
        $this->repoBrandPro = $repoBrandPro;
        $this->repoFaq = $repoFaq;
        $this->repoProductAcc = $repoProductAcc;
    }

    public function management(Request $request){

        $perPage = 10;
        $q = $request->q;
        $search_by = $request->search_by;
        $products = $this->repoProduct->getAll($perPage, $q, $search_by);

        $data = [
            'q' => $q,
            'search_by' => $search_by,
            'products' => $products,
            'perPage' => $perPage
        ];
        return view('product.management', $data);
    }

    public function create(){
    	$suppliers = $this->repoSupplier->getAllBySelect();
        $typeproducts = $this->repoTypePro->getAll();
        $cateproducts = $this->repoCatePro->getAll();
        $brandproducts = $this->repoBrandPro->getAll();
    	$data = [
    		'suppliers' => $suppliers,
            'typeproducts' => $typeproducts,
            'cateproducts' => $cateproducts,
            'brandproducts' => $brandproducts,
            'time' => time()
    	];
    	return view('product.create', $data);
    }

    public function edit($product_id){
        if(!empty($product_id)){

            $suppliers = $this->repoSupplier->getAllBySelect();
            $typeproducts = $this->repoTypePro->getAll();
            $cateproducts = $this->repoCatePro->getAll();
            $brandproducts = $this->repoBrandPro->getAll();
            $product = $this->repoProduct->getById($product_id);
            $faqs = $this->repoFaq->getByProduct($product_id);
            
            $data = [
                'suppliers' => $suppliers,
                'typeproducts' => $typeproducts,
                'cateproducts' => $cateproducts,
                'brandproducts' => $brandproducts,
                'product' => $product,
                'faqs' => $faqs,
                'time' => time()
            ];
            return view('product.edit', $data);

        }
    }

    public function save(Request $request){
    	if(!empty($request)){

    		$jdata = ['status' => 'error','msg' => ''];

    		$action = $request->action;
    		$time = $request->time;

    		$product_id = $request->product_id;
    		$supplier_id = $request->supplier_id;
    		$product_barcode = $request->product_barcode;
    		$product_name = $request->product_name;
    		$product_price_cost = $request->product_price_cost;
    		$product_price_sale = $request->product_price_sale;
    		$product_price_normal = $request->product_price_normal;
    		$product_age = $request->product_age;
    		$product_note = $request->product_note;
    		$product_gp_hps = $request->product_gp_hps;
    		$product_gp_tnews = $request->product_gp_tnews;
    		$product_gp_supplier = $request->product_gp_supplier;
    		$product_created_date = Carbon::now();
    		$product_created_user_id = session()->get('user_id');
            $product_detail_full = $request->product_detail_full;
            $product_detail_short = $request->product_detail_short;
            $type_product_id = $request->type_product_id;
            $category_product_id = $request->category_product_id;
            $brand_product_id = $request->brand_product_id;
            $product_color = $request->product_color;
            $product_dimension_width = $request->product_dimension_width;
            $product_dimension_length = $request->product_dimension_length;
            $product_dimension_height = $request->product_dimension_height;
            $product_dimension_weight = $request->product_dimension_weight;
            $product_dimension_pack_volume = $request->product_dimension_pack_volume;

    		$data = [
    			'product_id' => $product_id,
    			'supplier_id' => $supplier_id,
    			'product_barcode' => $product_barcode,
    			'product_name' => $product_name,
    			'product_price_cost' => $product_price_cost,
    			'product_price_sale' => $product_price_sale,
    			'product_price_normal' => $product_price_normal,
    			'product_age' => $product_age,
    			'product_note' => $product_note,
    			'product_gp_hps' => $product_gp_hps,
    			'product_gp_tnews' => $product_gp_tnews,
    			'product_gp_supplier' => $product_gp_supplier,
    			'product_created_date' => $product_created_date,
    			'product_created_user_id' => $product_created_user_id,
                'product_detail_short' => $product_detail_short,
                'product_detail_full' => $product_detail_full,
                'type_product_id' => $type_product_id,
                'category_product_id' => $category_product_id,
                'brand_product_id' => $brand_product_id,
                'product_color' => $product_color,
                'product_dimension_width' => $product_dimension_width,
                'product_dimension_length' => $product_dimension_length,
                'product_dimension_height' => $product_dimension_height,
                'product_dimension_weight' => $product_dimension_weight,
                'product_dimension_pack_volume' => $product_dimension_pack_volume
    		];


    		try{

                if($action == 'add'){
                    $this->repoProduct->save($data);
                }
    			
                //upload and update picture
    			$this->repoProductpic->updateByTime($time, ['product_id' => $product_id]);

                //delete faq
                if(isset($request->data_remove_faq_id)){
                    $this->repoFaq->delete_allByid($request->data_remove_faq_id);
                }

                if(count($request->faq_name) > 0){
                    foreach ($request->faq_name as $key => $value) {
                        $faq_name = $request->faq_name[$key];
                        $faq_answer_name = $request->faq_answer_name[$key];

                        if($action == 'add'){

                            $data_faq = [
                                'product_id' => $product_id,
                                'faq_name' => $faq_name,
                                'faq_answer_name' => $faq_answer_name
                            ];
                            if($faq_name != '' && $faq_answer_name != ''){
                                $this->repoFaq->save($data_faq);
                            }

                        }else if($action == 'edit'){

                            $faq_id = '';
                            if(isset($request->faq_id[$key])){
                                $faq_id = $request->faq_id[$key];
                            }
                            $data_faq = [
                                'product_id' => $product_id,
                                'faq_name' => $faq_name,
                                'faq_answer_name' => $faq_answer_name
                            ];

                            if(!empty($faq_id)){ //update
                                if($faq_name != '' && $faq_answer_name != ''){
                                    $this->repoFaq->update($faq_id, $data_faq);
                                }
                            }else{ //insert
                                if($faq_name != '' && $faq_answer_name != ''){
                                    $this->repoFaq->save($data_faq);
                                }
                            }

                        }


                    }
                }

    			$jdata = ['status' => 'success','msg' => ''];

    		}catch (\Exception $e) {
                //echo 'error';
            }

    		return response()->json($jdata);

    	}
    }

    public function listProductAcceptance(Request $request){

        $perPage = 1;

        $search_keyword = null;
        $search_by_keyword = null;
        $search_status = null;
        $search_date = null;
        $search_by_date = null;

        if(isset($request->search_keyword)){
            $search_keyword = $request->search_keyword;
        }
        if(isset($request->search_by_keyword)){
            $search_by_keyword = $request->search_by_keyword;
        }
        if(isset($request->search_status)){
            $search_status = $request->search_status;
        }
        if(isset($request->search_date)){
            $search_date = $request->search_date;
        }
        if(isset($request->search_by_date)){
            $search_by_date = $request->search_by_date;
        }

        $productAccs = $this->repoProductAcc->getAllProductAcceptance(
            $perPage,$search_keyword,$search_by_keyword,$search_status,$search_date,$search_by_date
        );

        $arrs = [];
        foreach ($productAccs as $key => $value) {
            if($value->acceptance_date_update != null){
                $acceptance_date = $value->acceptance_date_update;
            }else{
                $acceptance_date = $value->acceptance_date_create;
            }
            $arrs[] = (object)[
                'acceptance_id' => $value->acceptance_id,
                'invoice_number' => $value->invoice_number,
                'po_number' => $value->po_number,
                'acceptance_status' => $value->acceptance_status,
                'sale_person' => $value->sale_person,
                'due_date_pay' => $value->due_date_pay,
                'acceptance_date' => $acceptance_date
            ];
        }

        $data = [
            'search_keyword' => $search_keyword,
            'search_by_keyword' => $search_by_keyword,
            'search_status' => $search_status,
            'search_date' => $search_date,
            'search_by_date' => $search_by_date,
            'productAccs' => $productAccs,
            'perPage' => $perPage
        ];
        return view('product.list_acceptance', $data);

    }

    public function editProductAcceptance($acceptance_id){
        if(!empty($acceptance_id)){
            echo $acceptance_id;
        }
    }

    public function productAcceptance(Request $request){

        $suppliers = $this->repoSupplier->getAll();
        $data = [
            'suppliers' => $suppliers
        ];

        return view('product.acceptance', $data);
    }

    public function productAcceptanceImportList(Request $request){
        if(!empty($request)){
            $jdata = ['status' => 'error','msg' => 'ข้อมูลไม่ถูกต้อง','data' => []];

            $supplier_id = $request->supplier_id;
            $product_barcode = trim($request->barcode);
            $invoice_number = $request->invoice_number;
            $po_number = $request->po_number;
            $acceptance_status = $request->acceptance_status;
            $sale_person = $request->sale_person;
            $lot_number = $request->lot_number;
            $due_date_pay = $request->due_date_pay;
            $acceptance_date_create = Carbon::now();
            $acceptance_user_id = session()->get('user_id');

            $use_sum_vat = 0;
            if(isset($request->use_sum_vat)){
                $use_sum_vat = $request->use_sum_vat;
            }

            $amount = $request->amount;
            $expire_date = $request->expire_date;

            $product = $this->repoProduct->getByBarcode($product_barcode);
            $supplier = $this->repoSupplier->getById($supplier_id);
            if($product){

                $arrs = (object)[
                    'use_sum_vat' => $use_sum_vat,
                    'product_id' => $product->product_id,
                    'product_barcode' => $product->product_barcode,
                    'product_name' => $product->product_name,
                    'supplier_name' => $supplier->supplier_name,
                    'supplier_id' => $supplier_id,
                    'amount' => $amount,
                    'product_price_cost' => $product->product_price_cost,
                    'total_price' => sprintf('%0.2f', $product->product_price_cost * $amount),
                    'expire_date' => Theme::fullDate($expire_date)
                ];

                $jdata = ['status' => 'success','msg' => 'success','data' => $arrs];

            }else{
                $jdata = ['status' => 'error','msg' => 'ไม่พบข้อมูล Barcode : '.$product_barcode,'data' => []];
            }

            return response()->json($jdata);
        }
    }

    public function saveProductAcceptanceImportList(Request $request){
        if(!empty($request)){
            $jdata = ['status' => 'error','msg' => '','data' => []];

            $action = $request->action;
            $invoice_number = $request->invoice_number;
            $po_number = $request->po_number;
            $acceptance_status = $request->acceptance_status;
            $sale_person = $request->sale_person;
            $due_date_pay = $request->due_date_pay;

            $use_sum_vat = null;
            if(isset($request->use_sum_vat)){
                $use_sum_vat = $request->use_sum_vat;
            }
            
            $lot_number = $request->lot_number;
            $acceptance_note = $request->acceptance_note;

            if(count($request->item_product_id) > 0){

                if($action == 'add'){
                    $data_acceptance = [
                        'invoice_number' => $request->invoice_number,
                        'po_number' => $request->po_number,
                        'acceptance_status' => $request->acceptance_status,
                        'sale_person' => $request->sale_person,
                        'due_date_pay' => $request->due_date_pay,
                        'use_sum_vat' => $request->use_sum_vat,
                        'lot_number' => $request->lot_number,
                        'acceptance_note' => $request->acceptance_note,
                        'acceptance_date_create' => Carbon::now(),
                        'acceptance_user_id_create' => session()->get('user_id')
                    ];
                    $acceptance_id = $this->repoProductAcc->saveProductAcceptance($data_acceptance); 
                }else if($action == 'edit'){
                    $acceptance_id = $request->acceptance_id;
                    $data_acceptance = [
                        'invoice_number' => $request->invoice_number,
                        'po_number' => $request->po_number,
                        'acceptance_status' => $request->acceptance_status,
                        'sale_person' => $request->sale_person,
                        'due_date_pay' => $request->due_date_pay,
                        'use_sum_vat' => $request->use_sum_vat,
                        'lot_number' => $request->lot_number,
                        'acceptance_note' => $request->acceptance_note,
                        'acceptance_date_update' => Carbon::now(),
                        'acceptance_user_id_update' => session()->get('user_id')
                    ];
                    $this->repoProductAcc->updateProductAcceptance($acceptance_id,$data_acceptance);
                    $this->repoProductAcc->deleteAllProductAcceptanceItem($acceptance_id);
                }

                foreach ($request->item_product_id as $key => $value) {
                    $item_acceptance_item_amount = $request->item_acceptance_item_amount[$key];
                    $item_product_id = $request->item_product_id[$key];
                    $item_product_barcode = $request->item_product_barcode[$key];
                    $item_supplier_id = $request->item_supplier_id[$key];
                    $item_acceptance_item_price_cost = $request->item_acceptance_item_price_cost[$key];
                    $item_acceptance_item_expire_date = explode('/', $request->item_acceptance_item_expire_date[$key]);
                    $ex_day = $item_acceptance_item_expire_date[0];
                    $ex_month = $item_acceptance_item_expire_date[1];
                    $ex_year = $item_acceptance_item_expire_date[2];
                    $item_acceptance_item_expire_date = $ex_year.'-'.$ex_month.'-'.$ex_day;

                    $data_item = [
                        'acceptance_id' => $acceptance_id,
                        'product_id' => $item_product_id,
                        'product_barcode' => $item_product_barcode,
                        'supplier_id' => $item_supplier_id,
                        'acceptance_item_amount' => $item_acceptance_item_amount,
                        'acceptance_item_price_cost' => $item_acceptance_item_price_cost,
                        'acceptance_item_expire_date' => $item_acceptance_item_expire_date
                    ];
                    $this->repoProductAcc->saveProductAcceptanceItem($data_item);
                }

                $jdata = ['status' => 'success','msg' => '','data' => []];
            }
            return response()->json($jdata);
        }
    }

}