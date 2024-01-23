<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Auth;
use File;
use Session;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if($request->get('search')){
        $search =\Request::get('search');
        $project = Project::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $project = Project::orderBy('id', 'desc')->paginate(10);
         }
        $active = Project::where('active_flag', 1);

        return view('knowledgebank.project.index',compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('knowledgebank.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       request()->validate(['title' =>'required|unique:projects',
       'image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
       'url'=>'required',
        'alt_tag'    =>'required',
         'description' =>'required',
        'short_description' =>'required',
        
        
      
   ]);
      $project = new Project($request->except(['image','created_by','url']));
      if($request->file('image')){
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('knowledgebank/project'),$imagename);
        $project->image = $imagename;

    }
    $project->url = str_slug($request->url);
    $project->created_by = Auth::user()->id;
    $project->meta_title = $request->input("title");
    $project->meta_description = $request->input("short_description");
    $project->save();

    return redirect()->route('project.index')->with(['create_message'=>'Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
      return view('knowledgebank.project.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('knowledgebank.project.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
         request()->validate(['title' =>'required',
       'image' =>'mimes:jpeg,png,jpg,gif,svg|max:2048',
       'url'    =>'required',
        'alt_tag'    =>'required',
        'description' =>'required',
        'short_description' =>'required',      
      
   ]);
       $image_name = public_path('knowledgebank/project')."/".$project->image;
       

      if(File::exists($image_name)){
        if($request->file('image')){
         File::delete($image_name);
        $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('knowledgebank/project'),$imagename);
        $project->image = $imagename;
        }
        else{
           $project->image = $project->image; 
        }
        }
        else{
            
             $imagename  = time().'-'.$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('knowledgebank/project'),$imagename);
        $project->image = $imagename;
        }
        $project->updated_by = Auth::user()->id;
         $project->url = str_slug($request->url);
        $project->update($request->except(['image','updated_by','url']));
        $project->meta_title = $request->input("title");
        $project->meta_description = $request->input("short_description");
        $project->save();
       return redirect()->route('project.index')->with(['create_message'=>'Successfully Updated','alert'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
          $project->active_flag = 0;
        $project->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'Project '.$project->title.' deactiveted !');
         return redirect()->route('project.index');
    }
    public function reactivate(Project $project)
    {        

      $project->active_flag = 1;
      $project->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'project '.$project->title.' Activeted !');
       return redirect()->route('project.index');
    }
    public function metatag(Request $request,$project)
    {


        $meta = Project::findOrFail($project);
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
        Session::flash('message', 'The project ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
