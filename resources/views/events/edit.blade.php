@extends('../layouts/app')

@section('header')
    <div class="page-header">
        <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Events / Edit #{{$event->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1">

            <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                <div class="form-group">
                    {!! Form::label('start_date', 'Start Date:') !!}
                    {{ Form::input('text', 'start_date', old('start_date',$event->start_date), ['class' => 'form-control','required'=>'required','id'=>'from']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('end_date', 'End Date:') !!}
                    {{ Form::input('text', 'end_date', old('end_date',$event->end_date), ['class' => 'form-control','required'=>'required','id'=>'to']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('title', 'Name:') !!}
                    {{ Form::input('text', 'title', old('title',$event->title), ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('venue', 'Venue:') !!}
                    {{ Form::input('text', 'venue', old('venue',$event->venue), ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('address', 'Address:') !!}
                    {{ Form::input('text', 'address', old('address',$event->address), ['class' => 'form-control','required'=>'required']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('organiser', 'Event Organiser:') !!}
                    {{ Form::select('org_id', $eventorg,  old('org_id',$event->org_id), ['class' => 'form-control','required'=>'required','placeholder'=>'Select Event']) }}
                </div>
               
                <div class="form-group">
                    {!! Form::label('country_id', 'Country:') !!}
                    {{ Form::select('country_id', $countries,  old('country_id',$event->country_id), ['class' => 'form-control','required'=>'required','placeholder'=>'Select Country']) }}
                </div>
               <div class="form-group">
                    {!! Form::label('home_title', 'Home Title:') !!}
                    {{ Form::input('home_title', 'home_title', old('home_title',$event->home_title), ['class' => 'form-control','required'=>'required']) }}
                </div>
               
                <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {{ Form::input('text', 'email', old('email',$event->email), ['class' => 'form-control','required'=>'required']) }}
                </div>
                  <div class="form-group">
                    {!! Form::label('web_link', 'Web Link:') !!}
                    {{ Form::input('text', 'web_link', old('web_link',$event->web_link), ['class' => 'form-control','required'=>'required']) }}
                </div>
             
                             

                <div class="form-group">
                    {!! Form::label('url', 'Event Url:') !!}
                    {{ Form::input('text', 'url', old('url',$event->url), ['class' => 'form-control']) }}
                </div>

            
                          
                <div class="form-group">
                    {!! Form::label('status', 'Status:') !!}

                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        @if($event->active_flag == 1)
                        <option value="1" selected="selected">Active</option>
                        <option value="0">InActive</option>
                        @elseif($event->active_flag == 0)
                        <option value="1">Active</option>
                        <option value="0" selected="selected">InActive</option>
                        @endif
                    </select>
                </div>
           
          

                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('events.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                </div>

            </form>
             </div>

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
          changeYear: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+0w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1
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