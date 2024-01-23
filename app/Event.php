<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	 protected $fillable = [
        'start_date','end_date','title','venue','address','event_organiser','email','country_id','web_link','url','active_flag','org_id','home_title','name'
    ];
    protected $gaurded = [
        'id'
    ];
     public function country(){
      return $this->belongsTo('App\Country','country_id');
    }
    public function eventorg(){
      return $this->belongsTo('App\EventOrg','org_id');
    }
}
   
