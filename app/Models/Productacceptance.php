<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Productacceptance extends Model{
    
    protected $table = 'tb_product_acceptance';

    //for created_at and updated_at field
    public $timestamps = false;
    
}