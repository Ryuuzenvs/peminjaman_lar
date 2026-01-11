@extends('app')

@section('content')
<h3>Manajemen Peminjaman (Petugas)</h3>
<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>Peminjam</th>
            <th>Alat</th>
            <th>Tgl Pinjam</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loans as $l)
        <tr>
            <td>{{ $l->user->name }}</td>
            <td>{{ $l->tool->name_tools }}</td>
            <td>{{ $l->date_loan }}</td>
            <td>
                <span class="badge {{ $l->status == 'pend' ? 'bg-warning' : ($l->status == 'borro' ? 'bg-info' : 'bg-success') }}">
                    {{ $l->status }}
                </span>
            </td>
            <td>
                @if($l->status == 'pend')
                    <form action="{{ route('loans.approve', $l->id) }}" method="POST">
                        @csrf @method('PUT')
                        <button class="btn btn-sm btn-primary">Approve</button>
                    </form>
                @elseif($l->status == 'borro')
                    <form action="{{ route('loans.return', $l->id) }}" method="POST">
                        @csrf @method('PUT')
                        <button class="btn btn-sm btn-success">Terima Kembali</button>
                    </form>
                @else
                    <span class="text-muted">Selesai (Denda: {{ $l->penalty }})</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
