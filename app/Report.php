<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	 public function category(){
    	return $this->belongsTo(ReportCategory::class,'cat_id');
    }
    //
}
