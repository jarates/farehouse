<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Supplier extends Model{
    
    protected $table = 'tb_supplier';

    //for created_at and updated_at field
    public $timestamps = false;
    
}