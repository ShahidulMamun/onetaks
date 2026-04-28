
<nav class="navbar navbar-expand-lg bg-light fixed-top">
  <a class="navbar-brand gig-brand d-flex align-items-center gap-1" href="{{ route('user.dashboard')}}">
    One<span>Taskmarket</span>
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="mainNav">
    <ul class="navbar-nav ms-3 me-auto align-items-lg-center gap-lg-1">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">My Post</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Post Job</a></li>
          <li><a class="dropdown-item" href="{{ route('user.my.jobs')}}">My Jobs</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">My Work</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('user.find.jobs')}}">Find Jobs</a></li>
          <li><a class="dropdown-item" href="{{ route('user.finished.jobs')}}">Finished Jobs</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Browse Deal</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('user.browse.deal')}}">Browse Deal</a></li>
          <li><a class="dropdown-item" href="{{ route('user.deal.create')}}">Post Deal</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Deal History</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('user.my.deal.post')}}">My Deal Post</a></li>
          <li><a class="dropdown-item" href="{{ route('user.deal.order')}}">My Order</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.deposit')}}">Deposit</a>
      </li>
    </ul>

    <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0 nav-wrapper">
      <button class="icon-btn"><i class="bi bi-envelope"></i></button>
      <button class="icon-btn"><i class="bi bi-bell"></i></button>
      <div class="nav-wrapper" id="avatarWrap" style="position:relative; cursor:pointer;">
        <div class="avatar-circle" onclick="toggleHello()">
          <i class="bi bi-person" style="color:#6b7280; font-size:16px;"></i>
        </div>
        <div class="hello-dropdown d-none" id="helloBox">Hello, Ali</div>
      </div>
      <a href="{{route('user.create.job')}}">
        <button class="btn-post ms-1">POST JOB</button>
      </a>
   <!--  added by mamun -->
        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 pe-0" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset('storage/' . Auth::user()->photo) }}" width="36" height="36" class="rounded-circle border border-2 border-light" alt="">
          <div class="d-none d-lg-block text-start lh-sm">
            <div class="text-dark fw-semibold" style="font-size:13px;">Rakib Hasan</div>
          </div>
          <i class="bi bi-chevron-down text-secondary ms-1" style="font-size:11px;"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-1" style="min-width:220px; border-radius:12px;">
          <li class="px-3 py-2 border-bottom mb-1">
            <div class="d-flex align-items-center gap-2">
              <img src="{{ asset('storage/' . Auth::user()->photo) }}" width="40" height="40" class="rounded-circle">
              <div>
                <div class="fw-semibold" style="font-size:14px;">{{Auth::user()->name}}</div>
                <div class="text-muted" style="font-size:12px;">{{Auth::user()->email}}</div>
              </div>
            </div>
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{route('user.profile')}}">
             
              My Profile <i class="bi bi-person text-primary" style="font-size:16px;width:20px;"></i>
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#" onclick="return false;">
              <i class="bi bi-gear text-secondary" style="font-size:16px;width:20px;"></i>
              Settings
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#" onclick="return false;">
              <i class="bi bi-shield-lock text-success" style="font-size:16px;width:20px;"></i>
              Privacy & Security
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#" onclick="return false;">
              <i class="bi bi-question-circle text-info" style="font-size:16px;width:20px;"></i>
              Help & Support
            </a>
          </li>
          <li><hr class="dropdown-divider my-1"></li>
          <li>
            
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
              Logout
          </button>
          </form>
           
          </li>
        </ul>
    <!--  added by Mamun -->
    </div>
  </div>
</nav>
<br><br>
<div class="status-bar">
  <div class="container">
    <div class="row text-center">
      <div class="col status-item">Pending : <span>$0.000</span></div>
      <div class="col status-item">Earned : <span>$0.000</span></div>
      <div class="col status-item">Deposit : <span>$0.000</span></div>
    </div>
  </div>
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