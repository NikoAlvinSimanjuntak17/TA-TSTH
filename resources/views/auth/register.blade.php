<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pizza Andaliman | Daftar</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('admindasboard/assets/img/favicon/logopiza.png') }}" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">
</head>
<style>
    body {
        width: 100%;
        height: 100vh;
        font-family: 'Open Sans', sans-serif;
        background: url("/img/resto2.jpeg") top center;
        background-size: cover;
        position: relative;
        padding: 0;
    }
    body::before {
        content: "";
        background: rgba(0, 0, 0, 0.5);
        position: absolute;
        bottom: 0;
        top: 0;
        left: 0;
        right: 0;
    }
    .card {
        max-width: 600px;
        margin-top: 200px;
        padding: 20px;
        margin-left: 100px;
        background: rgba(42, 40, 38, 0.778);
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }
    .card-header {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 30px;
        text-align: center;
        color: #cda45e;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        font-size: 1.2rem;
        font-weight: 500;
        margin-bottom: 5px;
        color: #fff;
    }
    input[type='text'],
    input[type='email'],
    input[type='password'] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #28251f;
        color: #fff;
    }
    button[type='submit'] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #cda45e;
        color: #fff;
        font-size: 1.2rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button[type='submit']:hover {
        background-color: #d3af71;
    }
    p {
        font-size: 1.2rem;
        font-weight: 500;
        text-align: center;
        color: #fff;
    }
    p a {
        color: #cda45e;
        text-decoration: none;
    }
    p a:hover {
        text-decoration: underline;
    }
</style>
<body>
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
                <i class="bi bi-clock d-flex align-items-center ms-4"><span> Senin-Minggu: 10.00 - 21.00</span></i>
            </div>
        </div>
    </div>
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">
            <h1 class="logo me-auto me-lg-0"><a href="{{ __('/') }}">Pizza Andaliman</a></h1>
            <fieldset>
                @guest
                    @if (Route::has('login'))
                        <a href="{{ __('/') }}" class="book-a-table-btn">< Kembali</a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="book-a-table-btn">Masuk</a>
                    @endif
                @else
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest
            </fieldset>
        </div>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Daftar') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div id="error-alert" class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="list-style: none;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input type="text" placeholder="username" name="name" value="{{ old('name') }}" required/>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input type="email" placeholder="email" name="email" value="{{ old('email') }}" required/>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" placeholder="password" name="password" required/>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirm password">{{ __('Confirm Password') }}</label>
                                <input type="password" placeholder="confirm password" name="password_confirmation" required/>
                                @error('confirm password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn">{{ __('Daftar') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Hide the alert after 5 seconds
        setTimeout(function() {
            var alertElement = document.getElementById('error-alert');
            if (alertElement) {
                alertElement.style.display = 'none';
            }
        }, 3000); // 5000 milliseconds = 5 seconds
    </script>
</body>
</html>
