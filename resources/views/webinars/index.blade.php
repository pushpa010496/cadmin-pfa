@extends('../layouts/app')

@section('header')
<div class="container">
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i> Webinars
            <a class="btn btn-sm btn-success pull-right" href="{{ route('webinars.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Create</a>
        </h3>
    </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
              {!! Form::open(['method'=>'GET','url'=>'webinars','role'=>'search'])  !!}
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

            @if($data->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Name</th>                            
                                                     
                                                                                
                            <th class="text-center">Status</th>  
                                               
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>
                        @foreach($data as $value)
                            <tr>
                                <td class="text-center"><h5>{{$i}}</h5></td>
                                <td class="text-center"><h5>{{$value->title}}</h5></td>
                               
                               
                                <td class="text-center"><h5>{{$value->active_flag == 1 ? 'Active': 'In Active'}}</h5></td>             
                              
                                <td class="text-right">
                             
                                  
                                    <a class="btn btn-sm btn-primary" href="{{ route('webinars.show', $value->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    
                                    <a class="btn btn-sm btn-info" href="{{ route('webinars.edit', $value->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                    </a>
                                    @if($value->active_flag == 1 )
                                    <form action="{{ route('webinars.destroy', $value->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button>
                                    </form>
                                    @else 
                                         <a class="btn btn-sm btn-success" href="{{ url('webinars/reactivate', $value->id) }}">
                                         Active ?
                                    </a>
                                    @endif
                                  
                                </td>
                            </tr><?php $i++; ?>
                            
                        @endforeach
                    </tbody>
                </table>
                {!! $data->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection