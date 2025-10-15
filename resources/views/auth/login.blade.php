<!DOCTYPE html>
<html lang="en" class="loading semi-dark-layout" data-layout="semi-dark-layout" data-textdirection="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Sekolahku adalah aplikasi manajemen sekolah berbasis website yang dibangun dengan Laravel">
    <title>Login Page - SekolahKu</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Vendor CSS --}}
    <link rel="stylesheet" href="{{ asset('Assets/Backend/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/themes/semi-dark-layout.css') }}">

    {{-- Page CSS --}}
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/Backend/css/pages/page-auth.css') }}">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            background: #f8f9fa;
        }
        .auth-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* KIRI (FORM) */
        .login-left {
            background: #fff;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
        }
        .brand-logo img {
            height: 60px;
        }
        .login-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin-top: 1rem;
            text-align: center;
        }
        .login-sub {
            color: #6c757d;
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
        }
        .login-card .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }
        .login-card .btn-primary {
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 8px;
            background: #0d6efd;
            border: none;
        }

        /* KANAN (BACKGROUND BIRU) */
        .login-right {
            flex: 1;
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .login-right::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: 10%;
            left: -100px;
        }
        .login-right::after {
            content: "";
            position: absolute;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -100px;
            right: -100px;
        }
        .login-right img {
            width: 80%;
            max-width: 400px;
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-menu="vertical-menu-modern">

<div class="auth-wrapper">
    {{-- FORM LOGIN --}}
    <div class="login-left">
        <div class="brand-logo text-center mb-2">
            <img src="{{ asset('Assets/Backend/images/logo.png') }}" alt="Logo">
        </div>
        <h2 class="login-title">Welcome to SekolahKu 👋</h2>
        <p class="login-sub">Silakan masuk ke akun Anda dan mulai petualangan</p>

        <div class="login-card">
            {{-- ALERTS --}}
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                </div>
            @elseif($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('login') }}" method="POST" class="auth-login-form">
                @csrf
                <div class="form-group mb-2">
                    <label for="login-email">Email</label>
                    <input type="text" name="email" id="login-email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Masukkan email" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="login-password">Password</label>
                        <a href="#"><small>Lupa Password?</small></a>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input type="password" name="password" id="login-password"
                               class="form-control form-control-merge @error('password') is-invalid @enderror"
                               placeholder="············">
                        <div class="input-group-append">
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember-me">
                        <label class="custom-control-label" for="remember-me">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </form>
        </div>
    </div>

    {{-- ILUSTRASI KANAN --}}
    <div class="login-right d-none d-lg-flex">
        <img src="{{ asset('Assets/Backend/images/illustration/login-v2.svg') }}" alt="Login Illustration">
    </div>
</div>

{{-- JS --}}
<script src="{{ asset('Assets/Backend/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('Assets/Backend/js/core/app-menu.js') }}"></script>
<script src="{{ asset('Assets/Backend/js/core/app.js') }}"></script>
<script src="{{ asset('Assets/Backend/js/scripts/pages/page-auth-login.js') }}"></script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
    });
</script>
</body>
</html>
