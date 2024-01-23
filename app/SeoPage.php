<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
     public function seopages()
  {
    return $this->belongsTo('App\Page','page_id');
  }
}
