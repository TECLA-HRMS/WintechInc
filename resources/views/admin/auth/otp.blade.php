<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification - Wintech Inc</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
       <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            width: 100%;
            height: 80vh;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Left Section (Illustration) */
        .left-section {
           width: 60%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .left-section img {
            width: 90%;
            max-width: 500px;
            
        }

        /* Right Section (Login Form) */
        .right-section {
            width: 40%;
            padding: 2.5rem;
            background-color: #ffffff;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: #df1c6a;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1rem;
        }

        p {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.9rem;
            color: #374151;
        }

        input:focus {
            border-color: #df1c6a;
            outline: none;
            box-shadow: 0 0 0 3px rgba(223, 28, 106, 0.1);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #6b7280;
        }

        .options a {
            color: #df1c6a;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #e84545;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1.25rem;
        }

        button:hover {
            background-color: #a8124b;
        }

      
    </style>
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="{{ asset('logo.png') }}" alt="Wintech Inc Logo">
        </div>
        <div class="right-section">
            <div class="logo">
                <h1 style="color: #df1c6a;">Wintech Inc</h1>
            </div>
            <h1>OTP Verification</h1>
            <p>Please enter the OTP sent to your mobile number.</p>

            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.verify-otp') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="otp">OTP</label>
                    <input 
                        type="text" 
                        id="otp" 
                        name="otp" 
                        required
                        placeholder="Enter 6-digit OTP"
                        maxlength="6"
                        pattern="\d{6}"
                    >
                </div>
                <button type="submit" style="background: linear-gradient(135deg, #e84545, #df1c6a); border: none; color:white">Verify OTP</button>
            </form>
        </div>
    </div>
</body>
</html>