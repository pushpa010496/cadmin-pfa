
@extends('../layouts/app')

@section('header')
    <div class="page-header clearfix">
        <h3>
            <i class="fa fa-th-list" aria-hidden="true"></i>Select Table from your Data Base
           
        </h3>
    </div>

@endsection

@section('content')

   <div class="row">
  <div class="col-md-offset-3 col-md-6">
              

                <?php
                //Tables_in_plantaut_laravel
               // print_r($tables);

                //exit;
              
                ?>
                <div class="form-group">
              {!! Form::open(array('route' => 'exportdata','method'=>'POST','files'=>'true')) !!}
                
                <div class="form-group">
                  
                    <select name="tableinfo" id="tableinfo" class="form-control" required="required">
                        <option value="">-- Select one --</option>
                     
                         @foreach ($tables as $key => $value)

                        <option value="<?php echo $value->Tables_in_pharmafo_mvcpfa; ?>"><?php echo $value->Tables_in_pharmafo_mvcpfa; ?></option>
                        @endforeach
                        
                    </select>
                </div>
                 
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Export to excel</button>
                   <!--  <a class="btn btn-sm btn-default pull-right" href="{{ route('cmspages.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a> -->
                </div>
            </form>

        </div>
    </div>
@endsection