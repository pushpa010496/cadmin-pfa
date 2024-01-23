<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FileuploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fileupload.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             
              $category=$request->input('category');

           
              $title=$request->input('imgtitle');
             // $file = Input::file('image');
              $file=$request->file('image');
             
              $folder="";

              if ($category =="articles") {

                    $folder="articles";

              } 
              elseif ($category=="pressreleases") {

                       $folder="pressreleases";
   
             } 
             elseif ($category=="events-newsletters") {

                      $folder="events-newsletters";
   
             } 

            elseif ($category=="e-newsletters") {

                      $folder="e-newsletters";
  
            }
            elseif ($category=="clientemailblast") {

                      $folder="clientemailblast";
  
            }

            elseif ($category=="promotions") {

                      $folder="promotions";
  
            }

            elseif ($category=="interview") {

                    $folder="interview";
  
            }
             elseif ($category=="ebooks") {

                    $folder="ebooks";
  
            }
            
           else {

            $folder="";
   
                }
             // print_r($file->getClientsize()); die;
            // image upload in public/upload folder.
            $livelinks=[];
              $livelinkexists=[];
                foreach ($file as $files) {
                   
                
                $orfilename=strtolower($files->getClientOriginalName());

                $filenamee = preg_replace('/\s+/', '-', $orfilename);

                $filename=preg_replace('/[^A-Za-z0-9\-.]/', '', $filenamee); // Removes special chars.

                 //$filenamess[]=$filename;
             
               // $filename = str_slug($orfilename);
                
                $imagepath=$folder."/"."images/";
                 
                 if(file_exists(public_path().'/'.$imagepath.$filename))
                {
                 $livelinkexistss=config('app.url').'/'.$imagepath.$filename;
             
                //return view('fileupload.create',compact('livelinkexists'));
                $livelinkexists[]=$livelinkexistss;
                }
                else{
                    //$name=$files->getClientOriginalName();
               $dataupload=$files->move(public_path($imagepath),$filename);
              
        
           // LOWER($filename);
            if($dataupload){

             $livelink=config('app.url').$imagepath.$filename;

                }
                  $livelinks[]=$livelink;
            }
      
    }
   
 //exit;

           return view('fileupload.create',compact('livelinks','livelinkexists'));

                 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
