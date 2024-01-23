<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Config;
use Excel;
use App\DataConnecting;


class DataexportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = DB::select('SHOW TABLES');

        return view('dataexpo.index',compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //Connect Data Base

         $db=$request->input('database');

        $dbuser=$request->input('databaseuser');

        $dbpassword=$request->input('databaseuserpassword');

       Config::set("database.connections.mysql1", [
            "driver" => "mysql",
            "host" => "localhost",
            "database" =>$db,
            "username" =>$dbuser,
            "password" =>$dbpassword
]);

        $db_ext = \DB::connection('mysql1');
        $tables = $db_ext->select('SHOW TABLES');
       /* print_r($tables);
exit;*/
         
        return view('import_export',compact('tables','db','dbuser','dbpassword'));

         
    // or just DB::connection()
        if (DB::connection()->getDatabaseName())
         {
         return 'Connected to the DB: ' . DB::connection()->getDatabaseName();
         }

         exit;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    public function exportdata(Request $request)
    {

    $tbl_info=$request->input("tableinfo");
 
    if(isset($tbl_info)){

      //header('Content-Type: text/csv; charset=utf-8');  
     // header('Content-Disposition: attachment; filename=data.csv');  
     // $output = fopen("php://output", "w");  
     
     $data = DB::table($tbl_info)->get()->toArray();


     foreach ($data as $trackinfo) {
        
        $urlinfoArray[] = $trackinfo;

        
    }
   $array = json_decode(json_encode($urlinfoArray), True); 

   return Excel::create($tbl_info, function($excel) use ($array) {

   $excel->sheet('trackReport', function($sheet) use ($array)
        {
   $sheet->fromArray($array);
   $sheet->row(1, function($row) {
                // call cell manipulation methods
                $row->setBackground('#FFFF00');

            });
        });
})->download('xlsx');
    
}

      
    }

       public function promotionLeads()
   {


       $promotiondata=DB::table('flatpages')->select('type')->distinct('type')->get();
        $subscribers=DB::table('subscribers')->where('type','like','%Magazine-Subscription -%')->select('type')->distinct('type')->get();
    //    dd($subscribers);
        $webinars=DB::table('webinar_data')->select('type')->distinct('type')->get();
        $downloads=DB::table('downloads')->select('type')->distinct('type')->get();
        $cpc=DB::table('pharma_softwares')->select('type')->distinct('type')->get();
        $magazine_subscribe=DB::table('subscription')->select('type')->distinct('type')->get();
        return view('promotions.promotion',compact('promotiondata','subscribers','webinars','downloads','cpc','magazine_subscribe'));



   }

   public function promotionleadslist($promotion)
   {



  $leadsinfo=DB::table('flatpages')->select('id','firstname','lastname','name','email','title','company','country','type','phone','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();

 return view('promotions.leads',compact('leadsinfo'));

   }

   public function promotionformleadslist($promotion)
   {
    $leadsinfo=DB::table('subscribers')->select('id','fullname','email','designation','industry','address','country_name','type','telephone','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();
      return view('promotions.subscriptions',compact('leadsinfo'));
   }

   public function promotiondownloadleadslist($promotion)
   {
    $leadsinfo=DB::table('downloads')->select('id','fullname','email','designation','country_name','type','telephone','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();
      return view('promotions.download',compact('leadsinfo'));
   }

   public function promotionwebinars($webinar)
   {

     $leadsinfo=DB::table('webinar_data')->select('id','firstname','lastname','email','job_title','company','address1','address2','country','city','state','zip','type','phone','email_updates','representative','quotation','created_at','headquarters')->where('type',$webinar)->orderBy('id', 'desc')->get();
      return view('promotions.webinars',compact('leadsinfo'));
  }

  public function cpcleads($cpc)
  {
   $leadsinfo=DB::table('pharma_softwares')->select('id','FirstName','LastName','emailAddress','Phone','type','company','Country','created_at')->where('type',$cpc)->orderBy('id', 'desc')->get();
     return view('promotions.cpc',compact('leadsinfo'));
  }

  
  public function promotionsubscribe($promotion)
  {

    $leadsinfo=DB::table('subscription')->select('id','name','email','job_title','company','country','type','telephone','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();

return view('promotions.subscribe',compact('leadsinfo'));

  }

}
