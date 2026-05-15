<style>
.sidebar{
  width:220px;min-width:220px;background:#fff;border-right:1px solid #e2e8f0;
  display:flex;flex-direction:column;overflow-y:auto;overflow-x:hidden;
  flex-shrink:0;scrollbar-width:thin;scrollbar-color:#e2e8f0 transparent;
}
.sidebar::-webkit-scrollbar{width:4px}
.sidebar::-webkit-scrollbar-track{background:transparent}
.sidebar::-webkit-scrollbar-thumb{background:#e2e8f0;border-radius:4px}

.sb-profile{padding:10px 10px 6px}
.sb-profile-inner{
  padding:10px 12px;background:#eff6ff;border-radius:12px;
  display:flex;align-items:center;gap:10px;
}
.sb-avatar{
  width:32px;height:32px;border-radius:9px;background:#2563eb;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.sb-avatar svg{width:15px;height:15px}
.sb-name{font-size:12px;font-weight:700;color:#1d4ed8;line-height:1.2}
.sb-role{font-size:10px;color:#60a5fa;font-weight:500}

.sb-section{
  padding:14px 14px 4px;font-size:10px;font-weight:700;color:#9333EA;
  text-transform:uppercase;letter-spacing:.8px;
}

.ni{
  display:flex;
  align-items:center;gap:9px;
  padding:8px 10px;
  border-radius:9px;
  margin:1px 8px;
  cursor:pointer;
  font-size:12.5px;
  color:#060606;
  transition:background .15s,
  color .15s;
  text-decoration:none;
  position:relative;
  white-space:nowrap;
}
.ni:hover{background:#f1f5f9;color:#1e293b}
.ni.active{background:#eff6ff;color:#2563eb;font-weight:600}
.ni.active .ni-icon{color:#2563eb}
.ni.active::before{
  content:'';position:absolute;left:-8px;top:50%;transform:translateY(-50%);
  width:3px;height:60%;background:#2563eb;border-radius:0 3px 3px 0;
}

.ni-icon{
  width:30px;height:30px;border-radius:8px;display:flex;align-items:center;
  justify-content:center;flex-shrink:0;color:#94a3b8;transition:color .15s;
  background:transparent;
}
.ni:hover .ni-icon{background:#e2e8f0;color:#475569}
.ni.active .ni-icon{background:#dbeafe}
.ni-icon svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:1.7}

.ni-label{flex:1;font-size:12.5px;line-height:1}

.nbadge{
  font-size:10px;font-weight:700;padding:2px 7px;
  border-radius:20px;flex-shrink:0;
}
.nbadge.red{background:#fee2e2;color:#dc2626}
.nbadge.green{background:#dcfce7;color:#16a34a}
.nbadge.blue{background:#dbeafe;color:#2563eb}
.nbadge.amber{background:#fef9c3;color:#92400e}

.sb-bottom{margin-top:auto;padding:10px 8px;border-top:1px solid #f1f5f9}
.sb-logout{
  display:flex;align-items:center;gap:9px;padding:9px 10px;border-radius:9px;
  cursor:pointer;background:none;border:none;width:100%;
  color:#ef4444;font-size:12.5px;font-weight:500;transition:background .15s;
}
.sb-logout:hover{background:#fff1f2}
.sb-logout .ni-icon{background:#fff1f2;color:#ef4444;width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center}
.sb-logout:hover .ni-icon{background:#fee2e2}
.sb-logout svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:1.7}

</style>

<nav class="sidebar" id="sidebar">

  {{-- Profile Block --}}
  <div class="sb-profile">
    <div class="sb-profile-inner">
      <div class="sb-avatar">
        <svg viewBox="0 0 16 16" fill="none" stroke="#fff" stroke-width="1.8">
          <rect x="2" y="2" width="5" height="5" rx="1.5"/>
          <rect x="9" y="2" width="5" height="5" rx="1.5"/>
          <rect x="2" y="9" width="5" height="5" rx="1.5"/>
          <rect x="9" y="9" width="5" height="5" rx="1.5"/>
        </svg>
      </div>
      <div>
        <div class="sb-name">Admin Panel</div>
        <div class="sb-role">Super Admin</div>
      </div>
    </div>
  </div>

  {{-- Overview --}}
  <div class="sb-section">Overview</div>

  <a href="{{ route('admin.dashboard') }}"
     class="ni {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><rect x="2" y="2" width="5" height="5" rx="1.5"/><rect x="9" y="2" width="5" height="5" rx="1.5"/><rect x="2" y="9" width="5" height="5" rx="1.5"/><rect x="9" y="9" width="5" height="5" rx="1.5"/></svg>
    </div>
    <span class="ni-label">Dashboard</span>
  </a>

  <a href="{{ route('admin.users') }}"
     class="ni {{ request()->routeIs('admin.users') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M2 14a6 6 0 0 1 12 0"/></svg>
    </div>
    <span class="ni-label">Users</span>
    <span class="nbadge blue">{{ App\Models\User::count() }}</span>
  </a>

  {{-- Job Management --}}
  <div class="sb-section">Job Management</div>

  <a href="{{ route('admin.all-jobs') }}"
     class="ni {{ request()->routeIs('admin.all-jobs') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><rect x="2" y="4" width="12" height="9" rx="1.5"/><path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"/></svg>
    </div>
    <span class="ni-label">All Jobs</span>
  </a>

  <a href="{{ route('admin.pending-jobs') }}"
     class="ni {{ request()->routeIs('admin.pending-jobs') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="5.5"/><path d="M8 5v3l2 2"/></svg>
    </div>
    <span class="ni-label">Pending Jobs</span>
    <span class="nbadge amber">{{ App\Models\JobPost::where('status','pending')->count() }}</span>
  </a>

  <a href="{{ route('admin.active-jobs') }}"
     class="ni {{ request()->routeIs('admin.active-jobs') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M3 8l3 3 7-7"/></svg>
    </div>
    <span class="ni-label">Live Jobs</span>
  </a>

  <a href="{{ route('admin.paused-jobs') }}"
     class="ni {{ request()->routeIs('admin.paused-jobs') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><rect x="4" y="3" width="3" height="10" rx="1"/><rect x="9" y="3" width="3" height="10" rx="1"/></svg>
    </div>
    <span class="ni-label">Paused Jobs</span>
  </a>

  <a href="{{ route('admin.rejected-jobs') }}"
     class="ni {{ request()->routeIs('admin.rejected-jobs') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="5.5"/><path d="m5.5 5.5 5 5M10.5 5.5l-5 5"/></svg>
    </div>
    <span class="ni-label">Rejected Jobs</span>
    <span class="nbadge red">{{ App\Models\JobPost::where('status','rejected')->count() }}</span>
  </a>

  <a href="{{ route('admin.completed-jobs') }}"
     class="ni {{ request()->routeIs('admin.completed-jobs') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M2 8a6 6 0 1 0 12 0A6 6 0 0 0 2 8Z"/><path d="m5.5 8 2 2 3-3"/></svg>
    </div>
    <span class="ni-label">Complete Jobs</span>
  </a>

  {{-- Category Setting --}}
  <div class="sb-section">Category Setting</div>

  <a href="{{ route('admin.continent') }}"
     class="ni {{ request()->routeIs('admin.continent') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="5.5"/><path d="M8 2.5S6 5 6 8s2 5.5 2 5.5M8 2.5S10 5 10 8s-2 5.5-2 5.5M2.5 8h11"/></svg>
    </div>
    <span class="ni-label">Continent</span>
  </a>

  <a href="{{ route('admin.country') }}"
     class="ni {{ request()->routeIs('admin.country') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M2 12s1.5-2 4-2 4 2 4 2"/><circle cx="6" cy="6" r="2.5"/><path d="M11 8.5a2 2 0 1 0 0-4"/><path d="M13.5 12c-.5-.7-1.4-1.2-2.5-1.5"/></svg>
    </div>
    <span class="ni-label">Country</span>
  </a>

  <a href="{{ route('admin.category') }}"
     class="ni {{ request()->routeIs('admin.category') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/></svg>
    </div>
    <span class="ni-label">Category</span>
  </a>

  <a href="{{ route('admin.subcategory') }}"
     class="ni {{ request()->routeIs('admin.subcategory') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M2 4h12v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4Z"/><path d="M5 4V3h6v1"/><path d="M5 9h6"/></svg>
    </div>
    <span class="ni-label">Sub Category</span>
  </a>

  {{-- Payment Setting --}}
  <div class="sb-section">Payment Setting</div>

  <a href="{{ route('admin.payment.method') }}"
     class="ni {{ request()->routeIs('admin.payment.method') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><rect x="1.5" y="4" width="13" height="9" rx="1.5"/><path d="M1.5 7h13"/></svg>
    </div>
    <span class="ni-label">Payment Method</span>
  </a>

  {{-- Deposit Manage --}}
  <div class="sb-section">Deposit Manage</div>

  <a href="{{ route('admin.pending-deposit') }}"
     class="ni {{ request()->routeIs('admin.pending-deposit') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M8 3v8M5 8l3 3 3-3"/><rect x="2" y="12" width="12" height="2" rx="1"/></svg>
    </div>
    <span class="ni-label">Pending Deposit</span>
    <span class="nbadge red">{{ App\Models\Deposit::where('status','pending')->count() }}</span>
  </a>

  <a href="{{ route('admin.approved-deposit') }}"
     class="ni {{ request()->routeIs('admin.approved-deposit') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M8 3v8M5 8l3 3 3-3"/><rect x="2" y="12" width="12" height="2" rx="1"/></svg>
    </div>
    <span class="ni-label">Approved Deposit</span>
    <span class="nbadge green">{{ App\Models\Deposit::where('status','approved')->count() }}</span>
  </a>

  <a href="{{ route('admin.rejected-deposit') }}"
     class="ni {{ request()->routeIs('admin.rejected-deposit') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M8 3v8M5 8l3 3 3-3"/><rect x="2" y="12" width="12" height="2" rx="1"/></svg>
    </div>
    <span class="ni-label">Rejected Deposit</span>
    <span class="nbadge red">{{ App\Models\Deposit::where('status','rejected')->count() }}</span>
  </a>

  {{-- Withdraw Manage --}}
  <div class="sb-section">Withdraw Manage</div>

  <a href="{{ route('admin.withdraw.index') }}"
     class="ni {{ request()->routeIs('admin.withdraw.index') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M8 13V5M5 8l3-3 3 3"/><rect x="2" y="2" width="12" height="2" rx="1"/></svg>
    </div>
    <span class="ni-label">All Withdraw</span>
    <span class="nbadge blue">{{ App\Models\Withdraw::count() }}</span>
  </a>

  <a href="{{ route('admin.pending.withdraw') }}"
     class="ni {{ request()->routeIs('admin.pending.withdraw') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="5.5"/><path d="M8 5v3l2 2"/></svg>
    </div>
    <span class="ni-label">Pending Withdraw</span>
    <span class="nbadge amber">{{ App\Models\Withdraw::where('status','pending')->count() }}</span>
  </a>

  <a href="{{ route('admin.approved.withdraw') }}"
     class="ni {{ request()->routeIs('admin.approved.withdraw') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M3 8l3 3 7-7"/></svg>
    </div>
    <span class="ni-label">Approved Withdraw</span>
    <span class="nbadge green">{{ App\Models\Withdraw::where('status','approved')->count() }}</span>
  </a>

  <a href="{{ route('admin.reject.withdraw') }}"
     class="ni {{ request()->routeIs('admin.reject.withdraw') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="5.5"/><path d="m5.5 5.5 5 5M10.5 5.5l-5 5"/></svg>
    </div>
    <span class="ni-label">Rejected Withdraw</span>
    <span class="nbadge red">{{ App\Models\Withdraw::where('status','rejected')->count() }}</span>
  </a>

    {{-- Banner Manage --}}
  <div class="sb-section">Banner Manage</div>

  <a href="{{route('admin.banners')}}"
     class="ni {{ request()->routeIs('admin.banners') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M8 13V5M5 8l3-3 3 3"/><rect x="2" y="2" width="12" height="2" rx="1"/></svg>
    </div>
    <span class="ni-label">Banner</span>
    <span class="nbadge blue">{{App\Models\Banner::where('status','pending')->count()}}</span>
  </a>


  {{-- Notice Manage --}}
  <div class="sb-section">Notice Manage</div>

  <a href="{{ route('admin.notice-create') }}"
     class="ni {{ request()->routeIs('admin.notice-create') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><path d="M8 1.5a5 5 0 0 1 5 5v2l1 2H2l1-2v-2a5 5 0 0 1 5-5Z"/><path d="M6.5 13.5a1.5 1.5 0 0 0 3 0"/></svg>
    </div>
    <span class="ni-label">Notice</span>
  </a>

  {{-- System --}}
  <div class="sb-section">System</div>

  <a href="{{ route('admin.setting') }}"
     class="ni {{ request()->routeIs('admin.setting') ? 'active' : '' }}">
    <div class="ni-icon">
      <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="2.5"/><path d="M8 2v1.5M8 12.5V14M2 8h1.5M12.5 8H14M3.6 3.6l1 1M11.4 11.4l1 1M3.6 12.4l1-1M11.4 4.6l1-1"/></svg>
    </div>
    <span class="ni-label">Setting</span>
  </a>

  {{-- Logout --}}
  <div class="sb-bottom">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="sb-logout">
        <div class="ni-icon">
          <svg viewBox="0 0 16 16"><path d="M6 2H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3M10 11l3-3-3-3M13 8H6"/></svg>
        </div>
        <span>Logout</span>
      </button>
    </form>
  </div>

</nav>