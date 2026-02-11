@extends('app')


@section('content')
<div class="card shadow-sm">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Edit</h3>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('tools.update', $tools->id) }}" method="POST">
                @csrf
@method('PUT')
                <div class="mb-3">
                    <label class="form-label"> Nama alat</label>
                    <input type="text" name="name_tools" value="{{$tools->name_tools}}" class="form-control" required >
                </div>
               <div class="mb-3">
                    <label class="form-label">stock</label>
                    <input type="number" name="stock" class="form-control" required value="{{$tools->stock}}">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Pilih Kategori</label>

    <select class="form-select @error('category') is-invalid @enderror" name="category_id" required>

    <option value="" disabled>-- Pilih Kategori --</option>
    @forelse($category as $c)
    <option value="{{ $c->id }}" 
            {{ $c->id == $tools->category_id ? 'selected' : '' }}>
            {{ $c->nama_kategori }}
    </option>
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
                <button type="submit" class="btn btn-primary "><i class='fa-solid fa-pen-to-square'></i></button>
                <a href="{{route('tools.index')}}" class="btn btn-warning"><i class='fa-solid fa-arrow-left'></i></a>
            </form>
        </div>
    </div>
@endsection
