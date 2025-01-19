@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.game.create') }}">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Game
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
                                    @if (Auth::user()->role == 0)
                                        <th>Publisher</th>                                        
                                    @endif
                                    <th>Game Name</th>
                                    <th>Release Date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Genre</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if (Auth::user()->role == 0)
                                            <td>{{ $user->find($row->users_id)->nama }}</td>
                                        @endif
                                        <td>{{ $row->nama_game }}</td>
                                        <td>{{ $row->tanggal_rilis }}</td>
                                        <td>{{ $row->harga }}</td>
                                        <td>
                                            @if ($row->status == 0)
                                                <span class="badge badge-secondary">Inactive</span>
                                            @elseif ($row->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @elseif ($row->status == 2)
                                                <span class="badge badge-warning">Coming Soon</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->deskripsi }}</td>
                                        <td>
                                            @php
                                                $genres = DB::table('game_genres')->where('games_id', $row->id)->pluck('genres_id');
                                            @endphp
                                            @foreach ($genres as $genre_id)
                                                @php
                                                    $genre_name = DB::table('genres')->where('id', $genre_id)->value('nama_genre');
                                                @endphp
                                                <span class="badge badge-info">
                                                    <b>
                                                        {{ $genre_name }}
                                                    </b>
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.game.edit', $row->id) }}" title="Ubah Data">
                                                <button class="btn btn-cyan btn-sm mb-1"><i class="far fa-edit"> Edit</i></button>
                                            </a>
                                            <a href="{{ route('backend.game.show', $row->id) }}" title="Show Game Medias and Reviews">
                                                <button type="button" class="btn btn-warning btn-sm mb-1">
                                                    <i class="fas fa-plus"></i> Detail
                                                </button>
                                            </a>
                                            <form action="{{ route('backend.game.destroy', $row->id) }}" method="post" style="display: inline-block">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm mb-1" data-konf-delete="{{ $row->nama }}" title="Hapus Data">
                                                    <i class="fas fa-trash"></i> Delete
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