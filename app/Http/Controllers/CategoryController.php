<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\Http\Requests\CategoryRequest;
use Auth;
use Session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

         if($request->get('search')){
        $search = \Request::get('search'); 
        $data = Category::where('name', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $data = Category::orderBy('id', 'desc')->paginate(10);
         }
        $active = Category::where('active_flag', 1);
       
        return view('editorial.category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editorial.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {


        $category = new Category($request->except('url'));           
        $category->url= str_slug($request->url);
        $category->author_id= \Auth::id();
        $category->save();
        return redirect()->route('editorialcategory.index')->with('message', 'New Category in list !');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $editorialcategory)
    {
        return view('editorial.category.show',compact('editorialcategory'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $editorialcategory)
    {             

       return view('editorial.category.edit',compact('editorialcategory'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $editorialcategory)
    {

        $editorialcategory->url = str_slug($request->url);  
        $editorialcategory->author_id = \Auth::id();                 
        $editorialcategory->update($request->except('url'));
        if($editorialcategory->save())  {          
         return redirect()->route('editorialcategory.index')->with('message', 'New Category in list !');
     }   

 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $editorialcategory)
    {

        $editorialcategory->active_flag  = 0;
        $editorialcategory->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Category '.$editorialcategory->title.' De-Activeted !');
        return redirect()->route('editorialcategory.index')->with('message', 'New Category in list !');
    }
    public function reactivate(Category $editorialcategory)
    {        

      $editorialcategory->active_flag = 1;
      $editorialcategory->save();
      Session::flash('message_type', 'success');
      Session::flash('message_icon', 'checkmark');
      Session::flash('message_header', 'Success');
      Session::flash('message', 'Category '.$editorialcategory->title.' Activeted !');
      return redirect()->route('editorialcategory.index');
  }
}
