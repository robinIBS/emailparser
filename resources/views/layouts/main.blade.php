<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Email Parser') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <div class="ajax-loader">
                <img src="{{ url('images/ajax-loader.gif') }}" class="img-responsive" />
            </div>



            <nav class="navbar navbar-default navbar-static-top">
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
                            {{ config('app.name', 'Email Parser') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                            <li><a href="{{ url('create_filter') }}">Create Filter</a></li>
                            <li><a href="{{ url('create_filter_group') }}">Create Filter Group</a></li>
                            <li><a href="{{ url('notifications') }}">Notifications</a></li>

                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
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
            <div class="container">
                <!--**** Display the error message ****-->
                <div class="alert alert-danger alert-dismissable error-div ">
                    <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>-->
                    <a class="close" onclick="$('.error-div').hide()">×</a> 
                    <strong>Error!</strong> <p id="errors"></p>
                </div>


                <div class="alert alert-success alert-dismissable success-div">
                    <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>-->
                    <a class="close" onclick="$('.success-div').hide()">×</a>
                    <strong>Success!</strong> <p id="success-msg"></p>
                </div>
            </div>

            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/jquery.serializeObject.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <!--<script src="{{ asset('js/bootstrap.min.js') }}"></script>-->
        @stack('scripts')
        <script>
                        $(document).ready(function () {
                            $(function () {
                                $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
                            });
                            
                            $('.select2').select2();
                            
                        });
        </script>
    </body>
</html>
