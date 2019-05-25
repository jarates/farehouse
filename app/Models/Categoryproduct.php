<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Categoryproduct extends Model{
    
    protected $table = 'tb_category_product';

    //for created_at and updated_at field
    public $timestamps = false;
    
}