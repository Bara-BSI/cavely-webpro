@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.cart.create') }}">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Cart
                </button>
            </a>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $judul }}</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User Name</th>
                                    <th>Inputted Game</th>
                                    <th>Amount</th>
                                    <th>Has been paid</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->find($row->users_id)->nama }}</td>
                                        <td>{{ $game->find($row->games_id)->nama_game }}</td>
                                        <td>{{ $row->jumlah }}</td>
                                        <td>
                                            @if ($row->checkouts_id == null)
                                                No
                                            @else
                                                Yes
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.cart.edit', $row->id) }}" title="Ubah Data">
                                                <button class="btn btn-cyan btn-sm"><i class="far fa-edit">Ubah</i></button>
                                            </a>
                                            <form action="{{ route('backend.cart.destroy', $row->id) }}" method="post" style="display: inline-block">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- contentAkhir --}}
@endsection