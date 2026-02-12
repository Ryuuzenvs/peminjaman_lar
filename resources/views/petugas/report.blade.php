@extends('app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 no-print">
    <h3>Laporan Peminjaman</h3>
<div class="card mb-3 no-print">
    <div class="card-body">
        <form action="{{ route('officer.report') }}" method="GET" class="row g-3 mt-2">
            <div class="col-md-4">
                <label>Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label>Tanggal Selesai</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua</option>
                    <option value="borrow" {{ request('status') == 'borrow' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="return" {{ request('status') == 'return' ? 'selected' : '' }}>Kembali</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">Filter</button>
            </div>
        </form>
    </div>
</div>
    <button onclick="window.print()" class="btn btn-primary">Cetak Laporan (PDF)</button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $r)
                <tr>
                    <td>{{ $r->borrower->username }}</td>
                    <td>{{ $r->tool->name_tools ?? 'alat dihapus' }}</td>
                    <td>{{ $r->loan_date }}</td>
                    <td>{{ $r->return_date ?? '-' }}</td>
                    <td>{{ strtoupper($r->status) }}</td>
                    <td>Rp {{ number_format($r->penalty, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
<a href="{{route('officer.dashboard')}}" class="btn btn-danger">back</a>
    </div>

</div>

<style>

@media print {
    .no-print, .navbar, .btn, .footer {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endsection
