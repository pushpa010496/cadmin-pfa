<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

use App\Page;
use Illuminate\Http\Request;
use \Session;

class PageController extends Controller
{
	protected $model;

	public function __construct(Page $model)
	{
		$this->model = $model;
		$this->middleware('auth');
	}

	 public function index(Request $request)
    {
       	if($request->get('search')){
		$search = \Request::get('search'); 
 		$pages = Page::where('title', 'like', '%'.$search.'%')->paginate(20);
   		 }else{
   			$pages = Page::orderBy('id', 'desc')->paginate(10);
		 }
		$active = Page::where('active_flag', 1);
		return view('pages.index', compact('pages', 'active'));
    }

	public function create()
	{
	    return view('pages.create');
	}
	public function store(Request $request, User $user)
	{
		$page = new Page();

		request()->validate([
			'title' => 'required|max:255'
        ]);
		
		
	   	
	  	$page->title = $request->input("title");
		
		$page->active_flag = $request->input("active_flag");
		$page->author_id = $request->user()->id;

		$page->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The page \"<a href='pages/$page->title'>" . $page->name . "</a>\" was Created.");

		return redirect()->route('pages.index');
	}

	public function show(Page $page)
	{
		//$page = $this->model->findOrFail($id);

		return view('pages.show', compact('page'));
	}
	public function edit(Page $page)
	{
		return view('pages.edit', compact('page'));
	}

	public function update(Request $request, Page $page, User $user)
	{
		request()->validate([
			'title' => 'required|max:255'         ]);
		
		$page->title = $request->input("title");
			
		$page->active_flag = $request->input("active_flag");
		$page->author_id = $request->user()->id;


		$page->save();

		Session::flash('message_type', 'warning');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', "The page \"<a href='pages/$page->title'>" . $page->name . "</a>\" was Updated.");

		return redirect()->route('pages.index');
	}
	public function destroy(Page $page)
	{
		$page->active_flag = 0;
		$page->save();

		Session::flash('message_type', 'danger');
		Session::flash('message_icon', 'hide');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The page ' . $page->name . ' was De-Activated.');

		return redirect()->route('pages.index');
	}

	public function reactivate(Page $page,$id)
	{

		$page = Page::findOrFail($id);
		$page->active_flag = 1;
		$page->save();

		Session::flash('message_type', 'success');
		Session::flash('message_icon', 'checkmark');
		Session::flash('message_header', 'Success');
		Session::flash('message', 'The page ' . $page->name . ' was Re-Activated.');

		return redirect()->route('pages.index');
	}
}
