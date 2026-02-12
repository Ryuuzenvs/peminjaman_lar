@extends('app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <h3 class="text-center mb-4">Edit User</h3>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
                <input type="hidden" name="role" value="{{ $user->role  }}">
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak ingin ganti)</small></label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" {{ $user->role === 'admin' ? 'disabled' : '' }}>
    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
    <option value="officer" {{ $user->role === 'officer' ? 'selected' : '' }}>Officer</option>
    <option value="borrower" {{ $user->role === 'borrower' ? 'selected' : '' }}>Borrower</option>
</select>
@if($user->role === 'admin')
    <input type="hidden" name="role" value="admin">
@endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-warning">back</a>
        </form>
    </div>
</div>
@endsection
