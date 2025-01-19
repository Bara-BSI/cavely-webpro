@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.genre.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nama_genre">Genre Name</label>
                                        <input type="text" name="nama_genre" id="nama_genre" value="{{ old('nama_genre', $edit->nama_genre) }}" class="form-control @error('nama_genre')
                                            is-invalid
                                        @enderror" placeholder="Input Genre Name">
                                        @error('nama_genre')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="usia_minimal">Minimum Age</label>
                                        <input type="text" name="usia_minimal" id="usia_minimal" onkeypress="return hanyaAngka(event)" value="{{ old('usia_minimal', $edit->usia_minimal) }}" class="form-control @error('usia_minimal')
                                            is-invalid
                                        @enderror" placeholder="Input Minimum Age">
                                        @error('usia_minimal')
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
                                <a href="{{ route('backend.genre.index') }}">
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