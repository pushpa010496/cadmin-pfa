<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use \Session;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
       	if($request->get('search'))
       	{
    		$search = \Request::get('search'); 
     		$news = News::where('title', 'like', '%'.$search.'%')->paginate(10);
   		 }
   		 else
   		 {
   			$news = News::orderBy('id', 'desc')->paginate(10);
		 }
		$active = News::where('active_flag', 1);
		return view('news.index', compact('news','active'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
         return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $news = new News();

        request()->validate([
            'title' => 'required|max:255',
            'url'   =>'required',
             'location'   =>'required',
            'date'=>'required',
            'description'=>'required',
            'home_description'=>'required',
             'home_title' => 'required|max:255',
        ]);
        
        if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('news'), $imageName);
        $news->news_image = $imageName;  
        }       
        $news->date = ucfirst($request->input("date"));
        $news->title = ucfirst($request->input("title"));
        $news->img_title = ucfirst($request->input("img_title"));
        $news->news_img_alt = ucfirst($request->input("news_img_alt"));
        $news->location = ucfirst($request->input("location"));
        $news->url = str_slug($request->input("url"), "-");
        $news->home_title = ucfirst($request->input("home_title"));
        $news->home_description = ucfirst($request->input("home_description"));
         $news->short_description = ucfirst($request->input("home_description"));
        $news->description = ucfirst($request->input("description"));       
        $news->active_flag = $request->input("active_flag");
         $news->created_by = $request->user()->id;
         $news->issuer = 'Ochre';
         $news->meta_title = $request->input("title");
         $news->meta_description = $request->input("home_description");
       // $news->author_id = '1';
        $news->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The news " . $news->name . " was Created.");

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
     return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {   

        request()->validate([
            'title' => 'required|max:255',
             'url'   =>'required',
             'location'   =>'required',
            'date'=>'required',
            'description'=>'required',
            'home_description'=>'required',
             'home_title' => 'required|max:255',
        ]);
        
        if($request->file('image')){
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());
        request()->image->move(public_path('news'), $imageName);
        $news->news_image = $imageName;  
        }
        
        $news->date = ucfirst($request->input("date"));
        $news->title = ucfirst($request->input("title"));
        $news->img_title = ucfirst($request->input("img_title"));
        $news->news_img_alt = ucfirst($request->input("news_img_alt"));
        $news->location = ucfirst($request->input("location"));
        $news->url = str_slug($request->input("url"), "-");
        $news->home_title = ucfirst($request->input("home_title"));
        $news->home_description = ucfirst($request->input("home_description"));
        $news->short_description = ucfirst($request->input("home_description"));
        $news->description = ucfirst($request->input("description"));       
        $news->active_flag = $request->input("active_flag");
        $news->updated_by = $request->user()->id;
        $news->issuer = 'Ochre';
        $news->meta_title = $request->input("title");
        $news->meta_description = $request->input("home_description");

        $news->save();

        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The news " . $news->name . " was Updated.");

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
       
        $news->active_flag = 0;
        $news->save();

        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The news ' . $news->name . ' was De-Activated.');

        return redirect()->route('news.index');
    }
        public function reactivate(News $news,$id)
    {

        $news = News::findOrFail($id);
        $news->active_flag = 1;
        $news->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The news ' . $news->name . ' was Re-Activated.');

        return redirect()->route('news.index');
    }
    public function metatag(Request $request,$id)
    {
        $meta = News::findOrFail($id);
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
        Session::flash('message', 'The News ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
