<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid;
    }

    table tr td {
        padding: 6px;
        font-weight: normal;
        border: 1px solid #ccc;
    }

    table th {
        border: 1px solid #ccc;
    }
</style>
<table>
    {{-- <tr>
        <td align="center">
            <img src="{{ asset('images/header.png') }}" width="50%">
        </td>
    </tr> --}}
    <tr>
        <td align="left">
            About : {{ $judul }} <br>
        </td>
    </tr>
</table>
<p></p>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Phone Number</th>
            <th>Age</th>
            <th>Country</th>
            <th>Server</th>
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
                <td>{{ $row->hp }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($row->tanggal_lahir)->age }}
                </td>
                <td>
                    {{ $country->find($row->countries_id)->nama_negara }}
                </td>
                <td>
                    {{ $region->find($country->find($row->countries_id)->regions_id)->nama_region }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    window.onload = function() {
        printStruk();
    }

    function printStruk() {
        window.print();
    }
</script>