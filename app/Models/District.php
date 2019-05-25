<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class District extends Model{
    
    protected $table = 'districts';

    //for created_at and updated_at field
    public $timestamps = false;
    
}