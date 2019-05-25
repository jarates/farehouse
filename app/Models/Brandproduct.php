<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Brandproduct extends Model{
    
    protected $table = 'tb_brand_product';

    //for created_at and updated_at field
    public $timestamps = false;
    
}