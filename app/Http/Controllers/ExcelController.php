<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use DB;
use Excel;
use Config;
class ExcelController extends Controller
{
  
  
     /**

     * Create a new controller instance.

     *

     * @return void

     */
     public function __construct()  {
       
        $this->middleware('auth');
    }

    public function importExportView(){
                 $tables = DB::select('SHOW TABLES');

     
               
        return view('import_export',compact('tables'));

    }



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function importFile(Request $request){

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();

            $data = \Excel::load($path)->get();



            if($data->count()){

                foreach ($data as $key => $value) {

                    $arr[] = ['title' => $value->title, 'body' => $value->body];

                }

                if(!empty($arr)){

                    DB::table('products')->insert($arr);

                    dd('Insert Recorded successfully.');

                }

            }

        }

        dd('Request data does not have any files to import.');      

    } 



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    


public function exportFile(Request $request)
{

    $tbl_info=$request->input("tableinfo");


          \Config::set("database.connections.mysql1", [
            "driver" => "mysql",
            "host" => "localhost",
            "database" =>$request->input('db_name'),
            "username" =>$request->input('db_user'),
            "password" =>$request->input('db_password')
]);

        $db_ext = \DB::connection('mysql1');
        $data = $db_ext->table($tbl_info)->get()->toArray();
    //print_r($data); die;
//$modal =  'App'."\\".studly_case(strtolower(str_singular($tbl_info)));
    // $data = DB::table($tbl_info)->get()->toArray();
   // $data = $modal::get()->toArray();

     //$data=DB::select(DB::raw("SELECT * FROM '".$tbl_info."'") );

     
    foreach ($data as $trackinfo) {
        
        $array[] = (array)$trackinfo;

        
    }
    //print_r($urlinfoArray);
 
  // $array = json_decode(); 

  // print_r(implode(',', (array)$urlinfoArray));
//die;
  
   
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
