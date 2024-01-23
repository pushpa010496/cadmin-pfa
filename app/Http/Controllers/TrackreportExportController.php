<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrackreportExport;
use App\Tracklink;
use App\Trackurl_info;
use Excel;
use DB;

class TrackreportExportController extends Controller
{
   

public function downloadExcel()
{

    $data = Tracklink::get()->toArray();

  //  print_r($data);

   // exit;
   // $urlinfoArray=[];
   // $urlinfoArray[]=['id','short_urlid','clicks_count'];

foreach ($data as $trackinfo) {
        
        $urlinfoArray[] = $trackinfo;

        
    }
    //print_r($urlinfoArray); die;
return Excel::create('urltrackinfo', function($excel) use ($urlinfoArray) {
$excel->sheet('trackReport', function($sheet) use ($urlinfoArray)
        {
$sheet->fromArray($urlinfoArray);
$sheet->row(1, function($row) {
                // call cell manipulation methods
                $row->setBackground('#FFFF00');

            });
        });
})->download('xlsx');

   

}

public function reportbyip($shorturl_id)
{
   /* $ipdata = DB::table('trackurl_info')
     ->select('tracklinks.oriurl','trackurl_info.shorturl_id','trackurl_info.client_ip','tracklinks.type')
    ->join('tracklinks', 'trackurl_info.shorturl_id', '=', 'tracklinks.shorturl_id')
   ->where('trackurl_info.shorturl_id',$shorturl_id)->get();*/

    $ipdata =DB::connection('mysql2')->table('trackurl_info','tracklinks')
                  ->select('tracklinks.oriurl','trackurl_info.shorturl_id','trackurl_info.client_ip','trackurl_info.created_at','tracklinks.type')
                  ->join('tracklinks', 'trackurl_info.shorturl_id', '=', 'tracklinks.shorturl_id')
                  ->where('trackurl_info.shorturl_id',$shorturl_id)->get();
                
/*Don't Delete */
  /*  $ipdata = DB::table('trackurl_info')
                 ->select('client_ip', DB::raw('count(client_ip) as total'))
                 ->where('shorturl_id',$shorturl_id)
                 ->groupBy('client_ip')
                //->orderBy('client_ip')
                 ->get();
                 */

               //  print_r($user_info);

              //   exit;

    
$resultArray = json_decode(json_encode($ipdata), true);

   $ipurlinfoArray=[];
   $ipurlinfoArray[]=['Original Url','short Url Id','Client Ip','Created Date','Track Type'];

foreach ($resultArray as $iptrackinfo) {
        
       // $ipurlinfoArray[] = (array) $iptrackinfo;

    $ipurlinfoArray[] =$iptrackinfo;
        
    
  
       
        } 
  //print_r($ipurlinfoArray);

//exit;
return Excel::create('ipurltrackinfo', function($excel) use ($ipurlinfoArray) {
$excel->sheet('iptrackReport', function($sheet) use ($ipurlinfoArray)
        {
$sheet->fromArray($ipurlinfoArray);
$sheet->row(2, function($row) {
                // call cell manipulation methods
                $row->setBackground('#FFFF00');

            });
        });
})->download('xlsx');



}
public function reportbyclientip($shorturl_id)
{
    $ipdata = DB::connection('mysql2')->table('trackurl_info','tracklinks')
    ->select('tracklinks.oriurl','trackurl_info.shorturl_id','trackurl_info.client_ip','tracklinks.type')
          ->join('tracklinks', 'trackurl_info.shorturl_id', '=', 'tracklinks.shorturl_id')->where('trackurl_info.shorturl_id',$shorturl_id)->distinct()->get();
/*Don't Delete */
  /*  $ipdata = DB::table('trackurl_info')
                 ->select('client_ip', DB::raw('count(client_ip) as total'))
                 ->where('shorturl_id',$shorturl_id)
                 ->groupBy('client_ip')
                //->orderBy('client_ip')
                 ->get();
                 */

               //  print_r($user_info);

              //   exit;

    
$resultArray = json_decode(json_encode($ipdata), true);

   $ipurlinfoArray=[];
   $ipurlinfoArray[]=['Original Url','short Url Id','Client Ip','Track Type'];

foreach ($resultArray as $iptrackinfo) {
        
       // $ipurlinfoArray[] = (array) $iptrackinfo;

    $ipurlinfoArray[] =$iptrackinfo;
        
    
  
       
        } 
  //print_r($ipurlinfoArray);

//exit;
return Excel::create('ipurltrackinfo', function($excel) use ($ipurlinfoArray) {
$excel->sheet('iptrackReport', function($sheet) use ($ipurlinfoArray)
        {
$sheet->fromArray($ipurlinfoArray);
$sheet->row(2, function($row) {
                // call cell manipulation methods
                $row->setBackground('#FFFF00');

            });
        });
})->download('xlsx');



}
public function reportbytitle($titleid)
{
       //$ipdata = DB::table('trackurl_info')->select('*')->where('titleid',$titleid)->get();

  
                   $leagues = DB::connection('mysql2')->table('trackurl_info','tracklinks')
                  ->select('tracklinks.oriurl','trackurl_info.id','trackurl_info.shorturl_id','trackurl_info.client_ip','trackurl_info.created_at','tracklinks.type')
                  ->join('tracklinks', 'trackurl_info.shorturl_id', '=', 'tracklinks.shorturl_id')
                  ->where('trackurl_info.titleid', $titleid)
                  ->get();

              $resultArray = json_decode(json_encode($leagues), true);
 
         //  $resultArray = json_decode(json_encode($ipdata), true);
              $ipurlinfoArray=[];
              $ipurlinfoArray[]=['Original Url','Track click Id','short Url Id','Client Ip','Created Date','Track Type'];

    foreach ($resultArray as $iptrackinfo) {
        
       // $ipurlinfoArray[] = (array) $iptrackinfo;

    $ipurlinfoArray[] =$iptrackinfo;
     } 
  //print_r($ipurlinfoArray);

//exit;
                 return Excel::create('ipurltrackinfo', function($excel)use ($ipurlinfoArray) {
                $excel->sheet('Report by Title', function($sheet) use ($ipurlinfoArray)
                        {
                $sheet->fromArray($ipurlinfoArray);
                $sheet->row(2, function($row) {
                                // call cell manipulation methods
                $row->setBackground('#FFFF00');

            });
        });
})->download('xlsx');



}

public function titlereport($title_id){

 // echo"welcome";


//echo $title_id;

//  exit;


                  $titledata = DB::connection('mysql2')->table('trackurl_info')
                  ->select('*')->where('titleid',$title_id)->get()->unique('shorturl_id');



                  $title = DB::connection('mysql2')->table('trackurl_info')
                  ->select('*')->where('titleid',$title_id)->first();



                 // print_r($titledata);

             return view('tracklink.titletrackreport', compact('titledata','title'));

}
}
