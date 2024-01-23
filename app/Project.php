<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title','image','description','location','project_name',
'home_project','url','commence','est_inv','capacity','key_player','completion','date','active_flag','title_tag','alt_tag','short_description'];
}
