@extends('backend.v_layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.produk.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <img class="foto-preview">
                                        <input id="foto" class="form-control @error('foto')
                                            is-invalid
                                        @enderror" type="file" name="foto" onchange="previewFoto()">
                                        @error('foto')
                                            <div class="invalid-feedback alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="kategori_id" class="form-control @error('kategori')
                                            is-invalid
                                        @enderror">
                                            <option value="" selected>--Pilih Kategori--</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <span class="invalid-feedback alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}" class="form-control @error('nama_produk')
                                            is-invalid
                                        @enderror" placeholder="Masukkan Nama Produk">
                                        @error('nama_produk')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ckeditor">Detail</label>
                                        <textarea name="detail" id="ckeditor" class="form-control @error('detail')
                                            is-invalid
                                        @enderror">
                                            {{ old('detail') }}
                                        </textarea>
                                        @error('detail')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" name="harga" id="harga" onkeypress="return hanyaAngka(event)" value="{{ old('harga') }}" class="form-control @error('harga')
                                            is-invalid
                                        @enderror" placeholder="Masukkan Harga Produk">
                                        @error('harga')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="berat">Berat</label>
                                        <input type="text" name="berat" id="berat" onkeypress="return hanyaAngka(event)" value="{{ old('berat') }}" class="form-control @error('berat')
                                            is-invalid
                                        @enderror" placeholder="Masukkan Berat Produk">
                                        @error('berat')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input type="text" name="stok" id="stok" onkeypress="return hanyaAngka(event)" value="{{ old('stok') }}" class="form-control @error('stok')
                                            is-invalid
                                        @enderror" placeholder="Masukkan Stok Produk">
                                        @error('stok')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('backend.produk.index') }}">
                                    <button type="button" class="btn btn-secondary">Kembali</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection