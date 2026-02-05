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

            <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label"> usn</label>
                    <input type="text" name="username" class="form-control" placeholder="exam" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="123" required>
                </div>
<div class="mb-2">
				<select name="role" class="form-control" required>
    <option selected>Select role</option>
    <option value="admin">Admin</option>
    <option value="officer">Petugas</option>
    <option value="borrower">Peminjam</option>
                </select>
</div>
                <button type="submit" class="btn btn-primary w-100" id="loginBtn">Login</button>
            </form> 
        </div>
    </div>
<script>
    document.getElementById('loginForm').onsubmit = function() {
        // get id
        const btn = document.getElementById('loginBtn');
        const text = document.getElementById('btnText');
        
        // Disable btn
        btn.disabled = true;
        
        // intex
        text.innerText = 'Memproses...';
        btn.classList.add('opacity-50', 'cursor-not-allowed');
    };
</script>
</body>
</html>
