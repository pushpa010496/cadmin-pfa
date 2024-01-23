@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Newsletters / Show #{{$newsletter->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('e-newsletters.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('e-newsletters.edit', $newsletter->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i> Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $newsletter->title }}</h5>
              </div>
              
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="newsletter icon"></i>File</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($newsletter->file)
                    <a href="<?php echo config('app.url'); ?>e-newsletters/<?php echo $newsletter->file;?>" target="_blank"> View File</a>
                  @endif
                </h5>
              </div>
             <div class="col-md-3"> 
                <h5 class="text-primary"><i class="newsletter icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($newsletter->active_flag == 1)
                    Active
                    @elseif($newsletter->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="newsletter icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($newsletter->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($newsletter->created_at)) }}</h5>
              </div>
       </div>
    </div>
       
     
  
@endsection
