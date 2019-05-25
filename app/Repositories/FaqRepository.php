<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Faq;
use App\Repositories\UtilityRepository;

class FaqRepository {

	public function __construct(Faq $faq) {
		$this->faq = $faq;
	}

	public function save($data){
		$this->faq->insert($data);
	}

	public function getByProduct($product_id){
		return $this->faq->where('product_id',$product_id)->get();
	}

	public function update($faq_id, $data){
		$this->faq->where('faq_id',$faq_id)->update($data);
	}

	public function delete_allByid($string_by_array){
		if(!empty($string_by_array) && preg_match('/,/', $string_by_array)){
			$ex = explode(',', $string_by_array);
			foreach ($ex as $key => $value) {
				$faq_id = $value;
				if(!empty($faq_id)){
					$this->delete($faq_id);
				}
			}
		}
	}

	public function delete($faq_id){
		$this->faq->where('faq_id',$faq_id)->delete();
	}

}