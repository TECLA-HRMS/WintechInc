@extends('layouts.site')

@section('content')
<style>
/* --------------------------------------
   PREMIUM AUTH PAGE DESIGN
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

/* Custom Tabs */
.auth-tabs-wrapper {
    display: flex;
    background: #f1f5f9;
    border-radius: 12px;
    padding: 6px;
    margin-bottom: 40px;
    position: relative;
}

.auth-tab {
    flex: 1;
    text-align: center;
    padding: 12px 0;
    font-size: 15px;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.3s ease;
    z-index: 1;
}

.auth-tab.active {
    color: #b11e24;
}

.auth-tab-slider {
    position: absolute;
    top: 6px;
    left: 6px;
    height: calc(100% - 12px);
    width: calc(50% - 6px);
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Form Styles */
.auth-panel {
    display: none;
    animation: slideUp 0.4s ease forwards;
}

.auth-panel.active {
    display: block;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

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
    padding: 14px 18px;
    background-color: #ffffff;
    border: 1.5px solid #cbd5e1 !important; /* Elegant but visible border */
    border-radius: 12px;
    font-size: 15px;
    color: #0f172a;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03); /* Soft premium shadow */
}

.input-field::placeholder {
    color: #94a3b8;
    font-weight: 400;
}

.input-field:hover {
    border-color: #94a3b8 !important; /* Smooth darkening on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04);
}

.input-field:focus {
    outline: none;
    background-color: #ffffff;
    border-color: #b11e24 !important;
    box-shadow: 0 0 0 4px rgba(177, 30, 36, 0.15), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
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

/* Utilities */
.flex-row {
    display: flex;
    gap: 16px;
}
.flex-row .input-group {
    flex: 1;
}

.auth-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    margin-top: -8px;
}

.checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.checkbox-wrapper input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #b11e24;
    cursor: pointer;
}

.checkbox-wrapper span {
    font-size: 14px;
    color: #64748b;
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

.alert-success {
    background: #ecfdf5;
    color: #059669;
    border: 1px solid #a7f3d0;
}

.alert-danger {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

/* Responsive */
@media (max-width: 992px) {
    .auth-section {
        padding: 40px 20px;
    }
    .auth-card {
        flex-direction: column;
        max-width: 600px;
        margin: 0 auto;
    }
    .auth-visual {
        padding: 30px 20px;
        text-align: center;
        min-height: 200px;
    }
    .auth-visual-content h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    .auth-visual-content p {
        font-size: 14px;
    }
    .auth-visual-logo div {
        padding: 15px 25px !important;
    }
    .auth-visual-logo img {
        width: 140px !important;
    }
    .auth-visual-footer {
        display: none;
    }
}
@media (max-width: 768px) {
    .auth-section {
        padding: 20px 15px;
    }
    .auth-visual {
        display: none; /* Hide visual area on mobile to prioritize the form */
    }
    .auth-form-container {
        padding: 30px 20px;
    }
    .panel-header h3 {
        font-size: 22px;
    }
    .panel-header p {
        font-size: 14px;
    }
}
@media (max-width: 576px) {
    .auth-form-container {
        padding: 25px 15px;
    }
    .flex-row {
        flex-direction: column;
        gap: 0;
    }
    .auth-tabs-wrapper {
        margin-bottom: 25px;
    }
    .auth-options {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
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

            <div class="auth-visual-logo" style="flex: 1; display: flex; align-items: center; justify-content: center; position: relative; z-index: 1;">
                <div style="background: rgba(255, 255, 255, 0.95); padding: 25px 35px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2), 0 0 0 1px rgba(255,255,255,0.1); backdrop-filter: blur(10px); transform: translateY(-10px);">
                    <img loading="lazy" src="{{ asset('logo.png') }}" alt="Wintech Inc Logo" style="width: 180px; height: auto; display: block;">
                </div>
            </div>

            <div class="auth-visual-footer">
                <p>&copy; {{ date('Y') }} Wintech Inc. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side -->
        <div class="auth-form-container">
            
            <div class="auth-tabs-wrapper" id="tabsWrapper">
                <div class="auth-tab-slider" id="tabSlider"></div>
                <div class="auth-tab active" onclick="switchPanel('login', 0)">Login</div>
                <div class="auth-tab" onclick="switchPanel('register', 1)">Register</div>
            </div>

            <!-- Global Alerts -->
            @if(session('status'))
                <div class="alert alert-success">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('status') }}
                </div>
            @endif
            @if($errors->has('email') && !session('open_forgot') && !request()->routeIs('register'))
                <div class="alert alert-danger">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $errors->first('email') }}
                </div>
            @endif

            <!-- LOGIN PANEL -->
            <div id="panel-login" class="auth-panel active">
                <div class="panel-header">
                    <h3>Sign In</h3>
                    <p>Enter your email and password to access your account.</p>
                </div>
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="input-field" placeholder="you@example.com" value="{{ old('email', session('signup_email', $prefilledEmail ?? '')) }}" required>
                    </div>
                    
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password" class="input-field @error('password') input-error @enderror" placeholder="••••••••" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-options">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="remember" id="remember_me_checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me for later</span>
                        </label>
                        <a onclick="showForgotPassword()" class="link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-primary">
                        Sign In
                    </button>
                </form>
            </div>

            <!-- REGISTER PANEL -->
            <div id="panel-register" class="auth-panel">
                <div class="panel-header">
                    <h3>Create Account</h3>
                    <p>Fill in the details below to get started.</p>
                </div>
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="flex-row">
                        <div class="input-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="input-field @error('first_name') input-error @enderror" placeholder="John" value="{{ old('first_name') }}" required>
                            @error('first_name')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                        <div class="input-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="input-field @error('last_name') input-error @enderror" placeholder="Doe" value="{{ old('last_name') }}" required>
                            @error('last_name')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="input-field @error('email') input-error @enderror" placeholder="you@example.com" value="{{ old('email', $prefilledEmail ?? '') }}" required>
                        @error('email')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password" class="input-field @error('password') input-error @enderror" placeholder="Min. 8 characters" required>
                        @error('password')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="input-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="input-field" placeholder="Confirm your password" required>
                    </div>

                    <button type="submit" class="btn-primary">
                        Register Account
                    </button>
                </form>
            </div>

            <!-- FORGOT PASSWORD PANEL -->
            <div id="panel-forgot" class="auth-panel">
                <div class="panel-header">
                    <h3>Reset Password</h3>
                    <p>Enter your email address and we'll send you a link to reset your password.</p>
                </div>

                @if(session('open_forgot') && $errors->has('email'))
                    <div class="alert alert-danger">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="input-field" placeholder="you@example.com" value="{{ old('email') }}" required>
                    </div>

                    <button type="submit" class="btn-primary">
                        Send Reset Link
                    </button>
                </form>
                
                <div class="text-center mt-4">
                    <a onclick="switchPanel('login', 0)" class="link">
                        &larr; Back to Login
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function switchPanel(panelName, tabIndex) {
        // Hide all panels
        document.querySelectorAll('.auth-panel').forEach(panel => {
            panel.classList.remove('active');
        });
        
        // Show target panel
        document.getElementById('panel-' + panelName).classList.add('active');

        const tabsWrapper = document.getElementById('tabsWrapper');
        const slider = document.getElementById('tabSlider');
        const tabs = document.querySelectorAll('.auth-tab');

        if (panelName === 'forgot') {
            tabsWrapper.style.display = 'none'; // Hide tabs
        } else {
            tabsWrapper.style.display = 'flex'; // Show tabs
            
            // Move slider
            slider.style.transform = `translateX(${tabIndex * 100}%)`;
            
            // Update active text color
            tabs.forEach((tab, idx) => {
                if (idx === tabIndex) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });
        }
    }

    function showForgotPassword() {
        switchPanel('forgot', -1);
    }

    // Auto-open logic based on Laravel errors or sessions
    window.onload = function() {
        @if(session('open_forgot'))
            showForgotPassword();
        @elseif($errors->has('first_name') || $errors->has('last_name') || ($errors->has('email') && old('first_name')))
            switchPanel('register', 1);
        @elseif(session('signup_email') || request()->routeIs('register'))
            switchPanel('register', 1);
        @else
            switchPanel('login', 0); // Default to login
        @endif
    };
</script>
@endsection

