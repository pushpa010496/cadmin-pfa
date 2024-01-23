@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Seo Page / Show #{{$seopage->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('seopage.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('seopage.edit', $seopage->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
           
            <div class="col-md-3"> 
                <h5 class="text-primary"><i class="seopage icon"></i>Page</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $seopage->seopages->title }}</h5>
              </div>
            </div>
           <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>meta_title</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->meta_title  !!}</h5>
             </div> 
          </div>
          <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>meta_keywords</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->meta_keywords  !!}</h5>
             </div> 
          </div>
          <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>meta_description</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->meta_description  !!}</h5>
             </div> 
          </div>
          <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>og_title</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->og_title  !!}</h5>
             </div> 
          </div>
          <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>og_description</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->og_description  !!}</h5>
             </div> 
          </div>
          <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>og_keywords</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->og_keywords  !!}</h5>
             </div> 
          </div>
          <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>og_image</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->og_image  !!}</h5>
             </div> 
          </div>
           <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>og_video</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->og_video  !!}</h5>
             </div> 
          </div> <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>meta_region</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->meta_region  !!}</h5>
             </div> 
          </div> <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>meta_position</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->meta_position  !!}</h5>
             </div> 
          </div> <div class="row">
             <div class="col-md-3">
              <h4 class="text-primary"><i class="company icon"></i>meta_icbm</h4>
            </div>
            <div class="col-md-9">
                  <h5>{!! $seopage->meta_icbm  !!}</h5>
             </div> 
          </div>  
             <div class="row">
              <div class="col-md-3"> 
                <h4 class="text-primary"><i class="eventprofile icon"></i>Status</h4>
              </div>
              <div class="col-md-9">
                <h5>@if($seopage->active_flag == 1)
                    Active
                    @elseif($seopage->active_flag == 0)
                    Inactive
                    @endif
                </h5>
              </div>
             </div>
             <div class="row">
              <div class="col-md-3"> 
                <h4 class="text-primary"><i class="eventprofile icon"></i>Created Date</h4>
              </div>
              <div class="col-md-9">
                <h5>{!! date('j F Y', strtotime($seopage->created_at))  !!}<i class="time icon"></i> {!! date('g:i a', strtotime($seopage->created_at))  !!}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3"> 
                <h4 class="text-primary"><i class="eventprofile icon"></i>Created By</h4>
              </div>
              <div class="col-md-9">
                <h5>{!! @$seopage->author->name !!}</h5>                
              </div>
            </div>

       </div>
    </div>
       
     
  
@endsection
