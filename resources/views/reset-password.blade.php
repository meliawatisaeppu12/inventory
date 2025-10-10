<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Reset Password | SEPAKAT DISKOMINFO</title>
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
                <form class="sign-box" method="POST" action="{{ route('login.renew') }}">
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
                        <h3>Ubah Password</h3>
                        <p class="text-muted">Masukkan password baru Anda di bawah ini.</p>
                    </header>

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password baru" required>
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Ulangi Password Baru</label>
                        <input type="password" class="form-control" name="new_password" placeholder="Ulangi password baru" required>
                        <span class="text-danger">@error('new_password'){{ $message }}@enderror</span>
                    </div>

                    <input type="hidden" name="remember_token" value="{{ $emailHash }}">

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
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