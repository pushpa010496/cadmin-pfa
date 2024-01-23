@extends('../layouts/app')
@section('content')
<div class="content">
       

    <div class="row">
        <div class="col-md-offset-2 col-md-8 col-md-offset-2">
            @if($prnews->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center"><h5>#</h5></th>
                            <th><h5>Title</h5></th>     
                            <th><h5>issuer</h5></th>                         
                                  
                            <th class="text-right"><h5>OPTIONS</h5></th>
                        </tr>
                    </thead>

                    <tbody><?php $i=1; ?>
                        @foreach($prnews as $value)
                            <tr>
                                <td class="text-center"><h5>{{$i}}</h5></td>
                              
                              
                                <td><h5>{{$value->news_head}}</h5></td>

                                  <td><h5>{{$value->issuer}}</h5></td>
                              
                                
                                <td class="text-right">
                                   
                                    <a class="btn btn-sm btn-primary" href="{{ route('companies.show', $value->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                    
                                    <a class="btn btn-sm btn-warning" href="{{ route('companies.edit', $value->id) }}">
                                       <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit
                                    </a>

                                    <form action="{{ route('companies.destroy', $value->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-2" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>
                            </tr><?php $i++; ?>
                             <!-- Modal -->
                               
                                 
                        @endforeach
                    </tbody>
                </table>
               
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>
    </div>

@endsection 