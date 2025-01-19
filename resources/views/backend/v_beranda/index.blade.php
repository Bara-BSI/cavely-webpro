@extends('backend.v_layouts.app')
@section('content')

<!-- contentAwal -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <h5 class="card-title">{{ $judul }}</h5>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">
                        Welcome, {{ Auth::user()->nama }}
                    </h4>
                    to Cavely Dashboard. You are logged in as
                    <b>
                        @if (Auth::user()->role == 1)
                            Publisher.
                        @elseif (Auth::user()->role == 0)
                            Admin.
                        @else
                            Customer.
                            {{-- Seharusnya tidak bisa mengakses halaman backend --}}
                        @endif
                    </b>
                    <p>Here are some quick links to get you started:</p>
                    <div class="d-grid gap-2 d-md-block my-3">
                        @if (Auth::user()->role == 0)
                            <a href="{{ route('backend.region.index') }}" class="btn btn-info btn-lg my-1" role="button">
                                <i class="fas fa-map"></i>
                                Regions Management
                            </a>
                            <a href="{{ route('backend.country.index') }}" class="btn btn-warning btn-lg my-1" role="button">
                                <i class="fas fa-globe"></i>
                                Countries Management
                            </a>
                            <a href="{{ route('backend.user.index') }}" class="btn btn-primary btn-lg my-1" role="button">
                                <i class="fas fa-user"></i>
                                Users Management
                            </a>
                            <a href="{{ route('backend.genre.index') }}" class="btn btn-success btn-lg my-1" role="button">
                                <i class="fas fa-th-list"></i>
                                Genres Management
                            </a>
                            <a href="{{ route('backend.payment.index') }}" class="btn btn-danger btn-lg my-1" role="button">
                                <i class="fas fa-credit-card"></i>
                                Payment Method Management
                            </a>
                            <a href="{{ route('backend.cart.index') }}" class="btn btn-light btn-lg my-1" role="button">
                                <i class="fas fa-shopping-cart"></i>
                                User's Cart Management
                            </a>
                        @else
                            <a href="{{ route('backend.user.edit', Auth::user()->id) }}" class="btn btn-primary btn-lg my-1" role="button">
                                <i class="fas fa-user"></i>
                                Account Management
                            </a>
                        @endif
                        <a href="{{ route('backend.game.index') }}" class="btn btn-secondary btn-lg my-1" role="button">
                            <i class="fas fa-gamepad"></i>
                            Games Management
                        </a>
                        <a href="{{ route('backend.checkout.index') }}" class="btn btn-dark btn-lg my-1" role="button">
                            <i class="fas fa-dollar-sign"></i>
                            Orders Management
                        </a>
                    </div>
                    <hr>
                    <p class="text-center">Brought to you by BARESCRIM</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->
@endsection