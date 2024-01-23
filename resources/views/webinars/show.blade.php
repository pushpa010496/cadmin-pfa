@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Webinar / Show #{{$webinar->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('webinars.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('webinars.edit', $webinar->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
         
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Title</h5>
            <h5>{{$webinar->title }}</h5>
          </div>
          
          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Anchor title tag </h5>
            <h5>{{$webinar->title_tag }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i> Image</h5>
            <img src="{{ config('app.url').'webinars/'. $webinar->image}}" class="img-responsive">
          </div>
         
          
           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Image Alt tag </h5>
            <h5>{{$webinar->alt_tag }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Speaker</h5>
            <h5>{{$webinar->speaker }}</h5>
          </div>

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Speaker Designation</h5>
            <h5>{{$webinar->speaker_designation }}</h5>
          </div>

           

            <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>date for list</h5>
            <h5>{{$webinar->date }}</h5>
          </div>

            <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Webinar date </h5>
            <h5>{{$webinar->webinar_date }}</h5>
          </div>
          

           <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Status </h5>
            <h5>{{$webinar->active_flag == 1 ? 'Active':'In Active' }}</h5>
          </div>

          <div class="col-md-6">
            <h5 class="text-primary"><i class="role icon"></i>Created Date </h5>
              <h5>{{ date('j F Y', strtotime($webinar->created_at)) }}<i class="time icon"></i> {{ date('g:i a', strtotime($webinar->created_at)) }}</h5>
          </div>


          {{-- row end --}}
        </div>
        
       </div>
        
     
  
@endsection
