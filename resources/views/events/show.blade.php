@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>event / Show #{{$event->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('events.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('events.edit', $event->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
            <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Start Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($event->start_date)) }}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>End Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($event->end_date)) }}</h5>
              </div>
            </div>

             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>Event Name</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $event->title }}</h5>
              </div>
             </div>
          <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>Home Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $event->home_title }}</h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>venue</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $event->venue }}</h5>
              </div>
             </div>

             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>address</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $event->address }}</h5>
              </div>
             </div>
             
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>organiser</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ @$event->eventorg->name }}</h5>
              </div>
             </div>
             
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>country</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ @$event->country->title}}</h5>
              </div>
             </div>
             

             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>email</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $event->email }}</h5>
              </div>
             </div>
             
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>web_link</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $event->web_link }}</h5>
              </div>
             </div>
         
          
            <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>event Url</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $event->url }}</h5>
              </div>
            </div>
     
             
       
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($event->active_flag == 1)
                    Active
                    @elseif($event->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="event icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($event->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($event->created_at)) }}</h5>
              </div>
            </div>
       </div>
    </div>
       
     
  
@endsection
