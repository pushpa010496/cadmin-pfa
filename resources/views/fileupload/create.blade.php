@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Images Live Link/ Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
    
        <div class="col-md-offset-1 col-md-10">
          {!! Form::open(array('route' => 'fileupload.store','files'=>true)) !!}
            <div class="col-md-6">
              
                <div class="form-group">
                    {!! Form::label('category', 'Category:') !!}
                    <select name="category" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        <option value="articles">Articles</option>
                        <option value="pressreleases">Pressreleases</option>
                        <option value="events-newsletters">Events-newsletters</option>
                        <option value="e-newsletters">E-newsletters</option>
                        <option value="clientemailblast">E-dm</option>
                        <option value="promotions">Promotions</option>
                         <option value="interview">Interviews</option>
                         <option value="ebooks">ebooks</option>
                       


                        
                    </select>
                </div>

                <!--  <div class="form-group">
                    {!! Form::label('Image Title', 'Image title:') !!}
                       {{ Form::text('imgtitle', null, ['class' => 'form-control']) }}
                </div> -->
                 <br>
                 
                <div class="row form-group">
                    {!! Form::label('image', 'Upload Image:',['class' => 'col-md-3']) !!}
                    {{ Form::file('image[]',['class' => 'form-control col-md-9','multiple'=>true]) }}
                </div>

                 <br>

                <div class="form-group">
                  <input type="submit" id="sub" name="sub" class="btn btn-success" value="Generate Link">
                </div>
            </div>
                
          </form>

          <div class="clearfix"></div>

          <br>

           @if(@$livelinkexists)

             @foreach($livelinkexists as $livelinkexist)
               <div class="col-md-3">
             <h4 class="text-warning"><i class="fa fa-lg fa-exclamation-triangle"></i> File Already Exists <small>Please change image name</small></h4>
             
              <img src="{{$livelinkexist}}" style="width: 100px;padding-top: 20px;">
            </div>
              @endforeach
          @endif
          @if(@$livelinks)
            
             @foreach($livelinks as $key=>$livelink)
              <div id="alert" class="form-group">
               
                <div class="col-md-10">

                  <input type="text" value="{{$livelink}}" id="myInput-{{$key}}" class="form-control">  
                </div>
             
                <div class="col-md-2">
                  <button onclick="myFunction({{$key}})" class="btn btn-info">
                    <i class="fa fa-clipboard" aria-hidden="true"></i> Copy Link
                  </button>
                </div>
              </div>
         
          @endforeach

            @endif

        </div>
    </div>
@endsection

@section('scripts')
<script>
     var options = {
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("article")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Files',
    filebrowserUploadUrl: '{{public_path("article")}}/?type=Files&_token='
    };
 
</script>

<script>
function myFunction(key) {
  //var i=0;
var i="myInput-"+key;
  var copyText = document.getElementById(i);

  copyText.select();
  document.execCommand("copy");
  $("#copyalert").html("Copied");
  //location.reload(true);
  // $("#alert").remove();

    // $("#alert").html("Link Copied");
 }

$("#sub").click(function(){



 var image=$("#image").val();



 if(image!=""){

return true;

 }
 else{

  alert("Please select image file");
  return false;
 }

})
 
</script>

@endsection