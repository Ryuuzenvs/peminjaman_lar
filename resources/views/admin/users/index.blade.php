@extends('app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Daftar User</h5>
        <a class="btn btn-warning btn-sm" href="{{ route('admin.dashboard') }}">back</a>
    </div>

    <div class="card-body">
        <a class="btn btn-primary btn-sm mb-3" href="{{ route('users.create') }}">Tambah User</a>
        
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge bg-secondary">{{ strtoupper($u->role) }}</span></td>
                    <td>

                        @if($u->id != auth()->id())
                        <form method="post" action="{{ route('users.destroy', $u->id) }}" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">Hapus</button>
                        </form>
                        <a href="{{ route('users.edit', $u->id) }}" class="btn btn-warning btn-sm">edit</a>
                        @else
                        <span class="text-muted small italic">Logged In</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
