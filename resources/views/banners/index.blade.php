@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i> Banners
            <a class="btn btn-sm btn-success pull-right" href="{{ route('banners.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Create</a>
        </h3>
    </div>
    <div class="col-md-12">
          {!! Form::open(['method'=>'get','url'=>'banners','role'=>'search'])  !!}

          <div class="col-md-4">
            <input type="text" class="search-query form-control col-md -6" placeholder="Search" name="search" />
          </div>

          <div class="col-md-4">

                    <select id="banner_search" name="banner_search" class="form-control col-md-6">
                        <option value="">Select</option>
                        <option value="1">Active</option>
                        <option value="0">In Active</option>

                    </select> 
                  
                     
          </div>
            <div class="col-md-4">

                   <input type="submit" name="" class="btn btn-danger">
                    
                     
          </div>
               <div class="col-md-4">

                       
               
               </div>
         {!! Form::close() !!}
        </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($sliders->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Name</th>
                             <th class="text-center">page</th>
                            <th class="text-center">Status</th>  
                            <th class="text-center">From</th>  
                            <th class="text-center">To</th>                            
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody><?php $i=1; $page='';?>
                        @foreach($sliders as $slider)
                            <tr>
                                <td class="text-center"><h5>{{$i}}</h5></td>
                                <td class="text-center"><h5>{{$slider->type}}</h5></td>
                                <td class="text-center"><h5>{{$slider->title}}</h5></td>
                                @foreach($slider->bannerpage as $page)
                                <td class="text-center"><h5>
                                    {{$page->title}}
                                   </h5>
                                </td>
                                @endforeach
                                <td class="text-center">
                                    <h5>
                                          @if($slider->active_flag ==1) Active @elseif($slider->active_flag == 0) Inactive @endif
                                    </h5>
                                </td>
                                   <td class="text-center"><h5>{{date('d-m-Y',strtotime($slider->from_date)) }}</h5></td>
                                   <td class="text-center"><h5>{{date('d-m-Y',strtotime($slider->to_date)) }}</h5></td>
                                <td class="text-right">
                                    
                                    <a class="btn btn-sm btn-success" href="{{ url('banners/reactivate', $slider->id) }}">
                                         Active ?
                                    </a>

                                    <a class="btn btn-sm btn-primary" href="{{ route('banners.show', $slider->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    
                                    <a class="btn btn-sm btn-info" href="{{ route('banners.edit', $slider->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                    </a>

                                    <form action="{{ route('banners.destroy', $slider->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>
                            </tr><?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                {!! $sliders->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection