@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>slider / Show #{{$slider->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('sliders.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('sliders.edit', $slider->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">           
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $slider->title }}</h5>
              </div> 
              </div>
               <div class="row">    
                <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>From Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $slider->from_date }}</h5>
              </div> 
            </div>
             <div class="row">  
                <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>To Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $slider->to_date }}</h5>
              </div> 
            </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="role icon"></i>Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $slider->url }}</h5>
              </div>
            </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="role icon"></i>Pages</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $slider->pages }}</h5>
              </div>
            </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="role icon"></i>Type</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $slider->type }}</h5>
              </div>
            </div>
             <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="role icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($slider->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($slider->created_at)) }}</h5>
              </div>
            </div>
       </div>
    </div>
@endsection