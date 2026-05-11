<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hidden Admin Access</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #1a1a1a; display: flex; align-items: center; height: 100vh; }
        .login-card { width: 100%; max-width: 400px; padding: 20px; background: #fff; border-radius: 10px; margin: auto; }
    </style>
</head>
<body>
    <div class="login-card shadow">
        <h3 class="text-center mb-4">Admin Login</h3>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ url('/admin') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Access Control</button>
        </form>
    </div>
</body>
</html>