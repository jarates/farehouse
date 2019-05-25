<?php

namespace App\Repositories;

use Hash;
use DB;
use Artisan;

use App\Models\User;

class UtilityRepository {

	public static function session_set ($key, $value) {
		session([$key => $value]);
	}

	public static function session_get ($key) {
		return session($key);
	}

	public static function create_supported_image_extension ($image_type) {

        $image_types = [
			"image/jpg"  => ".jpg",
			"image/jpeg" => ".jpg",
			"image/png"  => ".png",
      		"image/bmp"  => ".bmp",
			"image/gif"  => ".gif"
        ];

        return (isset($image_types[$image_type])) ? $image_types[$image_type] : '';

    }

    public static function validImageExtension ($extension) {
        
        $extensions = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];

        return (self::in_arrayi($extension, $extensions)) ? true : false;
    } 


    public static function in_arrayi($needle, $haystack){
      return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }



    public static function validImageSize ($image) {
        
        $max_image_file_size = 5000 * 1024 * 1024;

        return ($image->getClientSize() <= $max_image_file_size) ? true  : false;
    }


    public static function validImage ($image, &$ext) {

        if ($image == null) {
            return false;
        }

        if(!getimagesize($image)) {
            return false;
        }

        $extension = $image->getClientOriginalExtension();

        if (!self::validImageExtension($extension)) {
            return false;
        }

        if (!self::validImageSize($image)) {
            return false;
        }

        $ext = self::create_supported_image_extension ($image->getMimeType());

        return true;

    }

    public static function generate_image_filename ($prefix, $extension) {
    	return uniqid($prefix). rand(10000000, 99999999) . $extension;
    }

}