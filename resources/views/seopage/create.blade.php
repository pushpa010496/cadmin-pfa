@extends('../layouts/app')

@section('header')
<div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> SeoPage/ Create </h3>
    </div>

@endsection


@section('content')

<div class="row">
        <div class="col-md-offset-3 col-md-6">
		{!! Form::open(array('route' => 'seopage.store')) !!}

		<?php $value = ''; ?>
		 <div class="form-group">
                    {!! Form::label('page_id', 'Pages:') !!}
                    {{ Form::select('page_id', $page, null, ['class' => 'form-control','required'=>'required','placeholder'=>'Select Page']) }}
                </div>  
                 @includeIf('./seoform')

          {!! Form::close() !!}

       </div>
 </div>         
@endsection
