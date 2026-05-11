@extends('frontend.layouts.app')
@section('content')

<style>
:root {
    --primary:    #6c47ff;
    --primary-dk: #4f2fe0;
    --accent:     #ff6b6b;
    --dark:       #0f0e17;
    --card-bg:    #ffffff;
    --muted:      #6b7280;
    --border:     #e5e7eb;
    --radius:     14px;
    --shadow:     0 20px 60px rgba(108,71,255,.13);
    --input-bg:   #f8f7ff;
}
.auth-page { min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 40px 16px 60px; }
.signup-card { background: var(--card-bg); border-radius: var(--radius); box-shadow: var(--shadow); padding: 48px 44px; width: 100%; max-width: 460px; border: 1px solid rgba(108,71,255,.1); position: relative; overflow: hidden; }
.signup-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--primary), var(--accent)); border-radius: var(--radius) var(--radius) 0 0; }
.form-title { font-size: 1rem; font-weight: 800; letter-spacing: .08em; color: var(--dark); margin-bottom: 8px; text-align: center; }
.form-subtitle { text-align: center; color: var(--muted); font-size: .9rem; margin-bottom: 32px; }
.form-label { font-size: .82rem; font-weight: 600; color: #374151; margin-bottom: 6px; display: block; letter-spacing: .03em; }
.form-label span { color: var(--accent); margin-left: 2px; }
.form-control { background: var(--input-bg); border: 1.5px solid var(--border); border-radius: 10px; padding: 12px 16px; font-size: .95rem; width: 100%; color: var(--dark); transition: border-color .2s, box-shadow .2s; outline: none; box-sizing: border-box; }
.form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(108,71,255,.12); background: #fff; }
.field-group { margin-bottom: 20px; width: 100%; }
.btn-register { width: 100%; padding: 13px; background: linear-gradient(135deg, var(--primary), var(--primary-dk)); color: #fff; font-size: 1rem; font-weight: 700; letter-spacing: .05em; border: none; border-radius: 10px; cursor: pointer; transition: transform .15s, box-shadow .15s; box-shadow: 0 6px 20px rgba(108,71,255,.35); margin-top: 8px; }
.btn-register:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(108,71,255,.45); }
.btn-register:active { transform: translateY(0); opacity: .9; }
.login-link { text-align: center; margin-top: 24px; font-size: .88rem; color: var(--muted); }
.login-link a { color: var(--primary); font-weight: 600; text-decoration: none; }
.login-link a:hover { color: var(--primary-dk); text-decoration: underline; }
.auth-alert { padding: 11px 14px; border-radius: 9px; font-size: .85rem; margin-bottom: 20px; }
.auth-alert.error { background: #fff1f1; border: 1px solid #fca5a5; color: #b91c1c; }
.auth-alert.success { background: #f0fdf4; border: 1px solid #86efac; color: #15803d; }
.icon-wrap { width: 64px; height: 64px; background: linear-gradient(135deg, rgba(108,71,255,.12), rgba(255,107,107,.1)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
.icon-wrap svg { width: 30px; height: 30px; stroke: var(--primary); fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
@media (max-width: 575px) { .signup-card { padding: 36px 22px 32px; } .form-title { font-size: 1rem; } }
@media (max-width: 360px) { .signup-card { padding: 28px 16px 26px; } }
</style>

<div class="auth-page">
    <div class="signup-card mt-5">
        <div class="icon-wrap">
            <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <div class="form-title">FORGOT PASSWORD</div>
        <p class="form-subtitle">Enter your email and we'll send you an OTP.</p>

        @if(session('success'))
            <div class="auth-alert success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="auth-alert error">
                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.otp.send') }}">
            @csrf
            <div class="field-group">
                <label class="form-label">Email Address <span>*</span></label>
                <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}" required autocomplete="email"/>
            </div>
            <div class="field-group" style="margin-bottom:0">
                <button type="submit" class="btn-register">Send OTP</button>
            </div>
        </form>

        <div class="login-link">Remembered your password? <a href="{{ route('login') }}">Login</a></div>
    </div>
</div>

<br><br>
<footer class="footer-section">
    @include('frontend.layouts.partials.footer')
</footer>
@endsection