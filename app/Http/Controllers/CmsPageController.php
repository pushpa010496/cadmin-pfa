<?php

namespace App\Http\Controllers;

use App\CmsPage;
use Illuminate\Http\Request;
use App\Http\Requests\CmsPageRequest;
use Session;


class CmsPageController extends Controller
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
        $cmspages = CmsPage::where('title', 'like', '%'.$search.'%')->paginate(20);
         }else{
            $cmspages = CmsPage::orderBy('id', 'desc')->paginate(10);
         }
       $active = CmsPage::where('active_flag', 1);

         //$cmspages=CmsPage::orderBy('id', 'desc')->paginate(10);
        return view('management.cmspages.index',compact('cmspages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('management.cmspages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CmsPageRequest $request)
    {
          $cmspage = new CmsPage();       
          $cmspage->title = $request->title;
          $cmspage->sub_title = $request->sub_title;
          $cmspage->url = str_slug($request->url);          
          $cmspage->title_tag = $request->title_tag;          
          $cmspage->description = $request->description;
          $cmspage->active_flag = $request->active_flag;
          $cmspage->save();

        return redirect()->route('cmspages.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function show(CmsPage $cmspage)
    {
        //
     return view('management.cmspages.show',compact('cmspage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsPage $cmspage)
    {
        //
        return view('management.cmspages.edit',compact('cmspage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function update(CmsPageRequest $request, CmsPage $cmspage)
    {
        //
         $cmspage->url = str_slug($request->url);  
         $cmspage->update($request->except('url'));
       
          if($cmspage->save())  {          
            return redirect()->route('cmspages.index');
         }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsPage $cmspage)
    {
        //
        $cmspage->active_flag = 0;
        $cmspage->save();
        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', 'CmsPages '.$cmspage->title.' deactiveted !');
         return redirect()->route('cmspages.index');
    }
    public function reactivate(CmsPage $cmspage)
    {        

      $cmspage->active_flag = 1;
      $cmspage->save();
       Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
       Session::flash('message', 'CmsPages '.$cmspage->title.' Activeted !');
       return redirect()->route('cmspages.index');
    }

     public function metatag(Request $request,$cmspage)
    {


        $meta = CmsPage::findOrFail($cmspage);
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
        Session::flash('message', 'The CmsPages ' . $meta->meta_title . ' Metatags was added.');

        return redirect()->back();
    }
}
