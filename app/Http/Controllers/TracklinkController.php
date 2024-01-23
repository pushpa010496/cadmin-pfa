<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tracklink;
use App\User;
use Auth;
use App\Role;
use App\Permission;
use \Session;
use DB;
use App\Company;
use Carbon\Carbon;


class TracklinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $model)
    {
        $this->middleware('auth');
        $this->model = $model;
    }
    public function index(Request $request)
    {

        
            
       //$titles_info=Tracklink::all()->unique('title');
       //return view('tracklink.titleinfo', compact('titles_info'));

     if($search = $request->search){


       $titles_info=Tracklink::where('title', 'like', '%'.$search.'%')->orWhere('shorturl_id', 'like', '%'.$search.'%')     
       ->paginate(200);




     }else{

      $titles_info=Tracklink::paginate(100);



            // $titles_info = DB::table('tracklinks')
            //                     ->select('*')->distinct('title')
            //                     ->get();
         
                


              //print_r($titles_info); die; 
         }    
 
         return view('tracklink.titleinfo',compact('titles_info'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       
        if (Auth::user()->can('tracklinkgen')) {

        $roles = Role::where('active_flag', 1)->orderBy('name')->pluck('name', 'id');
        return view('tracklink.create',compact('roles'));

        }else{

        Session::flash('message_type', 'danger');
        Session::flash('message_icon', 'hide');
        Session::flash('message_header', 'Success');
 
            Session::flash('message', "You do not have User permissions");
             return view('tracklink.titleinfo'); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     //echo $string=date('Ymdhis');

 
        if (Auth::user()->can('tracklinkgen')) {
        $linkgen = new Tracklink();
        $linkgen->type =$request->input("type");
        $linkgen->title =$request->input("title");
        $linkgen->oriurl =$request->input("oriurl");
        
        $titleid=rand();
        for($i=1;$i<=46;$i++){
            
            $randam=rand();
            $linkgen->oriurl =$request->input("oriurl".$i);
            $linkgen->shorturl_id=date('Ymdhis').$randam;

          
            if($linkgen->oriurl !=""){

                  $data = array(
     array('type'=>$request->input("type"), 'title'=>$request->input("title"),'oriurl'=>$linkgen->oriurl,'shorturl_id'=>$linkgen->shorturl_id,'titleid'=>$titleid));

               Tracklink::insert($data);

 //$linkgen->save();
                 
                   }

                   //echo "ok";

                  // exit;
         }

    
        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The Short link was Created.");

       // return redirect()->route('tracklinkgen.index');

       //return view('tracklink.titleinfo');
       return redirect('tracklinkgen');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tracklink $tracklink,$id)
    {
      //  return view('tracklink.show', compact('tracklink'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tracklink $tracklink ,$id)
    {
            
        //
       
        //$user = $this->model->findOrFail($id);
        $newlinks = Tracklink::where('id',$id)->orderBy('id')->first();
        //print_r($newlinks[0]->id);die;
        return view('tracklink.edit',compact('newlinks'));

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Tracklink $tracklink, $id)
    {

       
        $track = Tracklink::find($id);
        $track->title =$request->input("title");
        $track->oriurl =$request->input("oriurl");

       // $track->shorturl_id=date('Ymdhis');
        
        $this->validate($request, [
                    'oriurl' => 'required|string|max:255',
                    
             ]);

        $track->save();
         
        Session::flash('message_type', 'success');
        Session::flash('message_icon', 'checkmark');
        Session::flash('message_header', 'Success');
        Session::flash('message', "The Short link was Created.");

        return redirect()->route('tracklinkgen.index');


       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


public function getview(Request $request,$ttid){

          return view('tracklink.new-link',compact('ttid'));

}

    public function gettitleinfo(Request $request,$ttid){

      
         /* search code */
          if($request->get('search')){
        $search = \Request::get('search'); //<-- we use global request to get the param of URI
        //print_r($search);die;
        $tracklinkdata = Tracklink::where('shorturl_id', 'like', '%'.$search.'%')->paginate(250);
         }else{
            //$tracklinkdata = Tracklink::where('titleid',$ttid)->orderBy('id', 'desc')->paginate(10);

            $tracklinkdata = Tracklink::where('titleid',$ttid)->orderBy('id', 'desc')->paginate(250);
         }
       // $active = Tracklink::where('active_flag', 1);
       return view('tracklink.index', compact('tracklinkdata','ttid'));



        /* End search code */


    }


    public function geturlinfo(Request $request,$short_urlid)
    {
      
            $url_info=Tracklink::where('shorturl_id',$short_urlid)->first();
           
                
                if( $url_info){
                       $urlshortcode=$url_info->shorturl_id;
                       $clientip=$request->getClientIp();
                       $oriurl=$url_info->oriurl;

                       $cliks_count=$url_info->cliks_count;

                       //$newclick=$cliks_count+1;

                       

                       $date=date('Y-m-d');
                          
                       DB::connection('mysql2')->select('trackurl_info')->insert(
    ['shorturl_id' => $urlshortcode, 'client_ip' =>  $clientip,'created_at'=>$date,'updated_at'=>$date]
);                         
                             /*DB::table('tracklinks')
                             ->where('shorturl_id',$short_urlid)
                             ->update(['cliks_count' => $newclick]);
                             */

                           

                    return redirect($oriurl);  
                
                  }





    }

    public function trackreport(Request $request)
    {
   
    //ini_set('memory_limit', '-1');
   /* $url_info = DB::table('tracklinks')
    ->select('*')
    ->join('trackurl_info', 'trackurl_info.shorturl_id', '=', 'tracklinks.shorturl_id')
    ->get()->unique('titleid');*/
      $like=$request->input('type');
    $url_info = DB::connection('mysql2')->table('tracklinks','trackurl_info')
    ->select('tracklinks.title','tracklinks.shorturl_id','tracklinks.titleid')
    ->where('type',$like)
   /* ->join('trackurl_info', 'trackurl_info.shorturl_id', '=', 'tracklinks.shorturl_id')
    ->whereBetween('tracklinks.created_at', [
      Carbon::now()->startOfYear(),
      Carbon::now()->endOfYear(),
    ])
    ->whereBetween('tracklinks.created_at', [
      '2020-06-01','2020-08-01'
    ])  */
    ->get()->unique('titleid');
   
    
  return view('tracklink.trackreport', compact('url_info')); 

    
    }

    public function Addnewlink(Request $request)
    { 
                                     $titleid=$request->input('titleid');

                                     
                         $info= DB::connection('mysql2')->table('tracklinks')
                               ->where('titleid',$titleid)->get()->unique('titleid');


                               foreach($info as $iddata){

                             // if (Auth::user()->can('tracklinkgen')) {
       
                                    $linkgen = new Tracklink();
                                    $linkgen->type =$iddata->type;
                                    $linkgen->title =$iddata->title;
                                    $linkgen->oriurl =$request->input('oriurl1');
                                    //$titleid=rand();
                                    $randam=rand();
                                    $linkgen->oriurl =$request->input('oriurl1');
                                    $linkgen->shorturl_id=date('Ymdhis').$randam;

                                
            if($linkgen->oriurl !=""){
                  $data = array(
    array('type'=>$iddata->type, 'title'=>$iddata->title,'oriurl'=>$request->input('oriurl1'),'shorturl_id'=>$linkgen->shorturl_id,'titleid'=>$titleid));

               Tracklink::insert($data);

                $titles_info=Tracklink::paginate(100);
           
                return view('tracklink.titleinfo', compact('titles_info'));




    }
}
                      // }
    exit;
     



}


 public function companyUrl()
    {

     $companies = DB::table('companies')->select('id','comp_name','website')->get();
       
     if (Auth::user()->can('tracklinkgen')) {
        $linkgen = new Tracklink();
        $linkgen->type ="company";
        $linkgen->title ="Company Urls";
        
        
        foreach($companies as $company) 
        {
 

           $linkgen->oriurl = $company->website;
           $titleid=rand();
           $randam=rand();
           $linkgen->oriurl =$company->website;
           $linkgen->shorturl_id=date('Ymdhis').$randam;


           if($linkgen->oriurl !=""){
                $tracuid = new Tracklink();

                $tracuid->type = "company";
                $tracuid->title = "company";
                $tracuid->oriurl = $linkgen->oriurl;
                $tracuid->shorturl_id = $linkgen->shorturl_id;
                $tracuid->titleid = $titleid;
                $tracuid->save();
            

            //   $data = array(
            //      array('type'=> "company", 'title'=> "company" ,'oriurl'=>$linkgen->oriurl,'shorturl_id'=>$linkgen->shorturl_id,'titleid'=>$titleid));

            // $tracuid =  Tracklink::insert($data);


   $track_url = config('app.url').'/'.$linkgen->shorturl_id;
   $update = DB::select('companies')->where('id',$company->id)->update(['track_url'  => $track_url,'track_id'  => $tracuid->id]);

          }
      
        }

      Session::flash('message_type', 'success');
      Session::flash('message_icon', 'checkmark');
      Session::flash('message_header', 'Success');
      Session::flash('message', "The Short link was Created.");

       // return redirect()->route('tracklinkgen.index');

       //return view('tracklink.titleinfo');
      return redirect('tracklinkgen');

  }



    }





    public function companyUrlUpdate()
      {

       $companies = DB::table('companies')->select('id','comp_name','website','track_id')->get();
       foreach($companies as $company) 
       {
        $linkgen = Tracklink::find($company->track_id);
        $linkgen->title =$company->comp_name;
        $linkgen->save();

      }
      return 'completed';


    }
}
