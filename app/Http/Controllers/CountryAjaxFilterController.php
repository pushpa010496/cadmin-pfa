<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;



class CountryAjaxFilterController extends Controller

{

    public function getRegions()

    {

    	 $regions=DB::table('regions')->get();

    	 return $regions;

    }



    public function getRegionsWiseSubRegions($id)

    {

        if($id){

            $regionId = implode(',',$id);

            $subregions = DB::select( DB::raw("select * from `sub_region` where `region_id` in ($regionId)") );

            return $subregions;

        }else{

            return [];

        }

        

    }

    public function getRegionsWiseCountries($id)

    {

        if($id){

            $subregions = implode(',', $id);

            $countries = DB::select( DB::raw("select * from `region_country` where `sub_region` in ($subregions)") );

            return $countries;

        }else{

            return [];

        }

    }

}

