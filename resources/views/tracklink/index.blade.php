@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i>  URL Short links 
            <a class="btn btn-sm btn-success pull-right" href="{{ route('newlinkview',[$ttid])}}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Link</a>
        </h3>
    </div>
     <div class="col-md-4 pull-right">
          {!! Form::open(['method'=>'GET','url'=>'tracklinkgen','role'=>'search'])  !!}
              <div id="custom-search-input">
                <div class="input-group col-md-12 pull-right">
                    <input type="text" class="search-query form-control" placeholder="Search" name="search" />
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button">
                            <i class="fa fa-search" aria-hidden="true"></i>

                        </button>
                    </span>
                </div>
              </div>
         {!! Form::close() !!}
        </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($tracklinkdata->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>

                            <th>Short Url Id</th> 
                            <th>Original URL</th>
                            <th>Short Url</th> 
                             <th>Created Date</th> 
                            
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>
                        @foreach($tracklinkdata as $newlinks)
                            <tr>
                                <td class="text-center"><strong>{{$i}}</strong></td>

                                <td>{{$newlinks->shorturl_id}}</td> 
                                <td>{{$newlinks->oriurl}}</td> 
                                <td>{{'https://track.pharmafocusasia.com/'.$newlinks->shorturl_id. '/'}}
                                    
                                    <!-- <a class="btn btn-sm btn-info" href="{{url('geturlinfo/'. $newlinks->shorturl_id) }}">
                                       <i class="fa fa-pencil-square" aria-hidden="true"></i> Short url
                                    </a>

--> 



                                   <!-- {{'https://www.automotive-technology.com/tracklink/'.$newlinks->shorturl_id}}
-->
                                   </td>
                                <td>{{$newlinks->created_at}}</td> 
                                <td class="text-right">
                                   <!-- <a class="btn btn-sm btn-primary" href="{{ route('tracklinkgen.show', $newlinks->id) }}">
                                   
                                      <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                     -->  
                                    <a class="btn btn-sm btn-info" href="{{ route('tracklinkgen.edit', $newlinks->id) }}">
                                       <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                    </a>

                                    <form action="{{ route('tracklinkgen.destroy', $newlinks->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                       <!-- <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button> -->
                                    </form>
                                </td>
                            </tr><?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
               {!! $tracklinkdata->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection