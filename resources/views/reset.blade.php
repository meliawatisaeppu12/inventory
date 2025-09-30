<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>RESET PASSWORD | ASET KOMINFO</title>

    <link href="{{URL::asset('assets/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{URL::asset('assets/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{URL::asset('assets/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{URL::asset('assets/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{URL::asset('assets/img/favicon.png')}}" rel="icon" type="image/png">
    <link href="{{URL::asset('assets/img/favicon.ico')}}" rel="shortcut icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{URL::asset('assets/css/separate/pages/login.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}">
</head>
<body>
<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">
            <form class="sign-box reset-password-box" method="post" action="{{route('login.forgot')}}">
                @csrf
                @method('POST')
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <header class="sign-title"><h2>Reset Password</h2></header>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Masukan Email" value="{{old ('email')}}" required autofocus/>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-rounded">Reset</button>
                </div>

                <div class="form-group text-center ">
                    <a href="{{route('login.index')}}">Login</a>
                </div>
            </form>
        </div>
    </div>
</div><!--.page-center-->

<script src="{{URL::asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/popper/popper.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/tether/tether.min.js')}}"></script>
<script src="{{URL::asset('assets/js/lib/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/js/plugins.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
<script>
    $(function() {
        $('.page-center').matchHeight({
            target: $('html')
        });

        $(window).resize(function(){
            setTimeout(function(){
                $('.page-center').matchHeight({ remove: true });
                $('.page-center').matchHeight({
                    target: $('html')
                });
            },100);
        });
    });
</script>
<script src="{{URL::asset('assets/js/app.js')}}"></script>
</body>
</html>
