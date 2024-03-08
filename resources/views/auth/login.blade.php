<!DOCTYPE html>
<html>
<style>
    #grad1 {
        background-color: #9C27B0;
        background-image: linear-gradient(100deg, #90EE90, #81D4FA);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 0 10px 10px #fff;
        /* Ensure the gradient doesn't overflow */
    }

    /* .logo {
            max-width: 500px;
            height: auto;
            margin-bottom: 20px;
        } */
</style>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login e-Recruitment </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/my-style.css')}} ">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- <div class="logo-container text-center">
        <img src="{{ asset('assets/images/Ecocare 1.png') }}" alt="Logo" class="logo">
    </div> -->
</head>

<body class="hold-transition login-page">
    <!-- <div class="d-flex justify-content-center"> -->
    <div class="row col-md-6 ">
        <div class="container-fluid" id="grad1">
            <div class="card user-details-card">
                <div class="card-header text-center">
                    <h2>Login e-Recruitment</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif


                                <p class="mt-2">Don't have an account? <a href="{{ route('register.index') }}">Register here</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->

        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
        @include('sweetalert::alert')
</body>

</html>