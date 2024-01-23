@extends('../layouts/app')
@section('header')
    <div class="page-header">
        <h3><i class="fa fa-plus-square-o" aria-hidden="true"></i> Event Organisers / Create </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1">
                 {!! Form::open(array('route' => 'eventorganisers.store','files'=>true)) !!}
            <div class="col-md-6">
               
                <div class="form-group">
                    {!! Form::label('name', 'Event Org:') !!}
                    {{ Form::input('text', 'name', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('url', 'Event Org url:') !!}
                    {{ Form::input('text', 'url', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('longitude', 'Longitude Code:') !!}
                    {{ Form::input('text', 'longitude', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('latitude', 'Latitude Code:') !!}
                    {{ Form::input('text', 'latitude', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('org_logo', 'Org logo:') !!}
                     {!! Form::file('org_logo', array('class' => '')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('org_logo_title', 'Img Title:') !!}
                    {{ Form::input('text', 'org_logo_title', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('org_logo_alt', 'Img Alt:') !!}
                    {{ Form::input('text', 'org_logo_alt', null, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('org_address', 'Organization Address:') !!}
                    {{ Form::textarea('org_address', null, ['class' => 'form-control','size'=>'30x5']) }}
                </div>
                  <div class="form-group">
                    {!! Form::label('org_contactno', 'Phone:') !!}
                    {{ Form::input('text', ' org_contactno', null, ['class' => 'form-control','required'=>'required']) }}
                </div> 
              
            </div>
            <div class="col-md-6">
                
                
                <div class="form-group">
                    {!! Form::label('org_email', 'Email:') !!}
                    {{ Form::input('text', 'org_email', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                
                <div class="form-group">
                    {!! Form::label('org_website', 'Web Link:') !!}
                    {{ Form::input('text', 'org_website', null, ['class' => 'form-control','required'=>'required']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('active_menus', 'Active Menus:*') !!}<br/>
                    <input value="2" name="active_menus[brochure]" type="checkbox">  Brochure 
                    &nbsp;&nbsp;<input value="2" name="active_menus[interview]" type="checkbox">  Interview
                    &nbsp;&nbsp;<input value="2" name="active_menus[article]" type="checkbox">  Article
                    &nbsp;&nbsp;<input value="2" name="active_menus[gallery]" type="checkbox">  Gallery
                    &nbsp;&nbsp;<input value="2" name="active_menus[pressrelease]" type="checkbox">  Press Release
                </div>
                <div class="form-group">
                    {!! Form::label('exhibitor_description', 'Event Exhibitors:') !!}
                    {{ Form::textarea('exhibitor_description', null, ['class' => 'form-control my-editor','size'=>'30x6']) }}
                </div>
                
                <div class="form-group">
                    {!! Form::label('status', 'Status:') !!}
                    <select name="active_flag" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>        
                <div>&nbsp;&nbsp;</div>         
                <div>&nbsp;&nbsp;</div>         
            </div>                               
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ route('eventorganisers.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
<script>
     var options = {
    filebrowserImageBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Images',
    filebrowserImageUploadUrl: '{{public_path("article")}}/?type=Images&_token=',
    filebrowserBrowseUrl: '<?php echo config("app.url"); ?>article/?type=Files',
    filebrowserUploadUrl: '{{public_path("article")}}/?type=Files&_token='
    };
  $('textarea.my-editor').ckeditor(options);
</script>
@endsection