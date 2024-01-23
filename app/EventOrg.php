<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
class EventOrg extends Model
{
    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
    public function seoorg(){
      return $this->hasMany('App\SeoEventOrg');
    }
    
}