<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";

    protected $fillable =['name_ar','photo','name_en','price','details_ar','details_en','created_at','updated_at' ];
    protected $hidden =['created_at','updated_at'];
  //  public $timestamps = false ;

}
 