@extends('../layouts/app')

@section('header')
    <div class="page-header">
        <h3><i class="fa fa-pencil-square" aria-hidden="true"></i> Banners / Edit #{{$banner->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
                     
            <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {{ Form::input('text', 'title', old('title',$banner->title), ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('from_date', 'From Date:') !!}
                    {{ Form::input('text', 'from_date', $banner->from_date, ['class' => 'form-control datepicker','required'=>'required','id'=>'datepicker']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('to_date', 'To Date:') !!}
                    {{ Form::input('text', 'to_date', $banner->to_date, ['class' => 'form-control datepicker','required'=>'required','id'=>'']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('url', 'banner Url:') !!}
                    {{ Form::input('text', 'url', $banner->url, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('display_order', 'Display Oreder:') !!}
                   {{ Form::select('display_order', 
                      [
                      '1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10',
                      '11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18',
                      '19'=>'19','20'=>'20'], $banner->display_order, ['class' => 'form-control','required'=>'required','id'=>'display_order']) }}   
                </div>
                 <div class="form-group">
                    {!! Form::label('pages', 'Pages:') !!}
                    {{ Form::select('pages[]', $pages,$banner->pages()->pluck('id'), ['class' => 'page_list form-control','required'=>'required','multiple'=>'multiple','placeholder'=>'Select Page']) }}
                </div>
              {{--     <div class="form-group" id="category">
                    {!! Form::label('category', 'Category:') !!}
                    {{ Form::select('category[]', $category,$banner->pages()->pluck('id'), ['class' => 'form-control','multiple'=>'multiple','placeholder'=>'Select Category']) }}
                </div> --}}
                <div class="form-group">
                    {!! Form::label('position', 'Position:') !!}
                    {{ Form::select('position', $position,$banner->positions()->pluck('id'), ['class' => 'form-control','required'=>'required','placeholder'=>'Select Page']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('type', 'Type:') !!}
                      {{ Form::select('type', 
                      [''=>'--None--',
                      'image'=>'Image',
                      'swf'=>'Flash',
                      'script'=>'Banner Script'], $banner->type, ['class' => 'form-control','required'=>'required','id'=>'type']) }}                
                </div>
                <?php if($banner->type == "image" || $banner->type == "swf"){ ?>
                <div id="image"  style="display:block;" >
                    <?php }else{ ?>
                <div class="typeclass" id="image" >
                <?php } ?>
                    <div class="form-group">
                        {!! Form::label('image', 'banner Image:') !!}
                         {!! Form::file('image', array('class' => '')) !!}
                         @if($banner->image)
                           <img width="200" src="<?php echo config('app.url'); ?>ensign/<?php echo $banner->image;?>">
                         @endif
                    </div>            
                    <div class="form-group">
                        {!! Form::label('img_title', 'banner Img Title:') !!}
                        {{ Form::input('text', 'img_title', old('img_title',$banner->img_title), ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('img_alt', 'banner Img Alt:') !!}
                        {{ Form::input('text', 'img_alt', old('img_alt',$banner->img_alt), ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('anchor_title', 'banner Anchor Title:') !!}
                        {{ Form::input('text', 'anchor_title', old('anchor_title',$banner->anchor_title), ['class' => 'form-control']) }}
                    </div>
                </div>
                
                <?php if($banner->type == "script"){ ?>
               <div id="script" style="display:block; ">    
                 <?php }else{ ?>
               <div class="typeclass" id="script" >    
               <?php } ?>                      
                <div class="form-group">
                        {!! Form::label('script', 'Script:') !!}
                        {{ Form::textarea('script', $banner->script, ['class' => 'form-control','size'=>'30x4']) }}
                    </div>
               </div>
               <div class="form-group">
                 {!! Form::label( 'Other Emails for Enquiry: separete emails with comma (,)') !!}
                  {{ Form::input('text', 'emails', 'samsmith@ochre-media.com', ['class' => 'form-control','required'=>'required']) }}
              </div>
    

                <div class="form-group">
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        @if($banner->active_flag == 1)
                        <option value="1" selected="selected">Active</option>
                        <option value="0">InActive</option>
                        @elseif($banner->active_flag == 0)
                        <option value="1">Active</option>
                        <option value="0" selected="selected">InActive</option>
                        @endif
                    </select>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('banners.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
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
   
  
 $(function() {       
   $('.typeclass').hide();
   if($('#category select').val() == ''){
    $('#category').hide();
   }
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

 //     $('.page_list').on('change',function(){    
 //      var cat_val = $('.page_list').val();
     
 //     if (jQuery.inArray('3', cat_val)!='-1') {
        
 //          $('#category').show();        
 //        } else {
          
 //          $("#category select")[0].selectedIndex = -1;
 //           $('#category').hide();
 //        }
 // });

});
</script>

@endsection
