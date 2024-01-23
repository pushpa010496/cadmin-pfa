@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i>  URL Short links
            <!--<a class="btn btn-sm btn-success pull-right" href="{{ url('excel') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Export to Excel</a>
            -->
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
//print_r($url_info);

//exit;


?>
    <div class="row">
        <div class="col-md-9">
            @if($url_info->count())

       
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
<th>Title</th> 
                            <th>Short url Id</th> 
                           
                            
                             <th>Total Clicks</th> 

                              <th>Unique Clicks</th>
                              
                            
                        </tr>
                    </thead>

                    <tbody>{{$i=1}}

                     
                        @foreach($url_info as $newlinks)
                            <tr>
                                <td class="text-center"><strong>{{$i}}</strong></td>
 <td><a class="" href="{{ url('title',$newlinks->titleid) }}">{{$newlinks->title}}</a>
                                      
                                </td> 
                                <td>
                                     {{$newlinks->titleid}} 
                                </td> 
                                <!--
                                <td>
                                    {{$newlinks->oriurl}}
                                </td> 
                            -->
                              

                                 <td>
                                    <?php 
                                    $totalcount= DB::table('trackurl_info')
                             ->select('client_ip','shorturl_id')
                             ->where('titleid', '=', $newlinks->titleid)
                             ->get()
                             ->count();
                              ?>
                                    {{ $totalcount}}
                                </td>


                                <?php
                             $ipcount= DB::table('trackurl_info')
                                     ->select('client_ip','shorturl_id')
                                     ->where('titleid', '=', $newlinks->titleid)
                                     ->get()
                                     ->groupBy('client_ip')
                                     ->count();
                           //echo  $ipcount;

                                ?>
                                 <td>
                                    {{$ipcount}}
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