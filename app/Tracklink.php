<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracklink extends Model
{
	  protected $connection = 'mysql2';
	public $timestamps = true;
    protected $fillable = [
        'oriurl','shorturl_id'
    ];
    
}
