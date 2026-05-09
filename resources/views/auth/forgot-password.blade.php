<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password — {{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0a0a0f;
            --card: #111118;
            --border: #1e1e2e;
            --accent: #7c6af7;
            --accent-glow: rgba(124, 106, 247, 0.25);
            --text: #e8e8f0;
            --muted: #6b6b80;
            --error: #f87171;
            --success: #4ade80;
            --input-bg: #0f0f1a;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            overflow: hidden;
            position: relative;
        }

        /* Animated background orbs */
        body::before, body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            animation: float 8s ease-in-out infinite alternate;
        }
        body::before {
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(124,106,247,0.15), transparent 70%);
            top: -100px; left: -100px;
        }
        body::after {
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(99,179,237,0.1), transparent 70%);
            bottom: -50px; right: -50px;
            animation-delay: -4s;
        }
        @keyframes float {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(30px, 30px) scale(1.1); }
        }

        .card {
            position: relative;
            z-index: 1;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 0 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.03);
            animation: slideUp 0.5s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .icon-wrap {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #7c6af7, #63b3ed);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 24px var(--accent-glow);
        }
        .icon-wrap svg { width: 28px; height: 28px; color: white; }

        h1 { font-size: 1.5rem; font-weight: 600; margin-bottom: 0.4rem; letter-spacing: -0.02em; }
        p.subtitle { color: var(--muted); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1.75rem; }

        /* Status / error messages */
        .alert {
            padding: 0.85rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
            border: 1px solid;
        }
        .alert-success {
            background: rgba(74, 222, 128, 0.08);
            border-color: rgba(74, 222, 128, 0.3);
            color: var(--success);
        }
        .alert-error {
            background: rgba(248, 113, 113, 0.08);
            border-color: rgba(248, 113, 113, 0.3);
            color: var(--error);
        }

        .form-group { margin-bottom: 1.25rem; }
        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--muted);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-family: 'DM Mono', monospace;
        }

        input[type="email"] {
            width: 100%;
            padding: 0.8rem 1rem;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        input[type="email"]:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        input[type="email"].is-invalid { border-color: var(--error); }
        .invalid-feedback { color: var(--error); font-size: 0.8rem; margin-top: 0.4rem; }

        button[type="submit"] {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, #7c6af7, #6356d4);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 4px 20px var(--accent-glow);
            margin-top: 0.25rem;
        }
        button[type="submit"]:hover { opacity: 0.9; box-shadow: 0 6px 28px var(--accent-glow); }
        button[type="submit"]:active { transform: scale(0.98); }
        button[type="submit"]:disabled { opacity: 0.5; cursor: not-allowed; }

        .back-link {
            display: flex; align-items: center; gap: 6px;
            color: var(--muted); font-size: 0.85rem;
            text-decoration: none; margin-top: 1.5rem;
            transition: color 0.2s;
            justify-content: center;
        }
        .back-link:hover { color: var(--text); }
        .back-link svg { width: 14px; height: 14px; }

        .security-note {
            margin-top: 1.5rem;
            padding: 0.75rem 1rem;
            background: rgba(124,106,247,0.06);
            border: 1px solid rgba(124,106,247,0.15);
            border-radius: 10px;
            font-size: 0.78rem;
            color: var(--muted);
            line-height: 1.5;
        }
        .security-note strong { color: var(--accent); }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
            </svg>
        </div>

        <h1>Forgot Password?</h1>
        <p class="subtitle">Enter your email and we'll send you a secure link to reset your password.</p>

        {{-- Success message --}}
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        {{-- General errors --}}
        @if ($errors->has('email') && !$errors->has('throttle'))
            <div class="alert alert-error">{{ $errors->first('email') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    autocomplete="email"
                    autofocus
                    required
                >
            </div>

            <button type="submit" id="submitBtn">
                Send Reset Link
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
            </svg>
            Back to Login
        </a>

        <div class="security-note">
            🛡️ <strong>Security note:</strong> For your protection, we always show this message even if the email doesn't exist in our system. Reset links expire in <strong>{{ config('auth.passwords.users.expire', 60) }} minutes</strong>.
        </div>
    </div>

    <script>
        // Disable button after submit to prevent double-send
        document.getElementById('forgotForm').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.textContent = 'Sending...';
        });
    </script>
</body>
</html>