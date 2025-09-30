<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LOGIN | PIKEMAS DISKOMINFO</title>

    <link href="{{URL::asset('assets/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{URL::asset('assets/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{URL::asset('assets/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{URL::asset('assets/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{URL::asset('assets/img/favicon.png')}}" rel="icon" type="image/png">
    <link href="{{URL::asset('assets/img/favicon.ico')}}" rel="shortcut icon">


    <link rel="stylesheet" href="{{URL::asset('assets/css/separate/pages/login.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}">
</head>

<body>


    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box" method="post" action="{{route('login.verify')}}">
                    @csrf


                    {{--pesan error--}}
                    @if(Session::has('pesan'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('pesan')}}
                    </div>
                    @endif

                    <div style="text-align: center; margin-bottom: 20px;">
                        <img src="assets/img/logo_kominfo.png" alt="Logo" width="200">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email address" required autofocus />
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" required />
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <div class="form-group">
                        <a href="{{route ('login.reset')}}">Lupa Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>



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

            $(window).resize(function() {
                setTimeout(function() {
                    $('.page-center').matchHeight({
                        remove: true
                    });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                }, 100);
            });
        });
    </script>
    <script src="js/app.js"></script>
</body>

</html>