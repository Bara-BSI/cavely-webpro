@extends('frontend.v_layouts.app')
    <style>
        .bg-login {
            background-size: cover;
            background-repeat: no-repeat;
            background-image: url({{ asset('image/bg_login.png') }});
        }

        .bg-login2 {
            background: rgba(89, 154, 148, 0.75) !important;
        }

        .bg-login3 {
            background: rgba(0, 0, 0, 0.5) !important;
        }

        .btn-transparent {
            background: transparent !important;
            color: rgba(0, 0, 0, 0.5) !important;
        }

    </style>
@section('content')
    {{-- contentAwal --}}
    <div class="container-fluid bg-login">
        <h5>Cavely v.0.3.1</h1>
        <h1 class="text-white mx-auto text-center py-10"> {{ $judul }} </h1>
        <div class="row">
            <div class="col-lg-1 col-md-0"></div>
            <div class="col-lg-10 col-md-12">
                <div class="card bg-login  bg-login2 text-white">
                    <form action="{{ route('frontend.user.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="foto">Photo</label>
                                        {{-- view image --}}
                                        @if ($edit->foto)
                                            <img src="{{ asset('storage/img-user/' . $edit->foto) }}" class="foto-preview" width="100%">
                                            <p></p>
                                        @else
                                            <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="foto-preview" width="100%">
                                            <p></p>
                                        @endif
                                        {{-- file foto --}}
                                        <input type="file" name="foto" id="foto" class="form-control @error('foto')
                                            is-invalid
                                        @enderror" onchange="previewFoto()">
                                        @error('foto')
                                           <div class="invalid-feedback alert-danger">
                                                {{ $message }}
                                           </div>
                                        @enderror 
                                    </div>
                                </div>

                                <div class="col-md-8 bg-login3">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select name="role" id="role" class="form-control @error('role')
                                            is-invalid
                                        @enderror">
                                            <option value="" {{ old('role', $edit->role) == '' ? 'selected' : '' }}>
                                                - Choose Role -
                                            </option>
                                            @if (Auth::user()->role == 0)
                                                <option value="0" {{ old('role', $edit->role) == '0' ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                            @endif
                                            <option value="1" {{ old('role', $edit->role) == '1' ? 'selected' : '' }}>
                                                Publisher
                                            </option>
                                            <option value="2" {{ old('role', $edit->role) == '2' ? 'selected' : '' }}>
                                                Customer
                                            </option>
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Name</label>
                                        <input type="text" name="nama" id="nama" value="{{ old('nama', $edit->nama) }}" class="form-control @error('nama')
                                            is-invalid
                                        @enderror" placeholder="Enter Name">
                                        @error('nama')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" value="{{ old('email', $edit->email) }}" class="form-control @error('email')
                                            is-invalid
                                        @enderror" placeholder="Enter Email">
                                        @error('email')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="hp">Phone Number</label>
                                        <input type="text" name="hp" id="hp" onkeypress="return hanyaAngka(event)" value="{{ old('hp', $edit->hp) }}" class="form-control @error('hp')
                                            is-invalid
                                        @enderror" placeholder="Enter Phone Number">
                                        @error('hp')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_lahir">Birth Date</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $edit->tanggal_lahir) }}" class="form-control @error('tanggal_lahir')
                                            is-invalid
                                        @enderror" placeholder="Enter Birth Date">
                                        @error('tanggal_lahir')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="countries_id">Country</label>
                                        <select name="countries_id" id="countries_id" class="form-control @error('countries_id')
                                            is-invalid
                                        @enderror">
                                            <option value="" disabled>--Choose Country--</option>
                                            @foreach ($negara as $n)
                                                <option value="{{ $n->id }}" {{ old('countries_id', $edit->countries_id) == $n->id ? 'selected' : '' }}>{{ $n->nama_negara }}</option>
                                            @endforeach
                                        </select>
                                        @error('countries_id')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-top">
                            <div class="card-body row">
                                <a href="{{ route('frontend.beranda') }}" class="col-md-2 col-sm-4 btn btn-secondary">
                                    Back
                                </a>
                                <div class="col"></div>
                                <button class="btn btn-warning col-md-2 col-sm-4">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- contentAkhir --}}
@endsection