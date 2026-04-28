<!-- ================= HEADER ================= -->
<header>
<nav class="navbar navbar-expand-lg bg-light fixed-top py-3 px-4">
  <a class="navbar-brand d-flex align-items-center" href="{{asset('/')}}">
    <span class="logo-icon">
        <img src="{{ asset('images/logo.jpeg') }}" class="logo" alt="logo">
    </span>
    <span>
     Onetaskmarket
    </span>
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navMenu">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#faq">Faq</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#share_earn">Share &amp; Earn</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Article</a></li>
    </ul>
    <div class="d-flex gap-2 mt-2 mt-lg-0">
      <a class="btn btn-login" href="{{asset('/login')}}">Login</a>
      <a class="btn btn-signup text-white" href="{{asset('/register')}}">Sign Up</a>
    </div>
  </div>
</nav>
</header>
   