@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Sliders / Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                 {!! Form::open(array('route' => 'sliders.store','files'=>true)) !!}
                
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                {!! Form::label('category', 'Category:') !!}
                   <select name="category" id="type" class="valid form-control" >
                        <option value="">select category</option>

                        <option value="Article" {{ $slider->category === 'Article' ? 'selected' : '' }}>Article</option>
                        <option value="Interview" {{ $slider->category === 'Interview' ? 'selected' : '' }}>Interview</option>
                        <option value="Techno Trend" {{ $slider->category === 'Techno Trend' ? 'selected' : '' }}>Techno Trend</option>
                        <option value="Project" {{ $slider->category === 'Project' ? 'selected' : '' }}>Project</option>
                        <option value="Industry Report" {{ $slider->category === 'Industry Report' ? 'selected' : '' }}>Industry Report</option>
                        <option value="Research Insight" {{ $slider->category === 'Research Insight' ? 'selected' : '' }}>Research Insight</option>
                        <option value="Book Shelf" {{ $slider->category === 'Book Shelf' ? 'selected' : '' }}>Book Shelf</option>
                        <option value="Case Study" {{ $slider->category === 'Case Study' ? 'selected' : '' }}>Case Study</option>
                        <option value="White Paper" {{ $slider->category === 'White Paper' ? 'selected' : '' }}>White Paper</option>
                        <option value="News" {{ $slider->category === 'News' ? 'selected' : '' }}>News</option>
                        <option value="Press Release" {{ $slider->category === '>Press Release' ? 'selected' : '' }}>Press Release</option>
                        <option value="Event" {{ $slider->category === 'Event' ? 'selected' : '' }}>Event</option>
                        <option value="Webinar" {{ $slider->category === 'Webinar' ? 'selected' : '' }}>Webinar</option>
                        <option value="Foreword" {{ $slider->category === 'Foreword' ? 'selected' : '' }}>Foreword</option>
                        <option value="Author Guideline" {{ $slider->category === 'Author Guideline' ? 'selected' : '' }}>Author Guideline</option>
                        <option value="Advisory Board" {{ $slider->category === 'Advisory Board' ? 'selected' : '' }}>Advisory Board</option>
                        <option value="Editorial Calendar" {{ $slider->category === 'Editorial Calendar' ? 'selected' : '' }}>Editorial Calendar</option>
                        <option value="Testimonial" {{ $slider->category === 'Testimonial' ? 'selected' : '' }}>Testimonial</option>
                    </select> 
                </div>
                <div class="form-group {{ $errors->first('issue_no', 'has-error')}}">
                    {!! Form::label('issue_no', 'Issue No:') !!}
                    {{ Form::select('issue_no', $issues, null, ['class' => 'form-control','required'=>'required']) }}
                    <span class="help-block">{{ $errors->first('issue_no', ':message') }}</span> 
                    </div>

                <div class="form-group">
                    {!! Form::label('from_date', 'From Date:') !!}
                    {{ Form::input('text', 'from_date', null, ['class' => 'form-control datepicker','required'=>'required','id'=>'datepicker']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('to_date', 'To Date:') !!}
                    {{ Form::input('text', 'to_date', null, ['class' => 'form-control datepicker','required'=>'required','id'=>'']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('url', 'slider Url:') !!}
                    {{ Form::input('text', 'url', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('pages', 'Pages:') !!}
                    {{ Form::select('pages[]', $pages, null, ['class' => 'form-control','required'=>'required','multiple'=>'multiple','placeholder'=>'Select Page']) }}
                </div>
                <div class="form-group">
                   <select name="type" id="type" class="valid form-control">
                        <option value="">--None--</option>
                        <option value="image">Image</option>
                        <option value="swf">Flash</option>
                        <option value="script">Banner Script</option>
                    </select> 
                </div>
                <div class="" id="image">
                    <div class="form-group">
                    {!! Form::label('image', 'Sliders Image/Flash:') !!}
                     {!! Form::file('image', array('class' => '')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('img_title', 'Sliders Img Title:') !!}
                        {{ Form::input('text', 'img_title', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('img_alt', 'Sliders Img Alt:') !!}
                        {{ Form::input('text', 'img_alt', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="" id="script">
                    <div class="form-group">
                        {!! Form::label('script', 'Script:') !!}
                        {{ Form::textarea('script', null, ['class' => 'form-control','size'=>'30x4']) }}
                    </div>
                </div> 
               <div class="form-group">
                 {!! Form::label( 'Other Emails for Enquiry: separete emails with comma (,)') !!}
                  {{ Form::input('text', 'emails', 'samsmith@ochre-media.com', ['class' => 'form-control','required'=>'required']) }}
              </div>   
                <div class="form-group">
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
                 
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('sliders.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
    $( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
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
 $(function() {       
    $('.typeclass').hide();
    $('#type').change(function(){
           var i= $('#type').val();
         if(i=="image") 
             {
                 $('#script').hide(); 
                 $('#image').show();
             }
           else if(i=="swf"){
               $('#image').show();
               $('#script').hide(); 
               }
            else if(i=="script"){
               $('#image').hide();
               $('#script').show(); 
            }
    });

});
</script>

@endsection