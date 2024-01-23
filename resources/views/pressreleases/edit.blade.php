@extends('../layouts/app')

@section('header')
    <div class="page-header">
        <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Pressreleases / Edit #{{$pressrelease->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">

            <form action="{{ route('pressrelease.update', $pressrelease->id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    {!! Form::label('date', 'Date:') !!}
                    {{ Form::input('text', 'date', old('date',$pressrelease->date), ['class' => 'form-control','required'=>'required','id'=>'datepicker']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', old('title',$pressrelease->title), ['class' => 'form-control','required'=>'required']) }}
                </div>
               
                 <div class="form-group">
                    {!! Form::label('image', 'pressreleases Image:') !!}
                     {!! Form::file('image', array('class' => '')) !!}
                     @if($pressrelease->image)
                       <img width="200" src="<?php echo config('app.url'); ?>pressreleases/<?php echo $pressrelease->image;?>">
                     @endif
                </div>
            
                <div class="form-group">
                    {!! Form::label('img_title', 'pressreleases Img Title:') !!}
                    {{ Form::input('text', 'img_title', old('img_title',$pressrelease->img_title), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('img_alt', 'pressreleases Img Alt:') !!}
                    {{ Form::input('text', 'img_alt', old('img_alt',$pressrelease->img_alt), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('location', 'Location:') !!}
                    {{ Form::input('text', 'location', old('location',$pressrelease->location), ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {!! Form::label('url', 'pressreleases Url:') !!}
                    {{ Form::input('text', 'url', old('url',$pressrelease->url), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description:') !!}
                    {{ Form::textarea('description', old('description',$pressrelease->description), ['class' => 'form-control my-editor','size'=>'30x4']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('home_title', 'Home Title:') !!}
                    {{ Form::input('text', 'home_title', old('home_title',$pressrelease->home_title), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('short_description', 'Home Description:') !!}
                    {{ Form::textarea('short_description', old('short_description',$pressrelease->short_description), ['class' => 'form-control','size'=>'30x4']) }}
                </div>
                
                <div class="form-group">
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        @if($pressrelease->active_flag == 1)
                        <option value="1" selected="selected">Active</option>
                        <option value="0">InActive</option>
                        @elseif($pressrelease->active_flag == 0)
                        <option value="1">Active</option>
                        <option value="0" selected="selected">InActive</option>
                        @endif
                    </select>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('pressrelease.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
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
    $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
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
