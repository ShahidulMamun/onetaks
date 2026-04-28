@extends('user.layouts.app')
@section('content')
 <br><br><br>
<div class="container mt-5">
    <!-- Row 1 -->
    <div class="row">
		 @if(session('message'))
		    <div class="alert alert-success text-center font-weight-bold">
		        {{ session('message') }}
		    </div>
         @endif
        <!-- Personal Info Card -->
        <div class="col-12 col-xsm-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
         <div class="card">
          <h6 class="card-header border-0 text-muted">Personal Info</h6>
          <div class="card-body">
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="text-muted">Name</label>
                    <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', auth()->user()->name) }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                  <div class="form-group">
                    <label class="text-muted">Email</label>
                  <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', auth()->user()->email) }}">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
       <div class="form-group">
            <label class="text-muted">Phone</label>
            <input type="text" name="phone" class="form-control form-control-sm" value="{{ old('phone', auth()->user()->phone) }}">
                @error('phone')
                <small class="text-danger">{{ $message }}</small>
                @enderror
        </div>

            <div class="text-right">
                <button class="btn btn-post btn-sm mt-4">Update Info</button>
            </div>
        </form>
          </div>
        </div>
        </div>
         <!-- Change Password -->
        <div class="col-12 col-xsm-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
         <div class="card">
          <h6 class="card-header border-0 text-muted">Password Change</h6>
          <div class="card-body">
          <form action="{{ route('user.password.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="text-muted">Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                             @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                             @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-muted">New Password</label>
                            <input type="password" name="password" class="form-control form-control-sm">
                              @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                               @enderror
                         </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-sm">
                        </div>

                        <div class="text-right">
                            <button class="btn btn-post btn-sm mt-4">Update Password</button>
                        </div>
                    </form>
          </div>
        </div>
        </div>

        <!-- Profile Photo Card -->
        <div class="col-12 col-xsm-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="card">
                 <h6 class="card-header border-0 text-muted">Change Profile Picture</h6>
                <div class="card-body text-center">
                    <form action="{{ route('user.photo.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                             class="rounded-circle mb-3"
                             style="width:120px;height:120px;object-fit:cover;">

                        <div class="form-group">
                            <input type="file" name="image" class="form-control-file">
                              @error('image')
						        <small class="text-danger">{{ $message }}</small>
						      @enderror
                        </div>

                        <button class="btn btn-post btn-sm mt-4">Upload Photo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
 <br><br><br>
<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
@endsection