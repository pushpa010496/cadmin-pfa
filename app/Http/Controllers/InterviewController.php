<?php

namespace App\Http\Controllers;

use App\Interview;
use Illuminate\Http\Request;
use Auth;
use File;
use Session;
class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('search')){
        $search = Request::get('search'); 
        $interview = Interview::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $interview = Interview::orderBy('id', 'desc')->paginate(10);
         }
        $active = Interview::where('active_flag', 1);
      return view('knowledgebank.interview.index',compact('interview'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('knowledgebank.interview.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate
      (['title' =>'required',
       'photo' =>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
       'url'    =>'required'

   ]);

      $interview = new Interview($request->except(['photo','created_by','url']));
      if($request->file('photo')){
        $imagename  = time().'-'.$request->file('photo')->getClientOriginalName();
        request()->photo->move(public_path('knowledgebank/interview'),$imagename);
        $interview->photo = $imagename;

    }
    $interview->created_by = Auth::user()->id;
    $interview->url = str_slug($request->url);
    $interview->meta_title = $request->input("title");
    $interview->meta_description = $request->input("short_description");
    //$interview->home_interview = 1;
    $interview->save();
      return redirect()->route('interview.index')->with(['create_message'=>'Succesfully Created', 'alert'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function show(Interview $interview)
    {
       return view('knowledgebank.interview.show',compact('interview'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function edit(Interview $interview)
    {
      return view('knowledgebank.interview.edit',compact('interview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interview $interview)
    {
      
         request()->validate
      (['title' =>'required',
       'photo' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
       'url'    =>'required'
       
   ]);

      $image_name = public_path('knowledgebank/interview')."/".$interview->photo;
      

      if(File::exists($image_name)){
        if($request->file('photo')){
         File::delete($image_name);
        $imagename  = preg_replace('/\s+/','-',time().$request->file('photo')->getClientOriginalName());
        request()->photo->move(public_path('knowledgebank/interview'),$imagename);
        $interview->photo = $imagename;
        }
        else{
           $interview->photo = $interview->photo; 
        }
        }
        else{
            
             $imagename  =  preg_replace('/\s+/','-',time().$request->file('photo')->getClientOriginalName());
        request()->photo->move(public_path('knowledgebank/interview'),$imagename);
        $interview->photo = $imagename;
        }
       /* if($request->file('photo')){
            $imageName = preg_replace('/\s+/','-',time().$request->file('photo')->getClientOriginalName());
            if(request()->photo->move($image_name, $imageName)){                  
                if(File::exists($image_name.$interview->photo)){                  
                    \File::delete($image_name.$interview->photo);                         
                }
                $interview->photo = $imageName;
            }
        }*/

        $interview->url = str_slug($request->url);
        $interview->updated_by = Auth::user()->id;
        $interview->update($request->except(['photo','updated_by','url']));
        $interview->meta_title = $request->input("title");
        $interview->meta_description = $request->input("short_description");
        $interview->save();
       return redirect()->route('interview.index')->with(['create_message'=>'Successfully Updated','alert'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interview $interview)
    {
    $interview->active_flag = 0;
       $interview->save();

       return redirect()->route('interview.index')->with(['create_message'=>'Success fully deactivated']);
    }

    public function reactivate($id)
    {

        $interview = Interview::findOrFail($id);
        $interview->active_flag = 1;
        $interview->save();

        return redirect()->route('interview.index')->with(['create_message', 'The interview ' . $interview->name . ' was Re-Activated.','alert'=>'danger']);
    
    }
     public function metatag(Request $request,$interview)
    {


        $meta = Interview::findOrFail($interview);
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
}
