<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Country;
use App\EventOrg;
use \Session;
class EventController extends Controller
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
        $events = Event::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $events = Event::orderBy('id', 'desc')->paginate(10);
         }
        $active = Event::where('active_flag', 1);
        return view('events.index', compact('events', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('title','id');
        $eventorg = EventOrg::where('active_flag', 1)->pluck('name','id');
        return view('events.create',compact('countries','eventorg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       request()->validate([
        'start_date' => 'required',
        'end_date' => 'required',
        'url'  =>'required',
        'venue'  =>'required',
        'title'  =>'required',
        'address'  =>'required',
        'country_id'  =>'required',
        'email'  =>'required',
        'org_id'  =>'required',
        'active_flag'  =>'required',
        'web_link'  =>'required',
        'home_title'    =>'required|max:50'
        ]);
          

        $event = new Event($request->except('url','start_date','end_date'));
        $event->url = Str::slug($request->url, "-");
        $event->start_date = date("Y-m-d",strtotime($request->start_date));
        $event->end_date = date("Y-m-d",strtotime($request->end_date));    
        $event->created_by = $request->user()->id; 
       
        $event->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The event \"<a href='events/$event->name'>" . $event->title . "</a>\" was Created.");

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {

         $countries = Country::pluck('title','id');
         $eventorg = EventOrg::where('active_flag', 1)->pluck('name','id');
        return view('events.edit',compact('event','countries','eventorg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
       
       request()->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'url'  =>'required',
            'venue'  =>'required',
             'title'  =>'required',
            'address'  =>'required',
            'country_id'  =>'required',
            'email'  =>'required',
            'org_id'  =>'required',
            'active_flag'  =>'required',
            'web_link'  =>'required',
            'home_title'    =>'required|max:50'
        ]);
        // $event->update($request->except('url','start_date','end_date'));
        $event->title = ucfirst($request->title);       
        $event->venue = $request->venue;       
        $event->address = $request->address;       
        $event->org_id = $request->org_id;       
        $event->email = $request->email;      
        $event->country_id = $request->country_id;      
        $event->web_link = $request->web_link;      
        $event->active_flag = $request->active_flag;      
        $event->home_title = $request->home_title;

        $event->url = $request->url;
        $event->start_date = date("Y-m-d",strtotime($request->start_date));
        $event->end_date = date("Y-m-d",strtotime($request->end_date)); 
       // $event->updated_by = $request->user()->id;      
        $event->save();

        Session::flash('message_type', 'warning');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The event \"<a href='events/$event->title'>" . $event->title . "</a>\" was Updated.");

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->active_flag = 0;
        $event->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Event ' . $event->title . ' was De-Activated.');
        return redirect()->route('events.index');
    }
     public function reactivate(Event $event,$id)
    {

        $event = Event::findOrFail($id);
        $event->active_flag = 1;
        $event->save();

        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'The Event ' . $event->title . ' was Re-Activated.');

        return redirect()->route('events.index');
    }
      public function metatag(Request $request,$id)
    {
        $meta = Event::findOrFail($id);
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
        Session::flash('message', 'The Event ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
