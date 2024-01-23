@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i> Client emailblast
            <a class="btn btn-sm btn-success pull-right" href="{{ route('clientemailblast.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Create</a>
        </h3>
    </div>
    <div class="col-md-12">
          {!! Form::open(['method'=>'GET','url'=>'clientemailblast','role'=>'search'])  !!}
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
            @if($newsletters->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Title</th>                            
                            <th class="text-center">View File</th>                            
                            <th class="text-center">Status</th>                            
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>
                        @foreach($newsletters as $newsletter)
                            <tr>
                                <td class="text-center"><strong>{{$i}}</strong></td>
                                <td class="text-center"><strong>{{$newsletter->title}}</strong></td>
                                <td class="text-center"><strong>
                                    <a href="<?php echo config('app.url'); ?>clientemailblast/<?php echo $newsletter->file;?>" target="_blank"><span class="text-primary">View File</span></a>
                                    {{$newsletter->newsletters_url}}</strong></td>
                                <td class="text-center">
                                    @if($newsletter->active_flag ==1) Active @elseif($newsletter->active_flag == 0) Inactive @endif
                                </td>
                                <td class="text-right">

                                    <a class="btn btn-sm btn-success" href="{{ url('clientemailblast/reactivate', $newsletter->id) }}">
                                         Active ?
                                    </a>

                                    <a class="btn btn-sm btn-primary" href="{{ route('clientemailblast.show', $newsletter->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    
                                    <a class="btn btn-sm btn-info" href="{{ route('clientemailblast.edit', $newsletter->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                    </a>

                                    <form action="{{ route('clientemailblast.destroy', $newsletter->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>
                            </tr><?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                {!! $newsletters->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection