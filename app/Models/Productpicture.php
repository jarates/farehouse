<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Productpicture extends Model{
    
    protected $table = 'tb_product_pictures';

    //for created_at and updated_at field
    public $timestamps = false;
    
}