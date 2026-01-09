@extend('layout.app')

@section('content')
<div class="card">

<div class="card-header d-flex justify-content-between">

<h5>Daftar Alat</h5>
<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Alat</button>
</div>

<div class="card-body">
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

</div>

</div>
@endsection
