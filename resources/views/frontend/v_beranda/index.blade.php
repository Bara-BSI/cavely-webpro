@extends('frontend.v_layouts.app')

@section('content')
{{-- Awal konten --}}
<link rel="stylesheet" href="{{ asset('css/beranda.css')}}">
<div class="overallbg">
    <div class="bg-landingpage py-5">
        <div class="ml-5">
            <form class="form">
                <button>
                    <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                        <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <input class="input" placeholder="{{ DB::table('games')->inRandomOrder()->value('nama_game') }}" required="" type="text">
                <button class="reset" type="reset">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </form>
        </div>
        <div class="container text-white text-center my-5 py-5">
            <h1 style="font-size: 128px">NEW YEAR SALE!</h1>
            <h2 style="font-size: 48px">25 December 2024 - 5 January 2025</h2>
        </div>
    </div>

    <div class="py-3 px-3" style="position: relative">
        <div class="row mx-auto">
            @php
                $game1 = DB::table('games')->inRandomOrder()->limit(3)->get()
            @endphp
            @foreach ($game1 as $games)
                <div class="col-lg-4">
                    <div class="mx-1 my-2" style="background-image: url({{ asset('storage/media/' . DB::table('game_medias')->where('games_id', $games->id)->where('jenis', 'image')->value('nama')) }}); background-size: cover; background-position: center; height: 500px;">
                        <a href="{{ route('frontend.game.show', $games->id) }}" class="w-100 h-100 d-block"></a>
                    </div>
                </div>
            @endforeach              
        </div>
        <div class="w-100 h-100 d-block overlay1"></div>
    </div>

    <div class="py-3 px-3">
        <div class="text-white ml-5">
            <h1 style="font-size: 80px">TRENDING GAMES THIS WEEK</h1>
        </div>
        <div class="row mx-auto">
            @php
                $game2 = DB::table('games')->inRandomOrder()->limit(5)->get()
            @endphp
            @foreach ($game2 as $games)
                @if ($loop->iteration <4)
                    <div class="col-lg-4" style="position: relative">
                        <div class="mx-1 my-2 hover-container" style="background-image: url({{ asset('storage/media/' . DB::table('game_medias')->where('games_id', $games->id)->where('jenis', 'image')->value('nama')) }}); background-size: cover; background-position: center; height: 300px;">
                            <a href="{{ route('frontend.game.show', $games->id) }}" class="w-100 h-100 d-block"></a>
                            <div class="hover-element overlay2 text-white">
                                <div class="row" style="pointer-events: fill">
                                    <div class="col-2 mx-auto my-auto">
                                        <div class="rounded besaran-diskon mx-auto my-auto"></div>
                                    </div>
                                    <div class="col-8 my-auto">
                                        <p>
                                            <del>
                                                Harga Diskon
                                            </del>
                                        </p>
                                        <h3>
                                            IDR {{ $games->harga }}
                                        </h3>
                                    </div>
                                    <div class="col-2 my-auto">
                                        <a href="">
                                            <i class="fa fa-cart-plus text-xl text-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                @else
                    <div class="col-lg-6">
                        <div class="mx-1 my-2 hover-container" style="background-image: url({{ asset('storage/media/' . DB::table('game_medias')->where('games_id', $games->id)->where('jenis', 'image')->value('nama')) }}); background-size: cover; background-position: center; height: 500px;">
                            <a href="{{ route('frontend.game.show', $games->id) }}" class="w-100 h-100 d-block"></a>
                            <div class="hover-element overlay3 text-white">
                                <div class="row" style="pointer-events: fill">
                                    <div class="col-2 mx-auto my-auto">
                                        <div class="rounded besaran-diskon mx-auto my-auto"></div>
                                    </div>
                                    <div class="col-8 my-auto">
                                        <p>
                                            <del>
                                                Harga Diskon
                                            </del>
                                        </p>
                                        <h3>
                                            IDR {{ $games->harga }}
                                        </h3>
                                    </div>
                                    <div class="col-2 my-auto">
                                        <a href="">
                                            <i class="fa fa-cart-plus text-xl text-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif            
            @endforeach  
        </div>
    </div>

    <div class="my-3 mx-3">
        <div class="mr-5 text-white">
            <h1 class="text-right text-xl">DISCOUNT UP TO 90%</h1>
        </div>
        <div class="row" style="background-color: #3B7475">
            <div class="col-1 my-auto text-right">
                <button id="leftBtn" class="btn text-xl btn-cyan"><i class="mdi mdi-chevron-left"></i></button>
            </div>
            <div class="col-10 horizontal-scrollable">
                <div class="row">
                    @php
                        $game3 = DB::table('games')->inRandomOrder()->limit(5)->get()
                    @endphp
                    @foreach ($game3 as $games)
                        <div class="col" style="width:500px">
                            <div class="" style="background-image: url({{ asset('storage/media/' . DB::table('game_medias')->where('games_id', $games->id)->where('jenis', 'image')->value('nama')) }}); background-size: cover; background-position: center; height: 300px;">
                                <a href="{{ route('frontend.game.show', $games->id) }}" class="w-100 h-100 d-block"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-1 my-auto text-left">
                <button id="rightBtn" class="btn text-xl btn-cyan"><i class="mdi mdi-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <div class="my-3 mx-3 row" style="position: relative">
        <div class="col-xl-12 d-flex justify-content-center garis-pemisah" style="position: absolute">
            <div style="width: 5px; height: 100%; background-color: #599A94; border-radius: 2.5px"></div>
        </div>
        
        <div class="col-xl-6 mb-3">
            <div class="text-white ml-3">
                <h1 class="text-xl">Best Seller</h1>
            </div>
            <div class="card bg-transparent">
                @php
                    $game4 = DB::table('games')->inRandomOrder()->limit(5)->get()
                @endphp
                @foreach ($game4 as $games)
                    @php
                        $genres = DB::table('game_genres')->where('games_id', $games->id)->inRandomOrder()->limit(3)->pluck('genres_id');
                    @endphp
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-4" style="background-image: url({{ asset('storage/media/' . DB::table('game_medias')->where('games_id', $games->id)->where('jenis', 'image')->value('nama')) }}); background-size: cover; background-position: center; height: 300px;">
                                <a href="{{ route('frontend.game.show', $games->id) }}" class="w-100 h-100 d-block"></a>
                            </div>
                            
                            <div class="col-8 bg-dark text-white">
                                <div class="mx-1 my-3 row">
                                    <div class="col-11">
                                        <a href="{{ route('frontend.game.show', $games->id) }}" class="text-white under-hover">
                                            <h1>{{ $games->nama_game }}</h1>                                         
                                        </a>
                                        <h4>
                                            @foreach ($genres as $genre_id)
                                                @php
                                                    $genre_name = DB::table('genres')->where('id', $genre_id)->value('nama_genre');
                                                @endphp
                                                {{ $genre_name }}{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        </h4>
                                        <h4>
                                            By {{ DB::table('users')->where('id', $games->users_id)->value('nama') }}
                                        </h4>
                                    </div>
                                    <div class="col-1 my-1 mx-auto">
                                        <a href="">
                                            <h4><i class="fa fa-cart-plus text-white"></i></h4>
                                        </a>
                                    </div>
                                    <div class="col-12 my-auto">
                                        <div class="row">
                                            <div class="col-lg-7"></div>
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="rounded besaran-diskon mx-auto my-auto"></div>
                                                    </div>
                                                    <div class="col-8">
                                                        <p>
                                                            <del>
                                                                Harga Diskon
                                                            </del>
                                                        </p>
                                                        <h3>
                                                            IDR {{ $games->harga }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
               
        <div class="col-xl-6 mb-3">
            <div class="text-white ml-3">
                <h1 class="text-xl">New Domestic Games</h1>
            </div>
            <div class="card bg-transparent">
                @php
                    $genreId = DB::table('genres')->where('nama_genre', 'Domestic Market')->value('id');
                    $gameId = DB::table('game_genres')->where('genres_id', $genreId)->pluck('games_id');
                    $game5 = DB::table('games')->whereIn('id', $gameId)->orderBy('id', 'desc')->limit(5)->get();
                @endphp
                @foreach ($game5 as $games)
                    @php
                        $genres = DB::table('game_genres')->where('games_id', $games->id)->inRandomOrder()->limit(3)->pluck('genres_id');
                    @endphp
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-4" style="background-image: url({{ asset('storage/media/' . DB::table('game_medias')->where('games_id', $games->id)->where('jenis', 'image')->value('nama')) }}); background-size: cover; background-position: center; height: 300px;">
                                <a href="{{ route('frontend.game.show', $games->id) }}" class="w-100 h-100 d-block"></a>
                            </div>
                            
                            <div class="col-8 bg-dark text-white">
                                <div class="mx-1 my-3 row">
                                    <div class="col-11">
                                        <a href="{{ route('frontend.game.show', $games->id) }}" class="text-white under-hover">
                                            <h1>{{ $games->nama_game }}</h1>                                         
                                        </a>
                                        <h4>
                                            @foreach ($genres as $genre_id)
                                                @php
                                                    $genre_name = DB::table('genres')->where('id', $genre_id)->value('nama_genre');
                                                @endphp
                                                {{ $genre_name }}{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        </h4>
                                        <h4>
                                            By {{ DB::table('users')->where('id', $games->users_id)->value('nama') }}
                                        </h4>
                                    </div>
                                    <div class="col-1 my-1 mx-auto">
                                        <a href="">
                                            <h4><i class="fa fa-cart-plus text-white"></i></h4>
                                        </a>
                                    </div>
                                    <div class="col-12 my-auto">
                                        <div class="row">
                                            <div class="col-lg-7"></div>
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="rounded besaran-diskon mx-auto my-auto"></div>
                                                    </div>
                                                    <div class="col-8">
                                                        <p>
                                                            <del>
                                                                Harga Diskon
                                                            </del>
                                                        </p>
                                                        <h3>
                                                            IDR {{ $games->harga }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        
    </div>
    
</div>

<script src="{{ asset('js/beranda.js')}}"></script>

{{-- Akhir konten --}}
@endsection