<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
	
    protected $gaurded = ['id'];
    protected $fillable = ['title','image','url','speaker','speaker_designation','webinar_date','date','alt_tag','active_flag','title_tag','view_name'];

}
