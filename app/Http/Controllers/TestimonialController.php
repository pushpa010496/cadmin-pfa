<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Requests\TestimonialRequest;
use Session;

class TestimonialController extends Controller
{
     protected $model;
     public function __construct(Testimonial $model)
     {
        $this->model = $model;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->get('search')){
        $search = \Request::get('search'); 
        $testimonial = Testimonial::where('name', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $testimonial = Testimonial::orderBy('id', 'desc')->paginate(10);
         }
        $active = Testimonial::where('active_flag', 1);
        

       // $testimonial=Testimonial::orderBy('id', 'desc')->paginate(10);
        return view('management.testimonials.index',compact('testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $request)
    {
          $testimonial = new Testimonial();   
     

        $testimonial->name = $request->title;
        $testimonial->company = $request->company;
        $testimonial->url = str_slug($request->url);
        $testimonial->designation = $request->designation;        
        $testimonial->title_tag = $request->title_tag;
        $testimonial->alt_tag = $request->alt_tag;
        $testimonial->description = $request->description;
        $testimonial->active_flag = $request->active_flag;
        $testimonial->save();

        return redirect()->route('testimonial.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
     
          return view('management.testimonials.show',compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {

        //
        return view('management.testimonials.edit',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
 
      
        $testimonial->url = str_slug($request->url);  
         $testimonial->update($request->except('url'));
       
          if($testimonial->save())  {          
            return redirect()->route('testimonials.index');
         }  
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        //
         $testimonial->active_flag = 0;
        $testimonial->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Testimonial '.$testimonial->name.' deactiveted !');
         return redirect()->route('testimonials.index');
    }
     public function reactivate(Testimonial $testimonial)
    {        

      $testimonial->active_flag = 1;
      $testimonial->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'Testimonial '.$testimonial->name.' Activeted !');
       return redirect()->route('testimonials.index');
    }

     public function metatag(Request $request,$testimonial)
    {


        $meta = Testimonial::findOrFail($testimonial);
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
        Session::flash('message', 'The Testimonial ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
    
}
