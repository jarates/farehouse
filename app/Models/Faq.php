<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Faq extends Model{
    
    protected $table = 'tb_faq';

    //for created_at and updated_at field
    public $timestamps = false;
    
}