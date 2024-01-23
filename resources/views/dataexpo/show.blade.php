@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>cmspage / Show #{{$cmspage->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('cmspages.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('cmspages.edit', $cmspage->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
           
              
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="cmspage icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $cmspage->title }}</h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="cmspage icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $cmspage->description }}</h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="cmspage icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($cmspage->active_flag == 1)
                    Active
                    @elseif($cmspage->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="cmspage icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($cmspage->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($cmspage->created_at)) }}</h5>
              </div>
       </div>
    </div>
       
     
  
@endsection
