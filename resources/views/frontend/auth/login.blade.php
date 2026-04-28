@extends('frontend.layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row g-4 justify-content-center mt-5">
    <div class="signup-card mt-5">
  <div class="form-title">SIGN UP</div>
  <form method="post" action="{{route('login')}}">
       @csrf
      <div class="col-10 col-sm-10">
        <label class="form-label">Email<span>*</span></label>
        <input type="email" name="email" class="form-control" placeholder="Email Address" required/>
      </div>

      <!-- Password -->
      <div class="col-10 col-sm-10">
        <label class="form-label">Password<span>*</span></label>
        <div class="pass-wrap">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required/>
          <button type="button" class="pass-toggle" onclick="togglePass('password', this)">
            <svg id="eye-pass" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>
      <!-- Register Button -->
      <div class="col-10">
        <button type="submit" class="btn-register">Login</button>
      </div>
  </form>
  <div class="login-link">Don't Have an account? <a href="{{route('register')}}">Register</a></div>
</div>
</div>
</div>
<br><br><br>
<footer class="mt-5 footer-section">
    @include('frontend.layouts.partials.footer')
</footer>

@endsection