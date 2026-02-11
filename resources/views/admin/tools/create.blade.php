@extends('app')

@section('content')
<div class="card shadow-sm">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">create</h3>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('tools.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label"> nama alat</label>
                    <input type="text" name="name_tools" class="form-control" required>
                </div>
               <div class="mb-3">
                    <label class="form-label">stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Pilih Kategori</label>

    <select class="form-select @error('category') is-invalid @enderror" name="category_id" required>

    <option value="" selected disabled>-- Pilih Kategori --</option>
    @forelse($category as $c)
    <option value="{{ $c->id }}">
{{ $c->nama_kategori }}
    </option>

    @empty
    <option disabled value=" ">Belum ada kategori, buat dulu!
    </option>

    @endforelse
    </select>
@empty($category)
    <div class="text-danger small mt-1">Anda harus membuat minimal 1 kategori terlebih dahulu!</div>
@endempty

                </div>
                <button type="submit" class="btn btn-primary "><i class='fa-solid fa-plus'></i></button>
                <a href="{{route('tools.index')}}" class="btn btn-warning"><i class='fa-solid fa-arrow-left'></i></a>
            </form>
        </div>
    </div>
@endsection
