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
.form-subtitle { text-align: center; color: var(--muted); font-size: .9rem; margin-bottom: 32px; line-height: 1.5; }
.form-subtitle strong { color: var(--primary); }
.form-label { font-size: .82rem; font-weight: 600; color: #374151; margin-bottom: 6px; display: block; letter-spacing: .03em; }
.form-control { background: var(--input-bg); border: 1.5px solid var(--border); border-radius: 10px; padding: 12px 16px; font-size: .95rem; width: 100%; color: var(--dark); transition: border-color .2s, box-shadow .2s; outline: none; box-sizing: border-box; }
.form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(108,71,255,.12); background: #fff; }

/* OTP input style */
.otp-input { text-align: center; font-size: 2rem; font-weight: 700; letter-spacing: 10px; font-family: 'Courier New', monospace; color: var(--primary); }

.field-group { margin-bottom: 20px; width: 100%; }
.btn-register { width: 100%; padding: 13px; background: linear-gradient(135deg, var(--primary), var(--primary-dk)); color: #fff; font-size: 1rem; font-weight: 700; letter-spacing: .05em; border: none; border-radius: 10px; cursor: pointer; transition: transform .15s, box-shadow .15s; box-shadow: 0 6px 20px rgba(108,71,255,.35); margin-top: 8px; }
.btn-register:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(108,71,255,.45); }
.btn-register:active { transform: translateY(0); opacity: .9; }
.btn-resend { width: 100%; padding: 12px; background: transparent; color: var(--primary); font-size: .9rem; font-weight: 600; border: 1.5px solid rgba(108,71,255,.3); border-radius: 10px; cursor: pointer; transition: all .2s; margin-top: 10px; }
.btn-resend:hover { background: rgba(108,71,255,.06); border-color: var(--primary); }
.login-link { text-align: center; margin-top: 24px; font-size: .88rem; color: var(--muted); }
.login-link a { color: var(--primary); font-weight: 600; text-decoration: none; }
.login-link a:hover { color: var(--primary-dk); text-decoration: underline; }
.auth-alert { padding: 11px 14px; border-radius: 9px; font-size: .85rem; margin-bottom: 20px; }
.auth-alert.error { background: #fff1f1; border: 1px solid #fca5a5; color: #b91c1c; }
.auth-alert.success { background: #f0fdf4; border: 1px solid #86efac; color: #15803d; }

/* Timer */
.timer-wrap { text-align: center; margin-bottom: 16px; }
.timer-label { font-size: .82rem; color: var(--muted); }
.timer-count { font-size: 1.1rem; font-weight: 700; color: var(--accent); font-variant-numeric: tabular-nums; }
.timer-count.expired { color: #9ca3af; }

.icon-wrap { width: 64px; height: 64px; background: linear-gradient(135deg, rgba(108,71,255,.12), rgba(255,107,107,.1)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
.icon-wrap svg { width: 30px; height: 30px; stroke: var(--primary); fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }

@media (max-width: 575px) { .signup-card { padding: 36px 22px 32px; } .form-title { font-size: 1.45rem; } .otp-input { font-size: 1.6rem; letter-spacing: 6px; } }
@media (max-width: 360px) { .signup-card { padding: 28px 16px 26px; } }
</style>

<div class="auth-page">
    <div class="signup-card mt-5">
        <div class="icon-wrap">
            <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <div class="form-title">VERIFY OTP</div>
        <p class="form-subtitle">
            We sent a 6-digit OTP to<br>
            <strong>{{ session('password_reset_email') }}</strong>
        </p>

        @if(session('success'))
            <div class="auth-alert success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="auth-alert error">
                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.otp.verify') }}">
            @csrf
            <div class="field-group">
                <label class="form-label">Enter OTP</label>
                <input
                    type="text"
                    name="otp"
                    class="form-control otp-input"
                    placeholder="000000"
                    maxlength="6"
                    inputmode="numeric"
                    pattern="\d{6}"
                    required
                    autocomplete="one-time-code"
                />
            </div>

            <div class="timer-wrap">
                <span class="timer-label">Expires in: </span>
                <span class="timer-count" id="countdown">10:00</span>
            </div>

            <div class="field-group" style="margin-bottom:0">
                <button type="submit" class="btn-register">Verify OTP</button>
            </div>
        </form>

        <form method="POST" action="{{ route('password.otp.send') }}">
            @csrf
            <input type="hidden" name="email" value="{{ session('password_reset_email') }}">
            <button type="submit" class="btn-resend">Resend OTP</button>
        </form>

        <div class="login-link"><a href="{{ route('login') }}">← Back to Login</a></div>
    </div>
</div>

<br><br>
<footer class="footer-section">
    @include('frontend.layouts.partials.footer')
</footer>

<script>
// Countdown timer
let secs = 600;
const el = document.getElementById('countdown');
const tick = setInterval(() => {
    secs--;
    const m = String(Math.floor(secs / 60)).padStart(2, '0');
    const s = String(secs % 60).padStart(2, '0');
    el.textContent = `${m}:${s}`;
    if (secs <= 0) {
        clearInterval(tick);
        el.textContent = 'Expired';
        el.classList.add('expired');
    }
}, 1000);

// Auto-format: only digits
document.querySelector('.otp-input').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').slice(0, 6);
});
</script>

@endsection