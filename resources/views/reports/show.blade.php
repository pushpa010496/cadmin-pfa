@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3> Reports / Show #{{$reportcategory->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('reportcategories.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('reportcategories.edit', $reportcategory->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
            <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($reportcategory->date)) }}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="reports icon"></i>Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $reportcategory->title }}</h5>
              </div>
             </div>
          
                         
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="reports icon"></i>reports Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $reportcategory->url }}</h5>
              </div>
               </div>
            
          
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="reports icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!! $reportcategory->description !!}</h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="reports icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($reportcategory->active_flag == 1)
                    Active
                    @elseif($reportcategory->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
            </div>
            <div class="row">  
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="reports icon"></i> Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($reportcategory->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($reportcategory->created_at)) }}</h5>
              </div>
       </div>
    </div>  
       
     
  
@endsection 
