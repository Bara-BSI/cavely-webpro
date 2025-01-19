@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.user.create') }}">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add User
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            @if ($row->role == 1)
                                                <span class="badge badge-success">Publisher</span>
                                            @elseif ($row->role == 0)
                                                <span class="badge badge-primary">Admin</span>
                                            @else
                                                <span class="badge badge-warning">Customer</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @elseif ($row->status == 0)
                                                <span class="badge badge-secondary">NonAktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.user.edit', $row->id) }}" title="Ubah Data">
                                                <button class="btn btn-cyan btn-sm"><i class="far fa-edit">Ubah</i></button>
                                            </a>
                                            <form action="{{ route('backend.user.destroy', $row->id) }}" method="post" style="display: inline-block">
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
                        <form action="{{ route('backend.laporan.cetakuser') }}" method="post" 
                            class="form-horizontal" target="_blank">
                            @csrf
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- contentAkhir --}}
@endsection