<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('titulo')</title>

    <!-- Font Awesome Icons -->

    <script src="{{ asset('js/vue.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vue-resource.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ URL::asset('fullcalendar/css/main.css') }}">
    <script src="{{ URL::asset('fullcalendar/js/main.min.js') }}"></script>
    <script src="{{ URL::asset('fullcalendar/js/locales-all.js') }}"></script>

    <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/adminlte.min.css') }}">

    <!-- Google Font: Source Sans Pro -->

    <meta name="token" id="token" value="{{ csrf_token() }}">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>

                        {{ Session::get('') }}
                        <!--<span class="badge badge-danger navbar-badge">3</span>-->
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <a href="{{ url('logout') }}" class="dropdown-item dropdown-footer"><i
                                    class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>


                    </div>
                </li>


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- panel-------------------------------------------------------------- -->
            @yield('panel')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('contenido')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @stack('scripts')

    <script src="{{ URL::asset('js/apis/agenda/agenda.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ URL::asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>
