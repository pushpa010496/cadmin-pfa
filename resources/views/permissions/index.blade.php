@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i>  Permission
            <a class="btn btn-sm btn-success pull-right" href="{{ route('permissions.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>  Create</a>
        </h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($permissions->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Name</th>                            
                            <th class="text-center">Display Name</th>                            
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>
                        @foreach($permissions as $permission)
                            <tr>
                                <td class="text-center"><strong>{{$i}}</strong></td>
                                <td class="text-center"><strong>{{$permission->name}}</strong></td>
                                <td class="text-center"><strong>{{$permission->display_name}}</strong></td>
                                <td class="text-right">
                                    <a class="btn btn-sm btn-primary" href="{{ route('permissions.show', $permission->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    
                                    <a class="btn btn-sm btn-info" href="{{ route('permissions.edit', $permission->id) }}">
                                       <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                    </a>

                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>
                            </tr><?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                {!! $permissions->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection