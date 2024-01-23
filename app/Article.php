<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

	
    protected $fillable = ['title','sub_title','abstract','author_name','author_image','author_details','author_description','main_body','authorbio','home_articles','image','title_tag','alt_tag','url','active_flag','author_id','short_description','home_short_description'];


      public function authors(){
    	return $this->belongsToMany('App\Contributors')->withTimestamps();
    }

}
