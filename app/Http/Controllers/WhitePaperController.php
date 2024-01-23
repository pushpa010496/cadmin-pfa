<?php

namespace App\Http\Controllers;

use App\WhitePaper;
use Illuminate\Http\Request;
use Auth;
use Session;
use File;

class WhitePaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if($request->get('search')){
        $search = \Request::get('search'); 
        $whitepaper = WhitePaper::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $whitepaper = WhitePaper::orderBy('id', 'desc')->paginate(10);
         }
        $active = WhitePaper::where('active_flag', 1);
      return view('knowledgebank.whitepapers.index',compact('whitepaper'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('knowledgebank.whitepapers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(['title' =>'required|unique:white_papers',
            'image' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'pdf' =>'required|mimes:pdf|max:10000',
           'alt_tag' =>'required',
           'short_description'=>'required'


       ]);
        $whitepaper = new WhitePaper($request->except(['pdf','image','created_by','url']));
        if($request->file('pdf')){
            $pdfname  = time().'-'.$request->file('pdf')->getClientOriginalName();
            request()->pdf->move(public_path('knowledgebank/whitepaper'),$pdfname);
            $whitepaper->pdf = $pdfname;

        }
        if($request->file('image')){
            $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
            request()->image->move(public_path('knowledgebank/whitepaper'),$imagename);
            $whitepaper->image = $imagename;

        }    
        $whitepaper->url = str_slug($request->url);
        $whitepaper->created_by = Auth::user()->id;
        $whitepaper->home_whitepapers = 0;
        $whitepaper->meta_title = $request->title;
        $whitepaper->meta_description = $request->short_description;
        $whitepaper->whf_meta_title = $request->title;
        $whitepaper->whf_meta_description = $request->short_description;
        $whitepaper->save();

          return redirect()->route('whitepaper.index')->with(['create_message'=>'Successfully Created','alert'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WhitePaper  $whitePaper
     * @return \Illuminate\Http\Response
     */
    public function show(WhitePaper $whitepaper)
    {
        //
         return view('knowledgebank.whitepapers.show',compact('whitepaper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WhitePaper  $whitePaper
     * @return \Illuminate\Http\Response
     */
    public function edit(WhitePaper $whitepaper)
    {

         return view('knowledgebank.whitepapers.edit',compact('whitepaper'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WhitePaper  $whitePaper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhitePaper $whitepaper)
    {
    
     request()->validate(['title' =>'required',
         'pdf' =>'mimes:pdf|max:10000',
         'url'=>'required',
         'alt_tag' =>'required',
         'short_description'=>'required'

     ]);

      $path = public_path('knowledgebank/whitepaper').'/';
        if($request->file('image')){
            $imageName = preg_replace('/\s+/','-',time().'-whitepaper-'.$request->file('image')->getClientOriginalName());
            if(request()->image->move($path, $imageName)){                  
                if(File::exists($path.$whitepaper->image)){                  
                    \File::delete($path.$whitepaper->image);                         
                }
                $whitepaper->image = $imageName;
            }
        }
        if($request->file('pdf')){
            $pdf_Name = preg_replace('/\s+/','-',time().'-whitepaper-'.$request->file('pdf')->getClientOriginalName());
            if(request()->pdf->move($path, $pdf_Name)){                  
                if(File::exists($path.$whitepaper->pdf)){                  
                    \File::delete($path.$whitepaper->pdf);                         
                }
                $whitepaper->pdf = $pdf_Name;
            }
        }

        $whitepaper->update($request->except(['pdf','updated_by','url','image']));
        $whitepaper->updated_by = Auth::user()->id;
        $whitepaper->url = str_slug($request->url);
        $whitepaper->meta_title = $request->title;
        $whitepaper->meta_description = $request->short_description;
        $whitepaper->whf_meta_title = $request->title;
        $whitepaper->whf_meta_description = $request->short_description;
        $whitepaper->save();
   
    return redirect()->route('whitepaper.index')->with(['create_message'=>'Successfully Updated','alert'=>'success']);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WhitePaper  $whitePaper
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhitePaper $whitepaper)
    {
        //
         $whitepaper->active_flag = 0;
        $whitepaper->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Whitepaper '.$whitepaper->title.' deactiveted !');
         return redirect()->route('whitepaper.index');
    }
      public function reactivate(WhitePaper $whitepaper)
    {        

      $whitepaper->active_flag = 1;
      $whitepaper->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'Whitepaper '.$whitepaper->title.' Activeted !');
       return redirect()->route('whitepaper.index');
    }
    public function metatag(Request $request,$whitepaper)
    {


        $meta = WhitePaper::findOrFail($whitepaper);
        $meta->meta_title = $request->input("meta_title");
        $meta->meta_keywords = $request->input("meta_keywords");
        $meta->meta_description = $request->input("meta_description");
        $meta->og_title = $request->input("og_title");
        $meta->og_description = $request->input("og_description");
        $meta->og_keywords = $request->input("og_keywords");
        $meta->og_image = $request->input("og_image");
        $meta->og_video = $request->input("og_video");
        $meta->meta_region = $request->input("meta_region");
        $meta->meta_position = $request->input("meta_position");
        $meta->meta_icbm = $request->input("meta_icbm");
        $meta->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Whitepaper ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
    
    public function wpfmetatag(Request $request,$whitepaper)
    {


        $meta = WhitePaper::findOrFail($whitepaper);
        $meta->whf_meta_title = $request->input("meta_title");
        $meta->whf_meta_keywords = $request->input("meta_keywords");
        $meta->whf_meta_description = $request->input("meta_description");
        $meta->whf_og_title = $request->input("og_title");
        $meta->whf_og_description = $request->input("og_description");
        $meta->whf_og_keywords = $request->input("og_keywords");
        $meta->whf_og_image = $request->input("og_image");
        $meta->whf_og_video = $request->input("og_video");
        $meta->whf_meta_region = $request->input("meta_region");
        $meta->whf_meta_position = $request->input("meta_position");
        $meta->whf_meta_icbm = $request->input("meta_icbm");
        $meta->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Whitepaper ' . $meta->whf_meta_title . ' Metatags was added.');

        return redirect()->back();
    }
    
}
