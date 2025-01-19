@extends('backend.v_layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-6 mb-5">
        <h1 class="text-center">Manage Game Medias for {{ $game->nama_game }} by {{ $user->nama }}</h1>

        <form action="{{ route('media.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="games_id" value="{{ $game->id }}">
            <div class="form-group">
                <label for="file">Add Media</label>
                <input type="file" name="file" id="file" multiple class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <a href="{{ route('backend.game.index') }}">
                <button type="button" class="btn btn-secondary">Back</button>
            </a>
        </form>
        <hr>

        <h2>Existing Medias</h2>
        <ul class="list-group">
            <b>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>No</span>
                    <span>Media</span>
                    <span>Type</span>
                    <span>Action</span>
                </li>
            </b>
            
            @if($game_media->count() > 0)
                @foreach($game_media as $media)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $loop->iteration }}</span>
                    @if ($media->jenis == 'image')
                        <img src="{{ asset('storage/media/' . $media->nama) }}" alt="Media" width="200">
                    @else
                        <video src="{{ asset('storage/media/' . $media->nama) }}" width="200"></video>
                    @endif
                    
                    <span>{{ $media->jenis }}</span>
                    <form action="{{ route('media.delete', [$media->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="col-xl-6 mb-5">
        <h1 class="text-center">Reviews</h1>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Name</th>
                        <th>Review Date</th>
                        <th>Description</th>
                        <th>Grade</th>
                        @if (Auth::user()->role == 0)
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($review as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->find($row->users_id)->nama }}</td>
                            <td>{{ $row->tanggal_ulasan }}</td>
                            <td>{{ $row->deskripsi }}</td>
                            <td>{{ $row->nilai }}</td>
                            @if (Auth::user()->role == 0)
                                <td>
                                    <form action="{{ route('review.delete', ['games_id' => $row->games_id, 'users_id' => $row->users_id]) }}" method="post" style="display: inline-block">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm show_confirm mb-1" data-konf-delete="{{ $row->nama }}" title="Hapus Data">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection