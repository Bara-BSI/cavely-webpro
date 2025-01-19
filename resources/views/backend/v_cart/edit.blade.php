@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.cart.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="form-group">
                            <label for="users_id">User</label>
                            <select name="users_id" id="users_id" class="form-control @error('users_id')
                                is-invalid
                            @enderror">
                                <option value="" selected>--Choose User--</option>
                                @foreach ($user as $n)
                                    <option value="{{ $n->id }}" {{ old('users_id', $edit->users_id) == $n->id ? 'selected' : '' }}>{{ $n->nama }}</option>
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
                                    <option value="{{ $n->id }}" {{ old('games_id', $edit->games_id) == $n->id ? 'selected' : '' }}>{{ $n->nama_game }}</option>
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
                            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $edit->jumlah) }}" class="form-control @error('jumlah')
                                is-invalid
                            @enderror" placeholder="Input Amount">
                            @error('jumlah')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="border-top">
                            <div class="card-body">
                                <button class="btn btn-primary">Update</button>
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