<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f0;
            font-family: sans-serif;
        }

        .card {
            width: 100%;
            max-width: 400px;
            background: white;
            border: 1px solid #e5e5e0;
            border-radius: 12px;
            padding: 2.5rem 2rem;
            margin: 1rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #EEEDFE;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        h2 {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 4px;
            color: #1a1a1a;
        }

        .subtitle {
            font-size: 14px;
            color: #888;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #555;
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0 12px;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        input:focus {
            border-color: #534AB7;
        }

        .forgot {
            text-align: right;
            margin-top: -8px;
        }

        .forgot a {
            font-size: 13px;
            color: #534AB7;
            text-decoration: none;
        }

        button[type="submit"] {
            width: 100%;
            height: 40px;
            background: #534AB7;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 4px;
        }

        button[type="submit"]:hover {
            background: #3C3489;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 1.5rem;
        }

        .footer a {
            color: #534AB7;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        <div class="avatar">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#534AB7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>
        <h2>Welcome back</h2>
        <p class="subtitle">Sign in to your account</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <div>
                <label>Email address</label>
                <input type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="forgot">
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit">Sign in</button>
        </div>
    </form>

    <p class="footer">Don't have an account? <a href="/register">Sign up</a></p>
</div>

</body>
</html>
