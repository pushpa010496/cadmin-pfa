@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3>User / Show #{{$user->id}}</h3>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-sm btn-default" href="{{ route('tracklinkgen.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('tracklinkgen.edit', $user->id) }}">
                   <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="well well-sm">
        <div class="row">
              <div class="col-md-3">              
                <h5 class="text-primary"><i class="user icon"></i>Name</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $user->name }}</h5>
              </div>
              
              <div class="col-md-3"> 
                <h5 class="text-primary"><i class="user icon"></i>Email</h5>
              </div>
              <div class="col-md-9">
                <h5>{{ $user->email }}</h5>
              </div>

       </div>
    </div>

   

    </div>
@endsection
