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
            <form action="{{ route('tracklinkgen.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <div class="form-group col-md-4">
                    {!! Form::label('type', 'Type:') !!}
                    <!--{{ Form::input('text', 'oriurl', null, ['class' => 'form-control']) }} -->
 {{Form::select('type', array('se' => '--Select--','nw' => 'e-Newsletter', 'mb' => 'e-MailBlast','edm' => 'Promotional eDM','ban' => 'Banner'), 'S',['class' => 'form-control'])}}
                   
                </div>
               
                <div class="form-group col-md-4">
                    {!! Form::label('title', 'Url title:') !!}
                    <!--{{ Form::input('text', 'oriurl', null, ['class' => 'form-control']) }} -->

                    {{ Form::text('title', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 1:') !!}
                   
                    {{ Form::text('oriurl1', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriur2', 'Original Url 2:') !!}
                    
                    {{ Form::text('oriurl2', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 3:') !!}
                  
                    {{ Form::text('oriurl3', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 4:') !!}
                    
                    {{ Form::text('oriurl4', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 5:') !!}
                    
                    {{ Form::text('oriurl5', null, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 6:') !!}
                    
                    {{ Form::text('oriurl6', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 7:') !!}
                    
                    {{ Form::text('oriurl7', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 8:') !!}
                    
                    {{ Form::text('oriurl8', null, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 9:') !!}
                    
                    {{ Form::text('oriurl9', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 10:') !!}
                    
                    {{ Form::text('oriurl10', null, ['class' => 'form-control']) }}
                </div>

                 <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 11:') !!}
                    
                    {{ Form::text('oriurl11', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 12:') !!}
                    
                    {{ Form::text('oriurl12', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 13:') !!}
                    
                    {{ Form::text('oriurl13', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 14:') !!}
                    
                    {{ Form::text('oriurl14', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 15:') !!}
                    
                    {{ Form::text('oriurl15', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 16:') !!}
                    
                    {{ Form::text('oriurl16', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 17:') !!}
                    
                    {{ Form::text('oriurl17', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 18:') !!}
                    
                    {{ Form::text('oriurl18', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 19:') !!}
                    
                    {{ Form::text('oriurl19', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 20:') !!}
                    
                    {{ Form::text('oriurl20', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 21:') !!}
                    
                    {{ Form::text('oriurl21', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 22:') !!}
                    
                    {{ Form::text('oriurl22', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 23:') !!}
                    
                    {{ Form::text('oriurl23', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 24:') !!}
                    
                    {{ Form::text('oriurl24', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 25:') !!}
                    
                    {{ Form::text('oriurl25', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 26:') !!}
                    
                    {{ Form::text('oriurl26', null, ['class' => 'form-control']) }}
                </div>
               

               <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 27:') !!}
                    
                    {{ Form::text('oriurl27', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 28:') !!}
                    
                    {{ Form::text('oriurl28', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 29:') !!}
                    
                    {{ Form::text('oriurl29', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 30:') !!}
                    
                    {{ Form::text('oriurl30', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 31:') !!}
                    
                    {{ Form::text('oriurl31', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 32:') !!}
                    
                    {{ Form::text('oriurl32', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 33:') !!}
                    
                    {{ Form::text('oriurl33', null, ['class' => 'form-control']) }}
                </div>
                
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 34:') !!}
                    
                    {{ Form::text('oriurl34', null, ['class' => 'form-control']) }}
                </div>
 
                    <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 35:') !!}
                    
                    {{ Form::text('oriurl35', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 36:') !!}
                    
                    {{ Form::text('oriurl36', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 37:') !!}
                    
                    {{ Form::text('oriurl37', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 38:') !!}
                    
                    {{ Form::text('oriurl38', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 39:') !!}
                    
                    {{ Form::text('oriurl39', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 40:') !!}
                    
                    {{ Form::text('oriurl40', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 41:') !!}
                    
                    {{ Form::text('oriurl41', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 42:') !!}
                    
                    {{ Form::text('oriurl42', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 43:') !!}
                    
                    {{ Form::text('oriurl43', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 44:') !!}
                    
                    {{ Form::text('oriurl44', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('oriurl', 'Original Url 45:') !!}
                    
                    {{ Form::text('oriurl45', null, ['class' => 'form-control']) }}
                </div>

                <div class="well well-sm col-md-4">

                    <!-- <input type='button' value='Add More Ur' id='addButton'>
<input type='button' value='Remove Button' id='removeButton'>
<input type='button' value='Get TextBox Value' id='getButtonValue'>
                    
-->                   
                    <button type="submit" class="btn btn-sm btn-primary">Create Short link</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('users.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>

            </form>

        </div>
    </div>
@endsection