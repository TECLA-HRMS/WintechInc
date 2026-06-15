@extends('layouts.site')

@section('content')
<style>
/* --------------------------------------
   PREMIUM AUTH PAGE DESIGN - RESET PASSWORD
   -------------------------------------- */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

.auth-section {
    padding: 80px 20px;
    background-color: #f8fafc;
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Inter', sans-serif;
}

.auth-card {
    display: flex;
    width: 100%;
    max-width: 1000px;
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

/* Left Side - Visual */
.auth-visual {
    flex: 1;
    background: linear-gradient(135deg, #0d1a2f 0%, #1a325a 100%);
    padding: 60px 40px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    color: #ffffff;
    overflow: hidden;
}

.auth-visual::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(232, 73, 36, 0.15) 0%, transparent 50%);
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.auth-visual-content {
    position: relative;
    z-index: 1;
}

.auth-visual h2 {
    font-size: 36px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    color: #ffffff;
}

.auth-visual p {
    font-size: 16px;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.8);
}

.auth-visual-footer {
    position: relative;
    z-index: 1;
}

.auth-visual-footer p {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.6);
}

/* Right Side - Forms */
.auth-form-container {
    flex: 1;
    padding: 60px 50px;
    background: #ffffff;
    position: relative;
}

/* Form Styles */
.input-group {
    margin-bottom: 24px;
}

.input-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 8px;
}

.input-field {
    width: 100%;
    padding: 14px 16px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 15px;
    color: #0f172a;
    transition: all 0.2s ease;
    background: #ffffff;
}

.input-field::placeholder {
    color: #94a3b8;
}

.input-field:focus {
    outline: none;
    border-color: #b11e24;
    box-shadow: 0 0 0 4px rgba(177, 30, 36, 0.1);
}

.input-error {
    border-color: #ef4444;
}

.error-message {
    display: block;
    color: #ef4444;
    font-size: 13px;
    margin-top: 6px;
    font-weight: 500;
}

/* Button Styles */
.btn-primary {
    width: 100%;
    padding: 14px 20px;
    background: #b11e24;
    color: #ffffff;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn-primary:hover {
    background: #8c1418;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(177, 30, 36, 0.25);
}

.link {
    font-size: 14px;
    color: #b11e24;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.2s;
    cursor: pointer;
}

.link:hover {
    opacity: 0.8;
}

.text-center {
    text-align: center;
}
.mt-4 {
    margin-top: 24px;
}

.panel-header {
    margin-bottom: 30px;
}
.panel-header h3 {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
}
.panel-header p {
    font-size: 15px;
    color: #64748b;
}

/* Alerts */
.alert {
    padding: 14px 16px;
    border-radius: 10px;
    margin-bottom: 24px;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-danger {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

/* Responsive */
@media (max-width: 992px) {
    .auth-card {
        flex-direction: column;
        max-width: 500px;
    }
    .auth-visual {
        padding: 40px 30px;
        text-align: center;
    }
    .auth-visual-content h2 {
        font-size: 28px;
    }
    .auth-visual-footer {
        display: none;
    }
}
@media (max-width: 576px) {
    .auth-form-container {
        padding: 40px 24px;
    }
}
</style>

<div class="auth-section">
    <div class="auth-card">
        
        <!-- Left Side -->
        <div class="auth-visual">
            <div class="auth-visual-content">
                <h2>Welcome to Wintech Inc.</h2>
                <p>Unlock endless possibilities. Join our community of professionals and take the next step in your career journey.</p>
            </div>
            <div class="auth-visual-footer">
                <p>&copy; {{ date('Y') }} Wintech Inc. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side -->
        <div class="auth-form-container">
            
            <div class="panel-header">
                <h3>Reset Password</h3>
                <p>Please enter your new password below.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div style="flex: 1;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="input-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" class="input-field" placeholder="Minimum 8 characters" required>
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="btn-primary">
                    Reset Password
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="link">
                    &larr; Back to Login
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
