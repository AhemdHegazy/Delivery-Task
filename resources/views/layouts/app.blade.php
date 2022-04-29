<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name', 'Delivery') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset("assets/css/material-kit.css")}}?v=2.0.4" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset("assets/demo/demo.css")}}" rel="stylesheet" />
    <link href="http://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" />
    <style>
        .navbar.navbar-transparent {
            background: linear-gradient(60deg, #ab47bc, #7b1fa2) !important;
            box-shadow: 0 5px 20px 0px rgba(0, 0, 0, 0.2), 0 13px 24px -11px rgba(156, 39, 176, 0.6);
            padding-top: 9px;
            color: #fff;
        }
        .btn.btn-fab .material-icons, .btn.btn-fab .fa, .btn.btn-just-icon .material-icons, .btn.btn-just-icon .fa {
            margin-top: 0;
            position: absolute;
            width: 100%;
            transform: none;
            left: 0;
            top: 0;
            height: 100%;
            line-height: 25px;
            font-size: 20px;
        }
        .btn.btn-fab, .btn.btn-just-icon {
            font-size: 22px;
            height: 25px;
            min-width: 25px;
            width: 25px;
            padding: 0;
            overflow: hidden;
            position: relative;
            line-height: 25px;
            margin-right: 10px;
        }
    </style>
</head>
<body class="index-page sidebar-collapse">
    <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="/">
                    Delivery System</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                                    <span class="material-icons">
                                    home
                                    </span>Home
                        </a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('check') }}">
                                    <span class="material-icons">
                                    check
                                    </span> Check Delivery Status
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route("home")}}">
                                    <span class="material-icons">
                                    home
                                    </span>Home
                            </a>
                        </li>
                        @if(auth()->user()->role == "user")
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('check') }}">
                                    <span class="material-icons">
                                    check
                                    </span> Check Delivery Status
                                </a>
                            </li>

                        @elseif(auth()->user()->role == "admin")
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <span class="material-icons">
                                persons
                                </span> Users
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.staffs.index') }}">
                                <span class="material-icons">
                                perm_identity
                                </span> Staffs
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <span class="material-icons">
                                persons
                                </span> Users
                                </a>
                            </li>
                    @endif


                    @endif
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="material-icons">login</i> Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <span class="material-icons">
                                    verified_user
                                    </span> Register
                                </a>
                            </li>

                        @endif
                    @else
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                             <span class="material-icons">
                                      person
                                    </span>{{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-with-icons">
                                <a href="{{route("user.profile.index")}}" class="dropdown-item">
                                    <i class="material-icons">person</i> Profile
                                </a>

                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="dropdown-item">
                                    <i class="material-icons">logout</i> Logout
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
    @yield('content')
    <script src="{{asset("assets/js/core/jquery.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/js/core/popper.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/js/core/bootstrap-material-design.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/js/plugins/moment.min.js")}}"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="{{asset("assets/js/plugins/bootstrap-datetimepicker.js")}}" type="text/javascript"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{asset("assets/js/plugins/nouislider.min.js")}}" type="text/javascript"></script>
    <!--	Plugin for Sharrre btn -->
    <script src="{{asset("assets/js/plugins/jquery.sharrre.js")}}" type="text/javascript"></script>
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{asset("assets/js/material-kit.js")}}?v=2.0.4" type="text/javascript"></script>

    @yield("scripts")
</body>
</html>
