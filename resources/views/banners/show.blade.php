@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Banners / Show #{{$banner->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('banners.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('banners.edit', $banner->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">           
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $banner->title }}</h5>
              </div> 
            </div>
            <div class="row">       
               <div class="col-md-3"> 
                <h5 class="text-primary"><i class="project icon"></i>From Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $banner->from_date }}</h5>
              </div>
            </div>
            <div class="row">   
               <div class="col-md-3"> 
                <h5 class="text-primary"><i class="project icon"></i>To Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $banner->to_date }}</h5>
              </div> 
              </div>
              <div class="row">               
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="project icon"></i>Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $banner->url }}</h5>
              </div>
            </div>
            <div class="row">   
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="project icon"></i>Pages</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $banner->pages }}</h5>
              </div>
            </div>
            <div class="row">   
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="project icon"></i>Position</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $banner->position }}</h5>
              </div>
            </div>
            <div class="row">   
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="project icon"></i>type</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $banner->type }}</h5>
              </div>
            </div>
            <div class="row">   
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="project icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($banner->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($banner->created_at)) }}</h5>
              </div>
       </div>
    </div>
@endsection