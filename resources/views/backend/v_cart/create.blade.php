@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.cart.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="users_id">User</label>
                                        <select name="users_id" id="users_id" class="form-control @error('users_id')
                                            is-invalid
                                        @enderror">
                                            <option value="" selected>--Choose User--</option>
                                            @foreach ($user as $n)
                                                <option value="{{ $n->id }}">{{ $n->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('users_id')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="games_id">Game</label>
                                        <select name="games_id" id="games_id" class="form-control @error('games_id')
                                            is-invalid
                                        @enderror">
                                            <option value="" selected>--Choose Game--</option>
                                            @foreach ($game as $n)
                                                <option value="{{ $n->id }}">{{ $n->nama_game }}</option>
                                            @endforeach
                                        </select>
                                        @error('games_id')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah">Amount</label>
                                        <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" class="form-control @error('jumlah')
                                            is-invalid
                                        @enderror" placeholder="Input Amount">
                                        @error('jumlah')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('backend.cart.index') }}">
                                    <button type="button" class="btn btn-secondary">Back</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- contentAkhir --}}
    
@endsection