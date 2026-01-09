@extends('app')

@section('content')
<table class="table table-striped">
<thead>

<tr>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Aksi</th>
</tr>

</thead>

<tbody>
@foreach($tools as $t)
<tr>
<td> {{ $t->name}}</td>
<td> {{ $t->category->nama_kategory}}</td>
<td> {{ $t->stock}}</td>
<td>
<form method="post" action="{{route(tools.destroy, $t->id)}}">
@method('DELETE')
<button class="btn btn-danger btn-sm">Hapus</button>
</form>
</td>
<tr>
@endforeach
</tbody>

</table>
