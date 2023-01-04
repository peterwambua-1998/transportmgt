
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Scripts -->
      
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
       
        <link href="{{ asset('css/css/bootstrap.min.css') }}" rel="stylesheet">
        
    
    
        <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
          <!-- Required Fremwork -->
    
          <!-- themify-icons line icon -->
          <link rel="stylesheet" type="text/css" href="{{asset('css/icon/themify-icons/themify-icons.css')}}">
          <link rel="stylesheet" type="text/css" href="{{asset('css/icon/font-awesome/css/font-awesome.min.css')}}">
          <!-- ico font -->
          <link rel="stylesheet" type="text/css" href="{{asset('css/icon/icofont/css/icofont.css')}}">
          <!-- Style.css -->
          <link rel="stylesheet" type="text/css" href="{{asset('css/css/style.css')}}">
          <link rel="stylesheet" type="text/css" href="{{asset('css/css/jquery.mCustomScrollbar.css')}}">
    
          @yield('css')
          
    </head>
    <body>
        <div id="app" ></div>
            <div class="theme-loader">
                <div class="loader-track">
                    <div class="loader-bar"></div>
                </div>
            </div>
            {{--
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
    
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
    --}}
    
            <div id="pcoded" class="pcoded">
                <div class="pcoded-overlay-box"></div>
                <div class="pcoded-container navbar-wrapper">
                    @include('layouts.nav')
    
                    <div class="pcoded-main-container">
                        <div class="pcoded-wrapper">
                            @include('layouts.sidenav')
    
                            <div class="pcoded-content">
                                <div class="pcoded-inner-content">
                                    <div class="main-body">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    
                </div>
            </div>
    
           
       
       
            
    
        
        <script defer src="{{ asset('/js/js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script defer src="{{ asset('/js/js/chart/Chart.js') }}"></script>
        <script defer src="{{ asset('/js/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
        
        
        <script defer src="{{ asset('/js/js/modernizr/modernizr.js') }}"></script>
        <script defer src="{{ asset('/js/js/morris/morris.js') }}"></script>
        <script defer src="{{ asset('/js/js/raphael/raphael.min.js') }}"></script>
        <script defer src="{{ asset('/js/js/bootstrap-growl.min.js') }}"></script>
        <script defer src="{{ asset('/js/js/common-pages.js') }}"></script>
        <script defer src="{{ asset('/js/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script defer src="{{ asset('/js/js/jquery.mousewheel.min.js') }}"></script>
        <script defer src="{{ asset('/js/js/pcoded.min.js') }}"></script>
        <script defer src="{{ asset('/js/js/modernizr/css-scrollbars.js') }}"></script>
        
        <script defer src="{{ asset('/js/js/vartical-demo.js') }}"></script>
    
        <script defer src="{{ asset('/js/js/script.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    
        @yield('js')
    </body>
    </html>
    