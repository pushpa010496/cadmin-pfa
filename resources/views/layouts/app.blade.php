<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">    
    <link rel="stylesheet" href="{{ asset('css/superhero-bootstrap.css') }}">
    <link href="{{ config('app.url').'css/custom.css' }}" rel="stylesheet">

    <style type="text/css">
    #header-nav .navbar-nav > li > .dropdown-menu {
    margin-top: 0;
    border-top-right-radius: 0;
    border-top-left-radius: 0;
    background-color: #df691a;
}

#mega-nav .navbar-nav > li{width: auto;}
#mega-nav .navbar-nav>li>.dropdown-menu {
  margin-top: 1px;
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
}

#mega-nav .navbar-default .navbar-nav>li>a {
  width: 300px;
  font-weight: bold;
}

#mega-nav .mega-dropdown {
  position: static !important;
  width: 100%;
}


#mega-nav .mega-dropdown-menu {
  padding: 20px 0px;
  width: 100%;
  box-shadow: none;
  -webkit-box-shadow: none;
}

#mega-nav .mega-dropdown-menu > li > ul {
  padding: 0;
  margin: 0;
}

#mega-nav .mega-dropdown-menu > li > ul > li {
  list-style: none;
}

#mega-nav .mega-dropdown-menu > li > ul > li > a {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.428571429;
  color: #999;
  white-space: normal;
}

#mega-nav .mega-dropdown-menu > li ul > li > a:hover,
.mega-dropdown-menu > li ul > li > a:focus {
  text-decoration: none;
  color: #444;
  background-color: #f5f5f5;
}

#mega-nav .mega-dropdown-menu .dropdown-header {
  color: #df691a;
  font-size: 18px;
  font-weight: bold;
}

#mega-nav .mega-dropdown-menu form {
  margin: 3px 20px;
}

#mega-nav .mega-dropdown-menu .form-group {
  margin-bottom: 3px;
}
.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus{background-color: #273442;}

table a:not(.btn), .table a:not(.btn){color: #000;font-weight: bold;}

</style>
  @yield('style')

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" id="header-nav">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    @if (Auth::guest())
                    @else
                    
                    @if(Auth::user()->can('settings'))
                    <li>
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Settings
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                     <li class="col-sm-4">
                              <ul>
                                
                                <li><a href="{{ url('role') }}"> Roles</a></li>
                                <li><a href="{{ url('users') }}"> Users</a></li>
                                <li><a href="{{ url('permissions') }}"> Permissons</a></li>
                              </ul>
                            </li>
                      </ul>
                      
                    </div>
                    </li>
                   

                   
                   @endif
                      <li>
                           <ul class="nav navbar-nav pull-left">                       
                               
                                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Track
                                  <span class="caret"></span></button>
                                  <ul class="dropdown-menu">
                                 <li class="">
                                          <ul>
                                            
                                           <li><a href="{{ url('tracklinkgen') }}"> Track link Generation</a></li>
                                            <li><a href="{{ url('trackreport') }}"> Url Track Report</a></li>
                                          </ul>
                                        </li>
                                  </ul>
                              </ul>
                      </li>
                    <ul class="nav navbar-nav pull-right">                       
                       

                         <a href="{{url('/dataexport')}}"><button type="button" class="btn btn-warning"><i class="fa fa-share-square-o" aria-hidden="true"></i> Data Reports</button></a>
                         
                         <a href="{{url('/fileupload')}}"><button type="button" class="btn btn-info"> <i class="fa fa-upload"></i> Image Live Link</button></a>

                        @if(Request::segment(1) == 'interviews')                     
                        <a href="{{route('interview.position')}}"><button type="button" class="btn btn-warning">Interview Positions</button></a>
                      
                        @else
                        @endif
                         <a href="{{url('/promotionleads')}}"><button type="button" class="btn btn-warning"><i class="" aria-hidden="true"></i> Promotions Leads</button></a>
                      </ul>
                  @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        
                        @else
                           
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    
                 @guest
                    @else
             <div class="container">
                  <nav class="navbar navbar-default" id="mega-nav">
                    <div class="navbar-header">
                      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>
                    <div class="collapse navbar-collapse js-navbar-collapse">
                       <!-- <ul class="nav navbar-nav"> 


                                      
                        <li class="dropdown mega-dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">User Management <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i></a>
                           <ul class="dropdown-menu mega-dropdown-menu row">

                            <li class="col-sm-4">
                              <ul>
                                <li class="dropdown-header">Company</li>
                                <li><a href="{{ url('role') }}"> Roles</a></li>
                                <li><a href="{{ url('users') }}"> Users</a></li>
                              </ul>
                            </li>
                          </ul>

</li>
</ul> -->

                    <ul class="nav navbar-nav"> 


                                      
                        <li class="dropdown mega-dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Editorial Section <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i></a>

                          <ul class="dropdown-menu mega-dropdown-menu row">

                            <li class="col-sm-4">
                              <ul>
                               
                                <li><a href="{{ url('editorialcategory') }}"> Categories</a></li>
                               
                                
                              </ul>
                            </li>

                            <li class="col-sm-4">
                              <ul>
                            
                                <li><a href="{{ url('editorialarticle') }}"> Editorial Articles</a></li>
                                                               
                              </ul>
                            </li>

                              <li class="col-sm-4">
                              <ul>
                              
                                <li><a href="{{ url('contributors') }}"> Contributors</a></li>                               
                                
                              </ul>
                            </li>
                           
                            <li class="col-sm-4">
                              <ul>
                            
                                <li><a href="{{ url('seriesarticle') }}"> Series Articles</a></li>
                                                               
                              </ul>
                            </li>
                          </ul>
                        </li>                        
                      </ul> 
                     
                    <ul class="nav navbar-nav">
                        <li class="dropdown mega-dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Content Marketing <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i></a>
                          <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-4">
                              <ul>
                                
                                <li><a href="{{ url('e-newsletters') }}">E-news Letters</a></li>
                             
                                <li class="divider"></li>

                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                                
                                <li><a href="{{ url('clientemailblast') }}">Email Blast</a></li>  
                                <li class="divider"></li>
                                
                              </ul>
                            </li>
                           
                          </ul>
                        </li>     
                      </ul> 

                      

                      <ul class="nav navbar-nav">
                        <li class="dropdown mega-dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Magzines <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i></a>
                          <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-4">
                              <ul>
                               
                                <li><a href="{{ url('issues') }}">Issue</a></li>
                                <li><a href="{{ url('ebooks') }}">E-Book</a></li>
                               <li><a href="{{ url('clientadverts') }}">Client Adverts</a></li>  

                                <li class="divider"></li>

                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                                <li><a href="{{ url('authorguideline') }}">Author Guidelines</a></li>
                                 <li><a href="{{ url('advisorboard') }}">Advisor Board</a></li>
                                <li class="divider"></li>
                                
                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                                <li><a href="{{ url('callender') }}">Callender</a></li>
                                <li><a href="{{ url('mediapack') }}">Media Pack</a></li>
                                  
                                <li class="divider"></li>                              
                              </ul>
                            </li>
                          </ul>
                        </li>     
                      </ul> 

                       <ul class="nav navbar-nav">
                        <li class="dropdown mega-dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Industrial Updates <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i></a>
                          <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-4">
                              <ul>
                                
                                <li><a href="{{ url('news') }}">News</a></li>
                               <li><a href="{{ url('pressrelease') }}">Press Realease</a></li>  
                                <li class="divider"></li>

                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                               
                                 <li><a href="{{ url('events') }}">Events</a></li>
                                 <li><a href="{{ url('eventorganisers') }}">Event Organisers</a></li>
                                <li class="divider"></li>
                                
                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                             
                                  <li><a href="{{ url('reportcategories') }}">Report Categories</a></li>
                                <li class="divider"></li>                              
                              </ul>
                            </li>
                          </ul>
                        </li>     
                      </ul>
                      <ul class="nav navbar-nav">
                        <li class="dropdown mega-dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Knowldge Bank <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i></a>
                          <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-4">
                              <ul>
                               
                                <li><a href="{{ url('article') }}">Articles</a></li>
                               <!-- <li><a href="{{ url('seocompanies') }}">Author For Article</a></li>  -->
                                <li><a href="{{ url('interview') }}">Interviews</a></li>
                                 <li><a href="{{ url('project') }}">Projects</a></li> 
                                <li class="divider"></li>

                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                               
                                 <li><a href="{{ url('industryreport') }}">Industry Reports</a></li>
                                  <li><a href="{{ url('reports') }}">Global Reports</a></li>
                                   <li><a href="{{ url('technotrends') }}">Techno Trends</a></li>
                                    <li><a href="{{ url('reaserchinsites') }}">Research Insight</a></li>
                                <li class="divider"></li>
                                
                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                               <li><a href="{{ url('bookshelf') }}">Book Shelf</a></li>
                                <li><a href="{{ url('casestudies') }}">Case Studies</a></li>

                                  <li><a href="{{ url('whitepaper') }}">White Papers</a></li>
                                <li class="divider"></li>                              
                              </ul>
                            </li>
                          </ul>
                        </li>     
                      </ul> 
                      
                       <ul class="nav navbar-nav">
                        <li class="dropdown mega-dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Banner Management <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i></a>
                          <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-4">
                              <ul>
                                
                                <li><a href="{{ url('banners') }}">Add Banner</a></li>
                               <li><a href="{{ url('seocompanies') }}">Banners Clicks</a></li>  
                                <li class="divider"></li>

                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                                
                                 <li><a href="{{ url('sliders') }}">Add Slider</a></li>
                                  <li><a href="{{ url('seoeventorg') }}">Slider Clickss</a></li>
                                <li class="divider"></li>
                                
                              </ul>
                            </li>
                            <!-- <li class="col-sm-4">-->
                            <!--  <ul>-->
                                
                            <!--     <li><a href="{{url('bannersactive')}}">Active Banners</a></li>-->
                            <!--      <li><a href="{{url('slidersactive')}}">Active Sliders</a></li>-->
                            <!--    <li class="divider"></li>-->
                                
                            <!--  </ul>-->
                            <!--</li>-->

                             <li class="col-sm-4">
                              <ul>
                                
                                <li><a href="{{ url('trackbanner') }}">Banner Report</a></li>
                               <li><a href="{{ url('trackenewsletter') }}">Enewsletter Report</a></li>  
                                <li><a href="{{ url('trackedm') }}">Edm Report</a></li>  
                                <li class="divider"></li>

                              </ul>
                            </li>
                           
                          </ul>
                        </li>     
                      </ul> 
                     <ul class="nav navbar-nav">
                        <li class="dropdown mega-dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Adevrtise <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i></a>
                          <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-4">
                              <ul>
                             
                                <li><a href="{{ url('print') }}">Print</a></li>
                               <li><a href="{{ url('online') }}">Online</a></li> 
                                <li><a href="{{ url('targetmarket') }}">Target Market</a></li> 
                                <li class="divider"></li>

                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                                 <li><a href="{{ url('targetaudience') }}">Target Audiance</a></li>
                                 <li><a href="{{ url('techspec') }}">Tech Spec</a></li>
                                <li class="divider"></li>
                                
                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                               
                                  <li><a href="{{ url('terms') }}">Terms</a></li>
                                  <li><a href="{{ url('advertisers') }}">Adevetisers</a></li>
                                <li class="divider"></li>                              
                              </ul>
                            </li>
                          </ul>
                        </li>     
                      </ul>
                            



                            <ul class="nav navbar-nav">
                        <li class="dropdown mega-dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Managements <i class="fa fa-chevron-down text-primary" aria-hidden="true"></i></a>
                          <ul class="dropdown-menu mega-dropdown-menu row">
                            <li class="col-sm-4">
                              <ul>
                             
                                <li><a href="{{ url('cmspages') }}">CMS Pages</a></li>
                              
                                <li class="divider"></li>

                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                                 <li><a href="{{ url('testimonials') }}">Testimonials</a></li>
                                
                                <li class="divider"></li>
                                
                              </ul>
                            </li>
                            <li class="col-sm-4">
                              <ul>
                               
                                  <li><a href="{{ url('seopage') }}">SEO Main Pages</a></li>
                                 
                                <li class="divider"></li>                              
                              </ul>
                            </li>
                          </ul>
                        </li>     
                      </ul>

                    </div>
                    <!-- /.nav-collapse -->
                  </nav>
                </div>
                @endguest

<div class="container-fluid">   
        <div class="col-md-offset-3 col-md-6">
            @if(session('message'))
            <div class="alert alert-{{ session('message_type') }} alert-dismissible" id="success-alert" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{@session('message')}}

            </div>
            @endif
            @if(session('position_type'))
            <div class="alert alert-{{ session('message_type') }} alert-dismissible" id="success-alert" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{@session('position_type')}}
                 </div>
            @endif
        </div>
    <div class="col-md-12">
             @yield('header')
             @yield('content')
    </div>
      
    </div>

    <!-- Scripts -->
       <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
   <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Include Editor style. -->
<script src="{{ url('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ url('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>

 <script type="text/javascript">
        jQuery(document).on('click', '.mega-dropdown', function(e) {
            e.stopPropagation()
            });
    </script>
     <script>
       
        $(document).ready (function(){
           $("#success-alert").alert();
                $("#success-alert").fadeTo(2000, 2000).slideUp(2000, function(){
               $("#success-alert").slideUp(2000);
                });
        });
    </script>
    @yield('scripts')
</body>
</html>
