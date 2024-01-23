<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerPage extends Model
{
	protected $table = 'banner_page';
   public function banner()
   {
       return $this->belongsTo('App\Banner');
   }
  
}
