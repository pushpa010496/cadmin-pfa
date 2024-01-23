@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Event Organisers / Show #{{$eventorg->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('eventorganisers.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('eventorganisers.edit', $eventorg->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        
            <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Event Org Name</h5>
              </div>
              <div class="col-md-9">
                <h5>{{$eventorg->name}}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>longitude</h5>
              </div>
              <div class="col-md-9">
                <h5>{{$eventorg->longitude }}</h5>
              </div>
            </div>

             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>latitude</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $eventorg->latitude }}</h5>
              </div>
             </div>

              <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>eventorg Image</h5>
              </div>
              <div class="col-md-9">
                <h5>
                  @if($eventorg->org_logo)
                  <img width="100" src="<?php echo config('app.url'); ?>event/organiser/<?php echo $eventorg->org_logo;?>">
                  @endif
                </h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>Img alt</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $eventorg->org_logo_alt }}</h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>Img Title</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $eventorg->org_logo_title }}</h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>org address</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $eventorg->org_address }}</h5>
              </div>
             </div>
             
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>phone</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $eventorg->org_contactno }}</h5>
              </div>
             </div>
             
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>email</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $eventorg->org_email }}</h5>
              </div>
             </div>
             
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>web link</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $eventorg->org_website }}</h5>
              </div>
             </div>
             
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>active menus</h5>
              </div>
              <div class="col-md-9">
                <h5>
                   <?php $active_menus = json_decode($eventorg->active_menus); ?>
                     @if(@$active_menus->brochure==2) Brochure<br>  @endif  
                     @if(@$active_menus->article==2) Articles <br>@endif 
                     @if(@$active_menus->interview==2) Interviews <br>@endif
                     @if(@$active_menus->gallery==2) Gallery <br> @endif 
                     @if(@$active_menus->pressrelease==2) pressrelease <br>@endif 
                     @if(@$active_menus->partners==2) partners @endif 
                </h5>
              </div>
             </div>
             
             
            
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>Exhibitor description</h5>
              </div>
              <div class="col-md-9">
                <h5>{!!$eventorg->exhibitor_description!!}
                </h5>
              </div>
             </div>
             
             
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>Status</h5>
              </div>
              <div class="col-md-9">
                <h5>@if($eventorg->active_flag == 1)
                    Active
                    @elseif($eventorg->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="eventorg icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($eventorg->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($eventorg->created_at)) }}</h5>
              </div>
            </div>
       </div>
    </div>
       
     
  
@endsection
