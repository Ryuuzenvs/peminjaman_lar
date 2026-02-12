@extends('app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Daftar User</h5>
        <a class="btn btn-warning btn-sm" href="{{ route('admin.dashboard') }}"><i class='fa-solid fa-arrow-left'></i></a>
    </div>

    <div class="card-body">
        <a class="btn btn-primary btn-sm mb-3" href="{{ route('users.create') }}"><i class='fa-solid fa-plus'></i></a>
        
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
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge bg-secondary">{{ strtoupper($u->role) }}</span></td>
                    <td>
    @if($u->id != auth()->id())
        <form method="post" action="{{ route('users.destroy', $u->id) }}?role={{ $u->role }}" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')"><i class='fa-solid fa-trash-can'></i></button>
        </form>

        <a href="{{ route('users.edit', [$u->id, 'role' => $u->role]) }}" class="btn btn-warning btn-sm"><i class='fa-solid fa-pen-to-square'></i></a>
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
