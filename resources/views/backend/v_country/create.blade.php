@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.country.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                                        <label for="nama_negara">Country Name</label>
                                        <input type="text" name="nama_negara" id="nama_negara" value="{{ old('nama_negara') }}" class="form-control @error('nama_negara')
                                            is-invalid
                                        @enderror" placeholder="Enter Country Name">
                                        @error('nama_negara')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="regions_id">Regions</label>
                                        <select name="regions_id" id="regions_id" class="form-control @error('regions_id')
                                            is-invalid
                                        @enderror">
                                            <option value="" selected>--Pilih Regions--</option>
                                            @foreach ($region as $n)
                                                <option value="{{ $n->id }}">{{ $n->nama_region }}</option>
                                            @endforeach
                                        </select>
                                        @error('regions_id')
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
                                <a href="{{ route('backend.country.index') }}">
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