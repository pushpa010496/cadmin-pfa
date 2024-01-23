@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i>  All Urls Belongs to Title 

              <?php
                             $ipcount=  DB::connection('mysql2')->table('tracklinks')
                                     ->select('title')
                                     ->where('titleid', '=', $title->titleid)
                                     ->first();
                                     ?>
                                     <span style="color:#FF0000"><?php
                                     echo  $ipcount->title;
                                    
                           //echo  $ipcount;

                                ?></span>


           
            <a class="btn btn-sm btn-success pull-right" href="{{ url('excelbytitle',$title->titleid) }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Export to Excel</a>
         
        </h3>
    </div>
     <div class="col-md-4 pull-right">
          {!! Form::open(['method'=>'GET','url'=>'tracklinkgen','role'=>'search'])  !!}
              <div id="custom-search-input">
                <div class="input-group col-md-12 pull-right">
                    <input type="text" class="search-query form-control" placeholder="Search" name="search" />
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button">
                            <i class="fa fa-search" aria-hidden="true"></i>

                        </button>
                    </span>
                </div>
              </div>
         {!! Form::close() !!}
        </div>
@endsection

@section('content')

<?php
//print_r($titledata);

//exit;


?>
    <div class="row">
        <div class="col-md-9">
            @if($titledata->count())

       
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                                
                                <th>Short url id</th>
                                <th>Original url</th>  
                                <th>Short url</th> 
                                
                                <th>Total Clicks</th> 
                                <th>Unique Clicks</th>
                              <!--  <th>Download Report</th> -->
                            
                        </tr>
                    </thead>

                    <tbody>{{$i=1}}

                     
                        @foreach($titledata as $newlinks)
                            <tr>
                                <td class="text-center"><strong>{{$i}}</strong></td>
                               
                               
                               
                               <td>
                                     {{$newlinks->shorturl_id}} 
                                </td> 
                              
<td>
   <?php 
                             $oriurl=  DB::connection('mysql2')->table('tracklinks')
                             ->select('*')
                             ->where('shorturl_id', '=', $newlinks->shorturl_id)
                             ->get()
                             
                              ?>
@foreach($oriurl as $oriinfo)
                              {{$oriinfo->oriurl}} </td> 
@endforeach
                              <td>
   <?php 
                             $oriurl= DB::connection('mysql2')->table('tracklinks')
                             ->select('*')
                             ->where('shorturl_id', '=', $newlinks->shorturl_id)
                             ->first()
                             
                              ?>
{{'http://track.pharmafocusasia.com'.$newlinks->shorturl_id}}
                            </td> 
                                 <td>
                                    <?php 
                                    $totalcount=  DB::connection('mysql2')->table('trackurl_info')
                             ->select('client_ip','shorturl_id')
                             ->where('shorturl_id', '=', $newlinks->shorturl_id)
                             ->get()
                             ->count();
                              ?>
                                    <a  href="{{ url('excel',$newlinks->shorturl_id) }}">  {{ $totalcount}}</a>
                                </td>


                                <?php
                             $ipcount=  DB::connection('mysql2')->table('trackurl_info')
                                     ->select('client_ip','shorturl_id')
                                     ->where('shorturl_id', '=', $newlinks->shorturl_id)
                                     ->get()
                                     ->groupBy('client_ip')
                                     ->count();
                           //echo  $ipcount;

                                ?>
                                 <td>
                                 <a  href="{{ url('excelclientip',$newlinks->shorturl_id) }}">{{$ipcount}}</a>   
                                </td>
                                  <td>

                                    <!-- <a class="btn btn-sm btn-warning pull-right" href="{{ url('excelbytitle',$newlinks->titleid) }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Report By Title</a>

                                   <a class="btn btn-sm btn-success pull-right" href="{{ url('excel',$newlinks->shorturl_id) }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Report By Ip</a>-->
                                </td>
                                  

                            </tr><?php $i++; ?>
                       @endforeach
                    </tbody>
                </table>
               
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection