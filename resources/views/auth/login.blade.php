<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Peminjaman</title>
    <link href="{{ asset('bootstrap.min.css')}}" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; display: flex; align-items: center; height: 100vh; }
        .card { width: 100%; max-width: 400px; margin: auto; border-radius: 15px; }
    </style>
</head>
<body>
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Login</h3>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label"> usn</label>
                    <input type="text" name="name" class="form-control" placeholder="exam" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="123" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                <small>Belum punya akun? <a href="{{route('signup')}}">Daftar</a></small>
            </div>
        </div>
    </div>
</body>
</html>
