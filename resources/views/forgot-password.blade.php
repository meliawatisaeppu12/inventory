<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Lupa Password | SEPAKAT DISKOMINFO</title>
    <link rel='icon' href="{{URL::asset('assets/img/logo.png')}}" />

    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/separate/pages/login.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box" method="POST" action="{{ route('password.email') }}">
                    @csrf

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

                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/img/logo_kominfo.png') }}" alt="Logo" width="200">
                    </div>

                    <header class="text-center">
                        <h3>Lupa Password</h3>
                        <p class="text-muted">Masukkan email Anda untuk menerima link reset password.</p>
                    </header>

                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan email aktif" required autofocus>
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Kirim Link Reset</button>
                    </div>

                    <div class="form-group text-center">
                        <a href="{{ route('login.index') }}">Kembali ke Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/lib/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/match-height/jquery.matchHeight.min.js') }}"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });
        });
    </script>
</body>

</html>