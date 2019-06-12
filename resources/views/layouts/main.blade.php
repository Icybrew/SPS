<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <!--    Defaults    -->
        <meta charset="utf-8">
        <title>{{ config('app.name', 'SPS') }}</title>
        <meta name="description" content="Sveikatos priežiūros sistema">

        <!--    Mobile    -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 

        <!-- Styles -->
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/819a6d8daa.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>

        <!-- Header -->
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'SPS') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Middle of Navbar -->
                    <ul class="nav navbar-nav center_nav pull-right">
                        <li class="nav-item{{ Request::is('/') ? '  active' : NULL }}">
                            <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link{{ Request::is('services*') ? ' active' : NULL }}" href="{{ route('services.index') }}">Services</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link{{ Request::is('specialists*') ? ' active' : NULL }}" href="{{ route('specialists.index') }}">Specialists</a>
                        </li>
                        <li class="nav-item{{ Request::is('contacts*') ? ' active' : NULL }}">
                            <a class="nav-link" href="{{ route('contacts.index') }}">Contacts</a>
                        </li>
@if(Auth::check() && Auth::user()->hasRole(config('roles.name.admin')))
                        <li class="nav-item{{ Request::is('admin*') ? ' active' : NULL }}">
                            <a class="nav-link" href="{{ route('admin.index') }}">Admin</a>
                        </li>
@endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->firstname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header End -->

        <!-- Main -->
        <main>
            @yield('content')
        </main>
        <!-- Main End -->

        <!-- Footer -->
        <footer class="footer-area shadow-sm p-5">
            <div class="container text-light my-5">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="single-footer-widget">
                            <h6>Menu</h6>
                            <ul class="footer-nav">
                                <li>
                                    <a href="{{ route('home.index') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('services.index') }}">Services</a>
                                </li>
                                <li>
                                    <a href="{{ route('specialists.index') }}">Specialists</a>
                                </li>
                                <li>
                                    <a href="{{ route('contacts.index') }}">Contacts</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="single-footer-widget">
                            <h6>Contact Us</h6>
                            <p>SPS, Vilnius, Lithuania</p>
                            <h5><i class="fas fa-phone"></i> +370 123 45678</h5>
                            <h5><i class="fas fa-envelope"></i> info@sps.lt</h5>
                        </div>
                    </div>
                    <div class="col-lg-5 col-lg-5 col-md-12 col-sm-12">
                        <div class="single-footer-widget">
                            <h6>Info</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

    </body>
</html>
