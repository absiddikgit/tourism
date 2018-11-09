<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{!! asset('admin/favicon.ico') !!}" type="image/x-icon">

    <!-- Google Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> --}}
    {{-- <link rel="stylesheet" href="{!! asset('admin/css/fonts-css.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/css/material-icon.css') !!}"> --}}
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="{!! asset('material-icon/material-icons.css') !!}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{!! asset('admin/plugins/bootstrap/css/bootstrap.css') !!}" rel="stylesheet">


    <!-- Bootstrap Select Css -->
    {{-- <link href="{!! asset('admin/plugins/bootstrap-select/css/bootstrap-select.css') !!}" rel="stylesheet" /> --}}

    <!-- Waves Effect Css -->
    <link href="{!! asset('admin/plugins/node-waves/waves.css') !!}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{!! asset('admin/plugins/animate-css/animate.css') !!}" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="{!! asset('admin/plugins/sweetalert/sweetalert.css') !!}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="{!! asset('admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') !!}" rel="stylesheet">

    <!-- Morris Chart Css-->
    <link href="{!! asset('admin/plugins/morrisjs/morris.css') !!}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{!! asset('admin/css/style.css') !!}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{!! asset('admin/css/themes/all-themes.css') !!}" rel="stylesheet" />

    <!-- toastr -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/toastr.min.css')}}"/>

    {{-- Datepicker --}}
    <link href="{!! asset('datepicker/datepicker.css') !!}" rel="stylesheet" />

    {{-- this style used for borderless table
    --       no need to change this
    --}}
    <style type="text/css">.table.no-border tr td, .table.no-border tr th {border-width: 0;}</style>
    {{-- this style used for borderless table  --}}

    @yield('styles')
</head>

<body class="theme-deep-purple">
    <!-- Page Loader -->
    {{-- <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> --}}
    <!-- #END# Page Loader -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="">{{ config('app.name') }}</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    {{-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> --}}
                    <!-- #END# Call Search -->

                    <li class="pull-right">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>

                        <ul class="dropdown-menu pull-right">
                            <li><a href="" class=" waves-effect waves-block"><i class="material-icons">person</i>Profile</a></li>
                            {{-- <li role="separator" class="divider"></li> --}}
                            <li><a href="" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class=" waves-effect waves-block"><i class="material-icons">input</i>Sign Out</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{!! route('dashboard') !!}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if (Auth::user()->is_admin)
                        <li class="">
                            <a href="{!! route('user.index') !!}">
                                <i class="material-icons">supervisor_account</i>
                                <span>User</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">map</i>
                                <span>Location</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="{!! route('divisions.index') !!}">Division</a>
                                </li>
                                <li>
                                    <a href="{!! route('districts.index') !!}">District</a>
                                </li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="{!! route('places.index') !!}">
                                <i class="material-icons">place</i>
                                <span>Place</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{!! route('hotels.index') !!}">
                                <i class="material-icons">hotel</i>
                                <span>Hotel</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">map</i>
                            <span>Package</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{!! route('package-types.index') !!}">Type</a>
                            </li>
                            <li>
                                <a href="{!! route('packages.index') !!}">Package</a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="{!! route('customers') !!}">
                            <i class="material-icons">people</i>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{!! route('booking.packages') !!}">
                            <i class="material-icons">present_to_all</i>
                            <span>Booking</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{!! route('contacts') !!}">
                            <i class="material-icons">message</i>
                            <span>Inbox</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; {{ date('Y') }} <a href="javascript:void(0);">{{ config('app.name') }}</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            {{-- yield --}}
                @yield('content')
            {{--#END# yield --}}
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{!! asset('admin/plugins/jquery/jquery.min.js') !!}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{!! asset('admin/plugins/bootstrap/js/bootstrap.js') !!}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{!! asset('admin/plugins/jquery-slimscroll/jquery.slimscroll.js') !!}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{!! asset('admin/plugins/node-waves/waves.js') !!}"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="{!! asset('admin/plugins/jquery-validation/jquery.validate.js') !!}"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{!! asset('admin/plugins/jquery-steps/jquery.steps.js') !!}"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{!! asset('admin/plugins/sweetalert/sweetalert.min.js') !!}"></script>

    <!-- Custom Js -->
    <script src="{!! asset('admin/js/pages/forms/form-wizard.js') !!}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{!! asset('admin/plugins/jquery-datatable/jquery.dataTables.js') !!}"></script>
    <script src="{!! asset('admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') !!}"></script>
    <script src="{!! asset('admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js') !!}"></script>

    <!-- Custom Js -->
    <script src="{!! asset('admin/js/admin.js') !!}"></script>
    <script src="{!! asset('admin/js/pages/tables/jquery-datatable.js') !!}"></script>

    <!-- Demo Js -->
    <script src="{!! asset('admin/js/demo.js') !!}"></script>

    <!-- Datepicker -->
    <script src="{!! asset('datepicker/datepicker.js') !!}"></script>
    <script>
        $(function() {
            $('[data-toggle="datepicker"]').datepicker({
                autoHide: true,
                format: 'dd-mm-yyyy',
                zIndex: 2048,
            });
        });
    </script>

    <!-- toastr -->
    <script type="text/javascript" src="{{asset('js/toastr.min.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
            toastr.success("{{Session::get('success')}}")
        @endif
        @if (Session::has('info'))
            toastr.info("{{Session::get('info')}}")
        @endif
    </script>

    {{-- editors --}}
    <script src="{!! asset('admin/plugins/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('admin/js/pages/forms/editors.js') !!}"></script>

    @yield('scripts')


    <!-- Jquery CountTo Plugin Js -->
    {{-- <script src="{!! asset('admin/plugins/jquery-countto/jquery.countTo.js') !!}"></script> --}}

    <!-- Morris Plugin Js -->
    {{-- <script src="{!! asset('admin/plugins/raphael/raphael.min.js') !!}"></script>
    <script src="{!! asset('admin/plugins/morrisjs/morris.js') !!}"></script> --}}

    <!-- ChartJs -->
    {{-- <script src="{!! asset('admin/plugins/chartjs/Chart.bundle.js') !!}"></script> --}}

    <!-- Flot Charts Plugin Js -->
    {{-- <script src="{!! asset('admin/plugins/flot-charts/jquery.flot.js') !!}"></script>
    <script src="{!! asset('admin/plugins/flot-charts/jquery.flot.resize.js') !!}"></script>
    <script src="{!! asset('admin/plugins/flot-charts/jquery.flot.pie.js') !!}"></script>
    <script src="{!! asset('admin/plugins/flot-charts/jquery.flot.categories.js') !!}"></script>
    <script src="{!! asset('admin/plugins/flot-charts/jquery.flot.time.js') !!}"></script> --}}

    <!-- Sparkline Chart Plugin Js -->
    {{-- <script src="{!! asset('admin/plugins/jquery-sparkline/jquery.sparkline.js') !!}"></script> --}}


    {{-- <script src="{!! asset('admin/js/pages/index.js') !!}"></script> --}}

    <!-- Select Plugin Js -->
    {{-- <script src="{!! asset('admin/plugins/bootstrap-select/js/bootstrap-select.js') !!}"></script> --}}
</body>

</html>
