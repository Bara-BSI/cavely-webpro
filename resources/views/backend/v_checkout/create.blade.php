@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.checkout.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="carts">Carts</label>
                                        <div class="form-check">
                                            @foreach ($carts as $cart)
                                                <div>
                                                    <input type="checkbox" name="carts[]" id="carts_{{ $cart->id }}" value="{{ $cart->id }}" class="form-check-input cart-checkbox @error('carts') is-invalid @enderror"
                                                    data-price="{{ $cart->jumlah * $games->find($cart->games_id)->harga }}"
                                                    {{ in_array($cart->id, old('carts', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label w-100" for="carts_{{ $cart->id }}">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                {{ $users->find($cart->users_id)->nama }}
                                                            </div>
                                                            <div class="col-4">
                                                                {{ $games->find($cart->games_id)->nama_game }}
                                                            </div>
                                                            <div class="col-4">
                                                                {{ $cart->jumlah }}
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('carts')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_checkout">Order Date</label>
                                        <input type="date" name="tanggal_checkout" id="tanggal_checkout" value="{{ old('tanggal_checkout') }}" class="form-control @error('tanggal_checkout')
                                            is-invalid
                                        @enderror" placeholder="Input Order Date">
                                        @error('tanggal_checkout')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total_harga">Total Price</label>
                                        <input type="number" name="total_harga" id="total_harga" value="{{ old('total_harga') }}" class="form-control @error('total_harga')
                                            is-invalid
                                        @enderror" placeholder="Input Price" readonly>
                                        @error('total_harga')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="payments_id">Payment Method</label>
                                        <select name="payments_id" id="payments_id" class="form-control @error('payments_id')
                                            is-invalid
                                        @enderror">
                                            <option value="" selected>--Choose Payment Method--</option>
                                            @foreach ($payments as $n)
                                                <option value="{{ $n->id }}">{{ $n->nama_bank }}</option>
                                            @endforeach
                                        </select>
                                        @error('payments_id')
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
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('backend.checkout.index') }}">
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

    <script>
        const checkboxes = document.querySelectorAll('.cart-checkbox');
        const totalHargaInput = document.getElementById('total_harga');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateTotalHarga);
        });

        function updateTotalHarga() {
            let total = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.dataset.price);
                }
            });
            totalHargaInput.value = total;
        }

        // Initial calculation on page load
        updateTotalHarga();
    </script>
    
@endsection