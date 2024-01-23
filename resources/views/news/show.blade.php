@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>News / Show #{{$news->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('news.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('news.edit', $news->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
            <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($news->date)) }}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $news->title }}</h5>
              </div>
             </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>news Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($news->news_image)
                  <img width="200" src="<?php echo config('app.url'); ?>/news/<?php echo $news->news_image;?>">
                  @endif
                </h5>
              </div>
             </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Img alt</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $news->news_img_alt }}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Img Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $news->img_title }}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Location</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $news->location }}</h5>
              </div>
            </div>
           
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>news Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $news->url }}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Home Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $news->home_title }}</h5>
              </div>
            </div>
            <div class="row">  
               <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Home Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $news->home_description !!}</h5>
              </div>
               </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $news->description !!}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($news->active_flag == 1)
                    Active
                    @elseif($news->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="news icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($news->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($news->created_at)) }}</h5>
              </div>
       </div>
    </div>
       
     
  
@endsection
