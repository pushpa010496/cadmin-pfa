@extends('../layouts/app')

@section('header')
    <div class="page-header">
        <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Event Organisers / Edit #{{$eventorg->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1">

            <form action="{{ route('eventorganisers.update', $eventorg->id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

               <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('name', 'Event Org:') !!}
                    {{ Form::input('text', 'name', $eventorg->name, ['class' => 'form-control','required'=>'required']) }}
                   
                </div>
                <div class="form-group">
                    {!! Form::label('url', 'Event Org url:') !!}
                    {{ Form::input('text', 'url', $eventorg->url, ['class' => 'form-control','required'=>'required']) }}
                   
                </div>
                 <div class="form-group">
                    {!! Form::label('longitude', 'Longitude Code:') !!}
                    {{ Form::input('text', 'longitude',  old('longitude',$eventorg->longitude), ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('latitude', 'Latitude Code:') !!}
                    {{ Form::input('text', 'latitude',  old('latitude',$eventorg->latitude), ['class' => 'form-control','required'=>'required']) }}
                </div>
               <div class="form-group">
                    {!! Form::label('org_logo', 'Org logo:') !!}
                     {!! Form::file('org_logo', array('class' => '')) !!}<br/>
                      @if($eventorg->org_logo)
                       <img width="100" src="<?php echo config('app.url'); ?>event/organiser/<?php echo $eventorg->org_logo;?>">
                     @endif
                </div>
                <div class="form-group">
                    {!! Form::label('org_logo_title', 'Img Title:') !!}
                    {{ Form::input('text', 'org_logo_title',  old('org_logo_title',$eventorg->org_logo_title), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('org_logo_alt', 'Img Alt:') !!}
                    {{ Form::input('text', 'org_logo_alt',  old('org_logo_alt',$eventorg->org_logo_alt), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('org_address', 'Organization Address:') !!}
                    {{ Form::textarea('org_address',  old('org_address',$eventorg->org_address), ['class' => 'form-control','size'=>'30x7']) }}
                </div>
                
               
               
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('org_contactno', 'Phone:') !!}
                    {{ Form::input('text', ' org_contactno',  old('org_contactno',$eventorg->org_contactno), ['class' => 'form-control','required'=>'required']) }}
                </div> 
                 <div class="form-group">
                    {!! Form::label('org_email', 'Email:') !!}
                    {{ Form::input('text', 'org_email',  old('org_email',$eventorg->org_email), ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('org_website', 'Web Link:') !!}
                    {{ Form::input('text', 'org_website',  old('org_website',$eventorg->org_website), ['class' => 'form-control','required'=>'required']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('active_menus', 'Active Menus:*') !!}<br/>
                    <?php $active_menus = json_decode($eventorg->active_menus); ?>
                    <input value="2" name="active_menus[brochure]" @if(@$active_menus->brochure==2) checked @endif type="checkbox">  Brochure
                    &nbsp;&nbsp;<input value="2" @if(@$active_menus->interview==2) checked @endif name="active_menus[interview]" type="checkbox">  Interviews
                    &nbsp;&nbsp;<input value="2" @if(@$active_menus->article==2) checked @endif name="active_menus[article]" type="checkbox">  Articles
                    &nbsp;&nbsp;<input value="2" @if(@$active_menus->gallery==2) checked @endif name="active_menus[gallery]" type="checkbox">  Gallery
                    &nbsp;&nbsp;<input value="2" @if(@$active_menus->pressrelease==2) checked @endif name="active_menus[pressrelease]" type="checkbox">  Press Release
                    <!-- <input value="2" name="active_menus[articles]" type="checkbox">  Articles
                    &nbsp;&nbsp;<input value="2" name="active_menus[interviews]" type="checkbox">  Interviews
                     &nbsp;&nbsp;<input value="2" name="active_menus[upcomingeventorganisers]" type="checkbox">  Upcoming eventorganisers -->
                </div>
                <div class="form-group">
                    {!! Form::label('exhibitor_description', 'Event Exhibitors:') !!}
                    {{ Form::textarea('exhibitor_description',  old('exhibitor_description',$eventorg->exhibitor_description), ['class' => 'form-control my-editor','size'=>'30x6']) }}
                </div>
                
                <div class="form-group">
                    {!! Form::label('status', 'Status:') !!}

                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        @if($eventorg->active_flag == 1)
                        <option value="1" selected="selected">Active</option>
                        <option value="0">InActive</option>
                        @elseif($eventorg->active_flag == 0)
                        <option value="1">Active</option>
                        <option value="0" selected="selected">InActive</option>
                        @endif
                    </select>
                </div>
                 
            </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('eventorganisers.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 2
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+0w",
        changeMonth: true,
        numberOfMonths: 2
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>
<script>
     var options = {
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>interview/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("interview")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>interview/?type=Files',
    filebrowserUploadUrl: '{{public_path("interview")}}/?type=Files&_token='
  };
 $('textarea.my-editor').ckeditor(options);
</script>
@endsection