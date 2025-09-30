<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PIKEMAS DISKOMINFO</title>
    <link rel='icon' href="{{URL::asset('assets/img/logo.png')}}" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="{{URL::asset('assets/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{URL::asset('assets/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{URL::asset('assets/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{URL::asset('assets/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{URL::asset('assets/img/favicon.png')}}" rel="icon" type="image/png">
    <link href="{{URL::asset('assets/img/favicon.ico')}}" rel="shortcut icon">



    {{-- CSS TABLE--}}
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/datatables-net/datatables.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/separate/vendor/datatables-net.min.css')}}">
    {{--END TABLE--}}

    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/lobipanel/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/separate/vendor/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/jqueryui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/separate/pages/widgets.min.css')}}">

    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <link href="{{URL::asset('assets/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/main.css')}}" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            padding-top: 70px;
            /* agar konten tidak ketiban header */
        }

        /* Sidebar style */
        .sidebar {
            position: fixed;
            top: 65px;
            left: 0;
            height: calc(100% - 65px);
            width: 220px;
            background: #2c313e;
            color: #fff;
            transition: width 0.3s;
            overflow-y: auto;
            z-index: 999;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        /* Header kecil di dalam sidebar untuk toggle */
        .sidebar-header {
            display: flex;
            justify-content: flex-end;
            /* default di kanan */
            padding: 10px;
            position: relative;
        }


        .sidebar a {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        /* Link menu */
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background: #1a1d25;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 18px;
            min-width: 25px;
            text-align: center;
        }

        .sidebar.collapsed a span {
            display: none;
        }

        .sidebar.collapsed~.main-content {
            margin-left: 70px;
        }


        /* Header */
        .site-header {
            height: 65px;
            background: #fff;
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .site-header .site-logo img {
            display: block;
        }

        /* Content */
        .page-content {
            margin-left: 240px;
            padding: 15px 20px;
            padding-top: 10px;
            transition: margin-left 0.3s;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #c9e7f2, #d6c8f5);
        }



        /* Tombol toggle */
        .toggle-btn {
            background: #1e1e1e;
            border: none;
            color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 15px;
        }

        /* User menu */
        .user-menu img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        /* Toggle Button */
        .toggle-btn {
            background: #fff;
            /* putih polos */
            border: none;
            color: #333;
            /* ikon gelap */
            font-size: 10px;
            padding: 8px 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .toggle-btn:hover {
            background: #f1f1f1;
            /* abu muda saat hover */
        }
    </style>
</head>

<body class="horizontal-navigation">

    <!-- Header -->
    <header class="site-header">
        <div class="container-fluid d-flex align-items-center gap-3">
            <a href="#" class="site-logo">
                <img src="{{ URL::asset('assets/img/mentawai.png') }}" alt="Logo" height="40" class="d-none d-md-block me-2">
                <img src="{{ URL::asset('assets/img/logo_kominfo.png') }}" alt="Logo" height="35">
            </a>
        </div>
        <!-- User Info -->
        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="site-header-shown">
                    <div class="dropdown user-menu">
                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{URL::asset('assets/img/avatar-2-64.png')}}" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                            <a class="dropdown-item" href="{{ route('login.logout') }}"><span class="font-icon glyphicon glyphicon-log-out"></span>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
                <!--.site-header-shown-->
                <div class="site-header-collapsed-in text-right">
                    <div class="font-weight-bold">Hi, {{\App\Util\Helper::firstUserNameLogin()}}</div>
                </div>

                <!--site-header-content-in-->
            </div>
            <!--.site-header-content-->
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">

        <!-- Tombol Toggle -->
        <div class="sidebar-header">
            <button id="toggleSidebar" class="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <a href="{{Route('atasan.dashboard.index')}}">
            <i class="fa-solid fa-gauge"></i> <span>DASHBOARD</span>
        </a>
        <a class="nav-link" href="{{Route('atasan.instansi.index')}}">
            <i class="fa-solid fa-building"></i> <span>INSTANSI</span>
        </a>
        <a class="nav-link" href="{{Route('atasan.barang.index')}}">
            <i class="fas fa-box"></i> <span>BARANG</span>
        </a>
        <a class="nav-link" href="{{Route('atasan.peminjaman.index')}}">
            <i class="fas fa-hand-holding"></i> <span>PEMINJAMAN</span>
        </a>
        <a class="nav-link" href="#">
            <i class="fa-solid fa-file-lines"></i> <span>LAPORAN</span>
        </a>
    </div>

    <!-- Konten -->
    <div class="page-content">
        <div class="container-fluid">
            @yield('atasan.content')
        </div>
    </div>

    <script src="{{URL::asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/lib/popper/popper.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/lib/tether/tether.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/lib/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/plugins.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('assets/js/lib/jqueryui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/lib/lobipanel/lobipanel.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    {{--JS TABLE--}}
    <script src="{{URL::asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>
    {{--END TABLE--}}

    <script>
        $(document).ready(function() {
            try {
                $('.panel').lobiPanel({
                    sortable: true
                }).on('dragged.lobiPanel', function(ev, lobiPanel) {
                    $('.dahsboard-column').matchHeight();
                });
            } catch (err) {}

            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Day');
                dataTable.addColumn('number', 'Values');
                // A column for custom tooltip content
                dataTable.addColumn({
                    type: 'string',
                    role: 'tooltip',
                    'p': {
                        'html': true
                    }
                });
                dataTable.addRows([
                    ['MON', 130, ' '],
                    ['TUE', 130, '130'],
                    ['WED', 180, '180'],
                    ['THU', 175, '175'],
                    ['FRI', 200, '200'],
                    ['SAT', 170, '170'],
                    ['SUN', 250, '250'],
                    ['MON', 220, '220'],
                    ['TUE', 220, ' ']
                ]);

                var options = {
                    height: 314,
                    legend: 'none',
                    areaOpacity: 0.18,
                    axisTitlesPosition: 'out',
                    hAxis: {
                        title: '',
                        textStyle: {
                            color: '#fff',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        textPosition: 'out'
                    },
                    vAxis: {
                        minValue: 0,
                        textPosition: 'out',
                        textStyle: {
                            color: '#fff',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        baselineColor: '#16b4fc',
                        ticks: [0, 25, 50, 75, 100, 125, 150, 175, 200, 225, 250, 275, 300, 325, 350],
                        gridlines: {
                            color: '#1ba0fc',
                            count: 15
                        },
                    },
                    lineWidth: 2,
                    colors: ['#fff'],
                    curveType: 'function',
                    pointSize: 5,
                    pointShapeType: 'circle',
                    pointFillColor: '#f00',
                    backgroundColor: {
                        fill: '#008ffb',
                        strokeWidth: 0,
                    },
                    chartArea: {
                        left: 0,
                        top: 0,
                        width: '100%',
                        height: '100%'
                    },
                    fontSize: 11,
                    fontName: 'Proxima Nova',
                    tooltip: {
                        trigger: 'selection',
                        isHtml: true
                    }
                };

                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                chart.draw(dataTable, options);
            }

            $(window).resize(function() {
                drawChart();
                setTimeout(function() {}, 1000);
            });
        });

        //    Toggle Switch Enabled
        function toggleSwitch(switch_elem, on) {
            if (on) { // turn it on
                if ($(switch_elem)[0]) { // it already is so do
                    // nothing
                } else {
                    $(switch_elem).trigger('click').attr("checked", "checked"); // it was off, turn it on
                }
            } else { // turn it off
                if ($(switch_elem)[0]) { // it's already on so
                    $(switch_elem).trigger('click').removeAttr("checked"); // turn it off
                } else { // otherwise
                    // nothing, already off
                }
            }
        }


        $(function() {
            $('#semester').DataTable();
        });
    </script>
    </script>

    <script>
        document.getElementById("toggleSidebar").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("collapsed");
        });
    </script>

    <script src="{{URL::asset('assets/js/lib/bootstrap/bootstrap.min.js')}}"></script>

    <script src="{{URL::asset('assets/js/app.js')}}"></script>
</body>

</html>