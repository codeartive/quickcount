<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quick Count Application</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('assets/css/vendor/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/pe-icon-7-stroke.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/select2/css/select2.min.css')}}">

    <script type="text/javascript" src="{{asset('assets/js/vendor/html5shiv.min.js')}}"></script>
    <link href="{{asset('assets/css/vendor/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/vendor/jqvmap.min.css')}}" rel="stylesheet">

    {{-- <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" /> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" /> --}}

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>

    @yield('additional-css')
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="menu-title">Dashboard</li>
                    <li class="active">
                        <a href="{{route('dashboard')}}"><i class="menu-icon fa fa-pie-chart"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Master Data</li>
                    <li><a href="{{route('view.kecamatan')}}"><i class="menu-icon fa fa-building"></i>Kecamatan</a></li>
                    <li><a href="{{route('view.kelurahan')}}"><i class="menu-icon fa fa-institution"></i>Kelurahan</a></li>
                    <li><a href="{{route('view.rw')}}"><i class="menu-icon fa fa-home"></i>Rukun Warga</a></li>
                    {{-- <li><a href="{{route('view.rt')}}"><i class="menu-icon fa fa-id-badge"></i>Rukun Tetangga</a></li> --}}
                    <li><a href="{{route('view.tps')}}"><i class="menu-icon fa fa-pencil"></i>TPS</a></li>
                    <li><a href="{{route('view.partai')}}"><i class="menu-icon fa fa-flag"></i>Partai</a></li>
                    <li><a href="{{route('view.calon-legislatif')}}"><i class="menu-icon fa fa-users"></i>Calon Legislatif</a></li>
                    <li class="menu-title">Voting</li>
                    <li><a href="{{route('view.voting')}}"><i class="menu-icon fa fa-edit"></i>Entry Vote Data</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header" style="background:#ffef01">
            <div class="top-left">
                <div class="navbar-header" style="background:#ffef01">
                    <a class="navbar-brand" href="./"><img src="{{asset('images/Logo_Golkar.png')}}" width="25" alt="Logo"><span style="font-size: medium;color: black;margin-left: 20px;"><strong>Quick Count Application</strong></span></a>
                    <a class="navbar-brand hidden" href="./"><img src="{{asset('images/logo2.png')}}" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    {{-- <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary">4</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{asset('images/admin.jpg')}}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <span class="nav-link"><strong>{{Auth::user()->name}}</strong></span>
                            <hr style="margin:1px;">

                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2019 Codeartive
                    </div>
                    {{-- <div class="col-sm-6 text-right">
                        Theme by <a href="https://colorlib.com">Ela</a>
                    </div> --}}
                </div>
            </div>
        </footer>

        @yield('modal-area')

        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="{{asset('assets/js/vendor/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery.matchHeight.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>

    <!--  Chart js -->
    <script src="{{asset('assets/js/vendor/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/chartjs-plugin-labels.min.js')}}"></script>

    <!-- Data Table -->
    <script src="{{asset('assets/js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/init/datatables-init.js')}}"></script>

    <script src="{{asset('assets/select2/js/select2.min.js')}}"></script>
    <!--Chartist Chart-->
    {{-- <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script> --}}

    {{-- 
    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script> --}}

    <!--Local Stuff-->
    @yield('additional-js')

    @if (session('message'))
        <script type="text/javascript">
            $(document).ready(function(){
                var params = {!! json_encode(session('message')) !!}
                swal(params);
                // swal({
                //     title: "Good job!",
                //     text: "You clicked the button!",
                //     icon: "success",
                //     button: "OK",
                // });
            })
        </script>
    @endif

    
</body>
</html>
