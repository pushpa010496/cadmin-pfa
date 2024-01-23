@extends('../layouts/app')

@section('header')
    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> Role / Edit #{{$role->id}}</h3>
    </div>
@endsection
@section('css')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
  <style type="text/css">optgroup, select{color: #333;}</style>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">

            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    {!! Form::label('display_name', 'Display Name:') !!}
                    {{ Form::input('text', 'display_name', old('display_name', $role->display_name ), ['class' => 'form-control']) }}
                	
                </div> <div class="form-group">
                	{!! Form::label('name', 'Slug:') !!}
                    {{ Form::input('text', 'name', old('name', $role->name ), ['class' => 'form-control']) }}
                </div> <div class="form-group">
                	{!! Form::label('description', 'Description:') !!}
                    {{ Form::textarea('description', old('description', $role->description ), ['class' => 'form-control','rows'=>3]) }}</textarea>
                </div>
               
                <div class="form-group">
                    {!! Form::label('permissions', 'Permissions:') !!}
                    {!! Form::select('permissions[]',$permissions , $role->perms->pluck('id')->toArray() ,['id'=>'multiple-checkboxes','multiple'=>true] ) !!}
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('roles.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

        $('#multiple-checkboxes').multiselect();

    });

</script>
@endsection