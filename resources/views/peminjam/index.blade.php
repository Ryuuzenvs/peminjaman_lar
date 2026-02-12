@extends('app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">Status Pinjaman Aktif</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($myloan as $loan)
                <tr>
                    <td>{{ $loan->tool->name_tools }}</td>
                    <td>{{ $loan->loan_date }}</td>
                    <td>
                        @if($loan->status == 'pending')
                            <span class="badge bg-secondary">Menunggu ACC Pinjam</span>
                        @elseif($loan->request_return_date)
                            <span class="badge bg-info">Proses Verifikasi Pengembalian</span>
                        @else
                            <span class="badge bg-success">Sedang Dipinjam</span>
                        @endif
                    </td>
                    <td>
                        @if($loan->status == 'borrow' && !$loan->request_return_date)
                        <form action="{{ route('loans.requestReturn', $loan->id) }}" method="POST">
                            @csrf @method('PUT')
                            <button type="submit" class="btn btn-sm btn-danger">Kembalikan</button>
                        </form>
                        @else
                        -
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Tidak ada pinjaman aktif</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
