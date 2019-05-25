<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model{
    
    protected $table = 'tb_products';

    //for created_at and updated_at field
    public $timestamps = false;
    
}