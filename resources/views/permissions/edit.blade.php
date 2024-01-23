@extends('../layouts/app')

@section('header')
    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> Permission / Edit #{{$permission->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">

            <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

               <div class="form-group">
                    {!! Form::label('display_name', 'Display Name:') !!}
                    {{ Form::input('text', 'display_name', old('display_name', $permission->display_name ), ['class' => 'form-control']) }}
                    
                </div> <div class="form-group">
                    {!! Form::label('name', 'Slug:') !!}
                    {{ Form::input('text', 'name', old('name', $permission->name ), ['class' => 'form-control']) }}
                </div> <div class="form-group">
                    {!! Form::label('description', 'Description:') !!}
                    {{ Form::textarea('description', old('description', $permission->description ), ['class' => 'form-control','rows'=>3]) }}</textarea>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('permissions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection