@extends('../layouts/app')
@section('header')
<div class="container">
<div class="page-header">
  <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Webinars / Create </h3>
</div>
</div>
@endsection
@section('content')

<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div class="row well well-sm">
     {!! Form::open(array('route' => 'webinars.store','files'=>true)) !!}

    <div class="">
      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('title', 'Title:') !!}
        {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('title', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('speaker', 'has-error')}}">
        {!! Form::label('speaker', 'Speaker:') !!}
        {{ Form::input('text', 'speaker', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('speaker', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('speaker_designation', 'has-error')}}">
        {!! Form::label('speaker_designation', 'Speaker Designation:') !!}
        {{ Form::input('text', 'speaker_designation', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('speaker_designation', ':message') }}</span>     
      </div>
    </div>


    <div class="">
      <div class="form-group {{ $errors->first('speaker', 'has-error')}}">
        {!! Form::label('speaker2', 'Speaker 2:') !!}
        {{ Form::input('text', 'speaker2', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('speaker2', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('speaker_designation', 'has-error')}}">
        {!! Form::label('speaker2_designation', 'Speaker 2 Designation:') !!}
        {{ Form::input('text', 'speaker2_designation', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('speaker2_designation', ':message') }}</span>     
      </div>
    </div>

      <div class="">
      <div class="form-group {{ $errors->first('speaker', 'has-error')}}">
        {!! Form::label('speaker3', 'Speaker 3:') !!}
        {{ Form::input('text', 'speaker3', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('speaker3', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('speaker_designation', 'has-error')}}">
        {!! Form::label('speaker3_designation', 'Speaker 3 Designation:') !!}
        {{ Form::input('text', 'speaker3_designation', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('speaker3_designation', ':message') }}</span>     
      </div>
    </div>




    <div class="">
      <div class="form-group {{ $errors->first('title_tag', 'has-error')}}">
        {!! Form::label('title_tag', 'Anchor Title Tag:') !!}
        {{ Form::input('text', 'title_tag', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('title_tag', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('alt_tag', 'has-error')}}">
        {!! Form::label('alt_tag', 'Image Alt Tag:') !!}
        {{ Form::input('text', 'alt_tag', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('alt_tag', ':message') }}</span>     
      </div>    
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('image', 'has-error')}}">
        {!! Form::label('image', ' Image :') !!}
        {!! Form::file('image', array('class' => '')) !!}
        <span class="help-block">{{ $errors->first('image', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('date', 'has-error')}}">
        {!! Form::label('date', 'Date for list:') !!}
        {{ Form::input('text', 'date', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('date', ':message') }}</span>     
      </div>    
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('webinar_date', 'has-error')}}">
        {!! Form::label('webinar_date', 'Webinar Date :') !!}
        {{ Form::input('date', 'webinar_date', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('webinar_date', ':message') }}</span>     
      </div>    
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('url', 'has-error')}}">
        {!! Form::label('url', 'Webinar URL:') !!}
        {{ Form::input('text', 'url', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('url', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('view_name', 'has-error')}}">
        {!! Form::label('view_name', 'Webinar file name:') !!}
        {{ Form::input('text', 'view_name', null, ['class' => 'form-control','required'=>'required']) }}
        <span class="help-block">{{ $errors->first('view_name', ':message') }}</span>     
      </div>
    </div>
 <div class="">
      <div class="form-group  {{ $errors->first('is_series', 'has-error')}}">
        {!! Form::label('is_series', 'Series:') !!}
        {{ Form::select('is_series', ['1'=>'Yes','0'=>'No'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
        <span class="help-block">{{ $errors->first('is_series', ':message') }}</span>     
      </div>
    </div>
  
  <div class="">
      <div class="form-group {{ $errors->first('series_title', 'has-error')}}">
        {!! Form::label('series_title', 'Series Title:') !!}
        {{ Form::input('text', 'series_title', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('series_title', ':message') }}</span>     
      </div>
    </div>


<div class="">
      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('china_title', 'China Title:') !!}
        {{ Form::input('text', 'china_title', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('china_title', ':message') }}</span>     
      </div>
    </div>
<div class="">
      <div class="form-group {{ $errors->first('url', 'has-error')}}">
        {!! Form::label('china_url', 'China URL:') !!}
        {{ Form::input('text', 'china_url', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('china_url', ':message') }}</span>     
      </div>
    </div>


    <div class="">
      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('korea_title', 'Korean Title:') !!}
        {{ Form::input('text', 'korea_title', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('korea_title', ':message') }}</span>     
      </div>
    </div>

<div class="">
      <div class="form-group {{ $errors->first('url', 'has-error')}}">
        {!! Form::label('korea_url', 'Korean URL:') !!}
        {{ Form::input('text', 'korea_url', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('korea_url', ':message') }}</span>     
      </div>
    </div>

    <div class="">
      <div class="form-group {{ $errors->first('title', 'has-error')}}">
        {!! Form::label('japanese_title', 'Japanese Title:') !!}
        {{ Form::input('text', 'japanese_title', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('japanese_title', ':message') }}</span>     
      </div>
    </div>

<div class="">
      <div class="form-group {{ $errors->first('url', 'has-error')}}">
        {!! Form::label('japanese_url', 'Japanese URL:') !!}
        {{ Form::input('text', 'japanese_url', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('japanese_url', ':message') }}</span>     
      </div>
    </div>
    <div class="">
      <div class="form-group  {{ $errors->first('active_flag', 'has-error')}}">
        {!! Form::label('active_flag', 'Status:') !!}
        {{ Form::select('active_flag', ['1'=>'Active','0'=>'In Active'], null, ['class' => 'form-control','placeholder'=>'-- select -- ']) }}
        <span class="help-block">{{ $errors->first('active_flag', ':message') }}</span>     
      </div>
    </div>
  

  <div class="col-md-12">
    <div class="form-group mt-20">

      <button type="submit" class="btn btn-sm btn-primary pull-right">Create</button>
      <a class="btn btn-sm btn-default pull-left" href="{{ route('advisorboard.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    </div>
  </div>
</form>
</div>
</div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description');
</script>
@endsection