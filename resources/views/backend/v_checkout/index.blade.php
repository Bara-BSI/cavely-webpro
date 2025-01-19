@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="row">
        <div class="col-12">
            @if (Auth::user()->role == 0)
                <a href="{{ route('backend.checkout.create') }}">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Confirmed Orders
                    </button>
                </a>                
            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $judul }}</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            @if (Auth::user()->role == 0)
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Receipt Date</th>
                                        <th>User</th>
                                        <th>Games</th>
                                        <th>Amount</th>
                                        <th>Total Price</th>
                                        <th>Payment Method</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($index as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->tanggal_checkout }}</td>
                                            <td>
                                                @php
                                                    $cart = DB::table('carts')->where('checkouts_id', $row->id)->pluck('users_id');
                                                @endphp
                                                @foreach ($cart as $cart_id)
                                                    @php
                                                        $carts_user_name = DB::table('users')->where('id', $cart_id)->value('nama');
                                                    @endphp
                                                    <div>
                                                        <b>
                                                            {{ $carts_user_name }}
                                                        </b>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                @php
                                                    $cart = DB::table('carts')->where('checkouts_id', $row->id)->pluck('games_id');
                                                @endphp
                                                @foreach ($cart as $cart_id)
                                                    @php
                                                        $carts_game_name = DB::table('games')->where('id', $cart_id)->value('nama_game');
                                                    @endphp
                                                    <div>
                                                        <b>
                                                            {{ $carts_game_name }}
                                                        </b>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                @php
                                                    $cart = DB::table('carts')->where('checkouts_id', $row->id)->pluck('jumlah');
                                                @endphp
                                                @foreach ($cart as $cart_id)
                                                    <div>
                                                        <b>
                                                            {{ $cart_id }}
                                                        </b>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>{{ $row->total_harga }}</td>
                                            <td>{{ $payment->find($row->payments_id)->nama_bank }}</td>
                                            <td>
                                                <form action="{{ route('backend.checkout.destroy', $row->id) }}" method="post" style="display: inline-block">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="{{ $row->nama }}" title="Hapus Data">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>Inputted Game</th>
                                        <th>Amount</th>
                                        <th>Receipt Date</th>
                                        <th>Receipt ID</th>
                                        <th>Total Price</th>
                                        <th>Payment Method</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($index as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->find($row->users_id)->nama }}</td>
                                            <td>{{ $game->find($row->games_id)->nama_game }}</td>
                                            <td>{{ $row->jumlah }}</td>
                                            <td>{{ $checkout->find($row->checkouts_id)->tanggal_checkout }}</td>
                                            <td>{{ $checkout->find($row->checkouts_id)->id }}</td>
                                            <td>
                                                @php
                                                    $jumlah = $row->jumlah;
                                                    $harga = $game->find($row->games_id)->harga;
                                                    $total = $jumlah * $harga;
                                                @endphp
                                                {{ $total }}
                                            </td>
                                            <td>{{ $payment->find($checkout->find($row->checkouts_id)->payments_id)->nama_bank }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- contentAkhir --}}
@endsection