<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:system-ui,sans-serif;background:#f1f5f9;color:#0f172a;font-size:14px}
.app{display:flex;flex-direction:column;height:100vh;min-height:600px}
.topbar{height:52px;background:#fff;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;gap:10px;padding:0 14px;flex-shrink:0;z-index:10}
.hbtn{display:flex;flex-direction:column;gap:4px;background:none;border:none;cursor:pointer;padding:4px;border-radius:6px}
.hbtn span{display:block;width:18px;height:2px;background:#64748b;border-radius:2px;transition:all .2s}
.hbtn.open span:nth-child(1){transform:rotate(45deg) translate(4px,4px)}
.hbtn.open span:nth-child(2){opacity:0}
.hbtn.open span:nth-child(3){transform:rotate(-45deg) translate(4px,-4px)}
.logo{font-weight:700;font-size:15px;color:#2563eb;letter-spacing:-.3px}
.logo em{color:#94a3b8;font-style:normal;font-weight:400}
.tb-right{margin-left:auto;display:flex;align-items:center;gap:8px}
.tb-search{display:flex;align-items:center;gap:6px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:5px 10px}
.tb-search input{border:none;background:none;font-size:12px;color:#0f172a;outline:none;width:130px}
.tb-search svg{width:13px;height:13px;opacity:.4;flex-shrink:0}
.notif{position:relative;width:32px;height:32px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer}
.notif svg{width:14px;height:14px;opacity:.6}
.ndot{position:absolute;top:5px;right:5px;width:6px;height:6px;background:#ef4444;border-radius:50%;border:1.5px solid #fff}
.ava{width:30px;height:30px;border-radius:50%;background:#2563eb;color:#fff;font-size:11px;font-weight:600;display:flex;align-items:center;justify-content:center;cursor:pointer}

/* BODY = sidebar + main side by side */
.body{display:flex;flex:1;overflow:hidden}

/* SIDEBAR — always visible, 210px wide */
.sidebar{width:210px;min-width:210px;background:#fff;border-right:1px solid #e2e8f0;display:flex;flex-direction:column;overflow-y:auto;overflow-x:hidden;flex-shrink:0}

/* On mobile: sidebar becomes overlay */
.overlay{display:none;position:fixed;inset:0;top:52px;background:rgba(0,0,0,.45);z-index:40}

.sec-label{padding:14px 14px 4px;font-size:10px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.7px}
.ni{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;margin:1px 8px;cursor:pointer;font-size:13px;color:#64748b;transition:background .15s;white-space:nowrap}
.ni:hover{background:#f1f5f9;color:#0f172a}
.ni.on{background:#eff6ff;color:#2563eb;font-weight:500}
.ni svg{width:15px;height:15px;flex-shrink:0;opacity:.7}
.ni.on svg{opacity:1}
.nbadge{margin-left:auto;font-size:10px;font-weight:600;padding:1px 6px;border-radius:20px}
.nbadge.red{background:#fee2e2;color:#991b1b}
.nbadge.amber{background:#fef3c7;color:#92400e}
.sb-bottom{margin-top:auto;padding:10px 8px;border-top:1px solid #e2e8f0}

.main{flex:1;overflow-y:auto;padding:16px;min-width:0}

.pg-head{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:16px}
.pg-title{font-size:17px;font-weight:700;letter-spacing:-.3px}
.pg-sub{font-size:12px;color:#64748b;margin-top:2px}
.pills{display:flex;gap:6px}
.pill{padding:4px 10px;border-radius:20px;font-size:11px;font-weight:500;background:#f8fafc;color:#64748b;border:1px solid #e2e8f0;cursor:pointer}
.pill.on{background:#eff6ff;color:#2563eb;border-color:#bfdbfe}

.stats{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:14px}
.sc{background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:13px}
.sc .ic{width:32px;height:32px;border-radius:9px;display:flex;align-items:center;justify-content:center;margin-bottom:9px}
.sc .ic svg{width:15px;height:15px}
.sc .lbl{font-size:11px;color:#64748b;margin-bottom:2px}
.sc .val{font-size:18px;font-weight:700;letter-spacing:-.3px}
.sc .dl{font-size:11px;margin-top:3px}
.up{color:#16a34a}.dn{color:#dc2626}

.card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px;margin-bottom:14px}
.card-h{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.card-t{font-size:13px;font-weight:600}
.card-s{font-size:11px;color:#64748b}

table{width:100%;border-collapse:collapse;font-size:12px;table-layout:fixed}
th{padding:7px 8px;text-align:left;font-size:10px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.4px;border-bottom:1px solid #e2e8f0}
td{padding:8px 8px;border-bottom:1px solid #f1f5f9;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
tr:last-child td{border-bottom:none}
.tag{display:inline-block;padding:2px 7px;border-radius:20px;font-size:10px;font-weight:500}
.tg{background:#dcfce7;color:#15803d}.ta{background:#fef9c3;color:#854d0e}.tr{background:#fee2e2;color:#991b1b}.tb{background:#dbeafe;color:#1d4ed8}
.uc{display:flex;align-items:center;gap:6px}
.mav{width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:600;flex-shrink:0}

.fi{display:flex;gap:9px;padding:9px 0;border-bottom:1px solid #f1f5f9}
.fi:last-child{border-bottom:none}
.fd{width:26px;height:26px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center}
.ft{font-size:12px;line-height:1.4}
.fti{font-size:10px;color:#94a3b8;margin-top:2px}

/* MOBILE: sidebar hidden by default, slides in as overlay */
@media(max-width:640px){
  .sidebar{
    position:fixed;
    top:52px;left:0;
    height:calc(100% - 52px);
    z-index:50;
    transform:translateX(-100%);
    transition:transform .25s ease;
    min-width:200px;
    width:200px;
  }
  .sidebar.mob-open{transform:translateX(0)}
  .overlay.show{display:block}
  .stats{grid-template-columns:repeat(2,1fr)}
  .tb-search{display:none}
}
/* DESKTOP: hamburger hidden, sidebar always visible */
@media(min-width:641px){
  .hbtn{display:none}
  .overlay{display:none!important}
}

/* ============ MODERN PROFILE / PASSWORD CARDS ============ */
.settings-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-top:18px}
@media(max-width:768px){.settings-row{grid-template-columns:1fr}}

.modcard{
  background:#fff;
  border-radius:16px;
  border:1px solid #eef1f6;
  overflow:hidden;
  box-shadow:0 1px 2px rgba(15,23,42,.04), 0 8px 24px -8px rgba(15,23,42,.06);
  transition:box-shadow .25s ease, transform .25s ease;
}
.modcard:hover{box-shadow:0 4px 8px rgba(15,23,42,.05), 0 16px 32px -10px rgba(15,23,42,.1);transform:translateY(-2px)}

.modcard-head{
  display:flex;align-items:center;gap:11px;
  padding:18px 20px;
  position:relative;
  overflow:hidden;
}
.modcard-head.grad-blue{background:linear-gradient(135deg,#2563eb 0%,#4f8ef7 100%)}
.modcard-head.grad-rose{background:linear-gradient(135deg,#e11d48 0%,#fb7185 100%)}
.modcard-head::after{
  content:'';position:absolute;right:-20px;top:-30px;
  width:120px;height:120px;border-radius:50%;
  background:rgba(255,255,255,.08);
}
.modcard-icon{
  width:38px;height:38px;border-radius:11px;
  background:rgba(255,255,255,.18);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;position:relative;z-index:1;
  backdrop-filter:blur(2px);
}
.modcard-icon svg{width:18px;height:18px;stroke:#fff}
.modcard-headtext{position:relative;z-index:1}
.modcard-title{font-size:14.5px;font-weight:700;color:#fff;letter-spacing:-.2px;line-height:1.2}
.modcard-sub{font-size:11px;color:rgba(255,255,255,.85);margin-top:1px}

.modcard-body{padding:22px 20px 20px}

.minput-group{margin-bottom:16px;position:relative}
.minput-group:last-of-type{margin-bottom:0}
.minput-label{
  display:flex;align-items:center;gap:6px;
  font-size:11.5px;font-weight:600;color:#475569;
  margin-bottom:6px;letter-spacing:.1px;
}
.minput-label svg{width:13px;height:13px;opacity:.55;flex-shrink:0}
.minput-hint{font-size:10.5px;color:#94a3b8;margin-top:5px;display:block;line-height:1.4}

.minput-wrap{position:relative}
.minput-wrap input{
  width:100%;
  padding:10px 13px;
  padding-right:38px;
  border:1.5px solid #e6e9f0;
  border-radius:10px;
  font-size:13px;
  color:#0f172a;
  background:#f8fafc;
  transition:border-color .18s, background .18s, box-shadow .18s;
  outline:none;
}
.minput-wrap input::placeholder{color:#b6bdc9}
.minput-wrap input:hover{border-color:#cbd5e1}
.minput-wrap input:focus{
  background:#fff;
  border-color:#2563eb;
  box-shadow:0 0 0 3.5px rgba(37,99,235,.1);
}
.modcard-head.grad-blue{background:linear-gradient(135deg,#2563eb 0%,#4f8ef7 100%)}
.modcard-head.grad-rose{background:linear-gradient(135deg,#1e293b 0%,#475569 100%)}
.minput-wrap .minput-icon{
  position:absolute;right:12px;top:50%;transform:translateY(-50%);
  width:15px;height:15px;color:#94a3b8;pointer-events:none;
}
.minput-wrap input.is-invalid{border-color:#ef4444;background:#fef2f2}
.minput-wrap input.is-invalid:focus{box-shadow:0 0 0 3.5px rgba(239,68,68,.1)}

.minput-wrap .toggle-eye{
  position:absolute;right:10px;top:50%;transform:translateY(-50%);
  width:26px;height:26px;border:none;background:none;cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  border-radius:6px;color:#94a3b8;
}
.minput-wrap .toggle-eye:hover{background:#eef2f7;color:#475569}
.minput-wrap .toggle-eye svg{width:15px;height:15px}

.minvalid-fb{font-size:10.5px;color:#ef4444;margin-top:5px;display:flex;align-items:center;gap:4px}

.malert{
  display:flex;align-items:center;gap:8px;
  padding:9px 12px;border-radius:10px;
  font-size:12px;font-weight:500;margin-bottom:14px;
}
.malert svg{width:15px;height:15px;flex-shrink:0}
.malert.ok{background:#ecfdf5;color:#15803d;border:1px solid #bbf7d0}
.malert.bad{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca}

.mbtn{
  width:100%;
  display:flex;align-items:center;justify-content:center;gap:7px;
  padding:11px 14px;
  border:none;border-radius:10px;
  font-size:13px;font-weight:600;letter-spacing:.1px;
  cursor:pointer;color:#fff;
  transition:transform .15s ease, box-shadow .2s ease, opacity .15s;
  margin-top:6px;
}
.mbtn svg{width:14px;height:14px}
.mbtn.blue{background:linear-gradient(135deg,#2563eb,#4f8ef7);box-shadow:0 4px 12px -3px rgba(37,99,235,.45)}
.mbtn.rose{background:linear-gradient(135deg,#1e293b,#475569);box-shadow:0 4px 12px -3px rgba(30,41,59,.4)}
.mbtn:hover{transform:translateY(-1px);filter:brightness(1.04)}
.mbtn:active{transform:translateY(0)}

.pwd-strength{display:flex;gap:4px;margin-top:7px}
.pwd-strength span{flex:1;height:3px;border-radius:3px;background:#e6e9f0;transition:background .25s}
.pwd-strength span.s1{background:#ef4444}
.pwd-strength span.s2{background:#f59e0b}
.pwd-strength span.s3{background:#eab308}
.pwd-strength span.s4{background:#22c55e}
</style>

<div class="app">
  <div class="topbar">
    <button class="hbtn" id="hbtn" onclick="toggleSB()">
      <span></span><span></span><span></span>
    </button>
    <div class="logo">Onetask<em>Market</em> <span style="font-size:10px;background:#eff6ff;color:#2563eb;padding:2px 6px;border-radius:4px;font-weight:600;margin-left:2px">Admin</span></div>
    <div class="tb-search">
      <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6.5" cy="6.5" r="4.5"/><path d="m10 10 3.5 3.5"/></svg>
      <input placeholder="Search jobs, users...">
    </div>
    <div class="tb-right">
      <div class="notif"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 1.5a5 5 0 0 1 5 5v2l1 2H2l1-2v-2a5 5 0 0 1 5-5Z"/><path d="M6.5 13.5a1.5 1.5 0 0 0 3 0"/></svg><div class="ndot"></div></div>
      <div class="ava">AD</div>
    </div>
  </div>

  <div class="body">
    <div class="overlay" id="overlay" onclick="closeSB()"></div>

    @include('admin.layouts.sidebar');

    <main class="main">
      
   <div class="card shadow-sm border-0 rounded-3 mt-4">
  
    <div class="settings-row">
    {{-- ================= UPDATE EMAIL / USERNAME ================= --}}
    <div class="modcard">
        <div class="modcard-head grad-blue">
            <div class="modcard-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <div class="modcard-headtext">
                <div class="modcard-title">Update Email / Username</div>
                <div class="modcard-sub">Manage your admin identity</div>
            </div>
        </div>

        <div class="modcard-body">
            @if(session()->has('profile_success'))
                <div class="malert ok">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 6 9 17l-5-5"/></svg>
                    {{ session('profile_success') }}
                </div>
            @endif
            @if(session()->has('profile_error'))
                <div class="malert bad">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                    {{ session('profile_error') }}
                </div>
            @endif

            <form action="{{ route('admin.profile.update') }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                <div class="minput-group">
                    <label class="minput-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.5-7 8-7s8 3 8 7"/></svg>
                        Username
                    </label>
                    <div class="minput-wrap">
                        <input type="text"
                               name="name"
                               class="@error('name') is-invalid @enderror"
                               value="{{ old('name', auth()->user()->name) }}"
                               maxlength="50"
                               pattern="[A-Za-z0-9_\.\s]+"
                               title="Only letters, numbers, underscore, dot and space allowed"
                               placeholder="e.g. john_doe"
                               required>
                    </div>
                    @error('name')
                        <div class="minvalid-fb">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="12" height="12"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="minput-group">
                    <label class="minput-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                        Email Address
                    </label>
                    <div class="minput-wrap">
                        <input type="email"
                               name="email"
                               class="@error('email') is-invalid @enderror"
                               value="{{ old('email', auth()->user()->email) }}"
                               maxlength="100"
                               placeholder="you@example.com"
                               required>
                    </div>
                    @error('email')
                        <div class="minvalid-fb">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="12" height="12"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="minput-group">
                    <label class="minput-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Current Password
                    </label>
                    <div class="minput-wrap">
                        <input type="password"
                               name="current_password"
                               id="profileCurrentPass"
                               class="@error('current_password') is-invalid @enderror"
                               placeholder="Confirm with your password"
                               required>
                        <button type="button" class="toggle-eye" onclick="toggleEye('profileCurrentPass', this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <span class="minput-hint">Required to confirm any changes to your account</span>
                    @error('current_password')
                        <div class="minvalid-fb">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="12" height="12"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="mbtn blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/><path d="M17 21v-8H7v8M7 3v5h8"/></svg>
                    Update Profile
                </button>
            </form>
        </div>
    </div>

    {{-- ================= UPDATE PASSWORD ================= --}}
    <div class="modcard">
        <div class="modcard-head grad-rose">
            <div class="modcard-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>
            <div class="modcard-headtext">
                <div class="modcard-title">Update Password</div>
                <div class="modcard-sub">Keep your account secure</div>
            </div>
        </div>

        <div class="modcard-body">
            @if(session()->has('password_success'))
                <div class="malert ok">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 6 9 17l-5-5"/></svg>
                    {{ session('password_success') }}
                </div>
            @endif
            @if(session()->has('password_error'))
                <div class="malert bad">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                    {{ session('password_error') }}
                </div>
            @endif

            <form action="{{ route('admin.password.update') }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                <div class="minput-group">
                    <label class="minput-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Current Password
                    </label>
                    <div class="minput-wrap">
                        <input type="password"
                               name="current_password"
                               id="pwdCurrentPass"
                               class="@error('current_password') is-invalid @enderror"
                               placeholder="Enter current password"
                               required>
                        <button type="button" class="toggle-eye" onclick="toggleEye('pwdCurrentPass', this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @error('current_password')
                        <div class="minvalid-fb">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="12" height="12"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="minput-group">
                    <label class="minput-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                        New Password
                    </label>
                    <div class="minput-wrap">
                        <input type="password"
                               name="password"
                               id="newPassword"
                               class="@error('password') is-invalid @enderror"
                               minlength="8"
                               maxlength="64"
                               placeholder="Create new password"
                               oninput="checkStrength(this.value)"
                               required>
                        <button type="button" class="toggle-eye" onclick="toggleEye('newPassword', this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <div class="pwd-strength" id="pwdStrengthBar">
                        <span id="bar1"></span><span id="bar2"></span><span id="bar3"></span><span id="bar4"></span>
                    </div>
                    <span class="minput-hint">Min 8 characters, with uppercase, lowercase, number & symbol</span>
                    @error('password')
                        <div class="minvalid-fb">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="12" height="12"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="minput-group">
                    <label class="minput-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
                        Confirm New Password
                    </label>
                    <div class="minput-wrap">
                        <input type="password"
                               name="password_confirmation"
                               id="confirmPassword"
                               minlength="8"
                               maxlength="64"
                               placeholder="Re-enter new password"
                               required>
                        <button type="button" class="toggle-eye" onclick="toggleEye('confirmPassword', this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="mbtn rose">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>


  </div>

   

    </main>
  </div>
</div>

<script>
var mobOpen=false;
function toggleSB(){
  mobOpen=!mobOpen;
  var sb=document.getElementById('sidebar');
  var ov=document.getElementById('overlay');
  var hb=document.getElementById('hbtn');
  if(mobOpen){sb.classList.add('mob-open');ov.classList.add('show');hb.classList.add('open')}
  else{sb.classList.remove('mob-open');ov.classList.remove('show');hb.classList.remove('open')}
}
function closeSB(){
  mobOpen=false;
  document.getElementById('sidebar').classList.remove('mob-open');
  document.getElementById('overlay').classList.remove('show');
  document.getElementById('hbtn').classList.remove('open');
}
function navClick(el,name){
  document.querySelectorAll('.ni').forEach(function(n){n.classList.remove('on')});
  el.classList.add('on');
  document.getElementById('pg-title').textContent=name;
  if(window.innerWidth<=640) closeSB();
}
function setPill(el){
  document.querySelectorAll('.pill').forEach(function(p){p.classList.remove('on')});
  el.classList.add('on');
  drawChart();
}
function drawChart(){
  var days=['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
  var data=days.map(function(){return Math.round(5000+Math.random()*11000)});
  var max=Math.max.apply(null,data);
  var svg=document.getElementById('rchart');
  var W=340,H=90,pad=18,gap=7;
  var bw=Math.floor((W-pad*2-(days.length-1)*gap)/days.length);
  var html='';
  data.forEach(function(v,i){
    var x=pad+i*(bw+gap);
    var bh=Math.round((v/max)*(H-22));
    var y=H-16-bh;
    var clr=i===4?'#2563eb':'#bfdbfe';
    html+='<rect x="'+x+'" y="'+y+'" width="'+bw+'" height="'+bh+'" rx="3" fill="'+clr+'"/>';
    html+='<text x="'+(x+bw/2)+'" y="'+(H-2)+'" text-anchor="middle" font-size="9" fill="#94a3b8" font-family="system-ui">'+days[i]+'</text>';
  });
  svg.innerHTML=html;
}
drawChart();

var orders=[
  {u:'Sarah K.',av:'SK',c:'#2563eb',sv:'Logo Design',am:'$85',st:'completed'},
  {u:'Mike T.',av:'MT',c:'#16a34a',sv:'SEO Article',am:'$45',st:'progress'},
  {u:'Aisha B.',av:'AB',c:'#9333ea',sv:'Promo Video',am:'$220',st:'pending'},
  {u:'James O.',av:'JO',c:'#d97706',sv:'WP Fix',am:'$60',st:'completed'},
  {u:'Priya N.',av:'PN',c:'#e11d48',sv:'Data Entry',am:'$35',st:'disputed'},
];
var scls={completed:'tag tg',progress:'tag tb',pending:'tag ta',disputed:'tag tr'};
var slbl={completed:'Done',progress:'Active',pending:'Pending',disputed:'Dispute'};
document.getElementById('otb').innerHTML=orders.map(function(o){
  return '<tr><td><div class="uc"><div class="mav" style="background:'+o.c+'20;color:'+o.c+'">'+o.av+'</div>'+o.u+'</div></td><td style="color:#64748b">'+o.sv+'</td><td style="font-weight:500">'+o.am+'</td><td><span class="'+scls[o.st]+'">'+slbl[o.st]+'</span></td></tr>';
}).join('');

var acts=[
  {bg:'#eff6ff',ic:'#2563eb',t:'<strong>Alex M.</strong> registered as new seller',ti:'2 min ago'},
  {bg:'#f0fdf4',ic:'#16a34a',t:'Order #4821 marked <strong>completed</strong>',ti:'8 min ago'},
  {bg:'#fef9c3',ic:'#854d0e',t:'<strong>Dispute #204</strong> opened by buyer',ti:'15 min ago'},
  {bg:'#fdf4ff',ic:'#9333ea',t:'<strong>$340</strong> withdrawal processed',ti:'28 min ago'},
  {bg:'#fff7ed',ic:'#d97706',t:'New <strong>5-star review</strong> posted',ti:'42 min ago'},
];
document.getElementById('afeed').innerHTML=acts.map(function(a){
  return '<div class="fi"><div class="fd" style="background:'+a.bg+'"><svg viewBox="0 0 12 12" fill="none" stroke="'+a.ic+'" stroke-width="1.6" width="12" height="12"><circle cx="6" cy="4" r="2"/><path d="M2 10a4 4 0 0 1 8 0"/></svg></div><div><div class="ft">'+a.t+'</div><div class="fti">'+a.ti+'</div></div></div>';
}).join('');
</script>


<script>
	
	function toggleEye(inputId, btn){
  var inp = document.getElementById(inputId);
  var isPass = inp.type === 'password';
  inp.type = isPass ? 'text' : 'password';
  btn.innerHTML = isPass
    ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a18.6 18.6 0 0 1 4.06-4.94M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 7 11 7a18.6 18.6 0 0 1-2.16 2.94M1 1l22 22M14.12 14.12a3 3 0 1 1-4.24-4.24"/></svg>'
    : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>';
}

function checkStrength(val){
  var bars = ['bar1','bar2','bar3','bar4'].map(function(id){return document.getElementById(id)});
  bars.forEach(function(b){b.className=''});

  var score = 0;
  if(val.length >= 8) score++;
  if(/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
  if(/[0-9]/.test(val)) score++;
  if(/[^A-Za-z0-9]/.test(val)) score++;

  var classes = ['s1','s1','s2','s3','s4'];
  for(var i=0; i<score; i++){
    bars[i].className = classes[score];
  }
}
</script>
