<?php

namespace App\Components;

use Storage;
use App\Models\Province;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class Theme{


	public static function test(){
			
		$data = 'test';

		return $data;

	}

	public static function numberFormat($number, $m){
		return number_format($number, $m);
	}

	public static function dateToday(){
		return date("dm").substr((date("Y")+543), 2);
	}

	public static function get_province(){
		$provinces = Province::get();
		return $provinces;
	}

	public static function tableRow($perPage,$row){
		
		$row = $row + 1;
		if(Input::get('page')){
			$page = Input::get('page');
		}else{
			$page = 1;
		}
		$new_row = $row;
		if($page >= 2){
			$new_row = ($perPage * ($page-1) + $row);
		}
		
		return $new_row;

	}

	public static function fullDateTime($datetime){
		return date("d/m/Y H:i", strtotime($datetime));
	}

	public static function fullDate($datetime){
		return date("d/m/Y", strtotime($datetime));
	}

	public static function htmlFormFAQ($time=null){

		$html = '<div class="cv-pm" id="'.$time.'">';
			$html .= '<div class="col-md-10">';
				$html .= '<div class="alert alert-info">';
					$html .= '<div>';
						$html .= '<label class="p-small">คำถาม</label>';
						$html .= '<input required="" type="text" name="faq_name[]" class="form-control">';
					$html .= '</div>';
					$html .= '<div>';
						$html .= '<label class="p-small">คำตอบ</label>';
						$html .= '<input required="" type="text" name="faq_answer_name[]" class="form-control">';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="col-md-2">';
				$html .= '<a href="javascript:" data-id="'.$time.'" class="btn btn-default btn-del-faq">ลบ</a>';
			$html .= '</div>';
		$html .= '</div>';
		return $html;
		
	}

	public static function htmlDropdownSearchProduct(){
		$data = [
			['value' => 'id','text' => 'ค้นหาด้วย (รหัสสินค้า)'],
			['value' => 'name','text' => 'ชื่อสินค้า'],
			['value' => 'type','text' => 'ประเภทสินค้า'],
			['value' => 'category','text' => 'หมวดหมู่สินค้า)'],
			['value' => 'brand','text' => 'ยี้ห้อสินค้า'],
			['value' => 'supplier','text' => 'ซัพพลายเออร์']
		];
		return $data;
	}

	public static function htmlDropdownSupTaxSystem(){
		$data = ['จดทะเบียนภาษีมูลค่าเพิ่ม','ไม่ได้จดทะเบียนภาษีมูลค่าเพิ่ม'];
		return $data;
	}

	public static function htmlDropdownPaymentMethod(){
		$data = ['โอนเงิน','เช็ค'];
		return $data;
	}

	public static function htmlDropdownPaymentBankType(){
		$data = ['ออมทรัพย์','กระแสรายวัน'];
		return $data;
	}

	public static function htmlSearchProductAcc(){
		$data = [
			['value' => 'id','text' => 'เลขที่เอกสาร'],
			['value' => 'invoice','text' => 'เลขที่ใบส่งสินค้า'],
			['value' => 'po','text' => 'เลขที่ใบ PO'],
		];
		return $data;
	}

	public static function htmlSearchProductAccStatus(){
		$data = [
			['value' => 'open','text' => 'เปิด'],
			['value' => 'close','text' => 'ปิด'],
			['value' => 'cancel','text' => 'ยกเลิก'],
		];
		return $data;
	}

	public static function htmlSearchProductAccDate(){
		$data = [
			['value' => 'date_create','text' => 'วันที่รับเข้า'],
			['value' => 'date_due','text' => 'วันที่ครบกำหนดชำระ'],
			['value' => 'date_update','text' => 'วันที่แก้ไขล่าสุด'],
		];
		return $data;
	}

	public static function statusProductAcc($status){

		$txt_status = '';
		foreach (self::htmlSearchProductAccStatus() as $key => $value) {
			if($value['value'] == $status){
				$txt_status = $value['text'];
			}
		}
		return $txt_status;

	}

}