<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
class Slider extends Model
{
    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
    public function pages(){
    return $this->belongsToMany('App\Page')->withTimestamps();
  }
  public function positions(){
  	return $this->belongsToMany('App\Position')->withTimestamps();
  }
}