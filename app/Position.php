<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
class Position extends Model{
	protected $gaurded=['id'];
    protected $parent = 'parent_id';

    public function Author(){
      return $this->belongsTo('App\User','author_id');
    }
   	public function sliders(){
	    return $this->belongsToMany('App\Slider','position_slider','position_id','slider_id')->withTimestamps();
	}
	public function banners(){
	    return $this->belongsToMany('App\Banner','position_banner','position_id','banner_id')->withTimestamps();
	}
	public function seop(){

		return $this->hasOne('App\SeoPage');

	}
}