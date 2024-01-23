<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xmlpharse extends Model
{
    protected $table='news_xml';

    protected $fillable=['news_head','data','location','type','xml_file_name','meta_title','meta_description'];
}
