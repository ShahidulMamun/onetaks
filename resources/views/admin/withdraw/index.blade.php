{{-- resources/views/admin/withdraw/index.blade.php --}}

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
.tb-tag{background:#dbeafe;color:#1d4ed8}
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
.sc-sub{font-size:10px;color:#94a3b8;margin-top:2px}

/* Filter bar */
.filter-bar{display:flex;align-items:center;gap:8px;margin-bottom:14px;flex-wrap:wrap}
.filter-bar input,.filter-bar select{padding:6px 10px;border:1px solid #e2e8f0;border-radius:8px;font-size:12px;outline:none;background:#fff;color:#0f172a;cursor:pointer}
.filter-bar input:focus,.filter-bar select:focus{border-color:#2563eb}
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

/* Amount display */
.amount-main{font-weight:700;font-size:13px;color:#0f172a}
.amount-sub{font-size:10px;color:#16a34a;font-weight:600;margin-top:2px}
.amount-charge{font-size:10px;color:#ef4444;margin-top:1px}
.amount-payable{font-size:10px;color:#2563eb;font-weight:600;margin-top:1px}

/* Account info */
.acc-type{display:inline-flex;align-items:center;gap:4px;padding:2px 7px;border-radius:5px;font-size:10px;font-weight:600;background:#f1f5f9;color:#475569;margin-bottom:3px}
.acc-no{font-size:11px;color:#64748b;font-family:monospace;letter-spacing:.5px}

/* Action buttons */
.act-btns{display:flex;gap:5px;flex-wrap:wrap}
.abtn{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:7px;font-size:11px;font-weight:500;border:none;cursor:pointer;text-decoration:none;transition:opacity .15s}
.abtn:hover{opacity:.85;text-decoration:none}
.abtn-info{background:#eff6ff;color:#2563eb}
.abtn-success{background:#f0fdf4;color:#16a34a}
.abtn-danger{background:#fff1f2;color:#e11d48}
.abtn svg{width:11px;height:11px}

/* Pagination */
.pg-wrap{padding:12px 18px;border-top:1px solid #f1f5f9;display:flex;justify-content:flex-end}

/* ===== REJECT MODAL ===== */
.modal-backdrop-custom{display:none;position:fixed;inset:0;background:rgba(15,23,42,.55);z-index:1000;align-items:center;justify-content:center}
.modal-backdrop-custom.show{display:flex}
.modal-box{background:#fff;border-radius:16px;width:100%;max-width:440px;margin:16px;box-shadow:0 20px 60px rgba(0,0,0,.18);overflow:hidden;animation:modalIn .22s ease}
@keyframes modalIn{from{opacity:0;transform:scale(.95) translateY(8px)}to{opacity:1;transform:scale(1) translateY(0)}}
.modal-header{padding:18px 20px 14px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between}
.modal-header-title{font-size:15px;font-weight:700;display:flex;align-items:center;gap:8px}
.modal-header-icon{width:30px;height:30px;border-radius:8px;background:#fff1f2;display:flex;align-items:center;justify-content:center}
.modal-header-icon svg{width:14px;height:14px;stroke:#e11d48}
.modal-close{width:28px;height:28px;border-radius:7px;background:#f8fafc;border:1px solid #e2e8f0;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .15s}
.modal-close:hover{background:#f1f5f9}
.modal-close svg{width:12px;height:12px;stroke:#64748b}
.modal-body{padding:18px 20px}
.modal-info-row{background:#f8fafc;border:1px solid #f1f5f9;border-radius:10px;padding:12px 14px;margin-bottom:14px;display:flex;gap:14px;flex-wrap:wrap}
.modal-info-item{flex:1;min-width:90px}
.modal-info-label{font-size:10px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px}
.modal-info-val{font-size:13px;font-weight:600;color:#0f172a}
.form-label-custom{font-size:12px;font-weight:600;color:#475569;margin-bottom:6px;display:block}
.form-textarea{width:100%;padding:10px 12px;border:1px solid #e2e8f0;border-radius:10px;font-size:13px;resize:none;outline:none;font-family:inherit;transition:border-color .15s;color:#0f172a}
.form-textarea:focus{border-color:#e11d48}
.form-textarea::placeholder{color:#cbd5e1}
.modal-footer{padding:14px 20px;border-top:1px solid #f1f5f9;display:flex;gap:8px;justify-content:flex-end}
.btn-cancel{padding:7px 16px;border-radius:9px;font-size:12px;font-weight:500;background:#f8fafc;border:1px solid #e2e8f0;cursor:pointer;color:#64748b;transition:background .15s}
.btn-cancel:hover{background:#f1f5f9}
.btn-reject-confirm{padding:7px 18px;border-radius:9px;font-size:12px;font-weight:600;background:#e11d48;border:none;cursor:pointer;color:#fff;transition:opacity .15s;display:flex;align-items:center;gap:6px}
.btn-reject-confirm:hover{opacity:.88}
.char-count{font-size:10px;color:#94a3b8;text-align:right;margin-top:4px}

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
      <input placeholder="Search withdrawals...">
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
        <div>
          <div class="pg-title">Withdraw Requests</div>
          <div class="pg-sub">Review and manage user withdrawal requests</div>
        </div>
      </div>

      <!-- Flash Messages -->
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
        $dollarRate   = \App\Models\WebsiteSetting::first()->dolar_rate ?? 100;
        $totalReqs    = $withdraw->count();
        $pendingReqs  = $withdraw->where('status','pending')->count();
        $approvedReqs = $withdraw->where('status','approved')->count();
        $rejectedReqs = $withdraw->where('status','rejected')->count();
        $totalAmtBDT  = $withdraw->where('status','pending')->sum('amount');
        $totalAmtUSD  = $dollarRate > 0 ? round($totalAmtBDT / $dollarRate, 2) : 0;
      @endphp
      <div class="stats-row">
        <div class="sc">
          <div class="sc-ico" style="background:#eff6ff">
            <svg viewBox="0 0 16 16" fill="none" stroke="#2563eb" stroke-width="1.6"><rect x="2" y="4" width="12" height="8" rx="2"/><path d="M2 7h12"/><circle cx="5.5" cy="10" r="1" fill="#2563eb" stroke="none"/></svg>
          </div>
          <div>
            <div class="sc-lbl">Total Requests</div>
            <div class="sc-val">{{ $totalReqs }}</div>
          </div>
        </div>
        <div class="sc">
          <div class="sc-ico" style="background:#fef9c3">
            <svg viewBox="0 0 16 16" fill="none" stroke="#854d0e" stroke-width="1.6"><circle cx="8" cy="8" r="5.5"/><path d="M8 5.5V8l1.5 1.5"/></svg>
          </div>
          <div>
            <div class="sc-lbl">Pending</div>
            <div class="sc-val">{{ $pendingReqs }}</div>
            <div class="sc-sub">৳{{ number_format($totalAmtBDT,2) }} ≈ ${{ $totalAmtUSD }}</div>
          </div>
        </div>
        <div class="sc">
          <div class="sc-ico" style="background:#f0fdf4">
            <svg viewBox="0 0 16 16" fill="none" stroke="#16a34a" stroke-width="1.6"><path d="M3 8.5l3.5 3.5L13 4"/></svg>
          </div>
          <div>
            <div class="sc-lbl">Approved</div>
            <div class="sc-val">{{ $approvedReqs }}</div>
          </div>
        </div>
        <div class="sc">
          <div class="sc-ico" style="background:#fee2e2">
            <svg viewBox="0 0 16 16" fill="none" stroke="#dc2626" stroke-width="1.6"><path d="M4 4l8 8M12 4l-8 8"/></svg>
          </div>
          <div>
            <div class="sc-lbl">Rejected</div>
            <div class="sc-val">{{ $rejectedReqs }}</div>
          </div>
        </div>
      </div>

      <!-- Filter Bar -->
      <div class="filter-bar">
        <label>Filter:</label>
        <form method="GET" action="{{ route('admin.withdraw.index') }}" style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, account no...">
          <select name="status">
            <option value="">All Status</option>
            <option value="pending"  {{ request('status')=='pending'  ? 'selected':'' }}>Pending</option>
            <option value="approved" {{ request('status')=='approved' ? 'selected':'' }}>Approved</option>
            <option value="rejected" {{ request('status')=='rejected' ? 'selected':'' }}>Rejected</option>
          </select>
          <select name="account_type">
            <option value="">All Methods</option>
            <option value="bkash"  {{ request('account_type')=='bkash'  ? 'selected':'' }}>bKash</option>
            <option value="nagad"  {{ request('account_type')=='nagad'  ? 'selected':'' }}>Nagad</option>
            <option value="rocket" {{ request('account_type')=='rocket' ? 'selected':'' }}>Rocket</option>
            <option value="bank"   {{ request('account_type')=='bank'   ? 'selected':'' }}>Bank</option>
          </select>
          <button type="submit" class="abtn abtn-info" style="padding:6px 14px;font-size:12px">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" style="width:12px;height:12px"><circle cx="6.5" cy="6.5" r="4.5"/><path d="m10 10 3.5 3.5"/></svg>
            Search
          </button>
          @if(request()->hasAny(['search','status','account_type']))
            <a href="{{ route('admin.withdraw.index') }}" class="abtn abtn-danger" style="padding:6px 14px;font-size:12px">Clear</a>
          @endif
        </form>
      </div>

      <!-- Withdraw Table -->
      <div class="tcard">
        <div class="tcard-head">
          <span class="tcard-title">Withdrawal Requests</span>
          <span class="tcard-count">{{ $withdraw->count() }} requests found</span>
        </div>

        <div style="overflow-x:auto">
          <table>
            <thead>
              <tr>
                <th style="width:40px">#</th>
                <th>User</th>
                <th>Account Info</th>
                <th>Amount ($)</th>
                <th>Charge</th>
                <th>Payable (BDT)</th>
                <th>Status</th>
                <th>Requested At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($withdraw as $index => $w)
              @php
                $payableUSD = round($w->amount * $dollarRate, 4);
                $netBDT     = $w->amount - $w->charge;
              @endphp
              <tr>
                <!-- # -->
                <td style="color:#94a3b8;font-size:11px;font-weight:600">{{ $loop->iteration }}</td>

                <!-- User -->
                <td>
                  <div style="font-weight:500;font-size:12px">{{ $w->user->name ?? '—' }}</div>
                  <div style="font-size:10px;color:#94a3b8">{{ $w->user->email ?? '' }}</div>
                </td>

                <!-- Account Info -->
                <td>
                  @php
                    $methodColors = [
                      'bkash'  => ['bg'=>'#fff0f6','color'=>'#be185d'],
                      'nagad'  => ['bg'=>'#fff7ed','color'=>'#c2410c'],
                      'rocket' => ['bg'=>'#faf5ff','color'=>'#7e22ce'],
                      'bank'   => ['bg'=>'#eff6ff','color'=>'#1d4ed8'],
                    ];
                    $mc = $methodColors[strtolower($w->account_type)] ?? ['bg'=>'#f1f5f9','color'=>'#475569'];
                  @endphp
                  <div>
                    <span class="acc-type" style="background:{{ $mc['bg'] }};color:{{ $mc['color'] }}">
                      {{ strtoupper($w->account_type) }}
                    </span>
                  </div>
                  <div class="acc-no">{{ $w->account_no }}</div>
                </td>

                <!-- Amount BDT -->
                <td>
                  <div class="amount-main">${{ number_format($w->amount, 2) }}</div>
                </td>

                <!-- Charge -->
                <td>
                  @if($w->charge > 0)
                    <span style="font-size:12px;font-weight:600;color:#ef4444">${{ number_format($w->charge, 2) }}</span>
                  @else
                    <span style="font-size:11px;color:#94a3b8">No charge</span>
                  @endif
                </td>

                <!-- Payable USD -->
                <td>
                  <div style="font-weight:700;font-size:13px;color:#16a34a">৳{{ $payableUSD }}</div>
                 
                  <div style="font-size:10px;color:#000000;margin-top:1px">@1$=৳{{ $dollarRate }}</div>
                </td>

                <!-- Status -->
                <td>
                  @php
                    $stMap = ['pending'=>'ta','approved'=>'tg','rejected'=>'tr'];
                    $stClass = $stMap[$w->status] ?? 'ta';
                  @endphp
                  <span class="tag {{ $stClass }}">{{ ucfirst($w->status) }}</span>
                  @if($w->status === 'rejected' && $w->reason)
                    <div style="font-size:10px;color:#94a3b8;margin-top:3px;max-width:120px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis" title="{{ $w->reason }}">
                      {{ $w->reason }}
                    </div>
                  @endif
                </td>

                <!-- Date -->
                <td style="font-size:11px;color:#64748b;white-space:nowrap">
                  {{ $w->created_at->format('d M Y') }}<br>
                  <span style="color:#94a3b8">{{ $w->created_at->format('h:i A') }}</span>
                </td>

                <!-- Actions -->
                <td>
                  <div class="act-btns">
                    @if($w->status === 'pending')
                      <!-- Approve -->
                      <a href="{{ route('admin.withdraw.approve', $w->id) }}"
                         onclick="return confirm('Approve this withdrawal of ৳{{ $w->amount }}?')"
                         class="abtn abtn-success">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 8.5l3.5 3.5L13 4"/></svg>
                        Approve
                      </a>
                      <!-- Reject -->
                      <button type="button"
                              class="abtn abtn-danger"
                              onclick="openRejectModal({{ $w->id }}, '{{ addslashes($w->user->name ?? '') }}', '{{ $w->amount }}', '{{ strtoupper($w->account_type) }}', '{{ $w->account_no }}')">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4l8 8M12 4l-8 8"/></svg>
                        Reject
                      </button>
                    @else
                      <span style="font-size:11px;color:#cbd5e1;padding:4px 6px">—</span>
                    @endif
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="9" style="text-align:center;padding:40px;color:#94a3b8">
                  <svg viewBox="0 0 16 16" fill="none" stroke="#cbd5e1" stroke-width="1.4" width="32" height="32" style="display:block;margin:0 auto 8px"><rect x="2" y="4" width="12" height="8" rx="2"/><path d="M2 7h12"/></svg>
                  No withdrawal requests found
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if(method_exists($withdraw, 'links'))
        <div class="pg-wrap">
          {{ $withdraw->withQueryString()->links() }}
        </div>
        @endif
      </div>

    </main>
  </div>
</div>

<!-- ===== REJECT MODAL ===== -->
<div class="modal-backdrop-custom" id="rejectModal">
  <div class="modal-box">
    <div class="modal-header">
      <div class="modal-header-title">
        <div class="modal-header-icon">
          <svg viewBox="0 0 16 16" fill="none" stroke-width="1.8"><path d="M4 4l8 8M12 4l-8 8"/></svg>
        </div>
        Reject Withdrawal
      </div>
      <button class="modal-close" onclick="closeRejectModal()">
        <svg viewBox="0 0 16 16" fill="none" stroke-width="2"><path d="M4 4l8 8M12 4l-8 8"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <!-- Info preview -->
      <div class="modal-info-row">
        <div class="modal-info-item">
          <div class="modal-info-label">User</div>
          <div class="modal-info-val" id="modal-user-name">—</div>
        </div>
        <div class="modal-info-item">
          <div class="modal-info-label">Amount</div>
          <div class="modal-info-val" id="modal-amount">—</div>
        </div>
        <div class="modal-info-item">
          <div class="modal-info-label">Method</div>
          <div class="modal-info-val" id="modal-method">—</div>
        </div>
        <div class="modal-info-item">
          <div class="modal-info-label">Account</div>
          <div class="modal-info-val" id="modal-account" style="font-family:monospace;font-size:12px">—</div>
        </div>
      </div>

      <!-- Reason form -->
      <label class="form-label-custom" for="rejectReason">
        Rejection Reason <span style="color:#ef4444">*</span>
      </label>
      <textarea id="rejectReason" class="form-textarea" rows="4"
                placeholder="Explain why this withdrawal is being rejected. The user will be notified with this reason..."
                maxlength="500" oninput="updateCharCount()"></textarea>
      <div class="char-count"><span id="charCount">0</span>/500</div>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeRejectModal()">Cancel</button>
      <form id="rejectForm" method="POST" action="" style="margin:0">
        @csrf
        @method('POST')
        <input type="hidden" name="reason" id="reasonInput">
        <button type="submit" class="btn-reject-confirm" onclick="return prepareReject()">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px"><path d="M4 4l8 8M12 4l-8 8"/></svg>
          Confirm Reject
        </button>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Sidebar toggle
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

// Reject Modal
function openRejectModal(id, userName, amount, method, account) {
  document.getElementById('modal-user-name').textContent = userName || '—';
  document.getElementById('modal-amount').textContent    = '৳' + parseFloat(amount).toFixed(2);
  document.getElementById('modal-method').textContent    = method || '—';
  document.getElementById('modal-account').textContent   = account || '—';
  document.getElementById('rejectReason').value          = '';
  document.getElementById('charCount').textContent       = '0';

  // Set form action dynamically using named route pattern
  var baseUrl = '{{ url("admin/withdraw") }}/' + id + '/reject';
  document.getElementById('rejectForm').action = baseUrl;

  document.getElementById('rejectModal').classList.add('show');
  document.body.style.overflow = 'hidden';
  setTimeout(function(){ document.getElementById('rejectReason').focus(); }, 220);
}

function closeRejectModal() {
  document.getElementById('rejectModal').classList.remove('show');
  document.body.style.overflow = '';
}

// Close on backdrop click
document.getElementById('rejectModal').addEventListener('click', function(e){
  if(e.target === this) closeRejectModal();
});

// Close on Escape key
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape') closeRejectModal();
});

function updateCharCount() {
  var len = document.getElementById('rejectReason').value.length;
  document.getElementById('charCount').textContent = len;
}

function prepareReject() {
  var reason = document.getElementById('rejectReason').value.trim();
  if(!reason) {
    document.getElementById('rejectReason').style.borderColor = '#e11d48';
    document.getElementById('rejectReason').focus();
    return false;
  }
  document.getElementById('reasonInput').value = reason;
  return true;
}
</script>