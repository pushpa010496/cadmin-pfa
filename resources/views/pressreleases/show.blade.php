@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Pressreleases / Show #{{$pressrelease->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('pressrelease.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('pressrelease.edit', $pressrelease->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
            <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($pressrelease->date)) }}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $pressrelease->title }}</h5>
              </div>
             </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>pressreleases Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($pressrelease->image)
                  <img width="200" src="<?php echo config('app.url'); ?>pressreleases/<?php echo $pressrelease->image;?>">
                  @endif
                </h5>
              </div>
             </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>Img alt</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $pressrelease->img_alt }}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>Img Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $pressrelease->img_title }}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>Location</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $pressrelease->location }}</h5>
              </div>
            </div>
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>pressreleases Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $pressrelease->url }}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>Home Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $pressrelease->home_title }}</h5>
              </div>
            </div>
            <div class="row">  
               <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>Home Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $pressrelease->short_description !!}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $pressrelease->description !!}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($pressrelease->active_flag == 1)
                    Active
                    @elseif($pressrelease->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="pressreleases icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($pressrelease->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($pressrelease->created_at)) }}</h5>
              </div>
       </div>
    </div>
       
     
  
@endsection
