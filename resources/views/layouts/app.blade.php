<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/popup.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    
                    <span class="logo-mini"><img src="assets/layouts/layout/img/logo.png" alt="Utopians"/></span>
            <span class="logo-lg"></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="student_register">Student Register</a></li>
                        @else
                            <li class="nav-link">
                               

                               
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                               
                            </li>
                          
                        @endguest
                    </ul>
                </div>
            
            </div>
        </nav>

        <main class="py-4">
           @yield('content')
        </main>
         
    </div>
    
    <script src="{{ URL::asset('js/dashboard/toastr.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/vue.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/vue-select-main.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/vue-select.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/axios.min.js') }}" type="text/javascript"></script>
    @yield('script')

</body>
</html>
