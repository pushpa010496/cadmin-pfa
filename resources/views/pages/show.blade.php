@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>page / Show #{{$page->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('pages.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('pages.edit', $page->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
           
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($page->date)) }}</h5>
              </div>
              
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $page->title }}</h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>page Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($page->image)
                  <img width="200" src="<?php echo config('app.url'); ?>page/<?php echo $page->image;?>">
                  @endif
                </h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Img alt</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $page->img_alt }}</h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Img Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $page->img_title }}</h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Location</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $page->location }}</h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Commencement</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $page->commencement }}</h5>
              </div>
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>page Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $page->page_url }}</h5>
              </div>
              
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Home Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $page->home_title }}</h5>
              </div>

               <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Home Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $page->home_description }}</h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $page->description }}</h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($page->active_flag == 1)
                    Active
                    @elseif($page->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="page icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($page->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($page->created_at)) }}</h5>
              </div>
       </div>
    </div>
       
     
  
@endsection
