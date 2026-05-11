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
.form-title { font-size: 1.75rem; font-weight: 800; letter-spacing: .08em; color: var(--dark); margin-bottom: 8px; text-align: center; }
.form-subtitle { text-align: center; color: var(--muted); font-size: .9rem; margin-bottom: 32px; }
.form-label { font-size: .82rem; font-weight: 600; color: #374151; margin-bottom: 6px; display: block; letter-spacing: .03em; }
.form-label span { color: var(--accent); margin-left: 2px; }
.form-control { background: var(--input-bg); border: 1.5px solid var(--border); border-radius: 10px; padding: 12px 16px; font-size: .95rem; width: 100%; color: var(--dark); transition: border-color .2s, box-shadow .2s; outline: none; box-sizing: border-box; }
.form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(108,71,255,.12); background: #fff; }
.field-group { margin-bottom: 20px; width: 100%; }

/* Password wrap */
.pass-wrap { position: relative; }
.pass-wrap .form-control { padding-right: 48px; }
.pass-toggle { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 4px; color: var(--muted); transition: color .2s; display: flex; align-items: center; }
.pass-toggle:hover { color: var(--primary); }
.pass-toggle svg { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

/* Password strength */
.strength-bar { display: flex; gap: 4px; margin-top: 8px; }
.strength-bar span { height: 4px; flex: 1; border-radius: 99px; background: var(--border); transition: background .3s; }
.strength-label { font-size: .75rem; color: var(--muted); margin-top: 4px; }

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
@media (max-width: 575px) { .signup-card { padding: 36px 22px 32px; } .form-title { font-size: 1.45rem; } }
@media (max-width: 360px) { .signup-card { padding: 28px 16px 26px; } }
</style>

<div class="auth-page">
    <div class="signup-card mt-5">
        <div class="icon-wrap">
            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div class="form-title">NEW PASSWORD</div>
        <p class="form-subtitle">Create a strong password for your account.</p>

        @if(session('success'))
            <div class="auth-alert success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="auth-alert error">
                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.reset') }}">
            @csrf

            {{-- New Password --}}
            <div class="field-group">
                <label class="form-label">New Password <span>*</span></label>
                <div class="pass-wrap">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Minimum 8 characters"
                        required
                        autocomplete="new-password"
                        oninput="checkStrength(this.value)"
                    />
                    <button type="button" class="pass-toggle" onclick="togglePass('password', this)" aria-label="Toggle password">
                        <svg class="eye-show" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg class="eye-hide" viewBox="0 0 24 24" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
                <div class="strength-bar">
                    <span id="s1"></span><span id="s2"></span><span id="s3"></span><span id="s4"></span>
                </div>
                <div class="strength-label" id="strength-text"></div>
            </div>

            {{-- Confirm Password --}}
            <div class="field-group">
                <label class="form-label">Confirm Password <span>*</span></label>
                <div class="pass-wrap">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Repeat your password"
                        required
                        autocomplete="new-password"
                    />
                    <button type="button" class="pass-toggle" onclick="togglePass('password_confirmation', this)" aria-label="Toggle password">
                        <svg class="eye-show" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg class="eye-hide" viewBox="0 0 24 24" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
            </div>

            <div class="field-group" style="margin-bottom:0">
                <button type="submit" class="btn-register">Reset Password</button>
            </div>
        </form>

        <div class="login-link"><a href="{{ route('login') }}">← Back to Login</a></div>
    </div>
</div>

<br><br>
<footer class="footer-section">
    @include('frontend.layouts.partials.footer')
</footer>

<script>
function togglePass(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const eyeShow = btn.querySelector('.eye-show');
    const eyeHide = btn.querySelector('.eye-hide');
    if (input.type === 'password') {
        input.type = 'text';
        eyeShow.style.display = 'none';
        eyeHide.style.display = 'block';
        btn.style.color = 'var(--primary)';
    } else {
        input.type = 'password';
        eyeShow.style.display = 'block';
        eyeHide.style.display = 'none';
        btn.style.color = '';
    }
}

function checkStrength(val) {
    const bars = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3'), document.getElementById('s4')];
    const label = document.getElementById('strength-text');
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const colors = ['', '#ef4444', '#f97316', '#eab308', '#22c55e'];
    const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
    bars.forEach((b, i) => b.style.background = i < score ? colors[score] : 'var(--border)');
    label.textContent = val.length ? labels[score] : '';
    label.style.color = colors[score];
}
</script>

@endsection