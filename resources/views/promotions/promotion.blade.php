@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Promotions</div>

                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status') }}
                        </div>
                    @endif

                    <h4> Forms</h4>

                    @foreach($downloads as $val)

                    <ul>
                        @if($val->type)
                        <li><a href="{{  url('leads/download/'.$val->type) }}">{{$val->type}}</a></li>

                        @endif
                    </ul>
                    @endforeach


                    <h4> Subscriptions</h4>

                    @foreach($subscribers as $val)

                    <ul>
                        @if($val->type)
                        <li><a href="{{  url('leads/forms/'.$val->type) }}">{{$val->type}}</a></li>

                        @endif
                    </ul>
                    @endforeach

                     <h4> Webinars</h4>

                    @foreach($webinars as $val)

                    <ul>
                        @if($val->type)
                        <li><a href="{{  url('leads/webinars/'.$val->type) }}">{{$val->type}}</a></li>

                        @endif
                    </ul>
                    @endforeach

                    <h4> Promotion in our website!</h4>

                    @foreach($promotiondata as $promotionpages)

                    <ul>
                        @if($promotionpages->type)
                        <li><a href="{{  url('leads/'.$promotionpages->type) }}">{{$promotionpages->type}}</a></li>

                        @endif
                    </ul>
                    @endforeach
                    @foreach($cpc as $cpc)

                <ul>
                    @if($cpc->type)
                    <li><a href="{{  url('cpcleads/'.$cpc->type) }}">{{$cpc->type}}</a></li>

                    @endif
                </ul>
                @endforeach

                <h4> Promotion in magazine</h4>

               @foreach($magazine_subscribe as $promotionpages)

            <ul>
            @if($promotionpages->type)
               <li><a href="{{  url('leads/subscribe/'.$promotionpages->type) }}">{{$promotionpages->type}}</a></li>

            @endif
              </ul>
              @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection