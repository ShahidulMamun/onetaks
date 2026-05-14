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

/* ── STAT CARDS ── */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:16px}
.sc{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:14px 16px;display:flex;flex-direction:column;gap:10px}
.sc-top{display:flex;align-items:center;justify-content:space-between}
.sc-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sc-icon svg{width:17px;height:17px}
.sc-badge{font-size:10px;font-weight:600;padding:3px 8px;border-radius:20px}
.sc-lbl{font-size:11px;color:#64748b;font-weight:500;letter-spacing:.2px}
.sc-val{font-size:22px;font-weight:700;color:#0f172a;letter-spacing:-.5px;line-height:1}
.sc-foot{font-size:11px;color:#94a3b8}

/* color variants */
.ic-blue{background:#eff6ff} .ic-blue svg{stroke:#2563eb}
.ic-green{background:#f0fdf4} .ic-green svg{stroke:#16a34a}
.ic-amber{background:#fef3c7} .ic-amber svg{stroke:#d97706}
.ic-purple{background:#fdf4ff} .ic-purple svg{stroke:#9333ea}
.ic-rose{background:#fff1f2} .ic-rose svg{stroke:#e11d48}
.ic-teal{background:#f0fdfa} .ic-teal svg{stroke:#0d9488}
.ic-indigo{background:#eef2ff} .ic-indigo svg{stroke:#4f46e5}
.ic-orange{background:#fff7ed} .ic-orange svg{stroke:#ea580c}

.badge-blue{background:#dbeafe;color:#1d4ed8}
.badge-green{background:#dcfce7;color:#15803d}
.badge-amber{background:#fef9c3;color:#854d0e}
.badge-purple{background:#f3e8ff;color:#7e22ce}
.badge-rose{background:#ffe4e6;color:#be123c}
.badge-teal{background:#ccfbf1;color:#0f766e}
.badge-indigo{background:#e0e7ff;color:#3730a3}
.badge-orange{background:#ffedd5;color:#c2410c}

/* ── REST ── */
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

@media(max-width:1024px){.stats{grid-template-columns:repeat(2,1fr)}}
@media(max-width:640px){
  .sidebar{position:fixed;top:52px;left:0;height:calc(100% - 52px);z-index:50;transform:translateX(-100%);transition:transform .25s ease;min-width:200px;width:200px}
  .sidebar.mob-open{transform:translateX(0)}
  .overlay.show{display:block}
  .stats{grid-template-columns:repeat(1,1fr)}
  .tb-search{display:none}
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
          <span class="pill on" onclick="setPill(this)">7d</span>
          <span class="pill" onclick="setPill(this)">30d</span>
          <span class="pill" onclick="setPill(this)">90d</span>
        </div>
      </div>

      {{-- ══ 8 STAT CARDS ══ --}}
      <div class="stats">

        {{-- 1. Total Users --}}
        <div class="sc">
          <div class="sc-top">
            <div class="sc-icon ic-blue">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                <path d="M2 14a6 6 0 0 1 12 0"/>
              </svg>
            </div>
            <span class="sc-badge badge-blue">Users</span>
          </div>
          <div>
            <div class="sc-lbl">Total Users</div>
            <div class="sc-val">{{$data['total_user']}}</div>
          </div>
          <div class="sc-foot">Registered accounts</div>
        </div>

        {{-- 2. Total Posted Jobs --}}
        <div class="sc">
          <div class="sc-top">
            <div class="sc-icon ic-purple">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <rect x="2" y="4" width="12" height="9" rx="1.5"/>
                <path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/>
              </svg>
            </div>
            <span class="sc-badge badge-purple">Jobs</span>
          </div>
          <div>
            <div class="sc-lbl">Total Posted Jobs</div>
            <div class="sc-val">{{ $data['total_posted_job'] }}</div>
          </div>
          <div class="sc-foot">Posted by buyers</div>
        </div>

        {{-- 3. Total Submitted Jobs --}}
        <div class="sc">
          <div class="sc-top">
            <div class="sc-icon ic-teal">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M2 8h12M2 4h12M2 12h7"/>
                <path d="m10 10 2 2 3-3"/>
              </svg>
            </div>
            <span class="sc-badge badge-teal">Submitted</span>
          </div>
          <div>
            <div class="sc-lbl">Total Submitted Proof</div>
            <div class="sc-val">{{ $data['total_submit_job'] }}</div>
          </div>
          <div class="sc-foot">Deliveries submitted</div>
        </div>

        {{-- 4. Lifetime Profit --}}
        <div class="sc">
          <div class="sc-top">
            <div class="sc-icon ic-green">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 1v2M8 13v2M1 8h2M13 8h2"/>
                <circle cx="8" cy="8" r="3.5"/>
              </svg>
            </div>
            <span class="sc-badge badge-green">Profit</span>
          </div>
          <div>
            <div class="sc-lbl">Lifetime Profit</div>
            <div class="sc-val">${{ number_format($lifetime_profit ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Platform earnings</div>
        </div>

        {{-- 5. Lifetime Deposit --}}
        <div class="sc">
          <div class="sc-top">
            <div class="sc-icon ic-indigo">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 3v8M5 8l3 3 3-3"/>
                <rect x="2" y="12" width="12" height="2" rx="1"/>
              </svg>
            </div>
            <span class="sc-badge badge-indigo">Deposit</span>
          </div>
          <div>
            <div class="sc-lbl">Lifetime Deposit</div>
            <div class="sc-val">${{ number_format($siteWallet->lifetime_deposit ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Total funds deposited</div>
        </div>

        {{-- 6. Lifetime Withdraw --}}
        <div class="sc">
          <div class="sc-top">
            <div class="sc-icon ic-amber">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M8 13V5M5 8l3-3 3 3"/>
                <rect x="2" y="2" width="12" height="2" rx="1"/>
              </svg>
            </div>
            <span class="sc-badge badge-amber">Withdraw</span>
          </div>
          <div>
            <div class="sc-lbl">Lifetime Withdraw</div>
            <div class="sc-val">${{ number_format($siteWallet->lifetime_withdraw ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Total funds withdrawn</div>
        </div>

        {{-- 7. Withdraw Charge --}}
        <div class="sc">
          <div class="sc-top">
            <div class="sc-icon ic-rose">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="5.5"/>
                <path d="M8 5.5v1.8l1.5 1.5"/>
                <path d="M5.5 10.5h5"/>
              </svg>
            </div>
            <span class="sc-badge badge-rose">Charge</span>
          </div>
          <div>
            <div class="sc-lbl">Withdraw Charge</div>
            <div class="sc-val">${{ number_format($withdraw_charge ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from withdrawals</div>
        </div>

        {{-- 8. Job Post Charge --}}
        <div class="sc">
          <div class="sc-top">
            <div class="sc-icon ic-orange">
              <svg fill="none" stroke-width="1.8" viewBox="0 0 16 16">
                <path d="M13 8V5a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h4"/>
                <path d="M11 10h4M13 8v4"/>
              </svg>
            </div>
            <span class="sc-badge badge-orange">Post Fee</span>
          </div>
          <div>
            <div class="sc-lbl">Job Post Charge</div>
            <div class="sc-val">${{ number_format($jobpost_charge ?? 0, 2) }}</div>
          </div>
          <div class="sc-foot">Fees from job posts</div>
        </div>

      </div>
      {{-- ══ END STAT CARDS ══ --}}

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