<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bimbingan Belajar Quran | Login</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('template_lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_lte/dist/css/adminlte.min.css') }}">

    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    <style>
        .login-box {
            width: 380px;
        }

        .login-card {
            border-radius: 14px;
            overflow: hidden;
            backdrop-filter: blur(6px);
        }

        .login-header {
            background: linear-gradient(135deg, #001f3f, #003366);
        }

        .login-logo img {
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, .4));
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-login {
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            letter-spacing: .4px;
        }

        .card-footer small {
            font-size: .8rem;
        }
    </style>
</head>

@php
    $cover = asset('img/cover.png');
@endphp

<body class="hold-transition login-page"
    style="background: url('{{ $cover }}'); background-repeat: no-repeat; background-size: cover;">

    <div class="login-box">

        <div class="card login-card shadow-lg">

            {{-- Header --}}
            <div class="card-header login-header text-center py-4">
                <div class="login-logo mb-2">
                    <img src="{{ asset('img/logo.png') }}" width="80">
                </div>
                <h5 class="text-white mb-0 font-weight-bold">Bimbingan Belajar Qur'an</h5>
                <small class="text-light">Silakan masuk ke sistem</small>
            </div>

            {{-- Body --}}
            <div class="card-body p-4 bg-light">

                <form action="{{ route('login') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group mb-3">
                            <input type="text" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Masukkan username" id="email" autofocus required>

                            <div class="input-group-append">
                                <div class="input-group-text bg-white">
                                    <span class="fas fa-user text-muted"></span>
                                </div>
                            </div>

                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group mb-4">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password" required>

                            <div class="input-group-append">
                                <div class="input-group-text bg-white">
                                    <span class="fas fa-lock text-muted"></span>
                                </div>
                            </div>

                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-login shadow-sm">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </button>
                </form>

            </div>

            {{-- Footer --}}
            <div class="card-footer text-center py-3 bg-dark">
                <small class="text-white d-block">© 2021 All rights reserved.</small>
                <small class="text-white">
                    Dikembangkan oleh
                    <a href="https://wa.me/6285765842510" class="text-primary font-weight-bold">
                        Kader UKMI
                    </a>
                </small>
            </div>

        </div>
    </div>

    <script src="{{ asset('template_lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template_lte/dist/js/adminlte.min.js') }}"></script>

    <script>
        $('#email').click(function() {
            $(this).removeClass('is-invalid');
        });
    </script>

</body>

</html>
