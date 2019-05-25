<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Amphur extends Model{
    
    protected $table = 'amphures';

    //for created_at and updated_at field
    public $timestamps = false;
    
}