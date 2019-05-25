<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Company extends Model{
    
    protected $table = 'tb_info_company';

    //for created_at and updated_at field
    public $timestamps = false;
    
}