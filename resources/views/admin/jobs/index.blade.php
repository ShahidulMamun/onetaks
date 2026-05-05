{{-- resources/views/admin/jobs/index.blade.php --}}

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
.main{flex:1;overflow-y:auto;padding:20px;min-width:0}
.tag{display:inline-block;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;letter-spacing:.3px}
.tg{background:#dcfce7;color:#15803d}
.ta{background:#fef9c3;color:#854d0e}
.tr{background:#fee2e2;color:#991b1b}
.tb{background:#dbeafe;color:#1d4ed8}
.tpurple{background:#f3e8ff;color:#7e22ce}

/* Page header */
.pg-head{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:18px}
.pg-title{font-size:18px;font-weight:700;letter-spacing:-.4px}
.pg-sub{font-size:12px;color:#64748b;margin-top:2px}

/* Stats row */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:18px}
.sc{background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px 16px;display:flex;align-items:center;gap:12px}
.sc-ico{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sc-ico svg{width:17px;height:17px}
.sc-lbl{font-size:11px;color:#64748b;margin-bottom:2px}
.sc-val{font-size:20px;font-weight:700;letter-spacing:-.5px;line-height:1}

/* Filter bar */
.filter-bar{display:flex;align-items:center;gap:8px;margin-bottom:14px;flex-wrap:wrap}
.filter-bar input{padding:6px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:12px;outline:none;background:#fff;width:200px}
.filter-bar input:focus{border-color:#2563eb}
.filter-bar select{padding:6px 10px;border:1px solid #e2e8f0;border-radius:8px;font-size:12px;outline:none;background:#fff;color:#0f172a;cursor:pointer}
.filter-bar select:focus{border-color:#2563eb}
.filter-bar label{font-size:12px;color:#64748b;font-weight:500}

/* Table card */
.tcard{background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden}
.tcard-head{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-bottom:1px solid #f1f5f9}
.tcard-title{font-size:14px;font-weight:600}
.tcard-count{font-size:12px;color:#64748b}

table{width:100%;border-collapse:collapse;font-size:12.5px}
thead th{padding:10px 14px;text-align:left;font-size:10.5px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;background:#fafafa;border-bottom:1px solid #f1f5f9}
tbody td{padding:11px 14px;border-bottom:1px solid #f8fafc;vertical-align:middle}
tbody tr:last-child td{border-bottom:none}
tbody tr:hover{background:#fafafe}

.thumb-img{width:64px;height:36px;border-radius:6px;object-fit:cover;border:1px solid #e2e8f0}
.thumb-placeholder{width:64px;height:36px;border-radius:6px;background:#f1f5f9;display:flex;align-items:center;justify-content:center}

.job-title{font-weight:500;color:#0f172a;max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block}
.job-code{font-size:10px;color:#94a3b8;margin-top:1px}

.earn-badge{font-weight:600;color:#16a34a}
.budget-badge{font-weight:600;color:#2563eb}

/* Worker progress */
.worker-prog{display:flex;flex-direction:column;gap:3px;min-width:90px}
.worker-bar-bg{height:4px;background:#f1f5f9;border-radius:4px;overflow:hidden}
.worker-bar-fill{height:100%;background:#2563eb;border-radius:4px;transition:width .3s}
.worker-nums{font-size:10px;color:#64748b}

/* Action buttons */
.act-btns{display:flex;gap:5px;flex-wrap:wrap}
.abtn{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:7px;font-size:11px;font-weight:500;border:none;cursor:pointer;text-decoration:none;transition:opacity .15s}
.abtn:hover{opacity:.85;text-decoration:none}
.abtn-info{background:#eff6ff;color:#2563eb}
.abtn-success{background:#f0fdf4;color:#16a34a}
.abtn-danger{background:#fff1f2;color:#e11d48}
.abtn svg{width:11px;height:11px}

/* Top badge */
.top-crown{display:inline-flex;align-items:center;gap:3px;padding:2px 7px;border-radius:20px;font-size:10px;font-weight:600;background:#fef3c7;color:#92400e}

/* Pagination */
.pg-wrap{padding:12px 18px;border-top:1px solid #f1f5f9;display:flex;justify-content:flex-end}

@media(max-width:900px){.stats-row{grid-template-columns:repeat(2,1fr)}}
@media(max-width:640px){
  .sidebar{position:fixed;top:52px;left:0;height:calc(100% - 52px);z-index:50;transform:translateX(-100%);transition:transform .25s ease;min-width:200px;width:200px}
  .sidebar.mob-open{transform:translateX(0)}
  .overlay.show{display:block}
  .stats-row{grid-template-columns:repeat(2,1fr)}
  .tb-search{display:none}
  table{font-size:11px}
  thead th,tbody td{padding:8px 10px}
}
@media(min-width:641px){.hbtn{display:none}.overlay{display:none!important}}
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

      <!-- Page header -->
      <div class="pg-head">
        <div>
          <div class="pg-title">{{ $pageTitle ?? 'All Jobs' }}</div>
          <div class="pg-sub">Manage and review all posted jobs</div>
        </div>
      </div>

      <!-- Flash messages -->
      @if(session()->has('success'))
        <div class="alert alert-success mb-3" style="border-radius:10px;font-size:13px">
          <strong>✓</strong> {{ session('success') }}
        </div>
      @endif
      @if(session()->has('error'))
        <div class="alert alert-danger mb-3" style="border-radius:10px;font-size:13px">
          <strong>✕</strong> {{ session('error') }}
        </div>
      @endif

      <!-- Stats Row -->
      @php
        $totalJobs    = $jobs->total() ?? count($jobs);
        $pendingCount = $jobs->where('status','pending')->count();
        $activeCount  = $jobs->where('status','active')->count();
        $topCount     = $jobs->where('is_top',1)->count();
      @endphp
      <div class="stats-row">
        <div class="sc">
          <div class="sc-ico" style="background:#eff6ff">
            <svg viewBox="0 0 16 16" fill="none" stroke="#2563eb" stroke-width="1.6"><rect x="2" y="3" width="12" height="10" rx="2"/><path d="M5 7h6M5 10h4"/></svg>
          </div>
          <div><div class="sc-lbl">Total Jobs</div><div class="sc-val">{{ $totalJobs }}</div></div>
        </div>
        <div class="sc">
          <div class="sc-ico" style="background:#fef9c3">
            <svg viewBox="0 0 16 16" fill="none" stroke="#854d0e" stroke-width="1.6"><circle cx="8" cy="8" r="5.5"/><path d="M8 5.5V8l1.5 1.5"/></svg>
          </div>
          <div><div class="sc-lbl">Pending</div><div class="sc-val">{{ $pendingCount }}</div></div>
        </div>
        <div class="sc">
          <div class="sc-ico" style="background:#f0fdf4">
            <svg viewBox="0 0 16 16" fill="none" stroke="#16a34a" stroke-width="1.6"><path d="M3 8.5l3.5 3.5L13 4"/></svg>
          </div>
          <div><div class="sc-lbl">Active</div><div class="sc-val">{{ $activeCount }}</div></div>
        </div>
        <div class="sc">
          <div class="sc-ico" style="background:#fef3c7">
            <svg viewBox="0 0 16 16" fill="none" stroke="#d97706" stroke-width="1.6"><path d="M8 2l1.6 3.4L13 6.1l-2.5 2.4.6 3.5L8 10.3 4.9 12l.6-3.5L3 6.1l3.4-.7z"/></svg>
          </div>
          <div><div class="sc-lbl">Top Jobs</div><div class="sc-val">{{ $topCount }}</div></div>
        </div>
      </div>

      <!-- Filter Bar -->
      <div class="filter-bar">
        <label>Filter:</label>
        <form method="GET" action="{{ route('admin.all-jobs') }}" style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Title, code...">
          <select name="status">
            <option value="">All Status</option>
            <option value="pending"  {{ request('status')=='pending'  ? 'selected':'' }}>Pending</option>
            <option value="active"   {{ request('status')=='active'   ? 'selected':'' }}>Active</option>
            <option value="complete"{{ request('status')=='complete'? 'selected':'' }}>complete</option>
            <option value="paused"   {{ request('status')=='paused'   ? 'selected':'' }}>Paused</option>
            <option value="rejected" {{ request('status')=='rejected' ? 'selected':'' }}>Rejected</option>
          </select>
          <select name="is_top">
            <option value="">All Type</option>
            <option value="1" {{ request('is_top')=='1' ? 'selected':'' }}>Top Jobs</option>
           
          </select>
          <button type="submit" class="abtn abtn-info" style="padding:6px 14px;font-size:12px">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" style="width:12px;height:12px"><circle cx="6.5" cy="6.5" r="4.5"/><path d="m10 10 3.5 3.5"/></svg>
            Search
          </button>
          @if(request()->hasAny(['search','status','is_top']))
            <a href="{{ route('admin.active-jobs') }}" class="abtn abtn-danger" style="padding:6px 14px;font-size:12px">Clear</a>
          @endif
        </form>
      </div>

      <!-- Jobs Table -->
      <div class="tcard">
        <div class="tcard-head">
          <span class="tcard-title">Job Listings</span>
          <span class="tcard-count">{{ $jobs->total() ?? count($jobs) }} jobs found</span>
        </div>

        <div style="overflow-x:auto">
          <table>
            <thead>
              <tr>
                <th style="width:40px">#</th>
                <th>Job Info</th>
                <th>Buyer</th>
                <th>Category</th>
                <th>Workers</th>
                <th>Budget</th>
                <th>Earn / Worker</th>
                <th>Thumbnail</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($jobs as $index => $job)
              <tr>
                <!-- # -->
                <td style="color:#94a3b8;font-size:11px;font-weight:600">
                  {{ ($jobs->currentPage() - 1) * $jobs->perPage() + $loop->iteration }}
                </td>

                <!-- Job Info -->
                <td>
                  <span class="job-title" title="{{ $job->title }}">
                    {{ $job->title }}
                    @if($job->is_top)
                      <span class="top-crown" style="margin-left:4px">★ Top</span>
                    @endif
                  </span>
                  <span class="job-code">Code: {{ $job->code }}</span>
                  @if($job->has_secret_code)
                    <span class="job-code" style="color:#9333ea">🔒 Secret Code</span>
                  @endif
                </td>

                <!-- Buyer -->
                <td>
                  <div style="font-weight:500;font-size:12px">{{ $job->user->name ?? '—' }}</div>
                  <div style="font-size:10px;color:#94a3b8">{{ $job->user->email ?? '' }}</div>
                </td>

                <!-- Category -->
                <td>
                  <div style="font-size:12px;font-weight:500">{{ $job->category->name ?? '—' }}</div>
                  <div style="font-size:10px;color:#94a3b8">{{ $job->subcategory->name ?? '' }}</div>
                </td>

                <!-- Workers progress -->
                <td>
                  <div class="worker-prog">
                    <div class="worker-nums">{{ $job->worker_done }} / {{ $job->worker_need }} done</div>
                    <div class="worker-bar-bg">
                      <div class="worker-bar-fill" style="width:{{ $job->worker_need > 0 ? round(($job->worker_done / $job->worker_need) * 100) : 0 }}%"></div>
                    </div>
                    <div class="worker-nums" style="color:#94a3b8">{{ $job->worker_remaining }} remaining</div>
                  </div>
                </td>

                <!-- Budget -->
                <td>
                  <span class="budget-badge">${{ number_format($job->budget, 2) }}</span>
                </td>

                <!-- Earn per worker -->
                <td>
                  <span class="earn-badge">${{ number_format($job->worker_earn, 2) }}</span>
                  @if($job->charge_percentage)
                    <div style="font-size:10px;color:#94a3b8">Fee: {{ $job->charge_percentage }}%</div>
                  @endif
                </td>

                <!-- Thumbnail -->
                <td>
                  @if($job->thumbnail)
                    <img src="{{ asset('storage/'.$job->thumbnail) }}" class="thumb-img" alt="thumbnail">
                  @else
                    <div class="thumb-placeholder">
                      <svg viewBox="0 0 16 16" fill="none" stroke="#cbd5e1" stroke-width="1.4" width="16" height="16"><rect x="2" y="4" width="12" height="9" rx="2"/><path d="M2 10l3-3 3 3 2-2 4 4"/></svg>
                    </div>
                  @endif
                </td>

                <!-- Status -->
                <td>
                  @php
                    $stMap = [
                      'pending'   => 'ta',
                      'active'    => 'tb',
                      'complete' => 'tg',
                      'pause'    => 'tpurple',
                      'rejecte'  => 'tr',
                    ];
                    $stClass = $stMap[$job->status] ?? 'ta';
                  @endphp
                  <span class="tag {{ $stClass }}">{{ ucfirst($job->status) }}</span>
                  @if($job->reject_done > 0)
                    <div style="font-size:10px;color:#94a3b8;margin-top:2px">Rejects: {{ $job->reject_done }}/{{ $job->max_reject }}</div>
                  @endif
                </td>

                <!-- Actions -->
                <td>
                  <div class="act-btns">
                    <!-- Details always visible -->
                    <a href="{{ route('admin.job-datails', $job->id) }}" class="abtn abtn-info">
                      <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="8" r="5.5"/><path d="M8 7v4M8 5.5v.5"/></svg>
                      Details
                    </a>

                    @if($job->status == 'pending')
                      <!-- Approve -->
                      <a href="{{ route('admin.approve-job', $job->id) }}"
                         onclick="return confirm('Approve this job?')"
                         class="abtn abtn-success">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 8.5l3.5 3.5L13 4"/></svg>
                        Approve
                      </a>
                      <!-- Delete -->
                      <a href="{{ route('admin.delete-job', $job->id) }}"
                         onclick="return confirm('Delete this job permanently?')"
                         class="abtn abtn-danger">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 4.5h10M6 4.5V3h4v1.5M5 4.5v7a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-7"/></svg>
                        Delete
                      </a>
                    @endif
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="10" style="text-align:center;padding:40px;color:#94a3b8">
                  <svg viewBox="0 0 16 16" fill="none" stroke="#cbd5e1" stroke-width="1.4" width="32" height="32" style="display:block;margin:0 auto 8px"><rect x="2" y="3" width="12" height="10" rx="2"/><path d="M5 7h6M5 10h4"/></svg>
                  No jobs found
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($jobs, 'links'))
        <div class="pg-wrap">
          {{ $jobs->withQueryString()->links() }}
        </div>
        @endif
      </div>

    </main>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
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
</script>