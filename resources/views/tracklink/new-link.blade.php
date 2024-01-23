@extends('../layouts/app')

@section('header')
    <div class="page-header"> 
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Short Url Generater</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-3 col-md-12" style="margin-left: 20px">
            <form action="{{ route('newlinkss') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                

                <div class="form-group col-md-4">
                  
                    <!--{{ Form::input('text', 'oriurl', null, ['class' => 'form-control']) }} -->

                    {{ Form::hidden('titleid', $ttid, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url :') !!}
                   
                    {{ Form::text('oriurl1', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-sm btn-primary">Create Short link</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('users.index') }}"></a>
                </div>
               
              

            </form>

        </div>
    </div>
@endsection