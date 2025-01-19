<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/cavely2.png') }}">
    <title>Cavely</title>
    <!-- Custom CSS -->
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .navbar {
            background-color: #1B1E2A;
            opacity: 0.75;
            height: 102px;
        }

        .bg-login {
            background-size: cover;
            background-repeat: no-repeat;
            background-image: url({{ asset('image/bg_login.png') }});
        }

        .bg-login2 {
            background: rgba(89, 154, 148, 0.75) !important;
        }

        .bg-login3 {
            background: rgba(89, 154, 148, 0) !important;
        }

        .btn-transparent {
            background: transparent !important;
            color: rgba(0, 0, 0, 0.5) !important;
        }

    </style>
</head>

<body>
    
    <div class="w-100 bg-login">
        <nav class="navbar row">
            <div class="col-lg-10 col-md-8 col-sm-6"></div>
            <div class="col-lg-1">
                <a href="{{ route('backend.beranda') }}">
                    <img src="{{ asset('image/cavely2.png') }}" alt="logo" width="100px" height="100px" style="margin-top: 1px; margin-right: 10px;">
                </a>
            </div>
        </nav>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="main-wrapper">
                    <!-- ============================================================== -->
                    <!-- Preloader - style you can find in spinners.css -->
                    <!-- ============================================================== -->
                    <div class="preloader">
                        <div class="lds-ripple">
                            <div class="lds-pos"></div>
                            <div class="lds-pos"></div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Preloader - style you can find in spinners.css -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Login box.scss -->
                    <!-- ============================================================== -->
                    <div class="auth-wrapper d-flex no-block justify-content-center bg-login2">
                        
                        <div class="auth-box bg-login3">
                            <div class="text-center">
                                <h4 style="color: white">SIGN IN TO YOUR ACCOUNT</h4>
                            </div>
                            <div id="loginform">
                                <!-- Form -->
                                {{-- error --}}
                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ session('error') }}</strong>
                                    </div>
                                @endif
                                {{-- errorEnd --}}
                                <form class="form-horizontal m-t-20" id="loginform" action="{{ route('backend.login') }}" method="POST">
                                    @csrf
                                    <div class="row p-b-30">
                                        <div class="col-12">
                                            <div class="text-white">
                                                <h5>
                                                    Username or Email
                                                </h5>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" name="email" value="{{ old('email') }}" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Required" aria-label="Username" aria-describedby="basic-addon1">
                                                @error('email')
                                                    <span class="invalid-feedback alert-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="text-white">
                                                <h5>
                                                    Password
                                                </h5>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Required" aria-label="Password" aria-describedby="basic-addon1">
                                                @error('password')
                                                    <span class="invalid-feedback alert-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button class="btn btn-warning w-100 " type="submit">Login</button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4 mt-1"><hr style="border-top: 2px solid #265157;"></div>
                                                <div class="col-4 mt-2 bg-login2 text-center">or sign in with</div>
                                                <div class="col-4 mt-1"><hr style="border-top: 2px solid #265157;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="row">
                                                <div class="col-2"></div>
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img src="{{ asset('image/google_logo.png') }}" alt="Google" width="100px" height="100px">
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img src="{{ asset('image/discord_logo.png') }}" alt="Discord" width="100px" height="100px">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="row">
                                                <div class="col-2"></div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <button class="btn btn-transparent" id="create-account" type="button"><u>Create Account</u></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <button class="btn btn-transparent" id="to-recover" type="button"><u>Forgot password?</u></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="recoverform">
                                <div class="text-center">
                                    <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                                </div>
                                <div class="row m-t-20">
                                    <!-- Form -->
                                    <form class="col-12" action="index.html">
                                        <!-- email -->
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        <!-- pwd -->
                                        <div class="row m-t-20 p-t-20 border-top border-secondary">
                                            <div class="col-12">
                                                <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                                                <button class="btn btn-info float-right" type="button" name="action">Recover</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Login box.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Page wrapper scss in scafholding.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Page wrapper scss in scafholding.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Right Sidebar -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Right Sidebar -->
                    <!-- ============================================================== -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>

</body>

</html>