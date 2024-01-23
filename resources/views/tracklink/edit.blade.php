@extends('../layouts/app')

@section('header')
    
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="page-header">
                
            </div> 
            <form action="{{ route('tracklinkgen.update', $newlinks->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
 <div class="form-group">
                    {!! Form::label('title', 'Url title:') !!}
                    {{ Form::text('title', old('oriurl', $newlinks->title), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('oriurl', 'Original Url:') !!}
                    {{ Form::textarea('oriurl', old('oriurl', $newlinks->oriurl), ['class' => 'form-control']) }}
                </div>
                 
                       

                <div class="well well-sm">
                    <button type="submit" name="submit_user" class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('users.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>

       


    </div>
@endsection