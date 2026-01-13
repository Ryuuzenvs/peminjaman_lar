@extends('app')

@section('content')
<div class="card">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

<div class="card-header d-flex justify-content-between">

<h5>Daftar Kategori</h5>
<a class="btn btn-warning btn-sm" href="{{route('admin.dashboard')}}">back </a>
</div>

<div class="card-body">
<table class="table table-striped text-center">
<thead>

<tr>
<th>Kategori</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>
@forelse($categories as $c)
<tr>
<td> {{ $c->nama_kategori}}</td>
<td>
<form method="post" action="{{route('category.destroy', $c->id)}}">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm">Hapus</button>
</form>
<a href="{{route('category.edit', $c->id)}}" class="btn btn-warning">edit</a>
</td>
</tr>

@empty
<tr>
<td colspan=3 class="text-center">kosong</td>
</td>
@endforelse
</tbody>
<a class="btn btn-primary btn-sm" href="{{route('category.create')}}">Tambah Kategori</a>
</table>
</div>
</div>
@endsection
