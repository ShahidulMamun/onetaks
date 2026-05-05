
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

/* ═════════ NAVBAR ═════════ */
.top-nav {
  background: var(--brand);
  height: 56px;
  padding: 0 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: static;
  top: 0;
  z-index: 1050;
  box-shadow: 0 2px 10px rgba(0,0,0,0.15);
}

.nav-brand {
  display: flex;
  align-items: center;
  gap: 10px;
}

.brand-box {
  width: 34px;
  height: 34px;
  background: #8A80A3;
  border-radius: 9px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  color: var(--brand);
}

.brand-name {
  color: #006a4e;
  font-weight: 700;
}

/* Desktop nav */
.nav-links {
  display: flex;
  align-items: center;
  gap: 6px;
}

.nav-links a {
  color: #006a4e;
  text-decoration: none;
  font-size: 14px;
  padding: 6px 12px;
  border-radius: 20px;
  transition: 0.2s;
}

.nav-links a:hover {
  background-color: rgba(0, 106, 78, 0.05);
  color: #D32031;
}

.nav-links a.active {
  background: rgba(0, 106, 78, 0.05);
  color: #D32031;
}

/* Right */
.nav-right {
  display: flex;
  align-items: center;
  gap: 10px;
}

.nav-icon-btn {
  background: none;
  border: none;
  color: #a7f3d0;
  font-size: 20px;
  padding: 6px;
  border-radius: 8px;
  position: relative;
  cursor: pointer;
}

.nav-icon-btn:hover {
  background: rgba(255,255,255,0.1);
  color: #4ade80;
}

/* Badge */
.nbadge {
  position: absolute;
  top: 2px;
  right: 2px;
  background: var(--accent);
  color: #fff;
  font-size: 9px;
  width: 15px;
  height: 15px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Three dot */
.three-dot-trigger {
  background: none;
  border: 1px solid rgba(74,222,128,0.4);
  color: #a7f3d0;
  padding: 4px 8px;
  border-radius: 8px;
  display: none;
  cursor: pointer;
}

.three-dot-trigger:hover {
  background: rgba(255,255,255,0.1);
}

/* Responsive */
@media (max-width: 991.98px) {
  .nav-links { display: none !important; }
  .three-dot-trigger { display: flex !important; }
}

@media (min-width: 992px) {
  .three-dot-trigger { display: none !important; }
}

/* ═════════ OFFCANVAS FIX ═════════ */

/* Width */
#rightMenu {
  width: 290px;
}

/* Small device */
@media (max-width: 400px) {
  #rightMenu {
    width: 100%;
  }
}

/* 🔥 IMPORTANT: Bootstrap animation keep intact */
.offcanvas {
  transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
}

/* Backdrop blur */
.offcanvas-backdrop.show {
  backdrop-filter: blur(4px);
  background: rgba(0,0,0,0.3);
}

/* ═════════ PROFILE ═════════ */
.oc-top {
  background: #006a4e;
  padding: 18px;
}

.oc-avatar {
  width: 54px;
  height: 54px;
  background: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--brand);
  margin-bottom: 10px;
}

.oc-name {
  color: #d1fae5;
  font-weight: 700;
}

.oc-email {
  color: #6ee7b7;
  font-size: 12px;
}

.oc-stats {
  display: flex;
  gap: 18px;
  margin-top: 10px;
}

.oc-stat-val {
  color: #4ade80;
  font-weight: 700;
}

.oc-stat-lbl {
  font-size: 10px;
  color: #6ee7b7;
}

/* ═════════ MENU ═════════ */
.offcanvas-body {
  padding: 10px 0;
  background: #fff;
}

.sec-lbl {
  font-size: 10px;
  font-weight: 700;
  color: var(--muted);
  padding: 12px 18px 5px;
}

.oc-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 11px 18px;
  background: none;
  border: none;
  width: 100%;
  cursor: pointer;
  color: var(--txt);
  text-decoration: none;
  transition: 0.2s;
}

.oc-item:hover {
  background: var(--brand-light);
}

/* Active */
.oc-item.active {
  background: var(--brand-light);
}

.oc-item.active .oc-ico {
  background: var(--brand);
  color: #fff;
}

/* Icon */
.oc-ico {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: var(--brand-light);
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Badge */
.badge-num {
  margin-left: auto;
  background: var(--accent);
  color: #fff;
  font-size: 10px;
  padding: 2px 6px;
  border-radius: 20px;
}

.badge-new {
  margin-left: auto;
  background: var(--brand-light);
  color: var(--brand);
  font-size: 10px;
  padding: 2px 6px;
  border-radius: 20px;
  border: 1px solid var(--border);
}

/* Divider */
.oc-divider {
  height: 1px;
  background: var(--border);
  margin: 6px 18px;
}

/* Danger */
.oc-item.danger:hover {
  background: #fde8e8;
}


/* Stats Bar */
.stats-bar {
  background: #F2F0F6;
  padding: 10px 24px;
  display: flex;
  gap: 12px;
  align-items: center;
  flex-wrap: wrap;
}

.stat-pill {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 7px 15px;
  border-radius: 20px;
  font-weight: 500;
  font-size: .95rem;
}



/* Pills */
.stat-pending {
  background: #fff8e1;
  color: #b8860b;
  border: 1px solid #ffe082;
}

.stat-earned {
  background: #e8f5e9;
  color: #2e7d32;
  border: 1px solid #a5d6a7;
}

.stat-deposit {
  background: #e3f2fd;
  color: #1565c0;
  border: 1px solid #90caf9;
}


@media (max-width: 400px) {
/* Stats Bar */
.stats-bar {
  background: #F2F0F6;
  padding: 10px 24px;
  display: flex;
  gap: 2px;
  align-items: center;
  flex-wrap: wrap;
}

.stat-pill {
    display: flex;
    align-items: center;
    gap: 1px;
    padding: 6px 6px;
    border-radius: 20px;
    font-weight: 500;
    font-size: .85rem;
}

  
}

/* Jobs Section */
.available-jobs {
  padding: 20px 24px;
}

.available-jobs h6 {
  font-weight: 800;
  font-size: 1rem;
}

.badge-count {
  background: #e0e0e0;
  color: #555;
  border-radius: 12px;
  padding: 2px 10px;
  font-size: .85rem;
  font-weight: 700;
}

/* Dropdown */
.dropdown-menu {
  border-radius: 10px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.12);
  border: 1px solid #eee;
  min-width: 220px;
  padding: 8px 0;
}

.dropdown-item {
  font-weight: 600;
  color: #6c757d;
  padding: 8px 18px;
  display: flex;
  align-items: center;
  background-color: transparent;
  gap: 10px;
}

.dropdown-item:hover {
  background: #f5f5f5;
  color: #006a4e;
}

.dropdown-item i {
  color: #1a7f5a;
  font-size: 1rem;
}

/* User Button */
.user-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  background: none;
  border: none;
  font-weight: 700;
  font-size: .97rem;
  cursor: pointer;
  color: #006a4e;
}

.user-btn:hover{
  color: #006a4e;
}


.user-btn img {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  object-fit: cover;
  background: #ddd;
}

/* Avatar */
.user-avatar {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background: linear-gradient(135deg, #1a7f5a, #a8edca);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-weight: 800;
  font-size: 1rem;
}

/* Notification */
.notif-btn {
  position: relative;
  background: none;
  border: none;
  font-size: 1.3rem;
  color: #444;
  cursor: pointer;
}

.notif-btn:hover {
  color: #000;
}

.notif-badge {
  position: absolute;
  top: -2px;
  right: -4px;
  background: #e74c3c;
  color: #fff;
  border-radius: 50%;
  width: 17px;
  height: 17px;
  font-size: .65rem;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
}

 /* Post Button */
.btn-post {
  background: #006a4e;
  color: #fff !important;
  border-radius: 80px 80px 80px 80px;
  font-size: 16px;
  font-weight: 600;
  padding: 8px 18px;
  border: none;
  transition: 0.2s;
}

.btn-post:hover {
  background: #006a4e;
  transform: translateY(-1px);
}

.btn-job{
  background: #fff;
  text-decoration: none;
  color: #006a4e !important;
  border-radius: 40px 40px 40px 40px;
  font-size: 15px;
  font-weight: 600;
  padding: 8px 18px;
  border: 1px solid #006a4e;
}

/*style for breaking notice*/
.breaking-wrapper {
    display: flex;
    align-items: center;
    background: #FF4433;
    color: #fff;
    padding: 8px 10px;
    overflow: hidden;
}

.label {
    color: #fff;
    font-weight: bold;
    margin-right: 15px;
    white-space: nowrap;
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
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}
/*style end for breaking news */
  </style>
<!-- ══ NAVBAR ══ -->
<nav class="top-nav navbar navbar-expand-lg bg-white">
  <!-- Brand -->
  @php 
  $setting = App\Models\WebsiteSetting::first();
  @endphp
  <div class="nav-brand mt-2">
   <!--  <div class="brand-box"></div> -->
    <a class="footer-logo" href="{{ route('user.dashboard')}}">
          <div class="logo-icon" style="background: none">
           <img src="{{asset('storage/'.$setting->site_logo)}}">
          </div>
        
<span class="logo-clickers d-none d-md-inline">{{$setting->site_title}}</span>
        </a>
  </div>
  <!-- Desktop Links (lg+) -->
  <div class="nav-links fw-bold">
    <a class="active" href="{{ route('user.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
    <a href="{{ route('user.find.jobs')}}" class=""><i class="fa fa-search" aria-hidden="true"></i> Find Jobs</a>
    <a href="{{ route('user.my.jobs')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> My Jobs</a>
    <a href="{{ route('user.finished.jobs')}}"><i class="fa fa-check-circle-o" aria-hidden="true"></i></i> Finished Jobs</a>

    <div class="dropdown">
          <button class="user-btn dropdown-toggle d-none d-lg-flex" data-bs-toggle="dropdown" aria-expanded="false">
             <i class="fa fa-users" aria-hidden="true"></i> Browse Deal
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="{{ route('user.browse.deal')}}">
                Browse Deal
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('user.deal.create')}}">
               Post Deal
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('user.my.deal.post')}}">
                My Deal Post
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('user.deal.order')}}">
                 My Order
              </a>
            </li>
          </ul>
        </div>
        <a href="{{ route('user.deposit')}}"><i class="fa fa-usd" aria-hidden="true"></i>Deposit</a>
  </div>
  <!-- Right side icons -->
  <div class="nav-right">
    <a class="btn btn-post me-2 d-none d-sm-block" href="{{route('user.create.job')}}">
          <i class="fa fa-plus-circle" aria-hidden="true"></i> Post a Job
        </a>
        <a class="btn-job btn-sm px-3 shadow-sm d-none d-sm-block d-lg-none d-xxl-none" href="#">
          <i class="fa fa-search" aria-hidden="true"></i> Find Jobs
        </a>
        <!-- notifaction -->
   <a href="{{route('user.unseen-notifications')}}"> <button class="nav-icon-btn d-none d-sm-block">
     <i class="fa fa-bell-o text-dark" aria-hidden="true"></i>
      <span class="nbadge bg-danger">{{App\Models\UserNotification::where('user_id',Auth::user()->id)->count()}}</span>
    </button>
  </a>
    <!-- profile -->
    <button class="nav-icon-btn d-none d-lg-flex">
      <i class="bi bi-person-circle" style="font-size:150px;"></i>
    </button>
      <!-- User Dropdown -->
        <div class="dropdown">
          <button class="user-btn dropdown-toggle d-none d-lg-flex" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="user-avatar"><img src="{{ asset('storage/' . Auth::user()->photo) }}" width="40" height="40" class="rounded-circle"></span>
            <div class="fw-semibold" style="font-size:14px;">{{Auth::user()->name}}</div>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><span class="text-muted fw-bold p-3" style="font-size:.8rem;color:#999!important;">Welcome!</span></li>
            <!-- <span class="text-muted fw-bold p-3" style="font-size:.8rem;color:#999!important;">{{Auth::user()->email}}</span> -->
            <li><hr class="dropdown-divider my-1"/></li>
            <li>
              <a class="dropdown-item" href="">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Article
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="">
                <i class="fa fa-bell-o" aria-hidden="true"></i> Notification
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('user.find.jobs')}}">
                <i class="fa fa-search-plus" aria-hidden="true"></i> Find job
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <i class="fa fa-gift" aria-hidden="true"></i> Refer & Earn
              </a>
            </li>
              <li>
              <a class="dropdown-item" href="">
                <i class="fa fa-usd" aria-hidden="true"></i> Withdraw
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Deposit
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="">
                <i class="fa fa-info" aria-hidden="true"></i> Support
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="">
                <i class="fa fa-file-image-o" aria-hidden="true"></i> My Banner
              </a>
            </li>
             <li>
              <a class="dropdown-item" href="">
                <i class="fa fa-users" aria-hidden="true"></i> Top Freelancer
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="">
                <i class="fa fa-lock" aria-hidden="true"></i> Privacy & Security
              </a>
            </li>
             <li>
              <a class="dropdown-item" href="{{route('user.profile')}}">
                <i class="fa fa-cogs" aria-hidden="true"></i> Setting
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="">
                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete Account
              </a>
            </li>
            <li><hr class="dropdown-divider my-0"/></li>
            <!-- logout -->
              <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <button type="submit" class="btn btn-danger btn-sm w-100">
             <i class="fa fa-sign-out text-white rounded" aria-hidden="true"></i> logout
         </button> 
           </a>
           <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
              @csrf
          </form>
            </li>
            <!-- end logout -->
          </ul>
        </div>
    <!--  only on mobile & tablet -->
    <button class="three-dot-trigger navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#rightMenu"aria-controls="rightMenu" title="Menu"><span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- ══ RIGHT OFFCANVAS MENU ══ -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="rightMenu">
  <div class="oc-top">
    <button type="button"
      class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
      data-bs-dismiss="offcanvas"></button>
     <div class="text-center mt-3">
  <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded" alt="not found">
</div>
    <div class="oc-name text-center mt-2">{{Auth::user()->name}}</div>
    <div class="oc-email text-center">{{Auth::user()->email}}</div>
  </div>

  <div class="offcanvas-body">
   <a href="{{route('user.dashboard')}}" class="oc-item" data-bs-dismiss="">
    <div class="oc-ico">
      <i class="fa fa-home text-danger" aria-hidden="true"></i>
    </div>
    <span class="oc-lbl">Home</span>
   </a>
   <a href="{{ route('user.find.jobs')}}" class="oc-item" data-bs-dismiss="">
    <div class="oc-ico">
      <i class="fa fa-search text-danger" aria-hidden="true"></i>
    </div>
    <span class="oc-lbl">Find Jobs</span>
   </a>
   <a href="{{route('user.my.jobs')}}" class="oc-item" data-bs-dismiss="">
    <div class="oc-ico">
    <i class="fa fa-shopping-bag text-danger" aria-hidden="true"></i>
    </div>
    <span class="oc-lbl">My Jobs</span>
   </a>
   <a href="{{ route('user.finished.jobs')}}" class="oc-item" data-bs-dismiss="">
    <div class="oc-ico">
   <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i>
    </div>
    <span class="oc-lbl">Finished Jobs</span>
   </a>
<!-- Browse Deal -->
    <div class="oc-divider"></div>
     <a href="{{ route('user.browse.deal')}}" class="oc-item" data-bs-dismiss="">
    <div class="oc-ico">
   <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i>
    </div>
    <span class="oc-lbl">Browse Deal</span>
   </a>
    <a href="{{ route('user.deal.create')}}" class="oc-item" data-bs-dismiss="">
    <div class="oc-ico">
   <i class="fa fa-cart-plus text-danger" aria-hidden="true"></i>
    </div>
    <span class="oc-lbl">Deal Create</span>
   </a>
    <a href="{{ route('user.my.deal.post')}}" class="oc-item" data-bs-dismiss="">
    <div class="oc-ico">
  <i class="fa fa-briefcase text-danger" aria-hidden="true"></i>
    </div>
    <span class="oc-lbl">My Deal Post</span>
   </a>

    <a href="{{ route('user.deal.order')}}" class="oc-item" data-bs-dismiss="">
    <div class="oc-ico">
  <i class="fa fa-briefcase text-danger" aria-hidden="true"></i>
    </div>
    <span class="oc-lbl">My Order</span>
   </a>

    <a href="{{ route('user.deposit')}}" class="oc-item" data-bs-dismiss="">
    <div class="oc-ico">
    <i class="fa fa-usd text-danger" aria-hidden="true"></i>
    </div>
    <span class="oc-lbl">Deposit</span>
   </a>
    <div class="oc-divider"></div>
          <!-- logout -->
    <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="hover: none;">
              <button type="submit" class="btn btn-danger btn-sm w-100">
             <i class="fa fa-sign-out text-white rounded" aria-hidden="true" style="hover: none;"></i> logout
         </button> 
           </a>
           <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
              @csrf
          </form>
         
    <!-- <button class="oc-item danger" data-bs-dismiss="offcanvas">
      <div class="oc-ico"><i class="bi bi-box-arrow-right"></i></div>
      <span class="oc-lbl">Logout</span>
    </button> -->

  </div>
</div>


<div class="stats-bar justify-content-center">
  <span class="stat-pill stat-pending">
    <i class="bi bi-clock"></i> Pending: ${{Auth::user()->current_earning}}
  </span>
  <span class="stat-pill stat-earned">
    <i class="bi bi-currency-dollar"></i> Earned: ${{Auth::user()->total_earning}}
  </span>
  <span class="stat-pill stat-deposit">
    <i class="bi bi-briefcase"></i> Deposit: ${{Auth::user()->current_deposit}}
  </span>
</div>

<div class="stats-bar justify-content-center">
  
    @php

     $notices = App\Models\BreakingNotice::where('status','active')->get();
     @endphp

 
 @if($notices->count())
<div class="breaking-wrapper">
    
    <div class="label">Breaking:</div>

    <div class="scroll-container">
        <div class="scroll-content">
            @foreach($notices as $notice)
                <span class="notice-item">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    🔥 {{ $notice->description }}
                </span>
            @endforeach
        </div>
    </div>

</div>
@endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script>
function toggleHello() {
  const box = document.getElementById('helloBox');
  box.classList.toggle('d-none');
}
document.addEventListener('click', function(e) {
  const wrap = document.getElementById('avatarWrap');
  const box = document.getElementById('helloBox');
  if (!wrap.contains(e.target)) box.classList.add('d-none');
});
</script>
<script>
  function updateLabel() {
    const w = window.innerWidth;
    const el = document.getElementById('deviceLabel');
    if (w < 768)       el.textContent = 'Mobile — Three dot ';
    else if (w < 992)  el.textContent = 'Tablet — Three dot ⋮ ';
    else               el.textContent = 'Desktop — Full Nav Links';
  }
  updateLabel();
  window.addEventListener('resize', updateLabel);
</script>

