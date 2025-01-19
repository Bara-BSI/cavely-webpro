@extends('frontend.v_layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('style.css')}}">
<div class="promosi_utama">
    <img src="{{ asset('image/gambar_beranda.png') }}" alt="Large Image" class="full-screen-image">
    <div class="centered-text">
        <div class="main-title">NEW YEAR SALE!</div>
        <div class="sub-main-title">25 December 2024 - 5 January 2025</div>
    </div>
</div>
<div class="additional-images">
    <img class="btn rounded-corner" src="{{ asset('image/saka.png') }}" alt="Image 1">
    <img src="{{ asset('image/theotown.png') }}" alt="Image 2">
    <img src="{{ asset('image/readyornot.png') }}" alt="Image 3">
</div>
<div class="content">
    <div class="menu-title">TRENDING GAME THIS WEEK</div>
    <div class="content-images">
        <img src="{{ asset('image/infinitynikki.png') }}" alt="Content Image 1">
        <img src="{{ asset('image/soul_reaver.png') }}" alt="Content Image 2">
        <img src="{{ asset('image/star_wars.png') }}" alt="Content Image 3">
    </div>
    <div class="content-images2">
        <img src="{{ asset('image/omori.png') }}" alt="Content Image2 1">
        <img src="{{ asset('image/neva.png') }}" alt="Content Image2 2">
    </div>
    <div class="menu-title2">DISCOUNT UP TO 90%</div>
    <div class="shape-container">
        <div class="arrow">&#9664;</div> <!-- Left arrow -->
        <div class="images">
            <img src="{{ asset('image/saka2.png') }}" alt="Image 1">
            <img src="{{ asset('image/chains_of_satinav.png') }}" alt="Image 2">
            <img src="{{ asset('image/the_thing.png') }}" alt="Image 3">
        </div>
        <div class="arrow">&#9654;</div> <!-- Right arrow -->
    </div>
    <div class="side-by-side-titles">
        <div class="menu-title1">BEST SELLER</div>
        <div class="menu-title2">NEW REALEASES</div>
    </div>
    <div class="columns">
        <div class="column">
            <img src="{{ asset('image/omori_2.png') }}" alt="OMORI">
            <div>
                <h1>OMORI</h1>
                <p>Psychological Horror, RPG, Adventure</p>
                <p>By OMOCAT, LLC</p>
            </div>
            <img src="{{ asset('icon/add_cart.png') }}" alt="Cart Icon" class="cart-icon">
            <div class="price">$19.99</div>
            <div class="price-shape">50% OFF</div>
        </div>
        <div class="column"> 
            <img src="{{ asset('image/saka.png') }}" alt="SAKA">
            <div>
                <h1>SAKA</h1>
                <p>Visual Novel, Simulation, Single Player</p>
                <p>By BARESCRIM</p>
            </div>
            <img src="{{ asset('icon/add_cart.png') }}" alt="Cart Icon" class="cart-icon">
            <div class="price">$29.99</div>
            <div class="price-shape">30% OFF</div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <img src="{{ asset('image/omori_2.png') }}" alt="OMORI">
            <div>
                <h1>OMORI</h1>
                <p>Psychological Horror, RPG, Adventure</p>
                <p>By OMOCAT, LLC</p>
            </div>
            <img src="{{ asset('icon/add_cart.png') }}" alt="Cart Icon" class="cart-icon">
            <div class="price">
                <p style="font-size: 15px; text-decoration: line-through;">IDR 108.000</p>
                <p>IDR 54.000</p>
            </div>
            <div class="price-shape">-50%</div>
        </div>
        <div class="column"> 
            <img src="{{ asset('image/saka.png') }}" alt="SAKA">
            <div>
                <h1>SAKA</h1>
                <p>Visual Novel, Simulation, Single Player</p>
                <p>By BARESCRIM</p>
            </div>
            <img src="{{ asset('icon/add_cart.png') }}" alt="Cart Icon" class="cart-icon">
            <div class="price">
                <p style="font-size: 15px; text-decoration: line-through;">IDR 108.000</p>
                <p>IDR 54.000</p>
            </div>
            <div class="price-shape">30% OFF</div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <img src="{{ asset('image/omori_2.png') }}" alt="OMORI">
            <div>
                <h1>OMORI</h1>
                <p>Psychological Horror, RPG, Adventure</p>
                <p>By OMOCAT, LLC</p>
            </div>
            <img src="{{ asset('icon/add_cart.png') }}" alt="Cart Icon" class="cart-icon">
            <div class="price">$19.99</div>
            <div class="price-shape">-50%</div>
        </div>
        <div class="column"> 
            <img src="{{ asset('image/saka.png') }}" alt="SAKA">
            <div>
                <h1>SAKA</h1>
                <p>Visual Novel, Simulation, Single Player</p>
                <p>By BARESCRIM</p>
            </div>
            <img src="{{ asset('icon/add_cart.png') }}" alt="Cart Icon" class="cart-icon">
            <div class="price">$29.99</div>
            <div class="price-shape">30% OFF</div>
        </div>
    </div>
    <!-- Tambahkan konten tambahan di sini -->
</div>
@endsection