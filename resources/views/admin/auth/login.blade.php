<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wintech Inc</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #111111 0%, #222222 50%, #111111 100%);
            position: relative;
            overflow: hidden;
        }

        /* Decorative background circles */
        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(30,111,220,0.15) 0%, transparent 70%);
            top: -100px;
            left: -100px;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(232,69,69,0.12) 0%, transparent 70%);
            bottom: -80px;
            right: -80px;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 520px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            position: relative;
            z-index: 1;
            margin: 1rem;
        }

        /* Left panel */
        .left-panel {
            flex: 1;
            background: linear-gradient(160deg, #e84545 0%, #df1c6a 60%, #a8124b 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 40px solid rgba(255,255,255,0.05);
            top: -80px;
            right: -80px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 30px solid rgba(255,255,255,0.05);
            bottom: -50px;
            left: -50px;
        }

        .brand-logo {
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }

        .brand-logo img {
            width: 150px;
            display: block;
        }

        .brand-tagline {
            color: rgba(255,255,255,0.9);
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            line-height: 1.6;
            max-width: 220px;
        }

        .brand-tagline span {
            display: block;
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.4rem;
            letter-spacing: 0.5px;
        }

        .divider-line {
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #e84545, #ff8c42);
            border-radius: 2px;
            margin: 1.2rem auto;
        }

        /* Right panel */
        .right-panel {
            flex: 1;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.5rem;
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0d2347;
            margin-bottom: 0.4rem;
        }

        .login-subtitle {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }

        .input-group {
            margin-bottom: 1.4rem;
            position: relative;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }

        input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.95rem;
            color: #111827;
            background: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input:focus {
            border-color: #df1c6a;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(223,28,106,0.1);
        }

        input::placeholder {
            color: #9ca3af;
        }

        .password-wrapper {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 20px;
            height: 20px;
            fill: #9ca3af;
            transition: fill 0.2s;
        }

        .eye-icon:hover {
            fill: #df1c6a;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #e84545 0%, #df1c6a 100%);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
            margin-top: 0.5rem;
            box-shadow: 0 4px 15px rgba(223,28,106,0.35);
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #df1c6a 0%, #a8124b 100%);
            box-shadow: 0 6px 20px rgba(223,28,106,0.45);
            transform: translateY(-1px);
        }

        .error-message {
            background: #fff5f5;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 1.2rem;
            color: #dc2626;
            font-size: 0.875rem;
        }

        .success-message {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 1.2rem;
            color: #15803d;
            font-size: 0.875rem;
        }

        .form-help {
            display: flex;
            justify-content: flex-end;
            margin-top: -0.6rem;
            margin-bottom: 1rem;
        }

        .form-help a {
            color: #df1c6a;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
        }

        .form-help a:hover {
            text-decoration: underline;
        }

        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.78rem;
            color: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .left-panel { display: none; }
            .right-panel { padding: 2.5rem 1.8rem; border-radius: 20px; }
            .login-wrapper { border-radius: 20px; }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">

        <!-- Left Branding Panel -->
        <div class="left-panel">
            <div class="brand-logo">
                <img loading="lazy" src="{{ asset('logo.png') }}" alt="Wintech Inc Logo">
            </div>
            <div class="brand-tagline">
                <span>WINTECH INC</span>
                Grow your business online with us
            </div>
            <div class="divider-line"></div>
            <p style="color:rgba(255,255,255,0.6);font-size:0.8rem;text-align:center;">Admin Management Portal</p>
        </div>

        <!-- Right Login Panel -->
        <div class="right-panel">
            <div class="login-title">Welcome Back 👋</div>
            <div class="login-subtitle">Sign in to your admin account</div>

            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="success-message">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" required placeholder="Enter your email" value="{{ old('email') }}">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required placeholder="Enter your password">
                        <svg id="togglePassword" class="eye-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/>
                        </svg>
                    </div>
                </div>

                <div class="form-help">
                    <a href="{{ route('admin.forgot-password') }}">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="footer-text">© {{ date('Y') }} Wintech Inc</div>
        </div>

    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.innerHTML = type === 'text'
                ? '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12zm11 4a4 4 0 100-8 4 4 0 000 8z"/>'
                : '<path d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/>';
        });
    </script>
</body>
</html>

