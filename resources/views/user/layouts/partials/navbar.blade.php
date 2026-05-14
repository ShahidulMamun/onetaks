<style>
:root {
  --brand:       #155c35;
  --brand-mid:   #1e8a52;
  --brand-light: #e6f4ed;
  --accent:      #f59e0b;
  --bg:          #f2f7f4;
  --border:      #d5e8dc;
  --txt:         #182820;
  --muted:       #627a6c;
}

/* ═════════ ROW 1 — NAVBAR ═════════ */
.top-nav {
  background: #fff;
  min-height: 54px;
  padding: 0 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: nowrap;
  z-index: 1050;
  box-shadow: 0 1px 6px rgba(0,0,0,0.08);
  gap: 8px;
}

/* Brand */
.nav-brand { display: flex; align-items: center; flex-shrink: 0; }
.footer-logo { display: flex; align-items: center; gap: 8px; text-decoration: none; }
.footer-logo img { height: 36px; width: auto; object-fit: contain; }
.logo-clickers { color: #006a4e; font-weight: 700; font-size: 15px; white-space: nowrap; }

/* Desktop nav links */
.nav-links { display: flex; align-items: center; gap: 4px; flex-shrink: 0; }
.nav-links a {
  color: #444; text-decoration: none; font-size: 13px;
  padding: 6px 10px; border-radius: 20px; transition: 0.2s; white-space: nowrap;
}
.nav-links a:hover, .nav-links a.active {
  background: rgba(0,106,78,0.08); color: #D32031;
}

/* Right side — equal spacing সব item-এর মাঝে */
.nav-right {
  display: flex;
  align-items: center;
  gap: 8px;           /* সব item-এর মাঝে equal gap */
  margin-left: auto;
  flex-shrink: 0;
  flex-wrap: nowrap;
}

/* notification li এর extra margin সরানো */
.nav-right .nav-item {
  display: flex;
  align-items: center;
  margin: 0;
  padding: 0;
}

.nav-right .nav-link {
  padding: 4px 6px !important;
  display: flex;
  align-items: center;
  color: #444;
  font-size: 18px;
}

/* Buttons */
.btn-post {
  background: #006a4e; color: #fff !important; border-radius: 80px;
  font-size: 12px !important; font-weight: 600; padding: 7px 14px;
  border: none; text-decoration: none; white-space: nowrap;
  display: flex; align-items: center; gap: 5px; transition: 0.2s;
}
.btn-post:hover { background: #005040; color: #fff !important; }

.btn-job {
  background: #fff; text-decoration: none; color: #006a4e !important;
  border-radius: 40px; font-size: 12px !important; font-weight: 600;
  padding: 6px 12px; border: 1px solid #006a4e; white-space: nowrap;
  display: flex; align-items: center; gap: 4px;
}
.btn-job:hover { background: #e6f4ed; }

/* User dropdown button */
.user-btn {
  display: flex; align-items: center; gap: 6px; background: none;
  border: none; font-weight: 700; font-size: 13px; cursor: pointer;
  color: #006a4e; padding: 4px 6px; border-radius: 8px;
}
.user-btn:hover { background: rgba(0,106,78,0.07); }
.user-btn img { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; }
.user-name-label { max-width: 90px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

/* Dropdown */
.dropdown-menu {
  border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.12);
  border: 1px solid #eee; min-width: 220px; padding: 8px 0;
}
.dropdown-item {
  font-weight: 600; color: #6c757d; padding: 8px 18px;
  display: flex; align-items: center; gap: 10px; font-size: 13px;
}
.dropdown-item:hover { background: #f5f5f5; color: #006a4e; }
.dropdown-item i { color: #1a7f5a; width: 16px; text-align: center; }

/* Three dot toggle (mobile/tablet) */
.three-dot-trigger {
  background: none; border: 1px solid #ccc; color: #444;
  padding: 5px 9px; border-radius: 8px; cursor: pointer; flex-shrink: 0;
  display: none; align-items: center;
}
.three-dot-trigger:hover { background: #f0f0f0; }

/* Responsive visibility */
@media (max-width: 991.98px) {
  .nav-links { display: none !important; }
  .three-dot-trigger { display: flex !important; }
  .user-name-label { display: none; }
  .d-desktop-only { display: none !important; }
}

/* Mobile: সব দেখাবে */
@media (max-width: 575px) {
  .btn-post {
    padding: 6px 10px;
    font-size: 11px !important;
    gap: 4px;
  }
  .btn-job {
    padding: 5px 9px;
    font-size: 11px !important;
  }
  .btn-post-label { display: inline !important; }
  .top-nav { padding: 0 6px; gap: 4px; }
  .nav-right { gap: 6px; }  /* mobile-এও equal gap */
}

/* Very small phones */
@media (max-width: 360px) {
  .btn-post { padding: 5px 8px; font-size: 10px !important; }
  .footer-logo img { height: 28px; }
}

@media (min-width: 992px) {
  .three-dot-trigger { display: none !important; }
}

/* ═════════ ROW 2 — STATS BAR ═════════ */
.stats-bar {
  background: #F2F0F6;
  padding: 7px 10px;
  display: flex;
  gap: 6px;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap; /* সব সময় 1 row */
  overflow-x: auto;  /* ছোট screen-এ scroll হবে কিন্তু ভাঙবে না */
}

.stat-pill {
  display: flex;
  align-items: center;
  gap: 5px;
  padding: 5px 12px;
  border-radius: 20px;
  font-weight: 600;
  font-size: .88rem;
  white-space: nowrap;
  flex-shrink: 0;
}

.stat-pending {
  background: #fff8e1; color: #b8860b; border: 1px solid #ffe082;
}
.stat-earned {
  background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7;
}
.stat-deposit {
  background: #e3f2fd; color: #1565c0; border: 1px solid #90caf9;
}

@media (max-width: 480px) {
  .stat-pill { padding: 4px 8px; font-size: 11px; gap: 3px; }
  .stats-bar { gap: 4px; padding: 5px 6px; }
}

@media (max-width: 360px) {
  .stat-pill { padding: 4px 6px; font-size: 10px; gap: 2px; }
  .stat-pill i { font-size: 10px; }
  .stats-bar { gap: 3px; padding: 5px 4px; }
}

/* ═════════ BREAKING NEWS ═════════ */
.breaking-outer {
  background: #006A4E;
  padding: 8px 0;
  width: 80%;
  margin: auto;
  font-size: 12px;

}
.breaking-wrapper {
  display: flex;
  align-items: center;
  color: #fff;
  overflow: hidden;
  max-width: 860px;
  margin: 0 auto;
  padding: 0 20px;
}
.breaking-label {
  color: #fff;
  font-weight: bold;
  margin-right: 15px;
  white-space: nowrap;
  flex-shrink: 0;
}
.scroll-container {
  overflow: hidden;
  flex: 1;
}
.scroll-content {
  display: inline-block;
  white-space: nowrap;
  animation: scroll-left 20s linear infinite;
}
.notice-item {
  margin-right: 50px;
  display: inline-block;
}
@keyframes scroll-left {
  0%   { transform: translateX(100%); }
  100% { transform: translateX(-100%); }
}

@media (max-width: 575px) {
  .breaking-wrapper { padding: 0 10px; }
}

/* ═════════ OFFCANVAS — page top থেকে, navbar-এর উপরে ═════════ */
#rightMenu {
  width: 290px;
  top: 0 !important;
  height: 100dvh !important;
  position: fixed !important;
  z-index: 1060 !important;   /* navbar (1050) এর চেয়ে বেশি, তাই উপরে থাকবে */
}
@media (max-width: 400px) { #rightMenu { width: 100%; } }
.offcanvas { transition: transform 0.35s cubic-bezier(0.22,1,0.36,1); }
.offcanvas-backdrop.show {
  backdrop-filter: blur(4px);
  background: rgba(0,0,0,0.3);
  z-index: 1055 !important;
}

.oc-top { background: #006a4e; padding: 18px; position: relative; }
.oc-name { color: #d1fae5; font-weight: 700; display: flex; align-items: center; gap: 10px; margin-top: 6px; }
.oc-email { color: #6ee7b7; font-size: 12px; margin-top: 4px; }

/* Stats inside offcanvas */
.oc-stats-row {
  display: flex; gap: 6px; flex-wrap: wrap;
  padding: 10px 14px; background: #f9fafb;
  border-bottom: 1px solid var(--border);
}
.oc-stat-pill { display: flex; align-items: center; gap: 4px; padding: 5px 10px; border-radius: 20px; font-weight: 600; font-size: 11px; }
.oc-stat-pill.stat-pending { background:#fff8e1; color:#b8860b; border:1px solid #ffe082; }
.oc-stat-pill.stat-earned  { background:#e8f5e9; color:#2e7d32; border:1px solid #a5d6a7; }
.oc-stat-pill.stat-deposit { background:#e3f2fd; color:#1565c0; border:1px solid #90caf9; }

.offcanvas-body { padding: 10px 0; background: #fff; }
.sec-lbl { font-size: 10px; font-weight: 700; color: var(--muted); padding: 12px 18px 5px; text-transform: uppercase; }
.oc-item {
  display: flex; align-items: center; gap: 12px; padding: 11px 18px;
  background: none; border: none; width: 100%; cursor: pointer;
  color: var(--txt); text-decoration: none; transition: 0.2s;
}
.oc-item:hover { background: var(--brand-light); }
.oc-ico { width: 34px; height: 34px; border-radius: 10px; background: var(--brand-light); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.oc-divider { height: 1px; background: var(--border); margin: 6px 18px; }
.oc-item.danger:hover { background: #fde8e8; }
</style>

<!-- ══════════════════════════════════
     ROW 1 — NAVBAR
══════════════════════════════════ -->
<nav class="top-nav navbar navbar-expand-lg bg-white">

  <!-- Logo -->
  @php $setting = App\Models\WebsiteSetting::first(); @endphp
  <div class="nav-brand">
    <a class="footer-logo" href="{{ route('user.dashboard') }}">
      <img src="{{ asset('storage/app/public/'.$setting->site_logo) }}" alt="Logo">
      <span class="logo-clickers d-none d-md-inline">{{ $setting->site_title }}</span>
    </a>
  </div>

  <!-- Desktop Nav Links -->
  <div class="nav-links fw-bold">
    <a class="active" href="{{ route('user.dashboard') }}"><i class="fa fa-home"></i> Home</a>
    <a href="{{ route('user.find.jobs') }}"><i class="fa fa-search"></i> Find Jobs</a>
    <a href="{{ route('user.my.jobs') }}"><i class="fa fa-shopping-bag"></i> My Jobs</a>
    <a href="{{ route('user.finished.jobs') }}"><i class="fa fa-check-circle-o"></i> Finished Jobs</a>
    <div class="dropdown">
      <button class="user-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-users"></i> Browse Deal
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('user.browse.deal') }}">Browse Deal</a></li>
        <li><a class="dropdown-item" href="{{ route('user.deal.create') }}">Post Deal</a></li>
        <li><a class="dropdown-item" href="{{ route('user.my.deal.post') }}">My Deal Post</a></li>
        <li><a class="dropdown-item" href="{{ route('user.deal.order') }}">My Order</a></li>
      </ul>
    </div>
    <a href="{{ route('user.deposit') }}"><i class="fa fa-usd"></i> Deposit</a>
  </div>

  <!-- Right Side -->
  <div class="nav-right">

    <!-- Post a Job -->
    <a class="btn btn-post" href="{{ route('user.create.job') }}">
      <i class="fa fa-plus-circle"></i>
      <span class="btn-post-label">Post a Job</span>
    </a>

    <!-- Find Jobs (mobile + tablet, hide on desktop) -->
    <a class="btn-job d-flex d-lg-none" href="{{ route('user.find.jobs') }}">
      <i class="fa fa-search"></i> Find Jobs
    </a>

    <!-- Bell Notification -->
    @php
      $notifications = App\Models\UserNotification::where('user_id', Auth::user()->id)
        ->where('status','pending')->orderBy('id','desc')->get();
    @endphp
    <li class="nav-item dropdown" style="list-style:none;">
      <a class="nav-link position-relative px-2" href="#" id="notificationDropdown"
         role="button" data-bs-toggle="dropdown" aria-expanded="false"
         style="color:#444; font-size:18px;">
        <i class="fa fa-bell"></i>
        @if($notifications->count() > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:9px;">
            {{ $notifications->count() }}
          </span>
        @endif
      </a>
      <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2"
          aria-labelledby="notificationDropdown"
          style="width:300px; max-height:380px; overflow-y:auto;">
        <li class="dropdown-header fw-bold">Notifications</li>
        @forelse($notifications as $notification)
          <li>
            <a href="javascript:void(0)"
               class="dropdown-item notification-item {{ $notification->status=='pending' ? 'bg-light' : '' }}"
               data-id="{{ $notification->id }}"
               data-title="{{ $notification->title }}"
               data-message="{{ $notification->message }}"
               data-time="{{ $notification->created_at->diffForHumans() }}"
               data-bs-toggle="modal" data-bs-target="#notificationModal">
              <div class="fw-bold" style="font-size:12px;">{{ Str::limit($notification->title, 35) }}</div>
              <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </a>
          </li>
        @empty
          <li class="text-center text-muted py-3" style="font-size:13px;">No notifications found</li>
        @endforelse
      </ul>
    </li>

    <!-- User Dropdown (desktop only) -->
    <div class="dropdown d-none d-lg-flex">
      <button class="user-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        @if(Auth::user()->photo)
        <img src="{{ asset('storage/'.Auth::user()->photo) }}" alt="avatar">
        @else
          <img src="{{ asset('storage/avatar.png') }}" alt="avatar">
        @endif
        <span class="user-name-label">{{ Auth::user()->name }}</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><span class="text-muted fw-bold px-3 py-2 d-block" style="font-size:.8rem;">Welcome!</span></li>
        <li><hr class="dropdown-divider my-1"/></li>
        <li><a class="dropdown-item" href="{{ route('article') }}"><i class="fa fa-pencil-square-o"></i> Article</a></li>
        <li><a class="dropdown-item" href="{{ route('user.unseen-notifications') }}"><i class="fa fa-bell-o"></i> Notification</a></li>
        <li><a class="dropdown-item" href="{{ route('user.find.jobs') }}"><i class="fa fa-search-plus"></i> Find job</a></li>
        <li><a class="dropdown-item" href="#"><i class="fa fa-gift"></i> Refer &amp; Earn</a></li>
        <li><a class="dropdown-item" href="{{ route('user.withdraw') }}"><i class="fa fa-usd"></i> Withdraw</a></li>
        <li><a class="dropdown-item" href="{{ route('user.deposit') }}"><i class="fa fa-plus-circle"></i> Deposit</a></li>
        <li><a class="dropdown-item" href=""><i class="fa fa-info"></i> Support</a></li>
        <li><a class="dropdown-item" href=""><i class="fa fa-file-image-o"></i> My Banner</a></li>
        <li><a class="dropdown-item" href=""><i class="fa fa-users"></i> Top Freelancer</a></li>
        <li><a class="dropdown-item" href=""><i class="fa fa-lock"></i> Privacy &amp; Security</a></li>
        <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa fa-cogs"></i> Setting</a></li>
        <li><a class="dropdown-item" href=""><i class="fa fa-trash-o"></i> Delete Account</a></li>
        <li><hr class="dropdown-divider my-0"/></li>
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <button type="button" class="btn btn-danger btn-sm w-100">
              <i class="fa fa-sign-out text-white"></i> Logout
            </button>
          </a>
          <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
        </li>
      </ul>
    </div>

    <!-- Toggle (mobile/tablet) -->
    <button class="three-dot-trigger navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#rightMenu"
            aria-controls="rightMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

  </div>
</nav>

<!-- ══════════════════════════════════
     ROW 2 — STATS BAR
══════════════════════════════════ -->
<div class="stats-bar">
  <span class="stat-pill stat-pending">
    <i class="bi bi-clock"></i> Pending: ${{ Auth::user()->current_earning }}
  </span>
  <span class="stat-pill stat-earned">
    <i class="bi bi-currency-dollar"></i> Earned: ${{ Auth::user()->total_earning }}
  </span>
  <span class="stat-pill stat-deposit">
    <i class="bi bi-briefcase"></i> Deposit: ${{ Auth::user()->current_deposit }}
  </span>
</div>

<!-- ══ BREAKING NEWS ══ -->
@php $notices = App\Models\BreakingNotice::where('status','active')->get(); @endphp
@if($notices->count())
<div class="breaking-outer mt-2">
  <div class="breaking-wrapper">
    <div class="breaking-label"><i class="fa fa-bullhorn"></i> Breaking:</div>
    <div class="scroll-container">
      <div class="scroll-content">
        @foreach($notices as $notice)
          <span class="notice-item"><i class="fa fa-bell"></i> 🔥 {{ $notice->description }}</span>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endif

<!-- ══ OFFCANVAS ══ -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="rightMenu">
  <div class="oc-top">
    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
            data-bs-dismiss="offcanvas"></button>
    <div class="oc-name">

        @if(Auth::user()->photo)
         <img src="{{ asset('storage/'.Auth::user()->photo) }}"  style="width:46px;height:46px;object-fit:cover;flex-shrink:0;" class="rounded-circle" alt="avatar">
        @else
          <img src="{{ asset('storage/avatar.png') }}" style="width:46px;height:46px;object-fit:cover;flex-shrink:0;" class="rounded-circle" alt="avatar">
        @endif

      <div>
        <div>{{ Auth::user()->name }}</div>
        <div class="oc-email"><i class="fa fa-dot-circle-o text-success"></i> Online</div>
      </div>
    </div>
  </div>

  <!-- Stats in offcanvas -->
  <div class="oc-stats-row">
   <!--  <span class="oc-stat-pill stat-pending"><i class="bi bi-clock"></i> Pending: ${{ Auth::user()->current_earning }}</span>
    <span class="oc-stat-pill stat-earned"><i class="bi bi-currency-dollar"></i> Earned: ${{ Auth::user()->total_earning }}</span>
    <span class="oc-stat-pill stat-deposit"><i class="bi bi-briefcase"></i> Deposit: ${{ Auth::user()->current_deposit }}</span> -->
  </div>

  <div class="offcanvas-body">
    <a href="{{ route('user.dashboard') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-home text-danger"></i></div><span>Home</span>
    </a>
    <a href="{{ route('user.find.jobs') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-search text-danger"></i></div><span>Find Jobs</span>
    </a>
    <a href="{{ route('user.my.jobs') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-shopping-bag text-danger"></i></div><span>My Jobs</span>
    </a>
    <a href="{{ route('user.finished.jobs') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-check-circle-o text-danger"></i></div><span>Finished Jobs</span>
    </a>
    <a href="{{ route('article') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-pencil-square-o text-danger"></i></div><span>Article</span>
    </a>

    <div class="oc-divider"></div>
    <div class="sec-lbl">Browse Deal</div>

    <a href="{{ route('user.browse.deal') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-globe text-danger"></i></div><span>Browse Deal</span>
    </a>
    <a href="{{ route('user.deal.create') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-cart-plus text-danger"></i></div><span>Deal Create</span>
    </a>
    <a href="{{ route('user.my.deal.post') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-briefcase text-danger"></i></div><span>My Deal Post</span>
    </a>
    <a href="{{ route('user.deal.order') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-list-alt text-danger"></i></div><span>My Order</span>
    </a>

    <div class="oc-divider"></div>
    <div class="sec-lbl">Account</div>

    <a href="{{ route('user.deposit') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-usd text-danger"></i></div><span>Deposit</span>
    </a>
    <a href="{{ route('user.withdraw') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-usd text-danger"></i></div><span>Withdraw</span>
    </a>
    <a href="{{ route('user.profile') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-cogs text-danger"></i></div><span>Profile / Setting</span>
    </a>
    <a href="{{ route('user.unseen-notifications') }}" class="oc-item oc-nav-link">
      <div class="oc-ico"><i class="fa fa-bell-o text-danger"></i></div><span>Notifications</span>
    </a>

    <div class="oc-divider"></div>

    <a class="oc-item danger" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form-oc').submit();">
      <div class="oc-ico"><i class="fa fa-sign-out text-danger"></i></div>
      <span class="text-danger fw-bold">Logout</span>
    </a>
    <form id="logout-form-oc" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
  </div>
</div>

<!-- ══ NOTIFICATION MODAL ══ -->
<div class="modal fade" id="notificationModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="notificationTitle" class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="notificationMessage"></p>
        <small id="notificationTime" class="text-muted"></small>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script>
/* offcanvas nav link click → close then navigate */
document.querySelectorAll('.oc-nav-link').forEach(link => {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    const url = this.getAttribute('href');
    const offcanvasEl = document.getElementById('rightMenu');
    const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasEl);
    if (offcanvasInstance) {
      offcanvasEl.addEventListener('hidden.bs.offcanvas', function handler() {
        offcanvasEl.removeEventListener('hidden.bs.offcanvas', handler);
        window.location.href = url;
      });
      offcanvasInstance.hide();
    } else {
      window.location.href = url;
    }
  });
});
  item.addEventListener('click', function () {
    document.getElementById('notificationTitle').innerText   = this.dataset.title;
    document.getElementById('notificationMessage').innerText = this.dataset.message;
    document.getElementById('notificationTime').innerText    = this.dataset.time;
    fetch(`/user/notification/read/${this.dataset.id}`, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
    }).then(r => r.json()).then(d => { if (d.success) this.classList.remove('bg-light'); });
  });
});
</script>