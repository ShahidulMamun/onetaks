@extends('frontend.layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row g-4 justify-content-center mt-5">
    <div class="signup-card">
  <div class="form-title">SIGN UP</div>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form action="{{route('register')}}" method="post">
    @csrf
    <div class="row g-3">
      <!-- Full Name -->
      <div class="col-12 col-sm-6">
        <label class="form-label">Full Name<span>*</span></label>
        <input type="text" name="name" class="form-control" placeholder="Name" required/>
      </div>

      <!-- Username -->
      <div class="col-12 col-sm-6">
        <label class="form-label">Username<span>*</span></label>
        <input type="text" name="user_name" class="form-control" placeholder="User Name" required/>
      </div>

      <!-- Email -->
      <div class="col-12 col-sm-6">
        <label class="form-label">Email<span>*</span></label>
        <input type="email" name="email" class="form-control" placeholder="Email Address" required/>
      </div>

      <!-- Password -->
      <div class="col-12 col-sm-6">
        <label class="form-label">Password<span>*</span></label>
        <div class="pass-wrap">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required/>
          <button type="button" class="pass-toggle" onclick="togglePass('password', this)">
            <svg id="eye-pass" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>

      <!-- Confirm Password -->
      <div class="col-12 col-sm-6">
        <label class="form-label">Confirm Password<span>*</span></label>
        <div class="pass-wrap">
          <input type="password" name="confirm_password" class="form-control" id="confirm" placeholder="Confirm Password" required/>
          <button type="button" class="pass-toggle" onclick="togglePass('confirm', this)">
            <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>

      <!-- Country -->
      <div class="col-12 col-sm-6">
        <label class="form-label">Country<span>*</span></label>
        <select class="form-select" name="country_id">
          @php $country = App\Models\Country::orderBy('name','asc')->get() @endphp
            @foreach($country as $ct)
          <option value="{{$ct->id}}" selected>{{$ct->name}}</option>
          @endforeach
        </select>
      </div>

      <!-- Terms checkbox -->
      <div class="col-12 mt-2">
        <div class="form-check d-flex align-items-start gap-2">
          <input class="form-check-input flex-shrink-0" name="terms" type="checkbox" id="terms" required/>
          <label class="form-check-label" for="terms">
            I agree to OnetaskMarket <a href="#">Terms &amp; Condition</a> and <a href="#">Privacy Policy</a>
          </label>
        </div>
      </div>

      <!-- Register Button -->
      <div class="col-12">
        <button type="submit" class="btn-register">REGISTER NOW</button>
      </div>

    </div>
  </form>

  <div class="login-link">Already Have an account? <a href="{{route('login')}}">Log in</a></div>
</div>
</div>
</div>
<footer class="mt-5 footer-section">
    @include('frontend.layouts.partials.footer')
</footer>

@endsection