@extends('app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <h3 class="text-center mb-4">Create User</h3>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan nama" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email@example.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" required>
                    <option disabled> pilih role</option>
                    <option value="borrower">Peminjam</option>
                    <option value="officer">Petugas</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class='fa-solid fa-plus'></i>
</button>
            <a href="{{ route('users.index') }}" class="btn btn-warning"><i class='fas fa-arrow-left'></i></a>
        </form>
    </div>
</div>
@endsection

