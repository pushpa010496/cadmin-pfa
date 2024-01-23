<?php

use App\Category;
use App\User;
use App\Page;

function getpage($pageurl)
{		
	if(!empty($pageurl)){			
		$page = \App\Page::where('title',$pageurl)->where('active_flag',1)->first();
		if($page){
			$page = $page->id;
		}else{
			$page = 0;
		}
	}else{
		$page = 1;
	}
	return $page;
}
function getcat($categoryid)
{
		$category = \App\Category::where('parent_id',$categoryid)->get();
		return $category;
}
function ordercatfirst($categoryid)
{
		$category = \App\Category::where('parent_id',$categoryid)->orderBy('catorder', 'asc')->take(10)->get();
		return $category;
}
function ordercatsecond($categoryid)
{
		$category = \App\Category::where('parent_id',$categoryid)->orderBy('catorder', 'desc')->take(9)->get();
		return $category;
}

