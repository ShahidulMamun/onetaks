<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

   @include('admin.layouts.sidebar')

    <main class="main">
      <div class="row"> 
         <div class="col-md-12">
               <div class="card shadow-sm border-0 rounded-3 mt-3">
                   <div class="card-body">{{$pageTitle}}
                   <table class="table table-striped  table-responsive">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>TranxID</th>
                        <th>Payment Number</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php $i=1; ?>
                     @foreach($deposits as $deposit)
                      
                      <tr>
                        <td> <?php echo $i++ ?></td>
                        <td><a href="">{{ $deposit->user->name}}</a></td>
                        <td><strong class="text-success">${{ $deposit->amount}}</strong></td>
                        <td>{{ $deposit->transaction_id}}</td>
                        <td>{{ $deposit->sender_number}}</td>
            
                        <td>
                          @if($deposit->status=="pending")
                           <strong class="badge badge-dark mt-2">Pending</strong>
                          @elseif($deposit->status=="approved")
                           <strong class="badge badge-success mt-2">Approved</strong>
                          @elseif($deposit->status=="rejected")
                           <strong class="badge badge-danger mt-2">Rejected</strong>
                          @endif

                        </td>
                    

                          <td>{{$deposit->created_at->format('d M Y, h:i A')}}</td>
                        
                        <td>
                         @if($deposit->status=="pending")
                        <a href="{{route('admin.user-delete',$deposit->id)}}"
                           onclick="return confirm('Are you sure to delete user?')">
                           <button class="btn btn-sm btn-danger">Reject</button>
                        </a>

                        <a href="{{route('admin.user-delete',$deposit->id)}}"
                           onclick="return confirm('Are you sure to delete user?')">
                           <button class="btn btn-sm btn-success">Approve</button>
                        </a>
                          @elseif($deposit->status=="approved")
                          <strong class="badge badge-success mt-2">
                          Approved {{ $deposit->approved_at->format('d M Y, h:i A')}}
                        </strong>
                          @elseif($deposit->status=="rejected")
                           <strong class="badge badge-danger mt-2">
                             Rejected {{ $deposit->updated_at->format('d M Y, h:i A')}}
                           </strong>
                          @endif

                        
                        

  
                        </td>
                      </tr>
                    @endforeach
                     
                    </tbody>
                  </table>
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

<!-- script for edit modal open and data set -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  
  $(document).on('click', '.editBtn', function () {

    let id = $(this).data('id');
    $('#edit_id').val(id);
   
    $('#edit_status').val($(this).data('status'));

    $('#editModal').modal('show');
});
</script>

