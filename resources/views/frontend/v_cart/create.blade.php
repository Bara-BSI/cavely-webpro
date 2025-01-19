@extends('frontend.v_layouts.app')

@section('content')
    <div class="container">
        <div class="text-center text-white my-5">
            <h1>{{ $judul }}</h1>
        </div>
        
        <div class="row">
        
            <div class="col-12 text-white bg-dark">
                <div class="row d-flex align-items-center">
                    <div class="col-1"><h5 class="my-2 text-center">No</h5></div>
                    <div class="col-4"><h5 class="my-2">Game Name</h5></div>
                    <div class="col-1"><h5 class="my-2 text-center">Amount</h5></div>
                    <div class="col-2"><h5 class="my-2 text-right">Price</h5></div>
                    <div class="col-2"><h5 class="my-2 text-right">Sub Total</h5></div>
                    <div class="col-2"><h5 class="my-2 text-center">Action</h5></div>
                </div>
            </div>

            @php
                $grandTotal = 0;
            @endphp
            @foreach ($cart as $carts)                
                @if ($loop->iteration % 2 == 1)
                    <div class="col-12 pt-2 text-dark bg-light">
                        <div class="row d-flex align-items-center">                    
                            <div class="col-1 my-auto text-center"><h6>{{ $loop->iteration }}</h6></div>                            
                            <div class="col-4 my-auto"><h6>{{ $game->where('id', $carts->games_id)->value('nama_game') }}</h6></div>
                            <div class="col-1 my-auto text-center"><h6>{{ $carts->jumlah }}</h6></div>
                            <div class="col-2 my-auto text-right"><h6>{{ $game->where('id', $carts->games_id)->value('harga') }}</h6></div>
                            <div class="col-2 my-auto text-right"><h6>{{ $game->where('id', $carts->games_id)->value('harga') * $carts->jumlah }}</h6></div>
                            <div class="col-2 my-auto text-center"><h6>
                                <form action="{{ route('frontend.cart.destroy', $carts->id) }}" method="post" style="display: inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="{{ $carts->nama }}" title="Delete Data">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </h6></div>
                        </div>
                    </div>
                @else
                    <div class="col-12 pt-2 text-white bg-secondary">
                        <div class="row d-flex align-items-center">                      
                            <div class="col-1 my-auto text-center"><h6>{{ $loop->iteration }}</h6></div>                            
                            <div class="col-4 my-auto"><h6>{{ $game->where('id', $carts->games_id)->value('nama_game') }}</h6></div>
                            <div class="col-1 my-auto text-center"><h6>{{ $carts->jumlah }}</h6></div>
                            <div class="col-2 my-auto text-right"><h6>{{ $game->where('id', $carts->games_id)->value('harga') }}</h6></div>
                            <div class="col-2 my-auto text-right"><h6>{{ $game->where('id', $carts->games_id)->value('harga') * $carts->jumlah }}</h6></div>
                            <div class="col-2 my-auto text-center"><h6>
                                <form action="{{ route('frontend.cart.destroy', $carts->id) }}" method="post" style="display: inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="{{ $carts->nama }}" title="Delete Data">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </h6></div>
                        </div>
                    </div>
                @endif
                @php
                    $grandTotal += $game->where('id', $carts->games_id)->value('harga') * $carts->jumlah
                @endphp
            @endforeach
            <form action="{{ route('frontend.checkout.store') }}" method="post" class="form-horizontal col-12" enctype="multipart/form-data">
                @csrf
                    <div class="my-3">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9 d-inline-flex text-white">
                                <h3 class="mx-auto my-auto">Grand Total :</h3>
                                <h3 class="mx-auto my-auto d-inline-flex">
                                    <span class="mr-3">IDR</span>
                                    {{ $grandTotal }}
                                </h3>
                                <input type="hidden" name="carts" value="{{ $cart->pluck('id') }}">
                                <input type="hidden" name="total_harga" value="{{ $grandTotal }}">
                                <input type="hidden" name="tanggal_checkout" value="{{ today() }}">
                                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="false" aria-controls="collapsePayment">
                                    Choose Payment Method
                                </button>
                            </div>
                            <div class="collapse col-12 mt-3" id="collapsePayment">
                                    <div class="card card-body text-center">
                                        <div class="form-group">
                                            <label for="payments_id">Payment Method</label>
                                            <select name="payments_id" id="payments_id" class="form-control @error('payments_id')
                                                is-invalid
                                            @enderror">
                                                <option value="" selected>--Choose Payment Method--</option>
                                                @foreach ($payment as $n)
                                                    <option value="{{ $n->id }}">{{ $n->nama_bank }}</option>
                                                @endforeach
                                            </select>
                                            @error('payments_id')
                                                <span class="invalid-feedback alert-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success">Confirm Order</button>
                                    </div>
                                </div>
                        </div>
                    </div>
            </form>
                    
        </div>
    </div>
@endsection