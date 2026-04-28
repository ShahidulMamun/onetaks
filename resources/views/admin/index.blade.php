
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

    <nav class="sidebar" id="sidebar">
      <div style="padding:10px 8px 6px">
        <div style="padding:8px 10px;background:#eff6ff;border-radius:10px;display:flex;align-items:center;gap:8px">
          <div style="width:28px;height:28px;border-radius:7px;background:#2563eb;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="#fff" stroke-width="1.8"><rect x="2" y="2" width="5" height="5" rx="1.5"/><rect x="9" y="2" width="5" height="5" rx="1.5"/><rect x="2" y="9" width="5" height="5" rx="1.5"/><rect x="9" y="9" width="5" height="5" rx="1.5"/></svg>
          </div>
          <div><div style="font-size:11px;font-weight:600;color:#1d4ed8">Admin Panel</div><div style="font-size:10px;color:#3b82f6">Super Admin</div></div>
        </div>
      </div>

      <div class="sec-label">Overview</div>
      <div class="ni on" onclick="navClick(this,'Dashboard')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="2" width="5" height="5" rx="1.5"/><rect x="9" y="2" width="5" height="5" rx="1.5"/><rect x="2" y="9" width="5" height="5" rx="1.5"/><rect x="9" y="9" width="5" height="5" rx="1.5"/></svg>
        Dashboard
      </div>
      <div class="ni" onclick="navClick(this,'Users')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M2 14a6 6 0 0 1 12 0"/></svg>
        Users <span class="nbadge red">2.4k</span>
      </div>
      <div class="ni" onclick="navClick(this,'Job Listings')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="12" height="9" rx="1.5"/><path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/></svg>
        Job Listings <span class="nbadge amber">12</span>
      </div>
      <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        Orders
      </div>

       <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        <a href="{{route('admin.continent')}}">Continent</a>
      </div>

      <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        <a href="{{route('admin.country')}}" class="link">Country</a>
      </div>

        <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        <a href="{{route('admin.category')}}" class="link">Category</a>
      </div>

        <div class="ni" onclick="navClick(this,'Orders')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
        <a href="{{route('admin.subcategory')}}" class="link">Sub Category</a>
      </div>


      <div class="sec-label">Management</div>
      <div class="ni" onclick="navClick(this,'Disputes')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="5.5"/><path d="M8 5v3l2 2"/></svg>
        Disputes <span class="nbadge red">5</span>
      </div>
      <div class="ni" onclick="navClick(this,'Categories')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 2h5v5H2zM9 2h5v5H9zM2 9h5v5H2zM9 9h5v5H9z"/></svg>
        Categories
      </div>
      <div class="ni" onclick="navClick(this,'Reviews')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 2l1.7 3.4 3.8.5-2.7 2.7.6 3.8L8 10.6l-3.4 1.8.6-3.8L2.5 5.9l3.8-.5z"/></svg>
        Reviews
      </div>
      <div class="ni" onclick="navClick(this,'Payments')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="1.5" y="4" width="13" height="9" rx="1.5"/><path d="M1.5 7h13"/></svg>
        Payments
      </div>

      <div class="sec-label">Analytics</div>
      <div class="ni" onclick="navClick(this,'Reports')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12l4-4 3 3 5-6"/></svg>
        Reports
      </div>
      <div class="ni" onclick="navClick(this,'Fraud Detection')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 1.5L2 4v5c0 3 2.7 5.5 6 6.5 3.3-1 6-3.5 6-6.5V4l-6-2.5z"/></svg>
        Fraud Detection
      </div>

      <div class="sec-label">System</div>
      <div class="ni" onclick="navClick(this,'Settings')">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="2.5"/><path d="M8 2v1.5M8 12.5V14M2 8h1.5M12.5 8H14M3.6 3.6l1 1M11.4 11.4l1 1M3.6 12.4l1-1M11.4 4.6l1-1"/></svg>
        Settings
      </div>

      <div class="sb-bottom">
        <div class="ni" style="color:#dc2626">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M6 2H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3M10 11l3-3-3-3M13 8H6"/></svg>
            <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
              Logout
          </button>
          </form>
           
        </div>
      </div>
    </nav>

    <main class="main">
      <div class="pg-head">
        <div>
          <div class="pg-title" id="pg-title">Dashboard</div>
          <div class="pg-sub">Welcome back · Last updated 2 min ago</div>
        </div>
        <div class="pills">
          <span class="pill on" onclick="setPill(this)">7d</span>
          <span class="pill" onclick="setPill(this)">30d</span>
          <span class="pill" onclick="setPill(this)">90d</span>
        </div>
      </div>

      <div class="stats">
        <div class="sc"><div class="ic" style="background:#eff6ff"><svg viewBox="0 0 16 16" fill="none" stroke="#2563eb" stroke-width="1.8"><path d="M8 1v2M8 13v2M1 8h2M13 8h2"/><circle cx="8" cy="8" r="3.5"/></svg></div><div class="lbl">Revenue</div><div class="val">$84.2k</div><div class="dl up">▲ +12.4%</div></div>
        <div class="sc"><div class="ic" style="background:#f0fdf4"><svg viewBox="0 0 16 16" fill="none" stroke="#16a34a" stroke-width="1.8"><rect x="2" y="4" width="12" height="9" rx="1.5"/><path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/></svg></div><div class="lbl">Active Jobs</div><div class="val">1,382</div><div class="dl up">▲ +8.1%</div></div>
        <div class="sc"><div class="ic" style="background:#fef3c7"><svg viewBox="0 0 16 16" fill="none" stroke="#d97706" stroke-width="1.8"><circle cx="8" cy="8" r="5.5"/><path d="M8 5v3l2 2"/></svg></div><div class="lbl">Pending</div><div class="val">247</div><div class="dl dn">▼ action needed</div></div>
        <div class="sc"><div class="ic" style="background:#fdf4ff"><svg viewBox="0 0 16 16" fill="none" stroke="#9333ea" stroke-width="1.8"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M2 14a6 6 0 0 1 12 0"/></svg></div><div class="lbl">New Users</div><div class="val">3,841</div><div class="dl up">▲ +19.7%</div></div>
        <div class="sc"><div class="ic" style="background:#fff1f2"><svg viewBox="0 0 16 16" fill="none" stroke="#e11d48" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M8 5v2.5M8 9.5h.01"/></svg></div><div class="lbl">Disputes</div><div class="val">19</div><div class="dl dn">▼ -2 today</div></div>
        <div class="sc"><div class="ic" style="background:#ecfdf5"><svg viewBox="0 0 16 16" fill="none" stroke="#059669" stroke-width="1.8"><path d="M3 8l3 3 7-7"/></svg></div><div class="lbl">Avg Value</div><div class="val">$61.40</div><div class="dl up">▲ +$4.20</div></div>
      </div>

      <div class="card">
        <div class="card-h">
          <div><div class="card-t">Revenue — this week</div><div class="card-s">Daily earnings</div></div>
        </div>
        <svg id="rchart" viewBox="0 0 340 90" preserveAspectRatio="none" style="width:100%;height:80px;display:block"></svg>
      </div>

      <div class="card">
        <div class="card-h">
          <div><div class="card-t">Recent Orders</div></div>
          <span class="pill">View all</span>
        </div>
        <div style="overflow-x:auto">
          <table>
            <thead><tr><th style="width:28%">Buyer</th><th style="width:30%">Service</th><th style="width:18%">Amt</th><th style="width:24%">Status</th></tr></thead>
            <tbody id="otb"></tbody>
          </table>
        </div>
      </div>

      <div class="card">
        <div class="card-h"><div><div class="card-t">Activity Feed</div><div class="card-s">Real-time events</div></div></div>
        <div id="afeed"></div>
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
