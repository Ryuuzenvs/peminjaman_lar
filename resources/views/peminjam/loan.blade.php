@extends('app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">Pinjam Alat Baru</div>
    <div class="card-body">
        <div class="row">
            @foreach($tools as $t)
            <div class="col-md-4 mb-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5>{{ $t->name_tools }}</h5>
                        <p>Tersedia: <strong>{{ $t->stock }}</strong></p>
                        <form action="{{ route('pinjam.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tool_id" value="{{ $t->id }}">
                            <button type="submit" class="btn btn-primary w-100">Ajukan Pinjaman</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
