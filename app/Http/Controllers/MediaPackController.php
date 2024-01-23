<?php

namespace App\Http\Controllers;

use App\MediaPack;
use Illuminate\Http\Request;
use File;
use Session;

class MediaPackController extends Controller
{
    
    public function index(Request $request)
    {
      
    
      
     
        if($request->get('search')){
        $search = \Request::get('search'); 
        $mediapacks = MediaPack::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $mediapacks = MediaPack::orderBy('id', 'desc')->paginate(10);
         }
        $active = MediaPack::where('active_flag', 1);
        //$mediapacks=MediaPack::orderBy('id', 'desc')->paginate(10);
        return view('magzine.mediapack.index',compact('mediapacks'));
    }

  
    public function create()
    {
        return view('magzine.mediapack.create');
    }

    public function store(Request $request)
    {
         request()->validate([
                    'title' => 'required',
                    'url' => 'required',
                    'title_tag'=>'required',
                    'description'=>'required',
                    'pdf' =>'required|mimes:pdf', 
                    'active_flag' =>'required',
                    
                 ]);

         $mediapack = new MediaPack($request->except('image','pdf','url'));   
         if($request->file('image')){
            $imageName = preg_replace('/\s+/','-',time().'-mediapack-'.$request->file('image')->getClientOriginalName());
            request()->image->move(public_path('mediapack'), $imageName);
            $mediapack->image = $imageName;  
        }

        if($request->file('pdf')){
            // $pdf_Name = preg_replace('/\s+/','-',time().'-mediapack-'.$request->file('pdf')->getClientOriginalName());
            $pdf_Name = 'asian-hospital-healthcare-management-mediapack.pdf';            
            request()->pdf->move(public_path('mediapack').'/pdf/', $pdf_Name);
            $mediapack->pdf = $pdf_Name;  

            $src_from_industry = $path.'/pdf/asian-hospital-healthcare-management-mediapack.pdf';
            $dest_to_ahhm =  base_path().'/../public/mediapack/pdf/asian-hospital-healthcare-management-mediapack.pdf';
            \File::copy(public_path('mediapack').'/pdf/asian-hospital-healthcare-management-mediapack.pdf', $dest_to_ahhm); 


        }
        $mediapack->url = str_slug($request->url);  
        $mediapack->created_by = \Auth::id();
        $mediapack->save();
        return redirect()->route('mediapack.index'); 
    }


    public function show(MediaPack $mediapack)
    {
       return view('magzine.mediapack.show',compact('mediapack'));
    }

   
    public function edit(MediaPack $mediapack)
    {
        return view('magzine.mediapack.edit',compact('mediapack'));
    }

   
    public function update(Request $request, MediaPack $mediapack)
    {
           request()->validate([
                    'title' => 'required',
                    'url' => 'required',
                    'title_tag'=>'required',
                    'description'=>'required',
                    'pdf' =>'mimes:pdf', 
                    'active_flag' =>'required',
                    
                 ]);

          $path = public_path('mediapack').'/';
        
         
        if($request->file('image')){
            $imageName = preg_replace('/\s+/','-',time().'-mediapack-'.$request->file('image')->getClientOriginalName());
            if(request()->image->move($path, $imageName)){                  
                if(File::exists($path.$mediapack->image)){                  
                    \File::delete($path.$mediapack->image);                         
                }
                $mediapack->image = $imageName;
            }
        }
        if($request->file('pdf')){

            $pdf_Name = preg_replace('/\s+/','-',time().'-mediapack-'.$request->file('pdf')->getClientOriginalName());
          
             if(File::exists($path.'pdf/'.$mediapack->pdf)){                  
                    // \File::delete($path.$mediapack->pdf); 
                    $bkp_name =  'asian-hospital-healthcare-management-mediapack_'.date("Y_m_d_his").'.pdf';
                    $bkpmove =  \File::copy($path.'pdf/'.$mediapack->pdf, $path.$bkp_name);          
               // $bkp_name =  'asian-hospital-healthcare-management-mediapack_'.date("Y_m_d_his").'.pdf';
               // $bkpmove =  \File::copy(public_path('mediapack').'/pdf/asian-hospital-healthcare-management-mediapack.pdf', public_path('mediapack').'/'.$bkp_name);       
            
                   if($bkpmove){
                  
                     \File::delete($path.'/pdf/'.$mediapack->pdf); 
                      request()->pdf->move($path.'/pdf', $mediapack->pdf);
                      // $mediapack->pdf = $pdf_Name;

                   
                      $src_from_industry = $path.'/pdf/asian-hospital-healthcare-management-mediapack.pdf';
                      $dest_to_ahhm =  base_path().'/../public/mediapack/pdf/asian-hospital-healthcare-management-mediapack.pdf';
                      \File::copy(public_path('mediapack').'/pdf/asian-hospital-healthcare-management-mediapack.pdf', $dest_to_ahhm); 
                   }
             }else{
                  request()->pdf->move($path.'/pdf/', 'asian-hospital-healthcare-management-mediapack.pdf');
             }

            // if(request()->pdf->move($path, $pdf_Name)){                  
            //     if(File::exists($path.$mediapack->pdf)){                  
            //         \File::delete($path.$mediapack->pdf);                         
            //     }
            //     $mediapack->pdf = $pdf_Name;
            // }
        }

         $mediapack->url = str_slug($request->url);                   
         $mediapack->update($request->except('image','pdf','url'));
         $mediapack->modified_by = \Auth::id();
         if($mediapack->save())  {          
            return redirect()->route('mediapack.index');
         }   
    }

   
    public function destroy(MediaPack $mediapack)
    {
        $mediapack->active_flag = 0;
        $mediapack->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Mediapack '.$mediapack->title.' deactiveted !');
         return redirect()->route('mediapack.index');
    }

      public function reactivate(MediaPack $mediapack)
    {        

      $mediapack->active_flag = 1;
      $mediapack->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'Mediapack '.$mediapack->title.' Activeted !');
       return redirect()->route('mediapack.index');
    }
}
