@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i>  URL Short links
            <!--<a class="btn btn-sm btn-success pull-right" href="{{ url('excel') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Export to Excel</a>
            -->
        </h3>

    </div>
     <div class="col-md-4 pull-right">
         
        </div>
@endsection

@section('content')

<?php
//print_r($url_info);

//exit;


?>
    <div class="row">
         <form action="{{url('/trackreport')}}" method="GET">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <div class="form-group col-md-4">
                    {!! Form::label('type', 'Type:') !!}
                    <!--{{ Form::input('text', 'oriurl', null, ['class' => 'form-control']) }} -->
 {{Form::select('type', array('se' => '--Select--','nw' => 'e-Newsletter', 'mb' => 'e-MailBlast','edm' => 'Promotional eDM','ban' => ' Banner','company'=>'Company'), 'S',['class' => 'form-control'])}}
                   
                   <input type="submit">
                </div>

            </form>
        <div class="col-md-9">
            @if($url_info->count())

       
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Title</th> 
                            <th>Short url Id</th> 
                           
                            
                             <!-- <th>Total Clicks</th>  -->

                              <!-- <th>Unique Clicks</th> -->
                              
                            
                        </tr>
                    </thead>

                    <tbody>{{$i=1}}

                     
                        @foreach($url_info as $newlinks)
                            <tr>
                                <td class="text-center"><strong>{{$i}}</strong></td>
 <td><a class="" href="{{ url('title',$newlinks->titleid) }}">{{$newlinks->title}}</a>
                                      
                                </td> 
                                <td>
                                     {{$newlinks->titleid}} 
                                </td> 
                                
                            </tr><?php $i++; ?>
                       @endforeach
                    </tbody>
                </table>
              
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
        //jquery script
        console.log('sdsd');
       // alert("");
        $("#type").change(function(){
            var type = $(this).val();

           // alert(type);
            //now sending this username to ajax page for geting img saved against this username.
            $.ajax({
                alert("banners");
                url:"ajaxpage.php",
                data:{data:username}
            }).done(function(result)
            {
                //now assign result to its related place
                $(".img").html(result);
            })
        });
 
    });
</script>
@endsection
