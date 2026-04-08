<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            background: #E1F5EE;
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

        input[type="text"],
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
            border-color: #0F6E56;
        }

        button[type="submit"] {
            width: 100%;
            height: 40px;
            background: #0F6E56;
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
            background: #085041;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 1.5rem;
        }

        .footer a {
            color: #0F6E56;
            text-decoration: none;
            font-weight: 500;
        }

        .error {
            font-size: 12px;
            color: #c0392b;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        <div class="avatar">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0F6E56" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <line x1="19" y1="8" x2="19" y2="14"/>
                <line x1="22" y1="11" x2="16" y2="11"/>
            </svg>
        </div>
        <h2>Create an account</h2>
        <p class="subtitle">Fill in the details to get started</p>
    </div>

    <form method="POST" action="{{route('register')}}">
        @csrf
        <div class="form-group">
            <div>
                <label>Full name</label>
                <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}">
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label>Email address</label>
                <input type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}">
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••">
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>
            <button type="submit">Create account</button>
        </div>
    </form>

    <p class="footer">Already have an account? <a href="/login">Sign in</a></p>
</div>

</body>
</html>
