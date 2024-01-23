@extends('../layouts/app')
<style type="text/css">
@import url("//cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css");
  /**
  * Override feedback icon position
  * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
  */
  #eventForm .form-control-feedback {
  top: 0;
  right: -15px;
  }
  .bs-example{
  margin: 20px;
  }
  body {
  padding: 10px;
}

.row{
  margin-top: 15px;
  margin-bottom: 15px
}
  .btn-group,
.multiselect {
  width: 100%;
}

.multiselect {
  text-align: left;
  padding-right: 32px;
  overflow: hidden;
  text-overflow: ellipsis;
}

.multiselect .caret {
  right: 12px;
  top: 45%;
  position: absolute;
}

.multiselect-container.dropdown-menu {
    min-width: 0px;
}

.multiselect-container>li>a>label {
    white-space: normal;
    padding: 5px 15px 5px 35px;
}

.multiselect-container > li > a > label > input[type="checkbox"] {
    margin-top: 3px;
}
.btn-default, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
  color: #040404 !important;
  background-color: #ffffff !important;
  border-color: rgba(0, 0, 0, 0);
}
</style>
@section('content')
<div class="col-lg-12">
  @include('error')
  <!--   <div class="bs-example">
    <div class="alert  fade in" id="alert5" name="alert5">
        
        <p style="color: #FF0000"><marque><strong style="" class="">All Fields Are Required..</strong></marque></p>
       
    </div>
    </div> -->
</div>
<section class="content">
  <div class="box-body">
    <form action="{{ url('analyticaledmreports') }}" method="post">
    {{csrf_field()}}

       <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>Total Sent <span style="color: #FF0000">*</span></label>
           <input type="number" id="total_sent" name="total_sent" class="form-control">
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>
        <div class="col-md-3">
        <div class="form-group">
          <label>Bounce<span style="color: #FF0000">*</span></label>
           <input type="number" id="bounce" name="bounce" class="form-control" required>
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>
       <div class="col-md-3">
        <div class="form-group">
          <label>Delivered <span style="color: #FF0000">*</span></label>
           <input type="number" id="delivered" name="delivered" class="form-control" required>
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Opened <span style="color: #FF0000">*</span></label>
           <input type="number" id="opened" name="opened" class="form-control" required>
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>    
      
  </div>

    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>Clicks <span style="color: #FF0000">*</span></label>
           <input type="number" id="clicks" name="clicks" class="form-control" >
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>
        <div class="col-md-3">
        <div class="form-group">
          <label>Desktop<span style="color: #FF0000">*</span></label>
           <input type="number" id="desktop" name="desktop" class="form-control" required>
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>
    
      <div class="col-md-3">
        <div class="form-group">
          <label>Mobile <span style="color: #FF0000">*</span></label>
           <input type="number" id="mobile" name="mobile" class="form-control" required>
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>
        <div class="col-md-3">
        <div class="form-group">
          <label>Tablet <span style="color: #FF0000">*</span></label>
           <input type="number" id="tablet" name="tablet" class="form-control" required>
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>
    
   
  </div>

      <div class="row">
     
      <div class="col-md-3">
        <div class="form-group">
          <label>Subject Line <span style="color: #FF0000">*</span></label>
           <input type="text" id="subject_line" name="subject_line" class="form-control" >
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Release Date <span style="color: #FF0000">*</span></label>
          <input type="text" id="release_date" name="release_date" class="form-control" >
          <span id="alert1" name="alert1" style="color: red;font-weight: 600"></span>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Start Date <span style="color: #FF0000">*</span></label>
          <input type="text" id="startdate" name="startdate" class="form-control" required>
          <span id="alert1" name="alert1" style="color: red;font-weight: 600"></span>
        </div>
    </div>
     <div class="col-md-3">
          <div class="form-group">
            <label>End Date <span style="color: #FF0000">*</span></label>
            <input type="text" id="enddate" name="enddate" class="form-control" required>
            <span id="alert2" name="alert2" style="color:red;font-weight: 600"></span>
          </div>
      </div>
   
  </div>



    <div class="row">
      
        <div class="col-md-3">
        <div class="form-group">
          <label>Select Edmtitle <span style="color: #FF0000">*</span></label>
          <select class="form-control select2" id="shorturlid" name="shorturl" style="width: 100%;" required>
            <option selected="selected" value="ochre">--Select Edm--</option>
            @foreach($tracklinks as $edmdata)
            <option value="{{$edmdata->titleid}}">{{$edmdata->title}}</option>
            @endforeach
          </select>
          <span id="alert" name="alert" style="color: red;font-weight: 600"></span>
        </div>
      </div>

          <div class="col-md-3">
              <div class="form-group">
                  <label>Select Region <span style="color: #FF0000">*</span></label>
                  <select class="form-control" id="region" name="region[]" required  multiple >
                    @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->name}}</option>
                    @endforeach
                  </select>
              </div>
          </div>

          <div class="col-md-3">
             <div class="form-group">
           <label>Select Sub Region <span style="color: #FF0000">*</span></label>
                <select class="form-control" id="sub_region" name="sub_region[]" required multiple >
                  <option >--Select Sub Region--</option>
                </select>
              </div>
          </div>

          <div class="col-md-3">
             <div class="form-group">
           <label>Select Countries <span style="color: #FF0000">*</span></label>
                <select class="form-control " id="country_id" name="country_id[]" style="width: 100%;" required multiple >

                  <option >--Select Countries--</option>
                 
                </select>
              </div>
          </div>
     
     {{--  <div class="col-md-3">
        <div class="form-group">
          <label>Select oriurl <span style="color: #FF0000">*</span></label>
          <select class="form-control select2" id="oriurl_id" name="oriurl_id" style="width: 100%;" required>

              </select>
        {{--   {!! Form::label('Select edmtitle', 'edmtitle:',['class'=>'control-label']) !!}
          {!! Form::select('oriurl_id', $shorturl, null,['class'=>'form-control','id'=>'oriurl_id']  ) !!} --}}
         
      {{--   </div>
        /.form-group
      </div> --}} 
   
  <!-- /.col -->

  
  
  </div>



  <div class="col-md-12">
    <div class="form-group">
      <input type="SUBMIT" class="btn btn-info pull-right" style="margin-top:37PX" id="formsubmit" name="formsubmit" value="Get Word Report"> 
    </div>
  </div>
  <div class="col-md-12">
    <div class="col-lg-6">
      <fieldset>
        <!-- <legend style="">Select Metrics</legend> -->
        <div class="iCheck-helper" aria-checked="false" aria-disabled="false" style="position: relative;">
          <input type="checkbox" class="iCheck-helper" value=" ga:users" name="metric[]" id="metric" checked="checked" hidden="hidden" readonly> <span style="font-weight: 600" hidden="hidden">Total Trafic</span> &nbsp;&nbsp;<br>
          <!--  <input type="checkbox" class="iCheck-helper" value="ga:newUsers" name="metric[]" id="metric"> <span style="font-weight: 600">New Visitors / Return Visitors</span> &nbsp;&nbsp;<br>
            <input type="checkbox" class="iCheck-helper" value="ga:sessionDuration
            " name="metric[]" id="metric"><span style="font-weight: 600">Time Spent</span>&nbsp;&nbsp;<br>
            
            <input type="checkbox" class="iCheck-helper" value="ga:bounceRate" name="metric[]" id="metric"><span style="font-weight: 600">Bounce Rate</span>&nbsp;&nbsp;<br>
            <input type="checkbox" class="iCheck-helper" value="ga:organicSearches" name="metric[]" id="metric"><span style="font-weight: 600">Organic Sources</span>&nbsp;&nbsp;<br> -->
        </div>
      </fieldset>
    </div>
    <div class="col-lg-6">
      <fieldset>
        <!--  <legend>Select Dimensions</legend> -->
        <div class="iCheck-helper" aria-checked="false" aria-disabled="false" style="position: relative;">
          <input type="checkbox" class="iCheck-helper" value="ga:country" name="dim[]" id="dim" checked="checked" hidden="hidden"> <span style="font-weight: 600" hidden="hidden">Country</span> &nbsp;&nbsp;<br>
          <input type="checkbox" class="iCheck-helper" value="ga:deviceCategory" name="dim[]" id="dim" checked="checked" hidden="hidden"><span style="font-weight: 600" hidden="hidden">Device</span>&nbsp;&nbsp;<br>
          <input type="checkbox" class="iCheck-helper" value="ga:keyword" name="dim[]" id="dim" checked="checked" hidden="hidden"><span style="font-weight: 600" hidden="hidden">Key Words</span>&nbsp;&nbsp;<br>
          <input type="checkbox" class="iCheck-helper" value="ga:fullReferrer" name="dim[]" id="dim" checked="checked" hidden="hidden"><span style="font-weight: 600" hidden="hidden">Referal</span>&nbsp;&nbsp;<br>
          <input type="checkbox" class="iCheck-helper" value="ga:socialNetwork" name="dim[]" id="dim" checked="checked" hidden="hidden"><span style="font-weight: 600" hidden="hidden">Social Source</span>&nbsp;&nbsp;<br>
          <input type="checkbox" class="iCheck-helper" value="ga:out" name="dim[]" id="dim" checked="checked" hidden="hidden"><span style="font-weight: 600" hidden="hidden">Out Bound</span>&nbsp;&nbsp;<br>
          <input type="checkbox" class="iCheck-helper" value="ga:source" name="dim[]" id="dim" checked="checked" hidden="hidden"><span style="font-weight: 600" hidden="hidden">Source</span>&nbsp;&nbsp;<br>
        </div>
    </div>
    </fieldset>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label></label>
      <!--  <input type="SUBMIT" class="btn btn-success" style="margin-top: 27PX" id="formsubmit" name="formsubmit"> -->
    </div>
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
  {{ Form::close() }}
</section>
@section('scripts')
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
<script>
  $("#formsubmit").click(function () {
  
    var viewcompany=$("#displayid").val();
  
    var firstdate=$("#startdate").val();
    var lastdate=$("#enddate").val();
    if(viewcompany=="ochre"){
  $("#alert").html("Please Select Company");
    //alert("Please Select Company");
    return false;
  
    }
  
    if(firstdate==""){
  
  //alert("Please select startdate");
  
       //$("#alert1").addClass("alert-warning");
  
       $("#alert1").html("Please Select Start Date");
        // $("#alert").fadein(1000);
        // $("#alert").fadeout(8000);
       
        // $("#startdate").focus();
         return false;
  
  }
  
    if(lastdate==""){
        // $("#alert").html("Please Select End Date");
        // $("#alert").fadein(6000);
  
   $("#alert2").html("Please Select End Date");
   return false;
    }
    if ($('input:checkbox').filter(':checked').length < 1){
       // alert("Check at least one Dimension!");
         $("#alert").html("Check at least one Dimension!");
    return false;
    }
  
  });
  $(document).ready(function(){
  
  $('#startdate').datepicker({
      format: 'dd-mm-yyyy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
  
    });
    $('#enddate').datepicker({
      format: 'dd-mm-yyyy',
      changeMonth: true,
        changeYear: true,
        autoclose: true,
    });

     $('#release_date').datepicker({
      format: 'dd-mm-yyyy',
      changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
  
  });
</script>
<script type="text/javascript">

    $(document).ready(function() {
      $('#region').multiselect({
        numberDisplayed: 1,
        includeSelectAllOption: true,
        allSelectedText: 'All Regions selected',
        nonSelectedText: 'Please Select Regions',
        selectAllValue: 'all',
        selectAllText: 'Select all',
        unselectAllText: 'Unselect all',
       
     });
  });

    $(document).ready(function() {
    $('#region').change(function() {
      var region_id = $('#region').val();
      if(region_id){
         $.ajax({
            url: "{{route('get.sub-regions')}}",
            type: "POST",
            data: {region_id:region_id,"_token": "{{ csrf_token() }}",},
            dataType:"json",
            success: function (response) {
              var len = response.length;
                $("#sub_region").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    $("#sub_region").append("<option value='"+id+"'>"+name+"</option>");
                }
                $('#sub_region').multiselect({
                    numberDisplayed: 1,
                    includeSelectAllOption: true,
                    allSelectedText: 'All Sub Regions selected',
                    nonSelectedText: 'Please Select Sub Regions',
                    selectAllValue: 'all',
                    selectAllText: 'Select all',
                    unselectAllText: 'Unselect all',
                   
                 });
              
            },
         });
      }else{
      alert('Please Select Regions');
      }
   });
});


  $(document).ready(function() {
      $('#sub_region').change(function() {
        var sub_region = $('#sub_region').val();
              $.ajax({
              url: "{{route('get.region-country')}}",
              type: "POST",
              data: {sub_region:sub_region,"_token": "{{ csrf_token() }}",},
              dataType:"json",
              success: function (response) {
                    if(response){
                      var len = response.length;
                      $("#country_id").empty();
                      for( var i = 0; i<len; i++){
                          var country_code = response[i]['country_code'];
                          var name = response[i]['country'];
                          $("#country_id").append("<option value='"+country_code+"'>"+name+"</option>");
                      }
                          $('#country_id').multiselect({
                          numberDisplayed: 1,
                          includeSelectAllOption: true,
                          allSelectedText: 'All Countries selected',
                          nonSelectedText: 'Please Select Countries',
                          selectAllValue: 'all',
                          selectAllText: 'Select all',
                          unselectAllText: 'Unselect all',
                       });
                    }
              },
           });
      });
  });
  $("#shorturlid").on('change',function (e) {
        var titleid = e.target.value;
         $.get('{{url("/")}}/ajax-edm/'+titleid,function(data) {
           $("#oriurl_id").empty();  
           $("#oriurl_id").append(data);      
         });
         $("#country_code").val(data); 
    });
</script>
@endsection
@endsection