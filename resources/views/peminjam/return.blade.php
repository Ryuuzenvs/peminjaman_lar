@extends('app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-success text-white">Riwayat Pengembalian</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $h)
                <tr>
                    <td>{{ $h->tool->name_tools }}</td>
                    <td>{{ $h->loan_date }}</td>
                    <td>{{ $h->return_date }}</td>
                    <td>Rp {{ number_format($h->penalty, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada riwayat</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
