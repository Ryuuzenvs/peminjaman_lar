@extends('app')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p class="text-muted">Role: <span class="badge bg-primary">{{ ucfirst(auth()->user()->role) }}</span></p>
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
                <h3>{{ \App\Models\loan::where('status', 'borrowed')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h5>Perlu Approval</h5>
                <h3>{{ \App\Models\loan::where('status', 'pending')->count() }}</h3>
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
                <!--<a href="route('categories.index') " class="btn btn-outline-secondary">Kelola Kategori</a>-->
                </div>
        </div>
    </div>
</div>
@endsection
