<?php

namespace App\Http\Controllers;

use App\Pressrelease;
use Illuminate\Http\Request;
use App\User;
use \Session;
class PressreleaseController extends Controller
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
        $pressreleases = Pressrelease::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $pressreleases = Pressrelease::orderBy('id', 'desc')->paginate(10);
         }
        $active = Pressrelease::where('active_flag', 1);
        return view('pressreleases.index', compact('pressreleases', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pressreleases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        //return $request;
        $pressreleases = new Pressrelease();

        request()->validate([
            'title' => 'required|max:255',
           'url'  =>'required',
             'location'   =>'required',
            'date'=>'required',
            'description'=>'required',
            'short_description'=>'required'
        ]);
        
        if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('pressreleases'), $imageName);
        $pressreleases->image = $imageName; 
        }       


        $pressreleases->date = ucfirst($request->input("date"));
        $pressreleases->title = ucfirst($request->input("title"));
       
        $pressreleases->img_title = ucfirst($request->input("img_title"));
        $pressreleases->img_alt = ucfirst($request->input("img_alt"));
        $pressreleases->location = ucfirst($request->input("location"));
        $pressreleases->url = str_slug($request->input("url"), "-");
        $pressreleases->home_title = ucfirst($request->input("home_title"));
        $pressreleases->short_description = ucfirst($request->input("short_description"));
        $pressreleases->home_description = ucfirst($request->input("short_description"));
        $pressreleases->description = ucfirst($request->input("description"));      
        $pressreleases->active_flag = $request->input("active_flag");
        $pressreleases->created_by = \Auth::user()->id;
        $pressreleases->issuer = 'Ochre';
        $pressreleases->meta_title = $request->input("title");
        $pressreleases->meta_description = $request->input("home_description");
        //$pressreleases->author_id = '1';
        $pressreleases->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The pressreleases " . $pressreleases->name . " was Created.");

        return redirect()->route('pressrelease.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Pressrelease  $pressrelease
     * @return \Illuminate\Http\Response
     */
    public function show(Pressrelease $pressrelease)
    {
        return view('pressreleases.show', compact('pressrelease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pressrelease  $pressrelease
     * @return \Illuminate\Http\Response
     */
    public function edit(Pressrelease $pressrelease)
    {
        return view('pressreleases.edit', compact('pressrelease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pressrelease  $pressrelease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pressrelease $pressrelease)
    {

       request()->validate([
            'title' => 'required|max:255',
             'url'  =>'required',
             'location'   =>'required',
            'date'=>'required',
            'description'=>'required',
            'short_description'=>'required'
        ]);
        
        if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('pressreleases'), $imageName);
        $pressrelease->image = $imageName;  
        }
        
        $pressrelease->date = ucfirst($request->input("date"));
        $pressrelease->title = ucfirst($request->input("title"));
        $pressrelease->img_title = ucfirst($request->input("img_title"));
        $pressrelease->img_alt = ucfirst($request->input("img_alt"));
        $pressrelease->location = ucfirst($request->input("location"));
        $pressrelease->url = str_slug($request->input("url"), "-");
        $pressrelease->home_title = ucfirst($request->input("home_title"));
        $pressrelease->short_description = ucfirst($request->input("short_description"));
        $pressrelease->home_description = ucfirst($request->input("short_description"));
        $pressrelease->description = ucfirst($request->input("description"));       
        $pressrelease->active_flag = $request->input("active_flag");
         $pressrelease->updated_by = \Auth::user()->id;
         $pressrelease->meta_title = $request->input("title");
         $pressrelease->meta_description = $request->input("home_description");
        //$pressrelease->author_id ='1';

        $pressrelease->save();

        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The pressreleases " . $pressrelease->title . " was Updated.");

        return redirect()->route('pressrelease.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pressrelease  $pressrelease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pressrelease $pressrelease)
    {
       $pressrelease->active_flag = 0;
        $pressrelease->save();

        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The pressreleases ' . $pressrelease->title . ' was De-Activated.');

        return redirect()->route('pressrelease.index');
    }

    public function reactivate(Pressrelease $pressrelease,$id)
    {

        $pressrelease = Pressrelease::findOrFail($id);
        $pressrelease->active_flag = 1;
        $pressrelease->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The pressreleases ' . $pressrelease->title . ' was Re-Activated.');

        return redirect()->route('pressrelease.index');
    }
    public function metatag(Request $request,$id)
    {

        $meta = Pressrelease::findOrFail($id);
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
        Session::flash('message', 'The Pressreleases ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
