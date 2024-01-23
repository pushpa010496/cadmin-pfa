<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use App\CompanyProfile;
use PhpOffice\PhpWord\Shared\Converter;
use DB;
use Config;
class GoogletrackreportsController extends CountryAjaxFilterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $filter = 'ga:pagePath=~/linkedin-offer';
        $analyticsData = Analytics::performQuery(
         Period::years(1),
            'ga:sessions',
            [
                'metrics' => 'ga:sessions,ga:pageviews,ga:bounces,ga:newUsers',
                'dimensions' => 'ga:yearMonth,ga:pageTitle,ga:pagePath',
                'filters' =>$filter
            ]
   
);



    }

    public function trackreport(){
       $db_ext = \DB::connection('mysql2');
        $tracklinks = $db_ext->table('tracklinks')->where('type','=','ban')->orderBy('id', 'desc')->get();
         $regions= $this->getRegions();
      return view('googlereports.track',compact('tracklinks','regions'));
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
   
         $trackid=$request->input('displayid');

             // $siteurl=$request->input('');
            //return $companyid;
           
               $db_ext = \DB::connection('mysql2');
       
      $banner_name = $db_ext->table('tracklinks')->where('shorturl_id',$trackid)->orderBy('id', 'desc')->first();
            //$banner_name = Tracklink::where('shorturl_id',$trackid)->where('active_flag',1)->first();
           
         
            $metrics=$request->input('metric');
            $startdate=Carbon::parse($request->input('startdate'));
            $enddate=Carbon::parse($request->input('enddate'));
            $date1=date_create($startdate);
            $date2=date_create($enddate);
            $diff=date_diff($date1,$date2);
            $diff->format("%R%a days");
            $period=$diff->format("%a days");
            $color="";
            $metriclist=implode(",", $metrics);
            $dimensions=$request->input('dim');

            
            $dimlist=implode(",", $dimensions);
           
            $chart_labelsinfo="";
            $filter = 'ga:pagePath=~/'.$trackid;
           // $filter_track = 'ga:pagePath=~/'.$trackid;
            $c=count($dimensions);
            



            $New_return_users_data = Analytics::performQuery(
                     Period::create($startdate,$enddate),
                  'ga:sessions',
                  [
                      'metrics' =>'ga:pageViews,ga:bounceRate,ga:timeOnPage,ga:users',
                      'dimensions' =>'ga:userType',
                      'filters' =>$filter
                  ]
                  ); 
            $phpWord = new \PhpOffice\PhpWord\PhpWord(); 
            $PidPageSettings = array(
              'headerHeight'=> \PhpOffice\PhpWord\Shared\Converter::inchToTwip(.0),
              'footerHeight'=> \PhpOffice\PhpWord\Shared\Converter::inchToTwip(.0),
              'marginLeft'  => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(.0),
              'marginRight' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(.0),
              'marginTop'   => 0,
               'marginBottom'=> 0,
             'bgColor'=>'##272725'
           );
            $section = $phpWord->createSection($PidPageSettings);
            $headertableStyles = array('borderColor' => '#272725', 'borderSize' => 1,'cellMargin' => 8);
            $headerTableCellStyle = array('valign' => 'center');
            $headerfirstRowStyle = array('bgColor' => '#272725');
            $headerspacecell=array('space' => array('after' => 50,'before'=>50));
            $phpWord->addFontStyle('fStyle', array('bold'=>true, 'name'=>'Arial', 'size'=>10,'color'=>'white'));
            $phpWord->addTableStyle('mTable', $headertableStyles, $headerfirstRowStyle);
            $header1 = $section->addHeader();
            $htable = $header1->addTable('mTable');
            $htable->addRow();
            $htable->addCell(7500,$headerfirstRowStyle)->addText(htmlspecialchars($banner_name->title)." Performance Report",'fStyle',$headerspacecell);
            $htable->addCell(7500,$headerfirstRowStyle)->addText("Duration ".date('jS M Y',strtotime($startdate)).' - '.date('jS M Y',strtotime($enddate)),$headerspacecell,array('space' => array('after' => 50,'before'=>50),'align'=>'right'));

        /*end header section */
        /*start image and date*/
            $space = array('spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
                  'spacing' => 0,
                'lineHeight' => 1); 
            $table    = $section->addTable(array(
                        'unit' => \PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT,
                        'width' => 100 * 50,
                      ));
            $fancyTableCellStyle = array('valign' => 'center');
            $table->addRow();
             $image='public/images/pharma.png';
             $table->addCell()->addImage($image);
         
        /*end start image and date*/
     /*start profile name*/
            $tableStyle = array('borderColor' => '#1c83c1','borderSize' => 1,'cellMargin' => 10);
            $firstRowStyle = array('bgColor' => '#1c83c1','color'=>'white');
            $phpWord->addFontStyle('fStyle', array('bold'=>false, 'name'=>'Arial', 'size'=>12,'color'=>'white','align' =>'center'));
            $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
            $table = $section->addTable('myTable');
             $table->addRow();
             $table->addCell(14000,$fancyTableCellStyle)->addText("1.".htmlspecialchars($banner_name->title)." Performance Report:",'fStyle',array('space' => array('before' => 100,'after'=>100)));
        /*end  profile name*/ 

         /*traffic, new visitors, timespent,bouncerate ---- count*/ 
        $secondTableStyleName = 'tables';
        
        $secondTableStyle = array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 120);
        $secondTableFirstRowStyle = array('borderBottomSize' => 28, 'borderBottomColor' => '0000FF', 'bgColor' => '#ececec');
        $secondTableCellStyle = array('valign' => 'center');
        $spacecells=array('space' => array('before'=>200),'align'=>'center');
        $secondTableFontStyle = array('bold' => false,'name'=>'Arial');
         $secondcellTableFontStyle = array('bold' => true,'name'=>'Arial','size'=>12);
        $phpWord->addTableStyle($secondTableStyleName, $secondTableStyle, $secondTableFirstRowStyle,$space);
        $table = $section->addTable($secondTableStyleName);
        $table->addRow();

      
         $c3=$table->addCell(2600, $secondTableCellStyle,array('align' => 'center'));
        $c3->addText('Impressions:', $secondTableFontStyle, $spacecells,$secondTableCellStyle);
        $c3->addText(0, $secondcellTableFontStyle,array('align' => 'center'),$secondTableCellStyle);

         $c3=$table->addCell(2600, $secondTableCellStyle,array('align' => 'center'));
        $c3->addText('Clicks:', $secondTableFontStyle, $spacecells,$secondTableCellStyle);
        $c3->addText($New_return_users_data->totalsForAllResults['ga:users'], $secondcellTableFontStyle,array('align' => 'center'),$secondTableCellStyle);
        //$c3->addText(gmdate("H:i:s", $New_return_users_data->totalsForAllResults['ga:timeOnPage']),$secondcellTableFontStyle,array('align' => 'center'),$secondTableCellStyle);

      

  /*traffic, new visitors, timespent,bouncerate ---- tables*/
      $trafic_geotable = $section->addTable();
            $geo_table = $section->addTable();
            $keyword_referals = $section->addTable();
            $social = $section->addTable();
           
            $row1=$trafic_geotable->addRow();
            $row2=$geo_table->addRow();
           // $row3=$keyword_referals->addRow();
            //$row4=$social->addRow();
            

            $rowTableStyleName = 'row table styles';
            $rowTableStyle = array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
            $rowTableFirstRowStyle = array('bgColor' => '#1c83c1');
            $rowTableCellStyle = array('valign' => 'center','bgColor'=>'#ececec');
            $spacecell=array('space' => array('after' => 100,'before'=>100),'align'=>'center');
            $rowTableFontStyle = array('bold' => true,'align' =>'center','name'=>'Arial','size'=>10,'color'=>'white');
            $rowTablecellFontStyle = array('bold' => false,'align' =>'center','name'=>'Arial','size'=>10);
            $phpWord->addTableStyle($rowTableStyleName, $rowTableFirstRowStyle,$rowTableCellStyle);
            
          $count=$c-1;
          for($i=0;$i<=$count;$i++){
                $dimensions[$i];

  

/*Geo Based Traffic Report:*/

    if($dimensions[$i]=="ga:country"){

      //$dimensions[$i];
                $analyticsData = Analytics::performQuery(
                          Period::create($startdate,$enddate),
                'ga:sessions',
                [
                    'metrics' => $metriclist ,
                    'dimensions' =>'ga:countryIsoCode',
                    'filters' =>$filter
                ]
       
      );
               $chart_data ="";
               $chart_values="";
               $chart_labels="";
               $sum=0;
               $rstr="";
               $a="";

                $countries_list=$request->country_id;

                foreach($countries_list as $reportdata){
               $chart_labels.=$reportdata.'|';

              $chart_values.=$reportdata[1].',';

               if($chart_values>='25'){
                 $color.="B3BCC0".'|';
                }

                else{

                   $color.="5781AE".'|';

                }
            

                  }

                $chart_labelsinfo=substr($chart_labels,0,-1);
               // dd($chart_labelsinfo);

                $chart_labelsvalues=substr( $chart_values,0,-1);

                $data=str_replace(' ', '_', $chart_labelsinfo);

                 $col=substr($color,0,-1);

               // $c18=$row1->addCell(1000);
                $c7=$row1->addCell(15000, $spacecell);
                $c7->addText('2.Geo Based Traffic Report:',array('name'=>'Arial','size'=>12,'bold' => true));
                $c7->addImage('http://chart.apis.google.com/chart?cht=map:fixed=-60,0,80,-35&chs=600x350&chld='.$chart_labelsinfo.'&chco=b1d7f8|5b9dd3&chm=f2010+Winter,000000,0,0,10f2008+Summer,000000,0,1,10f2008+Winter,000000,0,2,10,1,:-5:10f2004+Summer,000000,0,3,10f2004+Summer,000000,0,4,10',array('width'=> 600,'height'=> 250));



            }

          /* Device Report :*/    

        if($dimensions[$i]=="ga:deviceCategory"){
                
               //  $dimensions[$i];
          $a=0;
            $b=0;
            $e=0;

                          $analyticsData = Analytics::performQuery(
                           Period::create($startdate,$enddate),
                        'ga:sessions',
                        [
                            'metrics' =>$metriclist,
                            'dimensions' =>$dimensions[$i],
                            'filters' =>$filter
                        ]
                        ); 

                         // dd($analyticsData);
                         // print_r($analyticsData);die;
                        $chart_data ="";
                   foreach($analyticsData as $reportdata){
                     $avalue=$reportdata[0];
                     $chart_data.="['".$reportdata[0]."',".$reportdata[1]."],";
                          if($avalue=="desktop"){
                            $a=$reportdata[1] ? $reportdata[1]:'0';
                           
                             }
                       if($avalue=="mobile"){
                           $b=$reportdata[1] ? $reportdata[1]:'0';
                           
                             }
                             if($avalue=="tablet"){
                            $e=$reportdata[1] ? $reportdata[1]:'0';
                           
                             }
            
                            }

                          // dd($b);
                          
                $c8=$row2->addCell(500);
                $c9=$row2->addCell(6000);
                $c9->addText('3. Device Report :',array('name'=>'Arial','size'=>12,'bold' => true,));
                $c9->addImage('http://chart.apis.google.com/chart?cht=p&chco=31a2e6,abe0ff&chds=a&chd=t:'.$a.','.$b.','.$e.'&chs=250x100&chdl=Desktop|Mobile|Tablet&chl='.$a.'|'.$b.'|'.$e.'&chdls=000000,12');

             }
        /*Geo Based Traffic Report:*/     
        if($dimensions[$i]=="ga:country"){
              $maxResults=5;
              

                $c22=$row2->addCell(500);
                $c10=$row2->addCell(6000);
                $geo_table =$c10->addTable($rowTableStyleName);
                $geo_table->addRow();
                $geo_table->addCell(2000, $rowTableFirstRowStyle)->addText('Country', $rowTableFontStyle,$spacecell);
                $geo_table->addCell(2000, $rowTableFirstRowStyle)->addText('Impressions', $rowTableFontStyle,$spacecell);
                $geo_table->addCell(2000, $rowTableFirstRowStyle)->addText('Clicks', $rowTableFontStyle,$spacecell);
               // $analyticsData=5;
              
              

             // $avalue=$reportdata[0]; 
          
                $geo_table->addRow();
                //$country_name=preg_replace("/[^a-zA-Z]/", "", $reportdata[0]);
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));                        
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));


                $geo_table->addRow();
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));                       
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));

                 $geo_table->addRow();
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));                       
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));

                 $geo_table->addRow();
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));                       
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));

                 $geo_table->addRow();
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));                       
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));
                $geo_table->addCell(1000, $rowTableCellStyle)->addText('null',$rowTablecellFontStyle,$spacecell,array('align'=>'center'));

            
            }
        

        

    

     }
     \Log::channel($phpWord);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(public_path('analytics_word/'.$banner_name->title.'.docx'));
        return response()->download(public_path('analytics_word/'.$banner_name->title.'.docx'))->deleteFileAfterSend(true);

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

    /**
    * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSubRegions(Request $request)
    {
       $id = $request->region_id;
       $subregions = $this->getRegionsWiseSubRegions($id);
       return $subregions;
    }


    /**
    * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getRegionCountry(Request $request)
    {
       $id = $request->sub_region;
       $countries = $this->getRegionsWiseCountries($id);
       return $countries;

    }


    
}
