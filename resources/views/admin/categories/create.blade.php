@extends('app')

@section('content')
<div class="card shadow-sm">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">create</h3>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label"> nama kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary "><i class='fa-solid fa-plus'></i></button>
                <a href="{{route('category.index')}}" class="btn btn-warning"><i class='fas fa-arrow-left'></i></a>
            </form>
        </div>
    </div>
@endsection
