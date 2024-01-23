@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Banners / Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                 {!! Form::open(array('route' => 'banners.store','files'=>true)) !!}
                
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', null, ['class' => 'form-control','required'=>'required']) }}
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
                    {!! Form::label('url', 'Banner Url:') !!}
                    {{ Form::input('text', 'url', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                   {!! Form::label('display_order', 'Display Oreder:') !!}
                   
          <select name="display_order" class="form-control">
                        <option value="">-- Select one --</option>
                      
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                     
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('pages', 'Pages:') !!}
                    {{ Form::select('pages[]', $pages, null, ['class' => 'form-control','multiple'=>'multiple','placeholder'=>'Select Page']) }}
                </div>
               {{--   <div class="form-group" id="category">
                    {!! Form::label('category', 'Category:') !!}
                    {{ Form::select('category[]', $category, null, ['class' => 'form-control','multiple'=>'multiple','placeholder'=>'Select Category']) }}
                </div>  --}}
                <div class="form-group">
                   <select name="type" id="type" class="valid form-control">
                        <option value="">--None--</option>
                        <option value="image">Image</option>
                        <option value="swf">Flash</option>
                        <option value="script">Banner Script</option>
                    </select> 
                </div>
                <div class="typeclass" id="image">
                    <div class="form-group">
                    {!! Form::label('image', 'Banners Image/Flash:') !!}
                     {!! Form::file('image', array('class' => '')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('img_title', 'Banners Img Title:') !!}
                        {{ Form::input('text', 'img_title', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('img_alt', 'Banners Img Alt:') !!}
                        {{ Form::input('text', 'img_alt', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('anchor_title', 'Banners Anchor Title:') !!}
                        {{ Form::input('text', 'anchor_title', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="typeclass" id="script">
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
                    {!! Form::label('position', 'Position:') !!}
                    {{ Form::select('position', $position, null, ['class' => 'form-control','placeholder'=>'Select Position']) }}
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
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('banners.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
 //   $('#category').hide();
 //  $('.page_list').on('change',function(){    
 //      var cat_val = $('.page_list').val();
 //     if (jQuery.inArray('3', cat_val)!='-1') {
 //          $('#category').show();
 //        } else {
 //           $('#category').hide();
 //           $("#category select")[0].selectedIndex = -1;
 //        }
 // });
</script>

@endsection