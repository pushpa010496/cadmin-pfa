<?php



namespace App\Http\Controllers;



use App\Http\Requests;

use App\Http\Controllers\Controller;



use App\User;

use Auth;



use App\Newsletter;

use Illuminate\Http\Request;

use \Session;



class ClientemailblastController extends Controller

{

	/**

	 * Variable to model

	 *

	 * @var newsletter

	 */

	protected $model;



	/**

	 * Create instance of controller with Model

	 *

	 * @return void

	 */

	public function __construct(Newsletter $model)

	{

		$this->model = $model;

		$this->middleware('auth');

	}



	/**

	 * Display a listing of the resource.

	 *

	 * @return Response

	 */

	 public function index(Request $request)

    {



       	if($request->get('search')){

		$search = \Request::get('search'); //<-- we use global request to get the param of URI

 		$newsletters = Newsletter::where('title', 'like', '%'.$search.'%')->where('type', 'clientemailblast')->paginate(20);

   		 }else{

   			$newsletters = Newsletter::where('type', 'clientemailblast')->orderBy('id', 'desc')->paginate(10);

		 }

		$active = Newsletter::where('active_flag', 1);

		return view('clientemailblast.index', compact('newsletters', 'active'));

    }





	/**

	 * Show the form for creating a new resource.

	 *

	 * @return Response

	 */

	public function create()

	{

		return view('clientemailblast.create');

	}



	/**

	 * Store a newly created resource in storage.

	 *

	 * @param Request $request

	 * @return Response

	 */

	public function store(Request $request, User $user)

	{
		

		$newsletter = new newsletter();



		request()->validate([

			'title' => 'required|max:255',

			'file' => 'required'                   

        ]);

		

		if($request->file('file')){

        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('file')->getClientOriginalName());

        request()->file->move(public_path('clientemailblast'), $imageName);

		$newsletter->file = $imageName;	

	    }

	   

		$newsletter->title = ucfirst($request->input("title"));

		$newsletter->type = "clientemailblast";

		$newsletter->active_flag = $request->input("active_flag");

		$newsletter->author_id = $request->user()->id;

		
		$newsletter->save();



		Session::flash('message_type', 'success');

		Session::flash('message_icon', 'checkmark');

		Session::flash('message_header', 'Success');

		Session::flash('message', "The newsletter \"<a href='clientemailblast/$newsletter->newsletter_title'>" . $newsletter->name . "</a>\" was Created.");



		return redirect()->route('clientemailblast.index');

	}



	/**

	 * Display the specified resource.

	 *

	 * @param  int  $id

	 * @return Response

	 */

	public function show(Newsletter $newsletter,$id)

	{

		$newsletter = $this->model->findOrFail($id);



		return view('clientemailblast.show', compact('newsletter'));

	}



	/**

	 * Show the form for editing the specified resource.

	 *

	 * @param  int  $id

	 * @return Response

	 */

	public function edit(Newsletter $newsletter,$id)

	{

		$newsletters = $newsletter->where('id',$id)->get();



		return view('clientemailblast.edit', compact('newsletters'));

	}



	/**

	 * Update the specified resource in storage.

	 *

	 * @param  int  $id

	 * @param Request $request

	 * @return Response

	 */

	public function update(Request $request, Newsletter $newsletter, User $user,$id)

	{
		
		request()->validate([

			'title' => 'required|max:255'

			//'file' => 'required'             

        ]);

        //$file_path = public_path('clientemailblast')."/".$newsletter->file;

		$newsletter = Newsletter::findOrFail($id);
		//return  $newsletter;
		if($request->file('file')){
			$file_path = public_path('clientemailblast');
        $imageName = preg_replace('/\s+/', '-', time().'-'.$request->file('file')->getClientOriginalName());
		if(request()->file->move($file_path, $imageName)){  
			if(\File::exists($file_path.$newsletter->file)){                 

                    \File::delete($file_path.$newsletter->file);                         

                } 

       // request()->file->move(public_path('clientemailblast/'), $newsletter->file);

		$newsletter->file = $imageName;	
			}
	    }

	   	$newsletter->title = ucfirst($request->input("title"));

		$newsletter->type = "clientemailblast";

		$newsletter->active_flag = $request->input("active_flag");

		$newsletter->author_id = $request->user()->id;





		$newsletter->save();



		Session::flash('message_type', 'warning');

		Session::flash('message_icon', 'checkmark');

		Session::flash('message_header', 'Success');

		Session::flash('message', "The newsletter \"<a href='clientemailblast/$newsletter->newsletter_title'>" . $newsletter->name . "</a>\" was Updated.");



		return redirect()->route('clientemailblast.index');

	}



	/**

	 * Remove the specified resource from storage.

	 *

	 * @param  int  $id

	 * @return Response

	 */

	public function destroy(Newsletter $newsletter,$id)

	{

		$newsletter = Newsletter::findOrFail($id);

		$newsletter->active_flag = 0;

		$newsletter->save();



		Session::flash('message_type', 'danger');

		Session::flash('message_icon', 'hide');

		Session::flash('message_header', 'Success');

		Session::flash('message', 'The clientemailblast ' . $newsletter->name . ' was De-Activated.');



		return redirect()->route('clientemailblast.index');

	}



	/**

	 * Re-Activate the specified resource from storage.

	 *

	 * @param  int  $id

	 * @return Response

	 */

	public function reactivate(Newsletter $newsletter,$id)

	{



		$newsletter = Newsletter::findOrFail($id);

		$newsletter->active_flag = 1;

		$newsletter->save();



		Session::flash('message_type', 'success');

		Session::flash('message_icon', 'checkmark');

		Session::flash('message_header', 'Success');

		Session::flash('message', 'The clientemailblast ' . $newsletter->name . ' was Re-Activated.');



		return redirect()->route('clientemailblast.index');

	}

}

