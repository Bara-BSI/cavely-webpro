@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.genre.create') }}">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Genre
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
                                    <th>Genre Name</th>
                                    <th>Minimum Age</th>
                                    <th>Game List</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama_genre }}</td>
                                        <td>{{ $row->usia_minimal }}</td>
                                        <td>
                                            @php
                                                $games = DB::table('game_genres')->where('genres_id', $row->id)->pluck('games_id');
                                            @endphp
                                            @foreach ($games as $game_id)
                                                @php
                                                    $game_name = DB::table('games')->where('id', $game_id)->value('nama_game');
                                                @endphp
                                                <b>
                                                    {{ $game_name }}{{ !$loop->last ? ',' : '' }}
                                                </b>
                                            @endforeach
                                        <td>
                                            <a href="{{ route('backend.genre.edit', $row->id) }}" title="Ubah Data">
                                                <button class="btn btn-cyan btn-sm"><i class="far fa-edit">Ubah</i></button>
                                            </a>
                                            <form action="{{ route('backend.genre.destroy', $row->id) }}" method="post" style="display: inline-block">
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