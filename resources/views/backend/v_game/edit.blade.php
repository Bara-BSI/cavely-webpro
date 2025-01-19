@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.game.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nama_game">Game Name</label>
                                        <input type="text" name="nama_game" id="nama_game" value="{{ old('nama_game', $edit->nama_game) }}" class="form-control @error('nama_game')
                                            is-invalid
                                        @enderror" placeholder="Input Game Name">
                                        @error('nama_game')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="tanggal_rilis">Release Date</label>
                                        <input type="date" name="tanggal_rilis" id="tanggal_rilis" value="{{ old('tanggal_rilis', $edit->tanggal_rilis) }}" class="form-control @error('tanggal_rilis')
                                            is-invalid
                                        @enderror" placeholder="Input Release Date">
                                        @error('tanggal_rilis')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="harga">Price</label>
                                        <input type="number" name="harga" id="harga" value="{{ old('harga', $edit->harga) }}" class="form-control @error('harga')
                                            is-invalid
                                        @enderror" placeholder="Input Price">
                                        @error('harga')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control @error('status')
                                            is-invalid
                                        @enderror">
                                            <option value="" {{ old('status', $edit->status) == '' ? 'selected' : '' }}>
                                                - Choose Status -
                                            </option>
                                            <option value="1" {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                            <option value="2" {{ old('status', $edit->status) == '2' ? 'selected' : '' }}>
                                                Coming Soon
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi">Description</label>
                                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Input Description">{{ old('deskripsi', $edit->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="genres">Genres</label>
                                        <div class="form-check">
                                            @foreach ($genres as $genre)
                                                <div>
                                                    <input type="checkbox" name="genres[]" id="genre_{{ $genre->id }}" value="{{ $genre->id }}" class="form-check-input @error('genres') is-invalid @enderror" {{ in_array($genre->id, old('genres', $game_genre->pluck('genres_id')->toArray())) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="genre_{{ $genre->id }}">
                                                        {{ $genre->nama_genre }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('genres')
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
                                <button class="btn btn-primary">Perbarui</button>
                                <a href="{{ route('backend.game.index') }}">
                                    <button type="button" class="btn btn-secondary">Kembali</button>
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