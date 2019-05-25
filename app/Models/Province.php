<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Province extends Model{
    
    protected $table = 'provinces';

    //for created_at and updated_at field
    public $timestamps = false;
    
}