{{-- resources/views/admin/jobs/show.blade.php --}}

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

/* Tags */
.tag{display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;letter-spacing:.3px}
.tg{background:#dcfce7;color:#15803d}
.ta{background:#fef9c3;color:#854d0e}
.tr{background:#fee2e2;color:#991b1b}
.tb{background:#dbeafe;color:#1d4ed8}
.tpurple{background:#f3e8ff;color:#7e22ce}

/* Page header */
.pg-head{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:20px}
.pg-left{display:flex;align-items:center;gap:10px}
.back-btn{display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:8px;background:#fff;border:1px solid #e2e8f0;font-size:12px;font-weight:500;color:#64748b;text-decoration:none;transition:all .15s}
.back-btn:hover{background:#f8fafc;color:#0f172a;text-decoration:none}
.pg-title{font-size:18px;font-weight:700;letter-spacing:-.4px}
.pg-sub{font-size:12px;color:#64748b;margin-top:2px}

/* Action buttons */
.act-btns{display:flex;gap:6px;flex-wrap:wrap}
.abtn{display:inline-flex;align-items:center;gap:5px;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:500;border:none;cursor:pointer;text-decoration:none;transition:all .15s}
.abtn:hover{opacity:.85;text-decoration:none;transform:translateY(-1px)}
.abtn-success{background:#16a34a;color:#fff}
.abtn-danger{background:#e11d48;color:#fff}
.abtn-warning{background:#d97706;color:#fff}
.abtn svg{width:12px;height:12px}

/* Main grid layout */
.detail-grid{display:grid;grid-template-columns:2fr 1fr;gap:16px}

/* Cards */
.dcard{background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-bottom:16px}
.dcard-head{padding:14px 18px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;gap:8px}
.dcard-icon{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.dcard-icon svg{width:14px;height:14px}
.dcard-title{font-size:13px;font-weight:600}
.dcard-body{padding:16px 18px}

/* Info rows */
.info-row{display:flex;align-items:flex-start;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f8fafc;gap:10px}
.info-row:last-child{border-bottom:none}
.info-label{font-size:11.5px;color:#64748b;font-weight:500;min-width:130px;flex-shrink:0}
.info-value{font-size:12.5px;font-weight:500;color:#0f172a;text-align:right;word-break:break-word}
.info-value.green{color:#16a34a;font-weight:700}
.info-value.blue{color:#2563eb;font-weight:700}

/* Thumbnail large */
.thumb-large{width:100%;aspect-ratio:16/7;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0}
.thumb-placeholder-lg{width:100%;aspect-ratio:16/7;border-radius:10px;background:#f8fafc;border:1px solid #e2e8f0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;color:#94a3b8;font-size:12px}

/* Progress bar */
.prog-wrap{margin:4px 0 2px}
.prog-bg{height:8px;background:#f1f5f9;border-radius:6px;overflow:hidden}
.prog-fill{height:100%;border-radius:6px;transition:width .5s ease}
.prog-labels{display:flex;justify-content:space-between;font-size:10px;color:#94a3b8;margin-top:4px}

/* Worker stats chips */
.wchips{display:flex;gap:8px;flex-wrap:wrap;margin-top:10px}
.wchip{flex:1;min-width:70px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:10px 12px;text-align:center}
.wchip-val{font-size:20px;font-weight:700;letter-spacing:-.5px}
.wchip-lbl{font-size:10px;color:#64748b;margin-top:2px}

/* Description box */
.desc-box{font-size:13px;line-height:1.7;color:#334155;background:#f8fafc;border-radius:10px;padding:14px;border:1px solid #f1f5f9;white-space:pre-wrap;word-break:break-word}

/* Proofs */
.proofs-list{display:flex;flex-direction:column;gap:6px}
.proof-item{display:flex;align-items:center;gap:8px;padding:8px 10px;background:#f8fafc;border-radius:8px;border:1px solid #f1f5f9;font-size:12px}
.proof-num{width:20px;height:20px;border-radius:50%;background:#eff6ff;color:#2563eb;font-size:10px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}

/* Reject reason */
.reject-box{background:#fff1f2;border:1px solid #fecdd3;border-radius:10px;padding:12px 14px}
.reject-box .rlabel{font-size:10px;font-weight:700;color:#e11d48;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px}
.reject-box .rtext{font-size:13px;color:#9f1239;line-height:1.5}

/* Secret code box */
.secret-box{display:flex;align-items:center;gap:8px;background:#fdf4ff;border:1px solid #e9d5ff;border-radius:10px;padding:10px 14px}
.secret-val{font-size:15px;font-weight:700;color:#7e22ce;letter-spacing:2px;font-family:monospace}

/* Top job badge */
.top-badge{display:inline-flex;align-items:center;gap:5px;background:linear-gradient(135deg,#fef3c7,#fde68a);color:#78350f;font-size:12px;font-weight:700;padding:5px 12px;border-radius:20px;border:1px solid #fcd34d}

/* Responsive */
@media(max-width:900px){.detail-grid{grid-template-columns:1fr}}
@media(max-width:640px){
  .sidebar{position:fixed;top:52px;left:0;height:calc(100% - 52px);z-index:50;transform:translateX(-100%);transition:transform .25s ease;min-width:200px;width:200px}
  .sidebar.mob-open{transform:translateX(0)}
  .overlay.show{display:block}
  .tb-search{display:none}
  .act-btns{gap:4px}
  .abtn{padding:6px 10px;font-size:11px}
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

      <!-- Page Header -->
      <div class="pg-head">
        <div class="pg-left">
          <a href="{{ route('admin.active-jobs') }}" class="back-btn">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><path d="M10 3L5 8l5 5"/></svg>
            Back
          </a>
          <div>
            <div class="pg-title">Job Details</div>
            <div class="pg-sub">Code: <strong>{{ $job->code }}</strong></div>
          </div>
        </div>

        <div class="act-btns">
          @if($job->is_top)
            <span class="top-badge">
              <svg viewBox="0 0 16 16" fill="#d97706" width="12" height="12"><path d="M8 2l1.6 3.4L13 6.1l-2.5 2.4.6 3.5L8 10.3 4.9 12l.6-3.5L3 6.1l3.4-.7z"/></svg>
              Top Job #{{ $job->top_order }}
            </span>
          @endif

          @php
            $stMap = ['pending'=>'ta','active'=>'tb','completed'=>'tg','paused'=>'tpurple','canceled'=>'tr','rejected'=>'tr'];
            $stClass = $stMap[$job->status] ?? 'ta';
          @endphp
          <span class="tag {{ $stClass }}" style="font-size:12px;padding:5px 12px">{{ ucfirst($job->status) }}</span>


          {{-- PENDING: Approve, Reject, Delete --}}
           @if($job->status == 'pending')
            <a href="{{ route('admin.approve-job', $job->id) }}"
               onclick="return confirm('Approve this job?')"
               class="abtn abtn-success">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8.5l3.5 3.5L13 4"/></svg>
              Approve
            </a>
            <button onclick="openRejectModal()" class="abtn abtn-warning">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 5v4M8 10.5v.5"/><circle cx="8" cy="8" r="6"/></svg>
              Reject
            </button>
            <a href="{{route('admin.job-datails',$job->id)}}"
               onclick="return confirm('Delete this job permanently?')"
               class="abtn abtn-danger">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 4.5h10M6 4.5V3h4v1.5M5 4.5v7a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-7"/></svg>
              Delete
            </a>
          @endif

          {{-- ACTIVE: Paused, Reject, Delete --}}
          @if($job->status == 'active')
            <a href="{{ route('admin.make-pause-job', $job->id) }}"
               onclick="return confirm('Pause this job?')"
               class="abtn abtn-warning">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="3" width="3" height="10" rx="1"/><rect x="9" y="3" width="3" height="10" rx="1"/></svg>
              Pause
            </a>
            <button onclick="openRejectModal()" class="abtn" style="background:#fff3cd;color:#856404">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 5v4M8 10.5v.5"/><circle cx="8" cy="8" r="6"/></svg>
              Reject
            </button>
            <a href="{{ route('admin.delete-job', $job->id) }}"
               onclick="return confirm('Delete this job permanently?')"
               class="abtn abtn-danger">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 4.5h10M6 4.5V3h4v1.5M5 4.5v7a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-7"/></svg>
              Delete
            </a>
          @endif

          {{-- PAUSED: Make Live, Reject, Delete --}}
          @if($job->status == 'pause')
            <a href="{{ route('admin.make-un-pause-job', $job->id) }}"
               onclick="return confirm('Make this job live/active?')"
               class="abtn abtn-success">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="8" cy="8" r="3" fill="currentColor"/><circle cx="8" cy="8" r="6"/></svg>
              Make Live
            </a>
            <button onclick="openRejectModal()" class="abtn" style="background:#fff3cd;color:#856404">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 5v4M8 10.5v.5"/><circle cx="8" cy="8" r="6"/></svg>
              Reject
            </button>
            <a href="{{ route('admin.delete-job', $job->id) }}"
               onclick="return confirm('Delete this job permanently?')"
               class="abtn abtn-danger">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 4.5h10M6 4.5V3h4v1.5M5 4.5v7a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-7"/></svg>
              Delete
            </a>
          @endif

          {{-- REJECTED: Approve (reconsider), Delete --}}
          @if($job->status == 'reject')
            <a href="{{ route('admin.approve-job', $job->id) }}"
               onclick="return confirm('Re-approve this rejected job?')"
               class="abtn abtn-success">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8.5l3.5 3.5L13 4"/></svg>
              Re-Approve
            </a>
            <a href="{{ route('admin.delete-job', $job->id) }}"
               onclick="return confirm('Delete this job permanently?')"
               class="abtn abtn-danger">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 4.5h10M6 4.5V3h4v1.5M5 4.5v7a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-7"/></svg>
              Delete
            </a>
          @endif

          {{-- COMPLETED / CANCELED: Delete only --}}
          @if($job->status=='complete')
            <a href="{{ route('admin.delete-job', $job->id) }}"
               onclick="return confirm('Delete this job permanently?')"
               class="abtn abtn-danger">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 4.5h10M6 4.5V3h4v1.5M5 4.5v7a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-7"/></svg>
              Delete
            </a>
          @endif

        </div>
      </div>

      {{-- ===== REJECT MODAL ===== --}}
      <div id="rejectModal" style="display:none;position:fixed;inset:0;z-index:999;background:rgba(0,0,0,.45);align-items:center;justify-content:center">
        <div style="background:#fff;border-radius:16px;padding:24px;width:100%;max-width:440px;margin:16px;box-shadow:0 20px 60px rgba(0,0,0,.2)">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px">
            <div>
              <div style="font-size:15px;font-weight:700;color:#0f172a">Reject Job</div>
              <div style="font-size:12px;color:#64748b;margin-top:2px">Provide a reason for rejection</div>
            </div>
            <button onclick="closeRejectModal()" style="width:30px;height:30px;border-radius:8px;border:1px solid #e2e8f0;background:#f8fafc;cursor:pointer;font-size:16px;color:#64748b;display:flex;align-items:center;justify-content:center">&times;</button>
          </div>
          <form action="{{ route('admin.reject-job', $job->id) }}" method="POST">
            @csrf
            <div style="margin-bottom:14px">
              <label style="font-size:12px;font-weight:600;color:#374151;display:block;margin-bottom:6px">Rejection Reason <span style="color:#e11d48">*</span></label>
              <textarea name="reject_reason" rows="4" required
                placeholder="Explain why this job is being rejected..."
                style="width:100%;padding:10px 12px;border:1px solid #e2e8f0;border-radius:10px;font-size:13px;outline:none;resize:vertical;font-family:inherit;color:#0f172a;line-height:1.5"
                onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'"></textarea>
            </div>
            <div style="display:flex;gap:8px;justify-content:flex-end">
              <button type="button" onclick="closeRejectModal()"
                style="padding:8px 16px;border-radius:8px;border:1px solid #e2e8f0;background:#f8fafc;font-size:13px;font-weight:500;color:#64748b;cursor:pointer">
                Cancel
              </button>
              <button type="submit"
                style="padding:8px 18px;border-radius:8px;border:none;background:#e11d48;color:#fff;font-size:13px;font-weight:600;cursor:pointer">
                Confirm Reject
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Flash messages -->
      @if(session()->has('success'))
        <div class="alert alert-success mb-3" style="border-radius:10px;font-size:13px">✓ {{ session('success') }}</div>
      @endif
      @if(session()->has('error'))
        <div class="alert alert-danger mb-3" style="border-radius:10px;font-size:13px">✕ {{ session('error') }}</div>
      @endif

      <!-- Reject reason banner -->
      @if($job->reject_reason)
        <div class="reject-box" style="margin-bottom:16px">
          <div class="rlabel">Rejection Reason</div>
          <div class="rtext">{{ $job->reject_reason }}</div>
        </div>
      @endif

      <!-- Two-column layout -->
      <div class="detail-grid">

        <!-- LEFT COLUMN -->
        <div>

          <!-- Thumbnail -->
          <div class="dcard">
            <div class="dcard-head">
              <div class="dcard-icon" style="background:#eff6ff">
                <svg viewBox="0 0 16 16" fill="none" stroke="#2563eb" stroke-width="1.6"><rect x="2" y="4" width="12" height="9" rx="2"/><path d="M2 10l3-3 3 3 2-2 4 4"/></svg>
              </div>
              <span class="dcard-title">Thumbnail</span>
            </div>
            <div class="dcard-body">
              @if($job->thumbnail)
                <img src="{{ asset('storage/'.$job->thumbnail) }}" class="thumb-large" alt="Job Thumbnail">
              @else
                <div class="thumb-placeholder-lg">
                  <svg viewBox="0 0 16 16" fill="none" stroke="#cbd5e1" stroke-width="1.4" width="28" height="28"><rect x="2" y="4" width="12" height="9" rx="2"/><path d="M2 10l3-3 3 3 2-2 4 4"/></svg>
                  No thumbnail uploaded
                </div>
              @endif
            </div>
          </div>

          <!-- Description -->
          <div class="dcard">
            <div class="dcard-head">
              <div class="dcard-icon" style="background:#f0fdf4">
                <svg viewBox="0 0 16 16" fill="none" stroke="#16a34a" stroke-width="1.6"><rect x="2" y="2" width="12" height="12" rx="2"/><path d="M5 6h6M5 9h4"/></svg>
              </div>
              <span class="dcard-title">Job Description</span>
            </div>
            <div class="dcard-body">
              <div class="desc-box">{{ is_array($job->description) ? implode("\n", $job->description) : $job->description }}</div>
            </div>
          </div>

          <!-- Proofs required -->
          @php
            // Handle proofs whether it's already array (cast), JSON string, or null
            $rawProofs = $job->proofs;
            if (is_array($rawProofs)) {
                $proofsArr = $rawProofs;
            } elseif (is_string($rawProofs) && !empty($rawProofs)) {
                $proofsArr = json_decode($rawProofs, true) ?? [];
            } else {
                $proofsArr = [];
            }
          @endphp
          @if(count($proofsArr) > 0)
          <div class="dcard">
            <div class="dcard-head">
              <div class="dcard-icon" style="background:#fef9c3">
                <svg viewBox="0 0 16 16" fill="none" stroke="#854d0e" stroke-width="1.6"><path d="M4 2h8l2 2v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1Z"/><path d="M5 9l1.5 1.5L11 6"/></svg>
              </div>
              <span class="dcard-title">Required Proofs <span style="color:#94a3b8;font-weight:400">({{ count($proofsArr) }})</span></span>
            </div>
            <div class="dcard-body">
              <div class="proofs-list">
                @foreach($proofsArr as $idx => $proof)
                  <div class="proof-item">
                    <div class="proof-num">{{ $idx + 1 }}</div>
                    <span>{{ is_string($proof) ? $proof : json_encode($proof) }}</span>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          @endif

        </div>

        <!-- RIGHT COLUMN -->
        <div>

          <!-- Worker Progress -->
          <div class="dcard">
            <div class="dcard-head">
              <div class="dcard-icon" style="background:#eff6ff">
                <svg viewBox="0 0 16 16" fill="none" stroke="#2563eb" stroke-width="1.6"><path d="M2 12a6 6 0 0 1 12 0"/><circle cx="8" cy="6" r="3"/></svg>
              </div>
              <span class="dcard-title">Worker Progress</span>
            </div>
            <div class="dcard-body">
              @php
                $pct = $job->worker_need > 0 ? round(($job->worker_done / $job->worker_need) * 100) : 0;
                $barColor = $pct >= 100 ? '#16a34a' : ($pct >= 50 ? '#2563eb' : '#f59e0b');
              @endphp
              <div style="display:flex;justify-content:space-between;align-items:baseline;margin-bottom:6px">
                <span style="font-size:12px;color:#64748b">Completion</span>
                <span style="font-size:16px;font-weight:700;color:{{ $barColor }}">{{ $pct }}%</span>
              </div>
              <div class="prog-bg">
                <div class="prog-fill" style="width:{{ $pct }}%;background:{{ $barColor }}"></div>
              </div>
              <div class="wchips">
                <div class="wchip">
                  <div class="wchip-val" style="color:#2563eb">{{ $job->worker_need }}</div>
                  <div class="wchip-lbl">Need</div>
                </div>
                <div class="wchip">
                  <div class="wchip-val" style="color:#16a34a">{{ $job->worker_done }}</div>
                  <div class="wchip-lbl">Done</div>
                </div>
                <div class="wchip">
                  <div class="wchip-val" style="color:#f59e0b">{{ $job->worker_remaining }}</div>
                  <div class="wchip-lbl">Left</div>
                </div>
              </div>
              <div class="info-row" style="margin-top:10px">
                <span class="info-label">Max Rejects Allowed</span>
                <span class="info-value">{{ $job->max_reject }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Rejects Done</span>
                <span class="info-value {{ $job->reject_done > 0 ? 'style=color:#e11d48;font-weight:700' : '' }}">{{ $job->reject_done }}</span>
              </div>
            </div>
          </div>

          <!-- Financial Info -->
          <div class="dcard">
            <div class="dcard-head">
              <div class="dcard-icon" style="background:#f0fdf4">
                <svg viewBox="0 0 16 16" fill="none" stroke="#16a34a" stroke-width="1.6"><circle cx="8" cy="8" r="5.5"/><path d="M8 5v1.5M8 9.5V11M6.5 7.5A1.5 1.5 0 0 1 8 6a1.5 1.5 0 0 1 0 3 1.5 1.5 0 0 0 0 3"/></svg>
              </div>
              <span class="dcard-title">Financial Details</span>
            </div>
            <div class="dcard-body">
              <div class="info-row">
                <span class="info-label">Total Budget</span>
                <span class="info-value blue">${{ number_format($job->budget, 2) }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Worker Earn</span>
                <span class="info-value green">${{ number_format($job->worker_earn, 2) }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Charge Percentage</span>
                <span class="info-value">{{ $job->charge_percentage ?? 0 }}%</span>
              </div>
            </div>
          </div>

          <!-- Job Details -->
          <div class="dcard">
            <div class="dcard-head">
              <div class="dcard-icon" style="background:#f3e8ff">
                <svg viewBox="0 0 16 16" fill="none" stroke="#9333ea" stroke-width="1.6"><rect x="2" y="3" width="12" height="10" rx="2"/><path d="M5 7h6M5 10h4"/></svg>
              </div>
              <span class="dcard-title">Job Information</span>
            </div>
            <div class="dcard-body">
              <div class="info-row">
                <span class="info-label">Title</span>
                <span class="info-value">{{ $job->title }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Code</span>
                <span class="info-value" style="font-family:monospace;background:#f1f5f9;padding:2px 8px;border-radius:5px">{{ $job->code }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Slug</span>
                <span class="info-value" style="font-size:11px;color:#64748b">{{ $job->slug }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Category</span>
                <span class="info-value">{{ $job->category->name ?? '—' }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Sub-category</span>
                <span class="info-value">{{ $job->subcategory->name ?? '—' }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Continent</span>
                <span class="info-value">{{ $job->continent->name ?? '—' }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Country</span>
                <span class="info-value">{{ $job->country->name ?? '—' }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Is Top Job</span>
                <span class="info-value">
                  @if($job->is_top)
                    <span style="color:#d97706;font-weight:700">★ Yes (Order #{{ $job->top_order }})</span>
                  @else
                    <span style="color:#94a3b8">No</span>
                  @endif
                </span>
              </div>
              @if($job->topped_at)
              <div class="info-row">
                <span class="info-label">Topped At</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($job->topped_at)->format('d M Y, h:i A') }}</span>
              </div>
              @endif
            </div>
          </div>

          <!-- Buyer Info -->
          <div class="dcard">
            <div class="dcard-head">
              <div class="dcard-icon" style="background:#fef3c7">
                <svg viewBox="0 0 16 16" fill="none" stroke="#d97706" stroke-width="1.6"><circle cx="8" cy="5.5" r="2.5"/><path d="M3 13a5 5 0 0 1 10 0"/></svg>
              </div>
              <span class="dcard-title">Buyer</span>
            </div>
            <div class="dcard-body">
              <div class="info-row">
                <span class="info-label">Name</span>
                <span class="info-value">{{ $job->user->name ?? '—' }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value" style="font-size:11.5px">{{ $job->user->email ?? '—' }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">User ID</span>
                <span class="info-value" style="color:#94a3b8">#{{ $job->user_id }}</span>
              </div>
            </div>
          </div>

          <!-- Secret Code -->
          @if($job->has_secret_code)
          <div class="dcard">
            <div class="dcard-head">
              <div class="dcard-icon" style="background:#fdf4ff">
                <svg viewBox="0 0 16 16" fill="none" stroke="#9333ea" stroke-width="1.6"><rect x="4" y="7" width="8" height="7" rx="1.5"/><path d="M6 7V5a2 2 0 0 1 4 0v2"/></svg>
              </div>
              <span class="dcard-title">Secret Code</span>
            </div>
            <div class="dcard-body">
              <div class="secret-box">
                <svg viewBox="0 0 16 16" fill="none" stroke="#9333ea" stroke-width="1.6" width="16" height="16"><rect x="4" y="7" width="8" height="7" rx="1.5"/><path d="M6 7V5a2 2 0 0 1 4 0v2"/></svg>
                <span class="secret-val">{{ $job->secret_code }}</span>
              </div>
            </div>
          </div>
          @endif

        </div>
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
function openRejectModal(){
  var m=document.getElementById('rejectModal');
  m.style.display='flex';
  document.body.style.overflow='hidden';
}
function closeRejectModal(){
  var m=document.getElementById('rejectModal');
  m.style.display='none';
  document.body.style.overflow='';
}
// Close modal on backdrop click
document.getElementById('rejectModal').addEventListener('click', function(e){
  if(e.target===this) closeRejectModal();
});
</script>