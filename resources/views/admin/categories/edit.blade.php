@extends('app')

@section('content')
<div class="card shadow-sm">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">edit</h3>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('category.update', $categories->id) }}" method="POST">
                @csrf
@method('PUT')
                <div class="mb-3">
                    <label class="form-label"> nama kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" value="{{$categories->nama_kategori}}" required>
                    
                </div>
                <button type="submit" class="btn btn-primary">edit</button>
                <a href="{{route('category.index')}}" class="btn btn-warning">back</a>
            </form>
        </div>
    </div>
@endsection
