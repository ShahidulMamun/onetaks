<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
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
.body{display:flex;flex:1;overflow:hidden}
.sidebar{width:210px;min-width:210px;background:#fff;border-right:1px solid #e2e8f0;display:flex;flex-direction:column;overflow-y:auto;overflow-x:hidden;flex-shrink:0}
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

/* ── SECTION HEADERS ── */
.sec-h{display:flex;align-items:center;gap:8px;margin:6px 0 10px}
.sec-h .sec-t{font-size:13px;font-weight:700;color:#0f172a;letter-spacing:-.2px}
.sec-h .sec-d{flex:1;height:1px;background:#e2e8f0}
.sec-h .sec-tag{font-size:10px;font-weight:600;padding:2px 8px;border-radius:20px}

/* ════════════════════════════════════════════════════════
   STAT CARDS — soft-glow system
   Palette restricted to 3 colors: Violet / Emerald / Rose
   Light card bg + deep colored glow shadow (not flat gray) +
   gradient-tinted icon chip, inspired by dark-glassmorphism
   reference but adapted to a light admin surface.
   ════════════════════════════════════════════════════════ */
.stats{display:grid;grid-template-columns:repeat(5,1fr);gap:12px;margin-bottom:22px}

.sc{
  position:relative;
  background:#fff;
  border:1px solid #eef0f4;
  border-radius:14px;
  padding:14px 16px;
  display:flex;
  flex-direction:column;
  gap:10px;
  box-shadow:
    0 1px 2px rgba(15,23,42,.04),
    0 1px 1px rgba(15,23,42,.02),
    0 10px 24px -8px var(--glow, rgba(99,102,241,.20));
  transition:box-shadow .18s, transform .18s;
}
.sc:hover{
  transform:translateY(-2px);
  box-shadow:
    0 2px 4px rgba(15,23,42,.05),
    0 16px 32px -8px var(--glow, rgba(99,102,241,.30));
}

.sc-top{display:flex;align-items:center;justify-content:space-between}
.sc-icon{
  width:36px;height:36px;border-radius:11px;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
  background:var(--accent-grad, linear-gradient(135deg,#818cf8,#6366f1));
  box-shadow:0 4px 10px -2px var(--glow, rgba(99,102,241,.45));
}
.sc-icon svg{width:17px;height:17px;stroke:#fff}
.sc-badge{font-size:10px;font-weight:600;padding:3px 8px;border-radius:20px;background:var(--accent-tint, #eef2ff);color:var(--accent, #6366f1)}
.sc-lbl{font-size:11px;color:#64748b;font-weight:500;letter-spacing:.2px}
.sc-val{font-size:22px;font-weight:700;color:#0f172a;letter-spacing:-.5px;line-height:1}
.sc-foot{font-size:11px;color:#94a3b8}

/* ── 3-color accent system ──
   --violet : primary / neutral metrics (platform fees, totals)
   --emerald: positive / inflow / profit metrics
   --rose   : charges / withdrawals / outflow metrics
   each sets: --accent (badge text), --accent-tint (badge bg),
              --accent-grad (icon chip gradient),
              --glow (card shadow + icon shadow tint)
*/
.c-indigo{
  --accent:#6d28d9; --accent-tint:#f3eeff;
  --accent-grad:linear-gradient(135deg,#a78bfa,#7c3aed);
  --glow:rgba(124,58,237,.22);
}
.c-emerald{
  --accent:#059669; --accent-tint:#ecfdf5;
  --accent-grad:linear-gradient(135deg,#34d399,#059669);
  --glow:rgba(16,185,129,.22);
}
.c-rose{
  --accent:#e11d48; --accent-tint:#fff1f2;
  --accent-grad:linear-gradient(135deg,#fb7185,#e11d48);
  --glow:rgba(225,29,72,.22);
}

/* legacy badge classes kept for non-stat-card use elsewhere in the page */
.badge-blue{background:#dbeafe;color:#1d4ed8}
.badge-green{background:#dcfce7;color:#15803d}
.badge-amber{background:#fef9c3;color:#854d0e}
.badge-purple{background:#f3e8ff;color:#7e22ce}
.badge-rose{background:#ffe4e6;color:#be123c}
.badge-teal{background:#ccfbf1;color:#0f766e}
.badge-indigo{background:#f3eeff;color:#6d28d9}
.badge-orange{background:#ffedd5;color:#c2410c}
.badge-cyan{background:#cffafe;color:#0e7490}
.badge-lime{background:#ecfccb;color:#4d7c0f}

/* ── REST ── */
.card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px;margin-bottom:14px;box-shadow:0 1px 2px rgba(15,23,42,.04), 0 1px 1px rgba(15,23,42,.02), 0 10px 24px -10px rgba(124,58,237,.16)}
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

@media(max-width:1200px){.stats{grid-template-columns:repeat(4,1fr)}}
@media(max-width:1024px){.stats{grid-template-columns:repeat(3,1fr)}}
@media(max-width:768px){.stats{grid-template-columns:repeat(2,1fr)}}
@media(max-width:640px){
  .sidebar{position:fixed;top:52px;left:0;height:calc(100% - 52px);z-index:50;transform:translateX(-100%);transition:transform .25s ease;min-width:200px;width:200px}
  .sidebar.mob-open{transform:translateX(0)}
  .overlay.show{display:block}
  .stats{grid-template-columns:repeat(2,1fr);gap:10px}
  .tb-search{display:none}
}
@media(max-width:380px){
  .stats{gap:8px}
  .sc{padding:12px 10px}
  .sc-val{font-size:18px}
}
@media(min-width:641px){
  .hbtn{display:none}
  .overlay{display:none!important}
}
</style>
</head>
<body>
<div class="app">

  {{-- TOP BAR --}}
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
      <div class="notif">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 1.5a5 5 0 0 1 5 5v2l1 2H2l1-2v-2a5 5 0 0 1 5-5Z"/><path d="M6.5 13.5a1.5 1.5 0 0 0 3 0"/></svg>
        <div class="ndot"></div>
      </div>
      <div class="ava">AD</div>
    </div>
  </div>

  <div class="body">
    <div class="overlay" id="overlay" onclick="closeSB()"></div>

    {{-- SIDEBAR --}}
    @include('admin.layouts.sidebar')

    {{-- MAIN CONTENT --}}
    <main class="main">

      {{-- PAGE HEADER --}}
      <div class="pg-head">
        <div>
          <div class="pg-title" id="pg-title">Dashboard</div>
          <div class="pg-sub">Welcome back · Last updated {{ now()->format('h:i A') }}</div>
        </div>
        <div class="pills">
          <!--<span class="pill on" onclick="setPill(this)">7d</span>-->
          <!--<span class="pill" onclick="setPill(this)">30d</span>-->
          <!--<span class="pill" onclick="setPill(this)">90d</span>-->
        </div>
      </div>

      {{-- ══ DAILY SECTION (rolling last 24 hours) ══ --}}
      <div class="sec-h">
        <span class="sec-t">Daily Overview</span>
        <span class="sec-d"></span>
        <span class="sec-tag badge-green">Last 24h</span>
      </div>

      <div class="stats">

        {{-- 1. Deposit (today) --}}
        <div class="sc c-emerald">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 3v8M5 8l3 3 3-3"/>
                <rect x="2" y="12" width="12" height="2" rx="1"/>
              </svg>
            </div>
            <span class="sc-badge">24h</span>
          </div>
          <div>
            <div class="sc-lbl">Deposit</div>
            <div class="sc-val">${{ number_format($data['deposit_today'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Total deposits (last 24 hours)</div>
        </div>

        {{-- 2. Withdraw (today) --}}
        <div class="sc c-rose">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 13V5M5 8l3-3 3 3"/>
                <rect x="2" y="2" width="12" height="2" rx="1"/>
              </svg>
            </div>
            <span class="sc-badge">24h</span>
          </div>
          <div>
            <div class="sc-lbl">Withdraw</div>
            <div class="sc-val">${{ number_format($data['withdraw_today'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Total withdrawals (last 24 hours)</div>
        </div>

        {{-- 3. Withdraw Charge (today) --}}
        <div class="sc c-rose">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="5.5"/>
                <path d="M8 5.5v1.8l1.5 1.5"/>
                <path d="M5.5 10.5h5"/>
              </svg>
            </div>
            <span class="sc-badge">24h</span>
          </div>
          <div>
            <div class="sc-lbl">Withdraw Charge</div>
            <div class="sc-val">${{ number_format($data['withdraw_charge_today'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from withdrawals (last 24 hours)</div>
        </div>

        {{-- 4. Job Post Charge (today) --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M13 8V5a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h4"/>
                <path d="M11 10h4M13 8v4"/>
              </svg>
            </div>
            <span class="sc-badge">24h</span>
          </div>
          <div>
            <div class="sc-lbl">Job Post Charge</div>
            <div class="sc-val">${{ number_format($data['jobpost_charge_today'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from job posts (last 24 hours)</div>
        </div>

        {{-- 5. Top Job Charge (today) --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1.5 9.7 5.2l4 .4-3 2.7.9 4-3.6-2-3.6 2 .9-4-3-2.7 4-.4Z"/>
              </svg>
            </div>
            <span class="sc-badge">24h</span>
          </div>
          <div>
            <div class="sc-lbl">Top Job Charge</div>
            <div class="sc-val">${{ number_format($data['top_job_charge_today'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from top job placements (last 24 hours)</div>
        </div>

        {{-- 6. Boost Job Charge (today) --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1.5c1.5 2 2 4 2 5.5a2 2 0 1 1-4 0c0-1.5.5-3.5 2-5.5Z"/>
                <path d="M5.2 9.8C4 11 3.5 12.3 4 13.5c.6 1.3 2.2 2 4 2s3.4-.7 4-2c.5-1.2 0-2.5-1.2-3.7"/>
              </svg>
            </div>
            <span class="sc-badge">24h</span>
          </div>
          <div>
            <div class="sc-lbl">Boost Job Charge</div>
            <div class="sc-val">${{ number_format($data['boost_job_charge_today'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from job boosts (last 24 hours)</div>
        </div>

        {{-- 7. Profit (today) --}}
        <div class="sc c-emerald">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1v2M8 13v2M1 8h2M13 8h2"/>
                <circle cx="8" cy="8" r="3.5"/>
              </svg>
            </div>
            <span class="sc-badge">24h</span>
          </div>
          <div>
            <div class="sc-lbl">Profit</div>
            <div class="sc-val">${{ number_format($data['profit_today'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Net earnings (last 24 hours)</div>
        </div>

      </div>
      {{-- ══ END DAILY SECTION ══ --}}


      {{-- ══ MONTHLY SECTION (rolling last 30 days) ══ --}}
      <div class="sec-h">
        <span class="sec-t">Monthly Overview</span>
        <span class="sec-d"></span>
        <span class="sec-tag badge-indigo">Last 30 Days</span>
      </div>

      <div class="stats">

        {{-- 1. Deposit (30d) --}}
        <div class="sc c-emerald">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 3v8M5 8l3 3 3-3"/>
                <rect x="2" y="12" width="12" height="2" rx="1"/>
              </svg>
            </div>
            <span class="sc-badge">30 Days</span>
          </div>
          <div>
            <div class="sc-lbl">Deposit</div>
            <div class="sc-val">${{ number_format($data['deposit_30d'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Total deposits (last 30 days)</div>
        </div>

        {{-- 2. Withdraw (30d) --}}
        <div class="sc c-rose">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 13V5M5 8l3-3 3 3"/>
                <rect x="2" y="2" width="12" height="2" rx="1"/>
              </svg>
            </div>
            <span class="sc-badge">30 Days</span>
          </div>
          <div>
            <div class="sc-lbl">Withdraw</div>
            <div class="sc-val">${{ number_format($data['withdraw_30d'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Total withdrawals (last 30 days)</div>
        </div>

        {{-- 3. Withdraw Charge (30d) --}}
        <div class="sc c-rose">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="5.5"/>
                <path d="M8 5.5v1.8l1.5 1.5"/>
                <path d="M5.5 10.5h5"/>
              </svg>
            </div>
            <span class="sc-badge">30 Days</span>
          </div>
          <div>
            <div class="sc-lbl">Withdraw Charge</div>
            <div class="sc-val">${{ number_format($data['withdraw_charge_30d'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from withdrawals (30 days)</div>
        </div>

        {{-- 4. Job Post Charge (30d) --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M13 8V5a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h4"/>
                <path d="M11 10h4M13 8v4"/>
              </svg>
            </div>
            <span class="sc-badge">30 Days</span>
          </div>
          <div>
            <div class="sc-lbl">Job Post Charge</div>
            <div class="sc-val">${{ number_format($data['jobpost_charge_30d'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from job posts (30 days)</div>
        </div>

        {{-- 5. Top Job Charge (30d) --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1.5 9.7 5.2l4 .4-3 2.7.9 4-3.6-2-3.6 2 .9-4-3-2.7 4-.4Z"/>
              </svg>
            </div>
            <span class="sc-badge">30 Days</span>
          </div>
          <div>
            <div class="sc-lbl">Top Job Charge</div>
            <div class="sc-val">${{ number_format($data['top_job_charge_30d'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from top job placements (30 days)</div>
        </div>

        {{-- 6. Boost Job Charge (30d) --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1.5c1.5 2 2 4 2 5.5a2 2 0 1 1-4 0c0-1.5.5-3.5 2-5.5Z"/>
                <path d="M5.2 9.8C4 11 3.5 12.3 4 13.5c.6 1.3 2.2 2 4 2s3.4-.7 4-2c.5-1.2 0-2.5-1.2-3.7"/>
              </svg>
            </div>
            <span class="sc-badge">30 Days</span>
          </div>
          <div>
            <div class="sc-lbl">Boost Job Charge</div>
            <div class="sc-val">${{ number_format($data['boost_job_charge_30d'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from job boosts (30 days)</div>
        </div>

        {{-- 7. Profit (30d) --}}
        <div class="sc c-emerald">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1v2M8 13v2M1 8h2M13 8h2"/>
                <circle cx="8" cy="8" r="3.5"/>
              </svg>
            </div>
            <span class="sc-badge">30 Days</span>
          </div>
          <div>
            <div class="sc-lbl">Profit</div>
            <div class="sc-val">${{ number_format($data['profit_30d'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Net earnings (30 days)</div>
        </div>

      </div>
      {{-- ══ END MONTHLY SECTION ══ --}}


      {{-- ══ LIFETIME SECTION ══ --}}
      <div class="sec-h">
        <span class="sec-t">Lifetime Overview</span>
        <span class="sec-d"></span>
        <span class="sec-tag badge-indigo">All time</span>
      </div>

      <div class="stats">
        {{-- 1. Total Users --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                <path d="M2 14a6 6 0 0 1 12 0"/>
              </svg>
            </div>
            <span class="sc-badge">Users</span>
          </div>
          <div>
            <div class="sc-lbl">Total Users</div>
            <div class="sc-val">{{ $data['total_user'] }}</div>
          </div>
          <div class="sc-foot">Registered accounts</div>
        </div>

        {{-- 2. Total Posted Jobs --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <rect x="2" y="4" width="12" height="9" rx="1.5"/>
                <path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/>
              </svg>
            </div>
            <span class="sc-badge">Jobs</span>
          </div>
          <div>
            <div class="sc-lbl">Total Posted Jobs</div>
            <div class="sc-val">{{ $data['total_posted_job'] }}</div>
          </div>
          <div class="sc-foot">Posted by buyers</div>
        </div>

        {{-- 3. Total Submitted Jobs --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M2 8h12M2 4h12M2 12h7"/>
                <path d="m10 10 2 2 3-3"/>
              </svg>
            </div>
            <span class="sc-badge">Submitted</span>
          </div>
          <div>
            <div class="sc-lbl">Total Submitted Proof</div>
            <div class="sc-val">{{ $data['total_submit_job'] }}</div>
          </div>
          <div class="sc-foot">Deliveries submitted</div>
        </div>

        {{-- 4. Lifetime Profit --}}
        <div class="sc c-emerald">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1v2M8 13v2M1 8h2M13 8h2"/>
                <circle cx="8" cy="8" r="3.5"/>
              </svg>
            </div>
            <span class="sc-badge">Profit</span>
          </div>
          <div>
            <div class="sc-lbl">Lifetime Profit</div>
            <div class="sc-val">${{ number_format($data['profit_lifetime'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Platform earnings</div>
        </div>

        {{-- 5. Lifetime Deposit --}}
        <div class="sc c-emerald">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 3v8M5 8l3 3 3-3"/>
                <rect x="2" y="12" width="12" height="2" rx="1"/>
              </svg>
            </div>
            <span class="sc-badge">Deposit</span>
          </div>
          <div>
            <div class="sc-lbl">Lifetime Deposit</div>
            <div class="sc-val">${{ number_format($data['lifetime_deposit'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Total funds deposited</div>
        </div>

        {{-- 6. Lifetime Withdraw --}}
        <div class="sc c-rose">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 13V5M5 8l3-3 3 3"/>
                <rect x="2" y="2" width="12" height="2" rx="1"/>
              </svg>
            </div>
            <span class="sc-badge">Withdraw</span>
          </div>
          <div>
            <div class="sc-lbl">Lifetime Withdraw</div>
            <div class="sc-val">${{ number_format($data['lifetime_withdraw'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Total funds withdrawn</div>
        </div>

        {{-- 7. Withdraw Charge --}}
        <div class="sc c-rose">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="5.5"/>
                <path d="M8 5.5v1.8l1.5 1.5"/>
                <path d="M5.5 10.5h5"/>
              </svg>
            </div>
            <span class="sc-badge">Charge</span>
          </div>
          <div>
            <div class="sc-lbl">Withdraw Charge</div>
            <div class="sc-val">${{ number_format($data['withdraw_charge'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from withdrawals (lifetime)</div>
        </div>

        {{-- 8. Job Post Charge --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M13 8V5a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h4"/>
                <path d="M11 10h4M13 8v4"/>
              </svg>
            </div>
            <span class="sc-badge">Post Fee</span>
          </div>
          <div>
            <div class="sc-lbl">Job Post Charge</div>
            <div class="sc-val">${{ number_format($data['jobpost_charge'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from job posts (lifetime)</div>
        </div>

        {{-- 9. Top Job Charge (lifetime) --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1.5 9.7 5.2l4 .4-3 2.7.9 4-3.6-2-3.6 2 .9-4-3-2.7 4-.4Z"/>
              </svg>
            </div>
            <span class="sc-badge">Top Job</span>
          </div>
          <div>
            <div class="sc-lbl">Top Job Charge</div>
            <div class="sc-val">${{ number_format($data['top_job_charge'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from top job placements (lifetime)</div>
        </div>

        {{-- 10. Boost Job Charge (lifetime) --}}
        <div class="sc c-indigo">
          <div class="sc-top">
            <div class="sc-icon">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1.5c1.5 2 2 4 2 5.5a2 2 0 1 1-4 0c0-1.5.5-3.5 2-5.5Z"/>
                <path d="M5.2 9.8C4 11 3.5 12.3 4 13.5c.6 1.3 2.2 2 4 2s3.4-.7 4-2c.5-1.2 0-2.5-1.2-3.7"/>
              </svg>
            </div>
            <span class="sc-badge">Boost Job</span>
          </div>
          <div>
            <div class="sc-lbl">Boost Job Charge</div>
            <div class="sc-val">${{ number_format($data['boost_job_charge'] ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from job boosts (lifetime)</div>
        </div>

      </div>
      {{-- ══ END LIFETIME SECTION ══ --}}


      {{-- REVENUE CHART --}}
      <div class="card">
        <div class="card-h">
          <div>
            <div class="card-t">Revenue — this week</div>
            <div class="card-s">Daily earnings</div>
          </div>
        </div>
        <svg id="rchart" viewBox="0 0 340 90" preserveAspectRatio="none" style="width:100%;height:80px;display:block"></svg>
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
</script>
</body>
</html>