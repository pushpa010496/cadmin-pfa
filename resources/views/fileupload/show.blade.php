@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Event Gallery / Show #{{$eventgallery->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('eventgallery.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('eventgallery.edit', $eventgallery->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
            <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Event Name</h5>
              </div>
              <div class="col-md-9">
                <h5>{{$eventgallery->event->name}}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{$eventgallery->title }}</h5>
              </div>
            </div>

           
              <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventgallery icon"></i>Small Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($eventgallery->small_img)
                  <img width="200" src="<?php echo config('app.url'); ?>event/gallery/<?php echo $eventgallery->small_img;?>">
                  @endif
                </h5>
              </div>
             </div>
              <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventgallery icon"></i>Big Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($eventgallery->big_img)
                  <img width="200" src="<?php echo config('app.url'); ?>event/gallery/<?php echo $eventgallery->big_img;?>">
                  @endif
                </h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventgallery icon"></i>Img alt</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $eventgallery->img_alt }}</h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventgallery icon"></i>Img Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $eventgallery->img_title }}</h5>
              </div>
             </div>
             
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventgallery icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($eventgallery->active_flag == 1)
                    Active
                    @elseif($eventgallery->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventgallery icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($eventgallery->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($eventgallery->created_at)) }}</h5>
              </div>
            </div>
       </div>
    </div>
       
     
  
@endsection
