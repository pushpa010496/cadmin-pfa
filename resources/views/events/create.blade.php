@extends('../layouts/app')
@section('header')
<div class="page-header">
  <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Events / Create </h3>
</div>
@endsection

@section('content')
@include('error')

<div class="row">
  <div class="col-md-offset-1 col-md-10 col-md-offset-1">
   {!! Form::open(array('route' => 'events.store','files'=>true)) !!}
   <div class="col-md-6">


    <div class="form-group">
      {!! Form::label('start_date', 'Start Date:') !!}
      {{ Form::input('text', 'start_date', null, ['class' => 'form-control','required'=>'required','id'=>'from']) }}
    </div>
    <div class="form-group">
      {!! Form::label('end_date', 'End Date:') !!}
      {{ Form::input('text', 'end_date', null, ['class' => 'form-control','required'=>'required','id'=>'to']) }}
    </div>
    <div class="form-group">
      {!! Form::label('title', 'Event Name:') !!}
      {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
    </div>
    <div class="form-group">
      {!! Form::label('venue', 'Venue:') !!}
      {{ Form::input('text', 'venue', null, ['class' => 'form-control','required'=>'required']) }}
    </div>
    <div class="form-group">
      {!! Form::label('address', 'Address:') !!}
      {{ Form::input('text', 'address', null, ['class' => 'form-control','required'=>'required']) }}
    </div>
    <div class="form-group">
      {!! Form::label('org_id', 'Organiser:') !!}
       {{ Form::select('org_id', $eventorg, null, ['class' => 'form-control','required'=>'required','placeholder'=>'Select Organiser']) }}
     
    </div>
    



  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('home_title', 'Home Title:') !!}
      {{ Form::input('text', 'home_title', null, ['class' => 'form-control','required'=>'required']) }}
    </div>
   <div class="form-group">
    {!! Form::label('country_id', 'Country:') !!}
    {{ Form::select('country_id', $countries, null, ['class' => 'form-control','required'=>'required','placeholder'=>'Select Country']) }}
  </div>

  <div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {{ Form::input('text', 'email', null, ['class' => 'form-control','required'=>'required']) }}
  </div>
  <div class="form-group">
    {!! Form::label('web_link', 'Web Link:') !!}
    {{ Form::input('text', 'web_link', null, ['class' => 'form-control','required'=>'required']) }}
  </div>


  <div class="form-group">
    {!! Form::label('url', 'Event Url:') !!}
    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}
  </div>

  <div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <select name="active_flag" class="form-control" required="required">
      <option value="">-- Select one --</option>
      <option value="1">Active</option>
      <option value="0">InActive</option>
    </select>
  </div>

</div>


<div class="well well-sm">
  <button type="submit" class="btn btn-sm btn-primary">Create</button>
  <a class="btn btn-sm btn-default pull-right" href="{{ route('events.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
  filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Images',
  filebrowserImageUploadUrl: '{{public_path("article")}}/?type=Images&_token=',
  filebrowserBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Files',
  filebrowserUploadUrl: '{{public_path("article")}}/?type=Files&_token='
};
$('textarea.my-editor').ckeditor(options);
</script>
@endsection