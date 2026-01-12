@extends('app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Daftar Alat Tersedia</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Alat</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tools as $t)
                        <tr>
                            <td>{{ $t->name_tools }}</td>
                            <td><span class="badge bg-info">{{ $t->stock }}</span></td>
                            <td>
                                <form action="{{ route('pinjam.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="tool_id" value="{{ $t->id }}">
                                    <button type="submit" class="btn btn-sm btn-success">Pinjam</button>
                                </form>
                            </td>
                        </tr>
@empty
<tr>
<td colspan="5" class="text-center">kosong alatnya</td>
</tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Pinjaman Saya</div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse($myloan as $loan)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $loan->tool->name_tools }}
                        <span class="badge bg-warning text-dark">{{ $loan->status }}</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center">Belum ada pinjaman</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
