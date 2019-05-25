<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;
use Validator;

use App\Models\Productpicture;
use App\Repositories\UtilityRepository;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use stdClass;

class ProductpictureRepository {

	public function __construct(Productpicture $productpicture) {
		$this->productpicture = $productpicture;
	}

	public function save($data){
		$this->productpicture->insert($data);
	}

	public function getPictureByTime($time, $product_id=null){
		return $this->productpicture->where('pt_time',$time)
									->orWhere('product_id',$product_id)
									->get();
	}

	public function delPictureById($product_picture_id){
		$this->productpicture->where('product_picture_id',$product_picture_id)->delete();
	}

	public function updateByTime($time, $data){
		$this->productpicture->where('pt_time',$time)->update($data);
	}

	public function uploadPicture($prefix, $file, $path){

		if (UtilityRepository::validImage($file, $ext)) {

			$fileName = UtilityRepository::generate_image_filename("{$prefix}_", $ext);
				
			$this->save_resize_photo($file, $fileName, $path);
			return $fileName;

		}

		throw new \Exception('error');

	}

	public function save_resize_photo($file, $fileName, $path) {

		$size = getimagesize($file);
		$file  = file_get_contents($file);
		$image  = Image::make($file);

		//originals
		//$width = ($size[0] > 700) ? 700 : $size[0];
		$original  = $this->resize_photo($file, 400, null);
		$original->save($path.$fileName);
		
		$this->compress($path.$fileName, $path.$fileName, 75);
		
	}

	public function compress($source, $destination, $quality) {

	    $info = getimagesize($source);

	    if ($info['mime'] == 'image/jpeg') 
	        $image = imagecreatefromjpeg($source);

	    elseif ($info['mime'] == 'image/gif') 
	        $image = imagecreatefromgif($source);

	    elseif ($info['mime'] == 'image/png') 
	        $image = imagecreatefrompng($source);
	    elseif ($info['mime'] == 'image/bmp') 
	        $image = imagecreatefrombmp($source);

	    imagejpeg($image, $destination, $quality);

	    return $destination;
	}

	public function resize_photo ($image, $new_width , $new_height, $aspect_ratio_needed = true) {

		$image = Image::make($image);
		$image->resize($new_width, $new_height, function ($c) use($aspect_ratio_needed){
	    	if ($aspect_ratio_needed) {
	    		$c->aspectRatio();
	    	}
		});

		return $image;
	}

}