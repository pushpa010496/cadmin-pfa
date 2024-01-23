<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[];
    protected $guarded=['id'];


    public function advertiser(){
    	return $this->hasMany('App\Advertiser');
    }
}
