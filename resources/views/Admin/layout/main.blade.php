<!DOCTYPE html>
<html>

<head lang="en">
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
</head>

<body class="horizontal-navigation">

    <header class="site-header">
        <div class="container-fluid">
            <a href="#" class="site-logo">
                <!-- <img class="hidden-md-down" src="{{URL::asset('assets/img/mentawai.png')}}" alt=""> -->
                <img class="hidden-md-down" src="{{URL::asset('assets/img/logo_kominfo.png')}}" alt="">
            </a>

            <button class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </button>
            {{-- <div class="text-right mr-2">{{\App\Util\Helper::firstUserNameLogin()}}
        </div>--}}
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
        <!--.container-fluid-->
    </header>
    <!--.site-header-->
    <div class="mobile-menu-left-overlay"></div>
    <ul class="main-nav nav nav-inline">
        <li class="nav-item">
            <a class="nav-link" href="{{Route('admin.dashboard.index')}}">HOME</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route ('admin.pengguna.index')}}">PENGGUNA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{Route('admin.instansi.index')}}">INSTANSI</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{Route('admin.barang.index')}}">BARANG</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{Route('admin.peminjaman.index')}}">PEMINJAMAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">LAPORAN</a>
        </li>
    </ul>


    <div class="page-content">
        <div class="container-fluid">

            @yield('admin.content')
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
            $('#peminjaman').DataTable();
        });
    </script>
    </script>


    <script src="{{URL::asset('assets/js/app.js')}}"></script>
</body>

</html>