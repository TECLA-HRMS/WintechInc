<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Wintech Inc</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0;font-family:'Inter',sans-serif}
        body{min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#111111 0%,#222222 50%,#111111 100%);padding:20px}
        .card{width:100%;max-width:430px;background:#fff;border-radius:18px;box-shadow:0 25px 60px rgba(0,0,0,.35);padding:34px}
        .logo{display:flex;justify-content:center;margin-bottom:22px}
        .logo img{width:150px;background:#fff;border-radius:12px}
        h1{font-size:24px;color:#0d2347;margin-bottom:8px}
        p{font-size:14px;color:#6b7280;line-height:1.6;margin-bottom:22px}
        label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:7px}
        input{width:100%;padding:12px 14px;border:1.5px solid #e5e7eb;border-radius:10px;background:#f9fafb;font-size:14px;outline:none}
        input:focus{border-color:#df1c6a;background:#fff;box-shadow:0 0 0 3px rgba(223,28,106,.1)}
        button{width:100%;margin-top:18px;padding:12px;border:0;border-radius:10px;background:linear-gradient(135deg,#e84545,#df1c6a);color:#fff;font-weight:700;cursor:pointer}
        button:hover{background:linear-gradient(135deg,#df1c6a,#a8124b)}
        .error-message,.success-message{border-radius:8px;padding:10px 14px;margin-bottom:16px;font-size:13px}
        .error-message{background:#fff5f5;border:1px solid #fecaca;color:#dc2626}
        .success-message{background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d}
        .back{display:block;text-align:center;margin-top:18px;color:#df1c6a;font-size:13px;font-weight:600;text-decoration:none}
        .back:hover{text-decoration:underline}
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Wintech Inc Logo">
        </div>

        <h1>Forgot Password</h1>
        <p>Enter your admin email address. We will send a secure reset link that expires in 60 minutes.</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.forgot-password.submit') }}" method="POST">
            @csrf
            <label for="email">Admin Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="admin@example.com">
            <button type="submit">Send Reset Link</button>
        </form>

        <a href="{{ route('admin.login') }}" class="back">Back to Login</a>
    </div>
</body>
</html>
