<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable =['name','designation','title','quest_answer','home_interview',
'description','photo','title_tag','alt_tag','url','active_flag'];
}
