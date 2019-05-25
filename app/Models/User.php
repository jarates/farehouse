<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model{
    
    protected $table = 'tb_user';

    //for created_at and updated_at field
    public $timestamps = false;
    
}