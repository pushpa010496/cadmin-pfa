<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Event;
use App\EventOrg;
use Illuminate\Http\Request;
use \Session;

class EventOrgController extends Controller
{
	protected $model;

	public function __construct(EventOrg $model)
	{
		$this->model = $model;
		$this->middleware('auth');
	}

	 public function index(Request $request)
    {
       	if($request->get('search')){
		$search = \Request::get('search'); 
		$eventorganisers = EventOrg::where('name', 'like', '%'.$search.'%')->paginate(20);
 		/*$eventorganisers = EventOrg::whereHas('event' , function($query) use($search) {
 			$query->where('name', 'like', '%'.$search.'%');
 			$query->where('event_type',1);})
	 		->where('active_flag',1)
	 		->paginate(20);*/
   		 }else{
   			$eventorganisers = EventOrg::orderBy('id', 'desc')->paginate(10);
		 }
		 
		$active = EventOrg::where('active_flag', 1);
		return view('eventorganisers.index', compact('eventorganisers', 'active'));
    }

	public function create()
	{
		
	    return view('eventorganisers.create');
	}
	public function store(Request $request, User $user)
	{
		$eventorg = new EventOrg();

		request()->validate([
			'name'=>'required',
			'org_email'=>'required',
			'url'=>'required',
            'org_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);
		
		if($request->file('org_logo')){
        $org_logoName = preg_replace('/\s+/','-',time().'-'.$request->file('org_logo')->getClientOriginalName());
        request()->org_logo->move(public_path('event/organiser'), $org_logoName);
		$eventorg->org_logo = $org_logoName;	
	    }
	   	
	   	$eventorg->name = $request->input("name");
	   	$eventorg->longitude = $request->input("longitude");
	   	$eventorg->latitude = $request->input("latitude");
	   	$eventorg->org_logo_title = ucfirst($request->input("org_logo_title"));
	   	$eventorg->org_logo_alt = ucfirst($request->input("org_logo_alt"));
	   	$eventorg->org_address = ucfirst($request->input("org_address"));
	   	$eventorg->org_contactno = $request->input("org_contactno");
		$eventorg->org_email = $request->input("org_email");
		$eventorg->org_website = $request->input("org_website");
		$eventorg->url = str_slug($request->input("url"));

		$eventorg->active_menus = json_encode($request->input("active_menus"));
		$eventorg->exhibitor_description = ucfirst($request->input("exhibitor_description"));
		
		$eventorg->active_flag = $request->input("active_flag");
		$eventorg->author_id = $request->user()->id;

		$eventorg->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The event " . $eventorg->name . " was Created.");

		return redirect()->route('eventorganisers.index');
	}

	public function show(EventOrg $eventorg,$id)
	{
		$eventorg = $this->model->findOrFail($id);

		return view('eventorganisers.show', compact('eventorg'));
	}
	public function edit(EventOrg $eventorg,$id)
	{
		$eventorg = EventOrg::find($id);
		return view('eventorganisers.edit', compact('eventorg'));
	}

	public function update(Request $request, EventOrg $eventorg, User $user,$id)
	{
		$eventorg = EventOrg::find($id);
		request()->validate([
           'name'=>'required',
           'org_email'=>'required',
			'url'=>'required',
            'org_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ]);
		
		if($request->file('org_logo')){
			$path = public_path('event/organiser');
			$org_logoName = preg_replace('/\s+/','-',time().'-'.$request->file('org_logo')->getClientOriginalName());        
			if(request()->org_logo->move($path, $org_logoName)){
				if(\File::exists($path.'/'.$eventorg->org_logo)){	        		
					\File::delete($path.'/'.$eventorg->org_logo);        	        		
				}        	
			}
			$eventorg->org_logo = $org_logoName;
		}
		
	   	$eventorg->name = $request->input("name");	    
	  	$eventorg->longitude = $request->input("longitude");
	   	$eventorg->latitude = $request->input("latitude");
	   	$eventorg->org_logo_title = ucfirst($request->input("org_logo_title"));
	   	$eventorg->org_logo_alt = ucfirst($request->input("org_logo_alt"));
	   	$eventorg->org_address = ucfirst($request->input("org_address"));
	   	$eventorg->org_contactno = $request->input("org_contactno");
		$eventorg->org_email = $request->input("org_email");
		$eventorg->org_website = $request->input("org_website");
		$eventorg->url = str_slug($request->input("url"));

		$eventorg->active_menus = json_encode($request->input("active_menus"));
		$eventorg->exhibitor_description = ucfirst($request->input("exhibitor_description"));
		
		$eventorg->active_flag = $request->input("active_flag");
		$eventorg->author_id = $request->user()->id;

		$eventorg->save();

		Session::flash('message_type', 'warning');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The event " . $eventorg->name . " was Updated.");

		return redirect()->route('eventorganisers.index');
	}
	public function destroy(EventOrg $eventorg,$id)
	{
		$eventorg = EventOrg::findOrFail($id);
		$eventorg->active_flag = 0;
		$eventorg->save();

		Session::flash('message_type', 'danger');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The event ' . $eventorg->name . ' was De-Activated.');

		return redirect()->route('eventorganisers.index');
	}

	public function reactivate(EventOrg $eventorg,$id)
	{

		$eventorg = EventOrg::findOrFail($id);
		$eventorg->active_flag = 1;
		$eventorg->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The event ' . $eventorg->name . ' was Re-Activated.');

		return redirect()->route('eventorganisers.index');
	}
	public function metatag(Request $request,$id){
		$meta = EventOrg::findOrFail($id);
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
		Session::flash('message', 'Event Org ' . $meta->meta_title . ' Metatags was added.');


		return redirect()->route('eventorganisers.index');
	}
}
