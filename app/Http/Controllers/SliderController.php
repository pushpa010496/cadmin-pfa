<?php



namespace App\Http\Controllers;



use App\Http\Requests;

use App\Http\Controllers\Controller;

use Mail;

use App\User;

use Auth;

use App\Page;

use App\Position;

use App\Tracklink;

use App\Slider;
use App\Issue;
use Illuminate\Http\Request;

use \Session;



class SliderController extends Controller

{

	protected $model;



	public function __construct(Slider $model)

	{

		$this->model = $model;

		$this->middleware('auth');

	}



	 public function index(Request $request)

    {

        $search = \Request::get('search');

        $banner_search = \Request::get('banner_search'); 

        $sliders = Slider::when(!empty($search), function ($query) use ($search) {

                return $query->where('title', 'like', '%'.$search.'%');

            })

            ->when(!empty($banner_search), function ($query) use ($banner_search) {

                return $query->where('active_flag', $banner_search);

            })

            ->orderBy('id','desc')

        ->paginate(20);

		return view('sliders.index', compact('sliders'));

    }



	public function create(Slider $slider)

	{

		$pages = Page::where('active_flag',1)->pluck('title','id');
		$issues =Issue::where('active_flag',1)->orderBy('id', 'desc')->pluck('issue_no','issue_no')->prepend('-- Select issue --','');

		$position = Position::where('active_flag','1')->pluck('position','id');

	    return view('sliders.create',compact('slider','pages','position','issues'));

	}

	public function store(Request $request, User $user)

	{

		$slider = new Slider();



		request()->validate([

			'title' => 'required',

            'image' => 'required',

            'url'	=>	'required',

        ]);

		

		if($request->url !=""){			

            // create short link

			$tracklinks = new Tracklink();

			$tracklinks->setConnection('mysql2');

			$tracklinks->type =  "ban";

			$tracklinks->title =  $request->title;

			$tracklinks->oriurl =  $request->url;

			$tracklinks->shorturl_id =  date('Ymdhis').rand();

			$tracklinks->titleid =  rand();

			$tracklinks->save();



			$track_url = 'http://track.pharmafocusasia.com/'.$tracklinks->shorturl_id. '/';	



			$slider->url = $track_url;

            //end short link

		}else{

			$slider->url = $request->url;

		}



		if($request->file('image')){

		$imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());

       // $imageName = str_slug(time().'-'.$request->file('image')->getClientOriginalName(), "-");

        request()->image->move(public_path('slider'), $imageName);

		$slider->image = $imageName;	

	    }

	    $data = [

          	'name' => ucfirst($request->input("title")),

		   	'from_date' => $request->input("from_date"),

		   	'to_date' => $request->input("to_date"),

		   	'track_url'=>$track_url,

			   'status'=>$request->active_flag == 1 ? 'Active' : 'In-Active'

		   	// 'type'=>$request->input("type"),

        ];



	    $emails = explode(',', $request->emails);

	    $title = ucfirst($request->title);

			foreach($emails as $email){ 

			    Mail::send('emails.slider.admin', $data, function($message) use ($data,$email,$title) {

		        $message->to($email);   

		        $message->subject($title.'-'.'Pharma Focus Asia!');

		        });	

		}

	   	

	   	$slider->title = ucfirst($request->input("title"));

	   	$slider->from_date = $request->input("from_date");

	   	$slider->to_date = $request->input("to_date");

		$slider->img_title = $request->input("img_title");

		$slider->img_alt = $request->input("img_alt");

        $slider->issue_id = $request->input("issue_no");

		$slider->category = $request->input("category");
		
		// $slider->url =$request->url;

		$slider->type = $request->input("type");

		$slider->script = $request->input("script");

		$slider->script = $request->input("script");

		//$slider->position = $request->input("position");

		

		$slider->active_flag = $request->input("active_flag");

		$slider->author_id = $request->user()->id;

        $slider->save();

       $slider->pages()->attach($request->input("pages"));

       //$slider->positions()->attach($request->input("position"));





		Session::flash('message_type', 'success');

		Session::flash('message_icon', 'checkmark');

		Session::flash('message_header', 'Success');

		Session::flash('message', "The slider \"<a href='sliders/$slider->title'>" . $slider->name . "</a>\" was Created.");



		return redirect()->route('sliders.index');

	}



	public function show(Slider $slider)

	{

		//$slider = $this->model->findOrFail($id);



		return view('sliders.show', compact('slider'));

	}

	public function edit(Slider $slider)

	{

		//print_r($slider->positions()->pluck('id'));die;

		

		$pages = Page::where('active_flag',1)->pluck('title','id');

		$position = Position::where('active_flag','1')->pluck('position','id');

        $issues =Issue::where('active_flag',1)->orderBy('id', 'desc')->pluck('issue_no','issue_no')->prepend('-- Select issue --','');


		return view('sliders.edit', compact('slider','pages','position','issues'));

	}



	public function update(Request $request, slider $slider, User $user)

	{

		request()->validate([

			'title' => 'required',

         

             'url'	=>	'required',

             'pages'	=>	'required'

        ]);

		

		if($request->file('image')){

		$imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('image')->getClientOriginalName());

        //$imageName = str_slug(time().'-'.$request->file('image')->getClientOriginalName(), "-");

        request()->image->move(public_path('slider'), $imageName);

		$slider->image = $imageName;	

	    }

	    $data = [

          	'name' => ucfirst($request->input("title")),

		   	'from_date' => $request->input("from_date"),

		   	'to_date' => $request->input("to_date"),

		   	'track_url'=>$slider->url,

			   'status'=>$request->active_flag == 1 ? 'Active' : 'In-Active'
		   	// 'type'=>$request->input("type"),

        ];



	    $emails = explode(',', $request->emails);

	    $title = ucfirst($request->title);

			foreach($emails as $email){ 

			    Mail::send('emails.slider.admin', $data, function($message) use ($data,$email,$title) {

		        $message->to($email);   

		        $message->subject($title.'-'.'Pharma Focus Asia!');

		        });	

		}

	   	

	   	$slider->from_date = $request->input("from_date");

	   	$slider->to_date = $request->input("to_date");

		$slider->title = ucfirst($request->input("title"));

		$slider->img_title = $request->input("img_title");

		$slider->img_alt = $request->input("img_alt");

		$slider->url =$request->url;

		$slider->type = $request->input("type");

		$slider->script = $request->input("script");

		$slider->issue_id = $request->input("issue_no");
		
		$slider->category = ucfirst($request->input("category"));

		

		$slider->active_flag = $request->input("active_flag");

		$slider->author_id = $request->user()->id;

        $slider->save();

       $slider->pages()->sync($request->input("pages"));

       //$slider->positions()->sync($request->input("position"));



		$slider->save();



		Session::flash('message_type', 'warning');

		Session::flash('message_icon', 'checkmark');

		Session::flash('message_header', 'Success');

		Session::flash('message', "The slider \"<a href='sliders/$slider->title'>" . $slider->name . "</a>\" was Updated.");



		return redirect()->route('sliders.index');

	}

	public function destroy(Slider $slider)

	{

		$slider->active_flag = 0;

		$slider->save();



		Session::flash('message_type', 'danger');

		Session::flash('message_icon', 'hide');

		Session::flash('message_header', 'Success');

		Session::flash('message', 'The slider ' . $slider->name . ' was De-Activated.');



		return redirect()->route('sliders.index');

	}



	public function reactivate(Slider $slider,$id)

	{



		$slider = Slider::findOrFail($id);

		$slider->active_flag = 1;

		$slider->save();



		Session::flash('message_type', 'success');

		Session::flash('message_icon', 'checkmark');

		Session::flash('message_header', 'Success');

		Session::flash('message', 'The slider ' . $slider->name . ' was Re-Activated.');



		return redirect()->route('sliders.index');

	}



	public function slidersactive(){

		$sliders = Slider::where('active_flag', 1)->orderBy('id', 'desc')->paginate(10);



		return view('sliders.active_sliders',compact('sliders'));

	}

}

