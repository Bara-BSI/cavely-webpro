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
    
    <div class="w-100 bg-login" style="min-height: 100vh">
        <nav class="navbar row">
            <div class="col-lg-10 col-md-8 col-sm-6"></div>
            <div class="col-lg-1">
                <a href="{{ route('backend.beranda') }}">
                    <img src="{{ asset('image/cavely2.png') }}" alt="logo" width="100px" height="100px" style="margin-top: 1px; margin-right: 10px;">
                </a>
            </div>
        </nav>
        <div class="container bg-login3 text-white">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-login3">
                        <form action="{{ route('frontend.user.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <h1 class="card-title text-white text-center">{{ $judul }}</h1>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="row my-3">
                                    <div class="col-md-4">
                                        <h2>Choose Role :</h2>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-secondary" data-toggle="collapse">
                                                <input type="radio" name="role" id="customer" value="2"> Customer
                                            </label>
                                            <label class="btn btn-secondary" data-toggle="collapse">
                                                <input type="radio" name="role" id="developer" value="1"> Developer
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row collapse" id="collapseInput">
                                    <div class="col-md-4">
                                        
                                        <div class="form-group">
                                            <label for="foto">Photo</label>
                                            <img class="foto-preview">
                                            <input type="file" name="foto" id="foto" class="form-control @error('foto')
                                                is-invalid
                                            @enderror" onchange="previewFoto()">
                                            @error('foto')
                                                <div class="invalid-feedback alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="col-md-8 bg-login2 py-2">
                                        {{-- <div class="form-group">
                                            <label for="role">Hak Akses</label>
                                            <select name="role" id="role" class="form-control @error('role')
                                                is-invalid
                                            @enderror">
                                                <option value="" {{ old('role') == '' ? 'selected' : '' }}>
                                                    - Pilih Hak Akses -
                                                </option>
                                                <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>
                                                    Publisher
                                                </option>
                                                <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                                <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>
                                                    Customer
                                                </option>
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div> --}}
    
                                        <div class="form-group">
                                            <label for="nama">Name</label>
                                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control @error('nama')
                                                is-invalid
                                            @enderror" placeholder="Enter Name">
                                            @error('nama')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email')
                                                is-invalid
                                            @enderror" placeholder="Enter Email">
                                            @error('email')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="hp">Phone Number</label>
                                            <input type="text" name="hp" id="hp" onkeypress="return hanyaAngka(event)" value="{{ old('hp') }}" class="form-control @error('hp')
                                                is-invalid
                                            @enderror" placeholder="Enter Phone Number">
                                            @error('hp')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Birth Date</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control @error('tanggal_lahir')
                                                is-invalid
                                            @enderror" placeholder="Enter Birth Date">
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="countries_id">Country</label>
                                            <select name="countries_id" id="countries_id" class="form-control @error('countries_id')
                                                is-invalid
                                            @enderror">
                                                <option value="" selected>--Choose Country--</option>
                                                @foreach ($negara as $n)
                                                    <option value="{{ $n->id }}">{{ $n->nama_negara }}</option>
                                                @endforeach
                                            </select>
                                            @error('countries_id')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control @error('password')
                                                is-invalid
                                            @enderror" placeholder="Enter Password">
                                            @error('password')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save</button>
    
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <a href="{{ route('backend.login') }}">
                                        <button type="button" class="btn btn-secondary">Login Instead</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
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

    // $('[data-toggle="tooltip"]').tooltip();
    // $(".preloader").fadeOut();
    // // ============================================================== 
    // // Login and Recover Password 
    // // ============================================================== 
    // $('#to-recover').on("click", function() {
    //     $("#loginform").slideUp();
    //     $("#recoverform").fadeIn();
    // });
    // $('#to-login').click(function(){
        
    //     $("#recoverform").hide();
    //     $("#loginform").fadeIn();
    // });

    $(document).ready(function() {
    $('input[name="role"]').change(function() {
        if (!$('#collapseInput').hasClass('show')) {
            $('#collapseInput').collapse('show');
        }

        $('.btn-group-toggle label').removeClass('active btn-warning').addClass('btn-secondary'); // Reset all buttons

        // Style only the checked button
        if ($(this).is(':checked')) {
            $(this).parent('label').addClass('active btn-warning').removeClass('btn-secondary');
        }
    });


});






    </script>


</body>

</html>