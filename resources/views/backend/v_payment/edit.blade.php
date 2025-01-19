@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.payment.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nama_bank">Paymen Method Name</label>
                                        <input type="text" name="nama_bank" id="nama_bank" value="{{ old('nama_bank', $edit->nama_bank) }}" class="form-control @error('nama_bank')
                                            is-invalid
                                        @enderror" placeholder="Enter Paymen Method Name">
                                        @error('nama_bank')
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
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-top">
                            <div class="card-body">
                                <button class="btn btn-primary">Update</button>
                                <a href="{{ route('backend.payment.index') }}">
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