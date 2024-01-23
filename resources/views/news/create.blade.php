@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> News / Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                {!! Form::open(array('route' => 'news.store','files'=>true)) !!} 
                <div class="form-group">
                    {!! Form::label('date', 'Date:') !!}
                    {{ Form::input('text', 'date', null, ['class' => 'form-control','required'=>'required','id'=>'datepicker']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('image', 'news Image:') !!}
                     {!! Form::file('image', array('class' => '')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('img_title', 'news Img Title:') !!}
                    {{ Form::input('text', 'img_title', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('news_img_alt', 'news Img Alt:') !!}
                    {{ Form::input('text', 'news_img_alt', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('location', 'Location:') !!}
                    {{ Form::input('text', 'location', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {!! Form::label('url', 'news Url:') !!}
                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {!! Form::label('home_title', 'Home Title:') !!}
                    {{ Form::input('text', 'home_title', null, ['class' => 'form-control']) }}
                </div>
              
                <div class="form-group">
                    {!! Form::label('home_description', 'Home Description:') !!}
                    {{ Form::textarea('home_description', null, ['class' => 'form-control','size'=>'30x4']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description:') !!}
                    {{ Form::textarea('description', null, ['class' => 'form-control my-editor','size'=>'30x4']) }}
                </div>
              
                <div class="form-group">
                    {!! Form::label('active_flag', 'Status:') !!}
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>                 
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('news.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("article")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Files',
    filebrowserUploadUrl: '{{public_path("article")}}/?type=Files&_token='
  };
 $('textarea.my-editor').ckeditor(options);
</script>
@endsection