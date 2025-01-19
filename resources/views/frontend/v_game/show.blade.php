@extends('frontend.v_layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/game_show.css')}}">
    <div class="container">
        <div class="jumbotron jumbotron-fluid" style="background-image: url('{{ asset('storage/media/' . $media->where('jenis', 'image')->first()->nama) }}'); background-size:cover; background-position:center">
            <img src="{{ asset('storage/img-user/' . $user->foto) }}" alt="{{ $user->nama }}" height="200px" class="ml-5" style="border-radius: 10%">
        </div>
        <div class="row">
            <div class="col-lg-8 mb-1">
                <div id="videoCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($media as $medias)
                            <li data-target="#videoCarousel" data-slide-to="{{ $loop->iteration - 1 }}" class="@if ($loop->iteration == 1) active @endif"></li>
                        @endforeach
                    </ol>                    
                    <div class="carousel-inner">
                        @foreach ($media as $medias)
                            <div class="w-100 carousel-item @if ($loop->iteration == 1)
                                active
                            @endif" style="height: 400px; overflow:hidden">
                                @if ($medias->jenis == 'video')
                                    <video class="d-block w-100" controls>
                                        <source src="{{ asset('storage/media/' . $medias->nama) }}" type="video/mp4" style="height: 400px; overflow:hidden; border-radius:10px">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <img src="{{ asset('storage/media/' . $medias->nama) }}" class="d-block w-100" alt="Image {{ $loop->iteration }}" style="height: 400px; overflow:hidden; border-radius:10px">
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#videoCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#videoCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-white mt-2">
                <h1>{{ $game->nama_game }}</h1>
                <hr class="hr-cyan">
                <p>{{ $game->deskripsi }}</p>
                <div class="row w-100">
                    <div class="col-5">
                        <h4>Developer:</h4>
                    </div>
                    <div class="col-7">
                        <u>
                            {{ $user->nama }}
                        </u>
                    </div>
                    <div class="col-5">
                        <h4>Release Date:</h4>
                    </div>
                    <div class="col-7">
                        {{ Carbon\Carbon::parse($game->tanggal_rilis)->format('d M, Y') }}
                    </div>
                </div>
                <div class="row w-100">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="row h-100">
                            <div class="col-3 h-75 w-100 my-auto" style="background-color: #FFE08A; border-radius:10px"></div>
                            <div class="col-9">
                                <p style="text-decoration: line-through">Harga Awal</p>
                                <h4>IDR {{ $game->harga }}</h4>
                            </div>                            
                        </div>
                    </div>
                </div>
                @if (Auth::check() && $cart->where('users_id', Auth::user()->id)->contains('checkouts_id', '!=', null))
                    <div class="">
                        <a href="" class="w-100 btn btn-success d-flex align-items-center" style="height: 100px; border-radius:10px">
                            <h2 class="text-center text-light w-100 my-auto">Play Now</h2>
                        </a>
                    </div>
                @else
                    <div class="">
                        <a href="" class="w-100 btn btn-warning d-flex align-items-center" style="height: 50px">
                            <b class="text-center text-dark w-100">Buy Now</b>
                        </a>
                    </div>
                    <div class=" mt-3">
                        <a class="w-100 btn btn-outline-dark d-flex align-items-center" style="height: 50px"
                        data-toggle="collapse" href="#cartCollapse" role="button" aria-expanded="false" aria-controls="cartCollapse">
                            <b class="text-center text-white w-100">Add to cart</b>
                        </a>
                        <div class="collapse my-2" id="cartCollapse">
                            <form action="{{ route('frontend.cart.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="games_id" value="{{ $game->id }}">
                                <input type="hidden" name="users_id" value="@if (Auth::check())
                                    {{ Auth::user()->id }}
                                @endif">
                                <div class="row">
                                    <div class="col-5 d-flex align-items-center">
                                        <label for="jumlah" class="my-auto"><h4>Item amount: </h4></label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-control" type="number" name="jumlah" id="jumlah">
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mt-1">
                <div class="mt-1">
                    @foreach ($genre as $genres)
                        <a href="#" class="btn btn-light">{{ $genres->nama_genre }}</a>
                    @endforeach
                </div>

                <div class="mt-5 text-white d-inline-flex">
                    <h2>ABOUT THIS GAME</h2>
                    <h6 class="mt-auto ml-5 text-warning">(database data column not yet available)</h6>
                </div>
                <hr class="hr-cyan">
                <div class="text-white mt-2">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque imperdiet libero eu neque facilisis, ac pretium nisi bibendum. Sed sit amet facilisis urna. Praesent ac gravida libero. Nulla facilisi. Donec vulputate interdum sollicitudin. Nunc lacinia, sapien vitae tincidunt fermentum, felis libero mollis orci, nec commodo erat libero at metus. Integer nec odio nec nulla facilisis fermentum. Curabitur euismod, nisi vel consectetur interdum, nisl nisi scelerisque nun</p>
                </div>

                <div class="mt-5 text-white d-inline-flex">
                    <h2>FEATURES</h2>
                    <h6 class="mt-auto ml-5 text-warning">(database data column not yet available)</h6>
                </div>
                <hr class="hr-cyan">
                <div class="text-white mt-2">
                    <ul>
                        @for ($i = 0; $i < 6; $i++)
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        @endfor
                    </ul>
                </div>

                <div class="mt-5 text-white d-inline-flex">
                    <h2>SYSTEM SPECIFICATION</h2>
                    <h6 class="mt-auto ml-5 text-warning">(database data column not yet available)</h6>
                </div>
                <hr class="hr-cyan">
                <div class="text-white mt-2">
                    <div class="row">
                        <div class="col-6">
                            <h4>Minimum</h4>
                        </div>
                        <div class="col-6">
                            <h4>Recommended</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-1 text-white">
                <div class="bg-dark">
                    <div class="px-4 py-2">
                        <h4>Achievements</h4>
                        <h6 class="mt-auto mx-2 text-warning">(database data column not yet available)</h6>
                        <div class="row d-flex">
                            <div class="col-4">
                                <div class="bg-light mr-2" style="height: 75px"></div>
                            </div>
                            <div class="col-4">
                                <div class="bg-light mr-2" style="height: 75px"></div>
                            </div>
                            <div class="col-4">
                                <div class="bg-light mr-2" style="height: 75px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 text-white">
            <h2>MORE GAME LIKE THIS</h2>
        </div>
        <div class="btn-outline-dark w-100" style="border-radius: 5px">
            <div class="container d-flex align-items-center">
                <button class="btn btn-cyan ml-auto" onclick="scrollContainer(-200)"><i class="mdi mdi-chevron-left"></i></button>
                <div class="scrollable-horizontal mx-2" id="scrollContainer">
                    @foreach ($other_game as $games)
                        <div class="scrollable-item mt-1" style="background-image: url({{ asset('storage/media/' . DB::table('game_medias')->where('games_id', $games->id)->where('jenis', 'image')->value('nama')) }}); background-size: cover; background-position: center;">
                            <a href="{{ route('frontend.game.show', $games->id) }}" class="w-100 h-100 d-block"></a>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-cyan mr-auto" onclick="scrollContainer(200)"><i class="mdi mdi-chevron-right"></i></button>
            </div>
        </div>
        <div class="mt-5 text-white">
            <h2>CUSTOMER REVIEWS</h2>
        </div>
        <hr class="hr-cyan">
        <div class="mt-2">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 mr-auto">
                    <div class="my-auto text-white">
                        <div class="row">
                            <div class="col-6">
                                <h3>
                                    Overall Rating :
                                </h3>
                            </div>
                            <div class="col-6 d-flex">
                                <i class="fas fa-star text-warning mr-1 mt-2" style="font-size: 2em"></i>
                                @php
                                    $reviewGrade = $review->avg('nilai'); // Calculate the average
                                    if (is_null($reviewGrade)) {  // Check if average is null (no reviews) - is_null is generally recommended
                                        $reviewGrade = 0;
                                    } else {
                                        $reviewGrade = number_format($reviewGrade, 1); // Format to one decimal place (optional)
                                    }
                                @endphp
                                <div class="row">
                                    <div class="col-12 d-flex align-items-center">
                                        <h1 class="mt-auto">{{ $reviewGrade }}</h1>
                                        <h3 class="text-secondary mt-auto">/10</h3>
                                    </div>
                                    <h4 class="col-12 text-secondary">({{ $review->count() }} reviews)</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Auth::check() && $cart->where('users_id', Auth::user()->id)->pluck('checkouts_id')->isNotEmpty())
                <div class="col-lg-6 text-white">
                    <form action="{{ route('backend.review.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <h5>Add your review+</h5>
                        <div class="rating">
                            @for ($i = 10; $i > 0; $i--)
                                <input value="{{ $i }}" name="nilai" id="star{{ $i }}" type="radio" data-toggle="collapse" data-target="#collapseStar" aria-expanded="false" aria-controls="collapseStar">
                                <label for="star{{ $i }}"></label>
                            @endfor                                                               
                        </div>
                        <div class="w-100" style="min-height: 120px;">
                            <div class="collapse width" id="collapseStar">
                                <div class="w-100">
                                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-75"></textarea>
                                    <input type="hidden" name="games_id" value="{{ $game->id }}">
                                    <input type="hidden" name="tanggal_ulasan" value="{{ today() }}">
                                    <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                </div>
                                @if ($review->where('users_id', Auth::user()->id)->isNotEmpty())
                                    <button type="submit" class="btn btn-primary">Update Review</button>
                                @else
                                    <button type="submit" class="btn btn-primary">Sumbit Review</button>
                                @endif                                    
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
        <hr class="hr-cyan">
        <div class="row mb-5">
            <div class="col-10 text-white">
                <div class="bg-dark">
                    <h4 class="ml-2 py-2">Newest Reviews</h4>
                </div>
                @foreach ($review as $reviews)
                    @if ($loop->iteration % 2 == 1)
                        <div class="bg-light">
                            <div class="row">
                                <div class="col-2">
                                    <div class="w-100 d-flex align-items-center">
                                        @if ($users->where('id', $reviews->users_id)->where('foto', Null))
                                            <img class="w-75 mx-auto my-2 border border-dark" src="{{ asset('storage/img-user/img-default.jpg') }}" alt="{{ $users->where('id', $reviews->users_id)->value('nama') }}">
                                        @else
                                            <img class="w-75 mx-auto my-2 border border-dark" src="{{ asset('storage/img-user/' . $users->where('id', $reviews->users_id)->value('foto')) }}" alt="{{ $users->where('id', $reviews->users_id)->value('nama') }}">  
                                        @endif
                                    </div>
                                    <div class="w-100 text-dark">
                                        <h5 class="w-75 mx-auto">{{ $users->where('id', $reviews->users_id)->value('nama') }}</h5>
                                    </div>
                                </div>
                                <div class="col-10 text-dark">
                                    <div class="row d-flex">
                                        <div class="col-12">
                                            <h3>
                                                <span><i class="fas fa-star text-warning mr-1 mt-2"></i></span>
                                                <span>{{ $reviews->nilai }}</span>
                                                <span class="text-dark-50">/10</span>
                                            </h3>
                                        </div>
                                        <div class="col-12">
                                            <p>
                                                {{ Carbon\Carbon::parse($reviews->tanggal_ulasan)->format('d M, Y') }}
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <p>
                                                {{ $reviews->deskripsi }}
                                            </p>
                                        </div>
                                        <div class="col-9 mt-auto">
                                            <hr class="hr-cyan">
                                        </div>
                                        <div class="col-12 d-inline-flex">
                                            <p>Was this review helpful?
                                                <h6 class="ml-2 text-warning">(database data column not yet available)</h6>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-secondary">
                            <div class="row">
                                <div class="col-2">
                                    <div class="w-100 d-flex align-items-center">
                                        @if ($users->where('id', $reviews->users_id)->where('foto', Null))
                                            <img class="w-75 mx-auto my-2 border border-light" src="{{ asset('storage/img-user/img-default.jpg') }}" alt="{{ $users->where('id', $reviews->users_id)->value('nama') }}">
                                        @else
                                            <img class="w-75 mx-auto my-2 border border-light" src="{{ asset('storage/img-user/' . $users->where('id', $reviews->users_id)->value('foto')) }}" alt="{{ $users->where('id', $reviews->users_id)->value('nama') }}">  
                                        @endif
                                    </div>
                                    <div class="w-100 text-light">
                                        <h5 class="w-75 mx-auto">{{ $users->where('id', $reviews->users_id)->value('nama') }}</h5>
                                    </div>
                                </div>
                                <div class="col-10 text-light">
                                    <div class="row d-flex">
                                        <div class="col-12">
                                            <h3>
                                                <span><i class="fas fa-star text-warning mr-1 mt-2"></i></span>
                                                <span>{{ $reviews->nilai }}</span>
                                                <span class="text-light-50">/10</span>
                                            </h3>
                                        </div>
                                        <div class="col-12">
                                            <p>
                                                {{ Carbon\Carbon::parse($reviews->tanggal_ulasan)->format('d M, Y') }}
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <p>
                                                {{ $reviews->deskripsi }}
                                            </p>
                                        </div>
                                        <div class="col-9 mt-auto">
                                            <hr class="hr-cyan">
                                        </div>
                                        <div class="col-12 d-inline-flex">
                                            <p>Was this review helpful?
                                                <h6 class="ml-2 text-warning">(database data column not yet available)</h6>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    @endif
                @endforeach
            </div>
            <div class="col-2">
                <div class="bg-dark text-center text-white px-2 py-2">
                    <h3>Language</h3>
                    <h6 class="text-warning">(database data column not yet available)</h6>
                    <div class="btn-group btn-group-toggle btn-group-vertical" data-toggle="buttons">
                        <label class="btn btn-secondary">
                            <input type="radio"> Indonesia
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio"> English
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio"> Japanese
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio"> Chinese
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/game_show.js')}}"></script>
@endsection

