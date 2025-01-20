<!DOCTYPE html>
<html dir="ltr" lang="en">

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
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .margintop {
            height: 9px;
            background-color: #3B7475;
        }

        .foto-preview {
            display: none;
            width: 100%;
        }

        .navbar {
            height: 93px;
        }

        .navbar-collapse {
            background-color: #343a40;
            padding: 10px;
        }

        .nav-link {
            color: #D9D9D9 !important;
            font-size: 32px;
            font-family: 'Koulen', sans-serif;
            margin-right: 0px;
        }

        @font-face {
            font-family: 'Koulen';
            src: url('{{ asset('font/Koulen/Koulen-Regular.ttf') }}') format('truetype');
        }

        #navbarDropdown {
            color: #78C6BE !important;
            font-size: 32px;
            font-family: 'Koulen', sans-serif;
            width: 378px;
        }

        .dropdown-menu {
            background-color: #5B9593;
            border-radius: 10px;
            font-family: 'Koulen', sans-serif;
            font-size: 24px;
            padding: 20px;
        }

        .ddi1 {
            background-color: #3B7374;
            border-radius: 5px;
            color: #FFFFFF;
            width: 186px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ddi2 {
            background-color: #FFFFFF;
            outline: solid 1px #3B7374;
            border-radius: 5px;
            color: #3B7374;
            width: 186px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ddi1:hover, .ddi2:hover {
            background-color: #FFE08A !important;
            color: #000000 !important;
        }

        #categories {
            width: 885px;
            color: #FFFFFF;
            font-size: 24px;
        }

        #categories a.dropdown-item {
            color: #FFFFFF;
            font-size: 24px;
            font-family: 'LeagueSpartan', sans-serif;
            height: 45px;
            border-radius: 5px;
            vertical-align: middle;
        }

        .moar-space {
            margin-bottom: 30px;
        }

        @font-face {
            font-family: 'LeagueSpartan';
            src: url('{{ asset('font/LeagueSpartan/LeagueSpartan-VariableFont_wght.ttf') }}') format('truetype');
        }

        #categories a:hover {
            color: #78C6BE;
        }

        #cart {
            height: 61px;
            width: 64px;
            background-color: #FFE08A;
            border-radius: 50%;
            display: inline-block;
        }

        #cartnot {
            color: #000000;
            height: 28px;
            width: 27px;
            border-radius: 50%;
            margin-left: 30px;
            margin-top: -65px;
            font-size: 20px;
            outline-color: #000000;
            outline-style: solid;
            outline-width: 3px;
            background-color: #D9D9D9;
        }

        #cart i {
            font-size: 30px;
            margin-top: 5px;
            padding-left: 5px;
        }

        #navbarDropdownUser {
            color: #78C6BE !important;
            background: rgba(0, 0, 0, 0.27);
            font-size: 20px;
            font-family: 'LeagueSpartan', sans-serif;
            width: 245px;
            height: 54px;
            align-items: center;
            justify-content: center;
        }

        .usersetting {
            color: #FFFFFF;
            font-size: 24px;
            font-family: 'LeagueSpartan', sans-serif;
            border-radius: 5px;
            vertical-align: middle;
        }

        .usersetting2 {
            color: #1E474D;
            font-size: 24px;
            font-family: 'LeagueSpartan', sans-serif;
            border-radius: 5px;
            vertical-align: middle;
        }


        @media (max-width: 1200px) {
            .navbar {
                height: auto;
            }
            .nav-link {
                font-size: 24px;
            }
            #navbarDropdown {
                font-size: 24px;
            }
            #categories {
                width: 600px;
                font-size: 20px;
            }
            #navbarDropdown div {
                color: #78C6BE !important;
                font-size: 24px;
                font-family: 'Koulen', sans-serif;
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .nav-link {
                font-size: 20px;
            }
            #navbarDropdown {
                font-size: 20px;
            }
            #categories, #categories a.dropdown-item {
                width: 600px;
                font-size: 16px;
            }
        }

        .text-link-bawah {
            color: #78C6BE;
        }

        .text-link-bawah:hover {
            color: #D9D9D9;
        }

        .kaki {
            font-family: 'LeagueSpartan', sans-serif;
        }
    </style>
</head>

<body style="background-color: #051723">
    <div class="margintop"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark align-items-center sticky-top">
        <a class="navbar-brand" href="{{ route('frontend.beranda') }}">
            <img src="{{ asset('image/cavely2.png') }}" alt="Cavely Logo" height="93">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto align-items-center nav">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Store</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Library</a>
                </li>
                <li class="nav-item mx-2 dropdown">
                    <a class="nav-link" href="#" id="navbarDrop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                        <i class="mdi mdi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDrop" id="categories">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 justify-content-center">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="ml-3">Special Sections</div>
                                            <div class="moar-space">
                                                <a href="#" class="dropdown-item">Free To Play</a>
                                                <a href="#" class="dropdown-item">Demo</a>
                                                <a href="#" class="dropdown-item">Early Access</a>
                                            </div>
                                            <div class="ml-3">Themes</div>
                                            <div class="moar-space">
                                                <a href="#" class="dropdown-item">Anime</a>
                                                <a href="#" class="dropdown-item">Horror</a>
                                                <a href="#" class="dropdown-item">Survival</a>
                                                <a href="#" class="dropdown-item">Open World</a>
                                            </div>
                                            <div class="ml-3">Player Support</div>
                                            <div class="moar-space">
                                                <a href="#" class="dropdown-item">Co-Operative</a>
                                                <a href="#" class="dropdown-item">Multiplayer</a>
                                                <a href="#" class="dropdown-item">Singleplayer</a>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div style="width: 5px; height: 100%; background-color: #FFFFFF; border-radius: 2.5px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 justify-content-center">
                                    <div class="ml-3">Genres</div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12">
                                            <a href="#" class="dropdown-item">Role-Playing</a>
                                            <a href="#" class="dropdown-item">Action</a>
                                            <a href="#" class="dropdown-item">First-Person Shooter</a>
                                            <a href="#" class="dropdown-item">Third-Person Shooter</a>
                                            <a href="#" class="dropdown-item">Adventure</a>
                                            <a href="#" class="dropdown-item">Casual</a>
                                            <a href="#" class="dropdown-item">Puzzle</a>
                                            <a href="#" class="dropdown-item">Simulation</a>
                                            <a href="#" class="dropdown-item">Visual Novel</a>
                                            <a href="#" class="dropdown-item">Strategy</a>
                                            <a href="#" class="dropdown-item">Sport Racing</a>
                                            <a href="#" class="dropdown-item">Platformers</a>
                                            <a href="#" class="dropdown-item">Turn-Based</a>
                                        </div>
                                        <div class="col-xl-6 col-lg-12">
                                            <a href="#" class="dropdown-item">Dating</a>
                                            <a href="#" class="dropdown-item">Rogue-like</a>
                                            <a href="#" class="dropdown-item">Farming & Crafting</a>
                                            <a href="#" class="dropdown-item">Brawlers</a>
                                            <a href="#" class="dropdown-item">Stealth</a>
                                            <a href="#" class="dropdown-item">Metroidvania</a>
                                            <a href="#" class="dropdown-item">Battle Royale</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Support</a>
                </li>
                
                @if (!Auth::check())
                    <li class="nav-item mx-2 dropdown">
                        <a class="nav-link" href="#" id="navbarDropdownSignIn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            SIGN IN
                            <i class="mdi mdi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownSignIn">
                            <div class="container d-flex">
                                <a class="dropdown-item ddi1 mr-2" href="{{ route('frontend.user.create') }}">CREATE ACCOUNT</a>
                                <a class="dropdown-item ddi2" href="{{ route('backend.login') }}">SIGN IN</a>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto align-items-center">
                @if (Auth::check())
                    <li class="nav-item mx-2 dropdown" id="navbarDropdownUser">
                        <a class="nav-link p-0" href="#" id="navbarDropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="row">
                                <div class="col-3">
                                    @if (Auth::user()->foto)
                                    <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user" class="" width="55" height="54">
                                    @else
                                    <img src="{{ asset('storage/img-user/img-default.jpg') }}" alt="user" class="" width="55" height="54">
                                    @endif
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-center">
                                    {{ Auth::user()->nama }}
                                </div>
                                <div class="col-3">
                                    <i class="mdi mdi-chevron-down" style="font-size: 36px;"></i>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                            @if (Auth::user()->role != 2)
                                <a href="{{ route('backend.beranda') }}" class="dropdown-item usersetting">Management Dashboard</a>
                            @endif                  
                            <a class="dropdown-item usersetting" href="#">View My Profile</a>
                            <hr style="border-top: 3px solid rgb(255,255,255,0.5);">
                            <a class="dropdown-item usersetting" href="#">Choose Another Account</a>
                            <a class="dropdown-item usersetting2" href="#" onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">Sign Out</a>
                        </div>
                    </li>
                @endif
                <li class="nav-item mx-2">
                    <a class="nav-link position-relative" href="{{ route('frontend.checkout.create') }}" id="cart">
                        <i class="fa fa-shopping-cart mx-auto" aria-hidden="true" style="color: black;"></i>
                        @php
                            if (Auth::check()){

                            $cartCount = DB::table('carts')->where('checkouts_id', Null)->where('users_id', auth()->user()->id)->count();
                            }
                        @endphp
                        @if (Auth::check() && $cartCount != 0)
                            <span class="position-absolute d-flex justify-content-center align-items-center" id="cartnot">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')

    <div class="mx-5 d-flex mb-3">
        <div class="mr-auto text-md">
                    <a href="" class="mr-5 text-link-bawah">Redeem Code</a>
                    <a href="" class="mr-5 text-link-bawah">Contact Us</a>
                    <a href="" class="mr-5 text-link-bawah">Career</a>
                    <a href="" class="mr-5 text-link-bawah">Submit your game</a>
        </div>
        <div class="text-md">
            <a href="" class="mr-5 text-link-bawah"><i class="fa fa-phone-square" aria-hidden="true"></i></a>
            <a href="" class="mr-5 text-link-bawah"><i class="fa fa-envelope" aria-hidden="true"></i></a>
            <a href="" class="mr-5 text-link-bawah"><i class="fa fa-instagram" aria-hidden="true"></i></a>
</div>
    </div>
    <footer class="text-white" style="background-color: #1E474D;">
        <div class="mx-5 kaki">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center" style="background-color: #D9D9D9">
                    <img src="{{ asset('image/cavely2.png') }}" alt="" width="200" height="200">
                </div>
                <div class="col-lg-9 col-md-6 mt-3">
                    <table>
                        <tr>
                            <td width="70">Language</td>
                            <td width="10">:</td>
                            <td>
                                <ul id="language-list" class="list-inline mt-3">
                                    <li class="list-inline-item language-item" style="color: #78C6BE;">English</li>
                                    <li class="list-inline-item language-item">Indonesia</li>
                                    <li class="list-inline-item language-item">日本語</li>
                                    <li class="list-inline-item language-item">中国人</li>
                                </ul>

                                <script>
                                    document.querySelectorAll('.language-item').forEach(item => {
                                        item.addEventListener('click', function() {
                                            document.querySelectorAll('.language-item').forEach(el => el.style.color = '');
                                            this.style.color = '#78C6BE';
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>Currency</td>
                            <td>:</td>
                            <td>
                                <ul id="currency-list" class="list-inline mt-3">
                                    <li class="list-inline-item currency-item" style="color: #78C6BE;">IDR</li>
                                    <li class="list-inline-item currency-item">USD</li>
                                    <li class="list-inline-item currency-item">EUR</li>
                                    <li class="list-inline-item currency-item">JPY</li>
                                </ul>

                                <script>
                                    document.querySelectorAll('.currency-item').forEach(item => {
                                        item.addEventListener('click', function() {
                                            document.querySelectorAll('.currency-item').forEach(el => el.style.color = '');
                                            this.style.color = '#78C6BE';
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                    </table>
                    <div class="float-right mt-2 mr-5">
                        <a href="#" class="ml-3 text-white">Privacy Policy</a>
                        <a href="#" class="ml-3 text-white">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('backend/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('backend/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
    <!-- this page js -->
    <script src="{{ asset('backend/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('backend/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>

    {{-- form keluar app --}}
    <form id="keluar-app" action="{{ route('backend.logout') }}" method="post" class="d-none">
        @csrf
    </form>
    {{-- form keluar app end --}}

    {{-- sweetalert --}}
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
    {{-- sweetalert End --}}

    {{-- konfirmasi success --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}"
            })
        </script>
    @endif
    {{-- konfirmasi success End --}}

    {{-- konfirmasi error --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}"
            })
        </script>
    @endif
    {{-- konfirmasi error End --}}

    <script type="text/javascript">
        // Konfirmasi delete
        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var konfdelete = $(this).data("konf-delete");
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus Data?',
                html: "Data yang dihapus <b>" + konfdelete + "</b> tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, dihapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success')
                        .then(() => {
                            form.submit();
                        });
                }    
            });
        });
    </script>
    <script>
        // previewFoto
        function previewFoto() {
            const foto = document.querySelector('input[name="foto"]');
            const fotoPreview = document.querySelector('.foto-preview');
            fotoPreview.style.display = 'block';
            const fotoReader = new FileReader();
            fotoReader.readAsDataURL(foto.files[0]);
            fotoReader.onload = function(fotoEvent) {
                fotoPreview.src = fotoEvent.target.result;
                fotoPreview.style.width = '100%';
            }
        }
    </script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    {{-- <script src="htttps://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>
