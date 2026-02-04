@extends('app')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Selamat Datang, {{ auth()->guard('admin')->user()->username }}</h2>
        <p class="text-muted">Role: <span class="badge bg-primary">Admin</span></p>
    </div>

    <div class="col-md-4">
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                <h5>Total Alat</h5>
                <h3>{{ \App\Models\tool::count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h5>Peminjaman Aktif</h5>
                <h3>{{ \App\Models\loan::where('status', 'borro')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h5>Perlu Approval</h5>
                <h3>{{ \App\Models\loan::where('status', 'pend')->count() }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('tools.index') }}" class="btn btn-outline-primary">Kelola Data Alat</a>
                <a href="{{route('category.index')}}" class="btn btn-outline-secondary">Kelola Kategori</a>
                <a href="{{route('users.index')}}" class="btn btn-outline-warning">Kelola user</a>
                <a href="{{route('admin.loans.index')}}" class="btn btn-outline-primary">Kelola loans</a>
                </div>
        </div>
    </div>
</div>
@endsection
