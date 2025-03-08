<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bimbingan Belajar Quran | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template_lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    {{-- <link rel="stylesheet" href="{{ asset('template_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template_lte/dist/css/adminlte.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
</head>

<body class="hold-transition login-page"
    style="background: url('https://images.squarespace-cdn.com/content/v1/651a86a59e2bad06fee181e5/1700758376658-GG8IAY4A51S1Y2BZJ5B9/Dark+halftone.png?format=2500w');
            background-size: cover;">
    <div class="login-box">

        <div class="card card-outline card-navy p-2">
            <div class="card-body bg-gray-light">

                <div class="login-logo">
                    <img src="https://bbq.arrahmanteknokrat.or.id/template/img/logo.png" alt="" width="50px">
                </div>
            </div>
            <div class="card-body ">
                <form action="{{ route('login') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group  mb-3">
                            <input type="text" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Username" id="email" autofocus required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control"
                                @error('password') is-invalid @enderror placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-lock"></i>
                                Login</button>
                        </div>
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
            <div class="card-footer text-center d-flex flex-column py-2" style="background-color: black">
                <strong style="color: #fff;"> © 2021 </strong>
                <span style="color: #fff;">All rights
                    reserved.
                </span>
                <span style="color: #fff;">Dikembangkan oleh
                    <a href="https://wa.me/6285765842510" style="color: rgb(13, 0, 255);">Kader UKMI<br></a>
                </span>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('template_lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template_lte/dist/js/adminlte.min.js') }}"></script>
    <script>
        $('#email').click(function(e) {
            e.preventDefault();
            $(this).removeClass('is-invalid');
        });
    </script>
</body>

</html>
