@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>Permission / Show #{{$permission->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('permissions.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>

            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('permissions.edit', $permission->id) }}">
                   <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                </a>
            </div>
        </div>
    </div>
      <div class="well well-sm">
        <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="role icon"></i>Name</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $permission->name }}</h5>
              </div>
              
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="permission icon"></i>Display Name</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $permission->display_name }}</h5>
              </div>

              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="permission icon"></i>Description</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $permission->description }}</h5>
              </div>
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="permission icon"></i>Created Date</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ date('j F Y', strtotime($permission->created_at)) }}<i class="time icon"></i>{{ date('g:i a', strtotime($permission->created_at)) }}</h5>
              </div>
       </div>
    </div>
       
     
  
@endsection
