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
.overlay{display:none;position:fixed;inset:0;top:52px;background:rgba(0,0,0,.45);z-index:40}
.main{flex:1;overflow-y:auto;padding:20px;min-width:0}
@media(max-width:640px){
  .sidebar{position:fixed;top:52px;left:0;height:calc(100% - 52px);z-index:50;transform:translateX(-100%);transition:transform .25s ease;min-width:200px;width:200px}
  .sidebar.mob-open{transform:translateX(0)}
  .overlay.show{display:block}
  .tb-search{display:none}
}
@media(min-width:641px){.hbtn{display:none}.overlay{display:none!important}}

/* PAGE SPECIFIC */
.page-header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:20px}
.page-title{font-size:18px;font-weight:700;color:#0f172a;letter-spacing:-.3px}
.page-sub{font-size:12px;color:#64748b;margin-top:2px}

/* FILTER BAR */
.filter-bar{background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px 16px;margin-bottom:16px;display:flex;flex-wrap:wrap;align-items:center;gap:10px}
.filter-bar form{display:flex;flex-wrap:wrap;gap:10px;align-items:center;width:100%}
.filter-group{display:flex;flex-direction:column;gap:4px}
.filter-label{font-size:10px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px}
.filter-select,.filter-input{
  height:34px;padding:0 10px;border:1px solid #e2e8f0;border-radius:8px;
  font-size:12px;color:#0f172a;background:#f8fafc;outline:none;
  transition:border .15s;
}
.filter-select:focus,.filter-input:focus{border-color:#2563eb;background:#fff}
.filter-input{width:180px}
.btn-filter{height:34px;padding:0 16px;border-radius:8px;border:none;cursor:pointer;font-size:12px;font-weight:600;transition:background .15s}
.btn-filter.apply{background:#2563eb;color:#fff}
.btn-filter.apply:hover{background:#1d4ed8}
.btn-filter.reset{background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0}
.btn-filter.reset:hover{background:#e2e8f0}
.filter-pills{display:flex;gap:6px;flex-wrap:wrap;margin-left:auto}
.fpill{padding:5px 12px;border-radius:20px;font-size:11px;font-weight:600;border:1.5px solid transparent;cursor:pointer;text-decoration:none;transition:all .15s}
.fpill:hover{opacity:.85}
.fpill.all{background:#f1f5f9;color:#475569;border-color:#e2e8f0}
.fpill.pending{background:#fef9c3;color:#854d0e;border-color:#fde047}
.fpill.active{background:#dcfce7;color:#15803d;border-color:#86efac}
.fpill.inactive{background:#f1f5f9;color:#475569;border-color:#cbd5e1}
.fpill.expired{background:#fee2e2;color:#991b1b;border-color:#fca5a5}
.fpill.rejected{background:#fce7f3;color:#9d174d;border-color:#f9a8d4}
.fpill.sel{box-shadow:0 0 0 2px currentColor}

/* STATS ROW */
.bstats{display:grid;grid-template-columns:repeat(5,1fr);gap:10px;margin-bottom:16px}
.bsc{background:#fff;border:1px solid #e2e8f0;border-radius:10px;padding:12px 14px;text-align:center}
.bsc .bval{font-size:20px;font-weight:700;line-height:1}
.bsc .blbl{font-size:10px;color:#94a3b8;margin-top:4px;text-transform:uppercase;letter-spacing:.4px}

/* TABLE CARD */
.tcard{background:#fff;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden}
.tcard-head{padding:14px 16px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between}
.tcard-title{font-size:13px;font-weight:600}
.tcard-count{font-size:11px;color:#94a3b8}

.btable{width:100%;border-collapse:collapse;font-size:12px}
.btable th{padding:9px 12px;text-align:left;font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;background:#fafafa;border-bottom:1px solid #f1f5f9}
.btable td{padding:11px 12px;border-bottom:1px solid #f8fafc;vertical-align:middle}
.btable tr:last-child td{border-bottom:none}
.btable tr:hover td{background:#fafafa}

.thumb-wrap{width:72px;height:40px;border-radius:6px;overflow:hidden;background:#f1f5f9;flex-shrink:0}
.thumb-wrap img{width:100%;height:100%;object-fit:cover}
.thumb-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#cbd5e1;font-size:18px}

.user-cell{display:flex;align-items:center;gap:8px}
.user-av{width:28px;height:28px;border-radius:50%;background:#eff6ff;color:#2563eb;font-size:9px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}

.status-badge{display:inline-flex;align-items:center;gap:4px;padding:3px 9px;border-radius:20px;font-size:10px;font-weight:700}
.status-badge::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0}
.sb-pending{background:#fef9c3;color:#854d0e}.sb-pending::before{background:#eab308}
.sb-active{background:#dcfce7;color:#15803d}.sb-active::before{background:#22c55e}
.sb-inactive{background:#f1f5f9;color:#475569}.sb-inactive::before{background:#94a3b8}
.sb-expired{background:#fee2e2;color:#991b1b}.sb-expired::before{background:#ef4444}
.sb-rejected{background:#fce7f3;color:#9d174d}.sb-rejected::before{background:#ec4899}

.act-btns{display:flex;gap:5px;flex-wrap:wrap}
.abtn{display:inline-flex;align-items:center;gap:4px;padding:5px 10px;border-radius:7px;font-size:11px;font-weight:600;border:none;cursor:pointer;transition:background .15s;text-decoration:none;white-space:nowrap}
.abtn svg{width:11px;height:11px;stroke:currentColor;fill:none;stroke-width:2}
.abtn-approve{background:#dcfce7;color:#15803d}.abtn-approve:hover{background:#bbf7d0}
.abtn-inactive{background:#f1f5f9;color:#475569;border:1px solid #e2e8f0}.abtn-inactive:hover{background:#e2e8f0}
.abtn-reject{background:#fce7f3;color:#9d174d}.abtn-reject:hover{background:#fbcfe8}
.abtn-delete{background:#fee2e2;color:#991b1b}.abtn-delete:hover{background:#fecaca}

.link-cell{max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#2563eb;font-size:11px}
.meta-cell{font-size:11px;color:#64748b}
.clicks-cell{font-size:12px;font-weight:600;color:#0f172a}

@media(max-width:768px){
  .bstats{grid-template-columns:repeat(2,1fr)}
  .btable thead{display:none}
  .btable tr{display:block;border:1px solid #e2e8f0;border-radius:10px;margin-bottom:10px;padding:10px}
  .btable td{display:flex;justify-content:space-between;align-items:center;padding:5px 0;border-bottom:1px solid #f8fafc;font-size:11px}
  .btable td::before{content:attr(data-label);font-weight:600;color:#94a3b8;font-size:10px;text-transform:uppercase;letter-spacing:.4px;margin-right:8px}
  .btable td:last-child{border-bottom:none}
  .act-btns{justify-content:flex-end}
}
</style>

<div class="app">
  <div class="topbar">
    <button class="hbtn" id="hbtn" onclick="toggleSB()">
      <span></span><span></span><span></span>
    </button>
    <div class="logo">Onetask<em>Market</em>
      <span style="font-size:10px;background:#eff6ff;color:#2563eb;padding:2px 6px;border-radius:4px;font-weight:600;margin-left:2px">Admin</span>
    </div>
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

    @include('admin.layouts.sidebar')

    <main class="main">

      {{-- PAGE HEADER --}}
      <div class="page-header">
        <div>
          <div class="page-title">Banner Management</div>
          <div class="page-sub">Manage all user-submitted banner advertisements</div>
        </div>
      </div>

      {{-- SUCCESS ALERT --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="border-radius:10px;font-size:13px">
          <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;vertical-align:middle"><path d="M3 8l3 3 7-7"/></svg>
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" style="border-radius:10px;font-size:13px">
          {{ session('error') }}
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
      @endif

      {{-- MINI STATS --}}
      <div class="bstats">
        <div class="bsc">
          <div class="bval">{{ $counts['all'] }}</div>
          <div class="blbl">Total</div>
        </div>
        <div class="bsc">
          <div class="bval" style="color:#eab308">{{ $counts['pending'] }}</div>
          <div class="blbl">Pending</div>
        </div>
        <div class="bsc">
          <div class="bval" style="color:#22c55e">{{ $counts['active'] }}</div>
          <div class="blbl">Active</div>
        </div>
        <div class="bsc">
          <div class="bval" style="color:#ef4444">{{ $counts['expired'] }}</div>
          <div class="blbl">Expired</div>
        </div>
        <div class="bsc">
          <div class="bval" style="color:#ec4899">{{ $counts['rejected'] }}</div>
          <div class="blbl">Rejected</div>
        </div>
      </div>

      {{-- FILTER BAR --}}
      <div class="filter-bar">
        <form method="GET" action="{{ route('admin.banners') }}">
          {{-- Search --}}
          <div class="filter-group">
            <span class="filter-label">Search</span>
            <input type="text" name="search" class="filter-input"
              placeholder="Title, user, code..."
              value="{{ request('search') }}">
          </div>

          {{-- Position --}}
          <div class="filter-group">
            <span class="filter-label">Position</span>
            <select name="position" class="filter-select" style="min-width:120px">
              <option value="">All Positions</option>
              <option value="top" {{ request('position')=='top'?'selected':'' }}>Top</option>
              <option value="sidebar" {{ request('position')=='sidebar'?'selected':'' }}>Sidebar</option>
              <option value="bottom" {{ request('position')=='bottom'?'selected':'' }}>Bottom</option>
              <option value="popup" {{ request('position')=='popup'?'selected':'' }}>Popup</option>
            </select>
          </div>

          {{-- Status --}}
          <div class="filter-group">
            <span class="filter-label">Status</span>
            <select name="status" class="filter-select" style="min-width:110px">
              <option value="">All Status</option>
              <option value="pending"  {{ request('status')=='pending' ?'selected':'' }}>Pending</option>
              <option value="active"   {{ request('status')=='active'  ?'selected':'' }}>Active</option>
              <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactive</option>
              <option value="expired"  {{ request('status')=='expired' ?'selected':'' }}>Expired</option>
              <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
            </select>
          </div>

          {{-- Sort --}}
          <div class="filter-group">
            <span class="filter-label">Sort</span>
            <select name="sort" class="filter-select" style="min-width:120px">
              <option value="latest"  {{ request('sort','latest')=='latest' ?'selected':'' }}>Latest First</option>
              <option value="oldest"  {{ request('sort')=='oldest' ?'selected':'' }}>Oldest First</option>
              <option value="clicks"  {{ request('sort')=='clicks'  ?'selected':'' }}>Most Clicks</option>
              <option value="price"   {{ request('sort')=='price'   ?'selected':'' }}>Highest Price</option>
            </select>
          </div>

          <div style="display:flex;gap:6px;margin-top:18px">
            <button type="submit" class="btn-filter apply">
              <svg width="11" height="11" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;vertical-align:middle"><circle cx="6.5" cy="6.5" r="4.5"/><path d="m10 10 3.5 3.5"/></svg>Filter
            </button>
            <a href="{{ route('admin.banners') }}" class="btn-filter reset" style="display:inline-flex;align-items:center;text-decoration:none">Reset</a>
          </div>

          {{-- Quick pill filters --}}
          <div class="filter-pills" style="margin-top:18px">
            <a href="{{ route('admin.banners') }}"
               class="fpill all {{ !request('status') ? 'sel' : '' }}">All ({{ $counts['all'] }})</a>
            <a href="{{ route('admin.banners',['status'=>'pending']) }}"
               class="fpill pending {{ request('status')=='pending' ? 'sel' : '' }}">Pending ({{ $counts['pending'] }})</a>
            <a href="{{ route('admin.banners',['status'=>'active']) }}"
               class="fpill active {{ request('status')=='active' ? 'sel' : '' }}">Active ({{ $counts['active'] }})</a>
            <a href="{{ route('admin.banners',['status'=>'inactive']) }}"
               class="fpill inactive {{ request('status')=='inactive' ? 'sel' : '' }}">Inactive ({{ $counts['inactive'] }})</a>
            <a href="{{ route('admin.banners',['status'=>'expired']) }}"
               class="fpill expired {{ request('status')=='expired' ? 'sel' : '' }}">Expired ({{ $counts['expired'] }})</a>
            <a href="{{ route('admin.banners',['status'=>'rejected']) }}"
               class="fpill rejected {{ request('status')=='rejected' ? 'sel' : '' }}">Rejected ({{ $counts['rejected'] }})</a>
          </div>
        </form>
      </div>

      {{-- TABLE --}}
      <div class="tcard">
        <div class="tcard-head">
          <div class="tcard-title">Banners</div>
          <div class="tcard-count">{{ $banners->total() }} results</div>
        </div>

        <div style="overflow-x:auto">
          <table class="btable">
            <thead>
              <tr>
                <th>#</th>
                <th>Thumbnail</th>
                <th>Title / Code</th>
                <th>Posted By</th>
                <th>Position</th>
                <th>Price</th>
                <th>Days</th>
                <th>Clicks</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($banners as $i => $banner)
              <tr>
                <td data-label="#">{{ $banners->firstItem() + $i }}</td>

                <td data-label="Thumb">
                  <div class="thumb-wrap">
                    @if($banner->thumbnail)
                      <img src="{{ asset('storage/'.$banner->thumbnail) }}" alt="thumb">
                    @else
                      <div class="thumb-placeholder">🖼</div>
                    @endif
                  </div>
                </td>

                <td data-label="Title">
                  <div style="font-weight:600;font-size:12px;color:#0f172a">{{ Str::limit($banner->title,28) }}</div>
                  <div style="font-size:10px;color:#94a3b8;margin-top:2px;font-family:monospace">{{ $banner->code }}</div>
                  @if($banner->link)
                    <a href="{{ $banner->link }}" target="_blank" class="link-cell" title="{{ $banner->link }}">
                      ↗ {{ Str::limit($banner->link,22) }}
                    </a>
                  @endif
                </td>

                <td data-label="Posted By">
                  <div class="user-cell">
                    <div class="user-av">{{ strtoupper(substr($banner->user->name,0,2)) }}</div>
                    <div>
                      <div style="font-size:12px;font-weight:500">{{ $banner->user->name }}</div>
                      <div style="font-size:10px;color:#94a3b8">{{ $banner->user->email }}</div>
                    </div>
                  </div>
                </td>

                <td data-label="Position">
                  <span style="font-size:11px;background:#f1f5f9;padding:3px 8px;border-radius:6px;color:#475569;font-weight:600;text-transform:capitalize">
                    {{ $banner->position ?? '—' }}
                  </span>
                </td>

                <td data-label="Price">
                  <span style="font-weight:600;color:#0f172a">${{ number_format($banner->price,2) }}</span>
                </td>

                <td data-label="Days" class="meta-cell">
                  {{ $banner->days }}d
                  @if($banner->approved_at)
                    <div style="font-size:10px;color:#94a3b8">from {{ \Carbon\Carbon::parse($banner->approved_at)->format('M d') }}</div>
                  @endif
                </td>

                <td data-label="Clicks">
                  <div class="clicks-cell">{{ number_format($banner->clicks) }}</div>
                  <div style="font-size:10px;color:#94a3b8">{{ number_format($banner->impressions) }} imp.</div>
                </td>

                <td data-label="Status">
                  <span class="status-badge sb-{{ $banner->status }}">{{ ucfirst($banner->status) }}</span>
                  @if($banner->status === 'rejected' && $banner->rejected_reason)
                    <div style="font-size:10px;color:#9d174d;margin-top:3px" title="{{ $banner->rejected_reason }}">
                      ⚠ {{ Str::limit($banner->rejected_reason,20) }}
                    </div>
                  @endif
                </td>

                <td data-label="Actions">
                  <div class="act-btns">
                    {{-- Approve / Activate --}}
                    @if(in_array($banner->status, ['pending','inactive','expired']))
                      <a href="{{ route('admin.banner.approve', $banner->id) }}"
                         onclick="return confirm('Approve this banner?')"
                         class="abtn abtn-approve">
                        <svg viewBox="0 0 16 16"><path d="M3 8l3 3 7-7"/></svg> Approve
                      </a>
                    @endif

                    {{-- Deactivate --}}
                    @if($banner->status === 'active')
                      <a href="{{ route('admin.banner.inactive', $banner->id) }}"
                         onclick="return confirm('Deactivate this banner?')"
                         class="abtn abtn-inactive">
                        <svg viewBox="0 0 16 16"><rect x="4" y="3" width="3" height="10" rx="1"/><rect x="9" y="3" width="3" height="10" rx="1"/></svg> Inactive
                      </a>
                    @endif

                    {{-- Reject --}}
                    @if(!in_array($banner->status, ['rejected']))
                      <button class="abtn abtn-reject rejectBtn"
                        data-id="{{ $banner->id }}">
                        <svg viewBox="0 0 16 16"><path d="m4 4 8 8M12 4l-8 8"/></svg> Reject
                      </button>
                    @endif

                    {{-- Delete --}}
                    <a href="{{ route('admin.banner.delete', $banner->id) }}"
                       onclick="return confirm('Permanently delete this banner?')"
                       class="abtn abtn-delete">
                      <svg viewBox="0 0 16 16"><path d="M3 4h10M5 4V3h6v1M6 7v5M10 7v5"/><rect x="4" y="4" width="8" height="9" rx="1.5"/></svg> Delete
                    </a>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="10" style="text-align:center;padding:40px;color:#94a3b8;font-size:13px">
                  <div style="font-size:32px;margin-bottom:8px">📭</div>
                  No banners found for the selected filters.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- PAGINATION --}}
        @if($banners->hasPages())
          <div style="padding:14px 16px;border-top:1px solid #f1f5f9">
            {{ $banners->appends(request()->query())->links() }}
          </div>
        @endif
      </div>

    </main>
  </div>
</div>

{{-- ═══════════════════════════════════════
     REJECT MODAL
════════════════════════════════════════ --}}
<div class="modal fade" id="rejectModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('admin.banner.reject') }}" method="POST">
      @csrf
      <input type="hidden" name="id" id="reject_id">
      <div class="modal-content" style="border-radius:14px;border:none;box-shadow:0 20px 60px rgba(0,0,0,.15)">
        <div class="modal-header" style="border-bottom:1px solid #f1f5f9;padding:16px 20px">
          <h5 style="font-size:14px;font-weight:700;color:#0f172a;margin:0">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="#e11d48" stroke-width="2" style="margin-right:6px;vertical-align:middle"><path d="m4 4 8 8M12 4l-8 8"/></svg>
            Reject Banner
          </h5>
          <button type="button" class="close" data-dismiss="modal" style="font-size:18px">&times;</button>
        </div>
        <div class="modal-body" style="padding:20px">
          <div class="form-group mb-0">
            <label style="font-size:12px;font-weight:600;color:#374151;margin-bottom:6px;display:block">
              Rejection Reason <span style="color:#ef4444">*</span>
            </label>
            <textarea name="rejected_reason" rows="4" required
              placeholder="Explain why this banner is being rejected..."
              style="width:100%;border:1px solid #e2e8f0;border-radius:9px;padding:10px 12px;font-size:13px;outline:none;resize:vertical;font-family:inherit;color:#0f172a"
              onfocus="this.style.borderColor='#2563eb'"
              onblur="this.style.borderColor='#e2e8f0'"></textarea>
          </div>
        </div>
        <div class="modal-footer" style="border-top:1px solid #f1f5f9;padding:12px 20px;gap:8px">
          <button type="button" class="btn btn-sm btn-light" data-dismiss="modal" style="border-radius:8px;font-size:12px">Cancel</button>
          <button type="submit" class="btn btn-sm btn-danger" style="border-radius:8px;font-size:12px;font-weight:600">Reject Banner</button>
        </div>
      </div>
    </form>
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

$(document).on('click','.rejectBtn',function(){
  $('#reject_id').val($(this).data('id'));
  $('#rejectModal').modal('show');
});
</script>