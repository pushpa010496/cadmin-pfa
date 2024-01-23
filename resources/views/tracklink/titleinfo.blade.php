@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i>  All Urls Belongs to Title 
 <a class="btn btn-sm btn-success pull-right" href="{{ url('tracklinkgen/create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>  Create</a>
         
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
//print_r($titles_info);

//exit;


?>
    <div class="row">
        <div class="col-md-9">
           

        
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                                <th>Title id</th> 
                                <th>Title</th> 
                                <th>Type</th> 
                                <th>Created_at</th> 
                                
                            
                        </tr>
                    </thead>

                    <tbody>@php ($i=1)

                     
                        @foreach($titles_info->unique('title') as  $newlinks)
                         
                            <tr>
                                <td class="text-center"><strong>{{$i}}</strong></td>
                                <td>{{$newlinks->titleid}} </td> 
                               
                               
                               <td>
                                  <a class="" href="{{ url('titlesinfo',$newlinks->titleid) }}">{{$newlinks->title}}</a>   
                                </td> 
                               <td>
                                     {{$newlinks->type}} 
                                </td> 

                                <td>
                                     {{$newlinks->created_at}} 
                                </td> 

                                 


                                
                            </tr><?php $i++; ?>
                       @endforeach
                    </tbody>
                </table>
               
           
                {!! $titles_info->appends(['sort' => 'titleid'])->render() !!}
            

        </div>
    </div>

@endsection