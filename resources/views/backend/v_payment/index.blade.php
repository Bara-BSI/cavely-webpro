@extends('backend.v_layouts.app')
@section('content')
    {{-- contentAwal --}}
    <div class="row">
        <div class="col-12">
            <a href="{{ route('backend.payment.create') }}">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Payment
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
                                    <th>Payment Method Name</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama_bank }}</td>
                                        <td>{{ $row->hp }}</td>
                                        <td>
                                            <a href="{{ route('backend.payment.edit', $row->id) }}" title="Ubah Data">
                                                <button class="btn btn-cyan btn-sm"><i class="far fa-edit">Edit</i></button>
                                            </a>
                                            <form action="{{ route('backend.payment.destroy', $row->id) }}" method="post" style="display: inline-block">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm" data-konf-delete="{{ $row->nama_bank }}" title="Hapus Data">
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