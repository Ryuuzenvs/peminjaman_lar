@extends('app')

@section('content')
<div class="card">

<div class="card-header d-flex justify-content-between">

<h5>Daftar Alat</h5>
<a class="btn btn-warning btn-sm" href="{{route('admin.dashboard')}}"><i class='fa-solid fa-arrow-left'></i> </a>
</div>

<div class="card-body">
<table class="table table-striped text-center">
<thead>

<tr>
<th>Nama Alat</th>
<th>Kategori</th>
<th>Stok</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>
@forelse($tools as $t)
<tr>
<td> {{ $t->name_tools}}</td>
<td> {{ $t->category->nama_kategori}}</td>
<td> {{ $t->stock}}</td>
<td>
<form method="post" action="{{route('tools.destroy', $t->id)}}">
@method('DELETE')
@csrf

<button class="btn btn-danger btn-sm"><i class='fa-solid fa-trash-can'></i></button>
<a href="{{route('tools.edit', $t->id)}}" class="btn btn-warning"><i class='fa-solid fa-pen-to-square'></i></a>
</form>
</td>
</tr>
@empty 
<tr>
<td colspan=4 class="text-center">kosong</td>
</tr>
@endforelse
</tbody>
<a class="btn btn-primary btn-sm" href="{{route('tools.create')}}"><i class='fa-solid fa-plus'></i></a>
</table>

</div>

</div>
@endsection
