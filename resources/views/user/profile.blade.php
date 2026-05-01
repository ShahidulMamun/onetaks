@extends('user.layouts.app')
@section('content')
  <style>
    :root {
      --accent: #6C63FF;
      --accent-light: #ede9ff;
      --accent-dark: #4b44cc;
      --bg: #f4f3ff;
      --card-bg: #ffffff;
      --text-main: #1a1a2e;
      --text-muted: #7b7b9a;
      --border: #e4e2f7;
      --warning: #f59e0b;
      --danger: #ef4444;
      --success: #10b981;
    }

    /* ── Page title ── */
    .page-title {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 1.75rem;
      letter-spacing: -0.5px;
      color: var(--text-main);
    }

    /* ── Cards ── */
    .profile-card,
    .info-card {
      background: var(--card-bg);
      border: 1.5px solid var(--border);
      border-radius: 20px;
      box-shadow: 0 4px 24px rgba(108,99,255,0.07);
      transition: box-shadow 0.25s;
    }
    .profile-card:hover,
    .info-card:hover {
      box-shadow: 0 8px 36px rgba(108,99,255,0.13);
    }

    /* ── Avatar ── */
    .avatar-wrap {
      position: relative;
      display: inline-block;
    }
    .avatar-img {
      width: 110px;
      height: 110px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid var(--accent);
      box-shadow: 0 0 0 6px var(--accent-light);
    }
    .avatar-initials {
      width: 110px;
      height: 110px;
      border-radius: 50%;
      background: linear-gradient(135deg, #6C63FF 0%, #a78bfa 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Syne', sans-serif;
      font-size: 2.2rem;
      font-weight: 700;
      color: #fff;
      border: 4px solid var(--accent);
      box-shadow: 0 0 0 6px var(--accent-light);
    }

    /* ── Change Photo button ── */
    .btn-change-photo {
      background: var(--accent);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-family: 'Syne', sans-serif;
      font-weight: 600;
      font-size: 0.85rem;
      padding: 0.45rem 1.1rem;
      transition: background 0.2s, transform 0.15s;
    }
    .btn-change-photo:hover {
      background: var(--accent-dark);
      color: #fff;
      transform: translateY(-1px);
    }

    /* ── Profile info labels ── */
    .profile-info-label {
      font-size: 0.78rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--text-muted);
    }
    .profile-info-value {
      font-size: 0.95rem;
      font-weight: 500;
      color: var(--text-main);
    }

    /* ── Badges ── */
    .badge-unverified {
      background: #fff8e1;
      color: var(--warning);
      border: 1.5px solid #fde68a;
      border-radius: 20px;
      font-size: 0.78rem;
      font-weight: 600;
      padding: 0.3em 0.85em;
    }
    .badge-not-verified {
      background: #fee2e2;
      color: var(--danger);
      border: 1.5px solid #fca5a5;
      border-radius: 20px;
      font-size: 0.72rem;
      font-weight: 600;
      padding: 0.25em 0.75em;
    }

    /* ── Section title ── */
    .section-title {
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 1rem;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      color: var(--accent);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .section-divider {
      border: none;
      border-top: 1.5px solid var(--border);
      margin: 0.75rem 0 1.5rem;
    }

    /* ── Form controls ── */
    .form-label {
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.06em;
      margin-bottom: 0.35rem;
    }
    .form-control, .form-select {
      border: 1.5px solid var(--border);
      border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      color: var(--text-main);
      padding: 0.6rem 1rem;
      background: #fafafe;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(108,99,255,0.13);
      background: #fff;
      outline: none;
    }
    .form-control::placeholder {
      color: #c0bcd8;
    }
    .form-control[readonly] {
      background: #f0effe;
      color: var(--text-muted);
      cursor: not-allowed;
    }

    /* ── Save button ── */
    .btn-save {
      background: linear-gradient(135deg, var(--accent) 0%, #a78bfa 100%);
      color: #fff;
      border: none;
      border-radius: 12px;
      font-family: 'Syne', sans-serif;
      font-weight: 700;
      font-size: 0.95rem;
      padding: 0.65rem 2rem;
      transition: transform 0.15s, box-shadow 0.2s;
      box-shadow: 0 4px 16px rgba(108,99,255,0.25);
    }
    .btn-save:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(108,99,255,0.35);
      color: #fff;
    }
    .btn-cancel {
      background: transparent;
      border: 1.5px solid var(--border);
      color: var(--text-muted);
      border-radius: 12px;
      font-family: 'Syne', sans-serif;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.65rem 1.5rem;
      transition: background 0.15s, color 0.15s;
    }
    .btn-cancel:hover {
      background: var(--accent-light);
      color: var(--accent);
    }

    /* ── Cannot be changed note ── */
    .cannot-change {
      font-size: 0.75rem;
      color: var(--danger);
      font-weight: 500;
    }

    /* ── Decoration dot ── */
    .dot-accent {
      width: 8px; height: 8px;
      border-radius: 50%;
      background: var(--accent);
      display: inline-block;
    }
 /*image button*/
    .upload-btn {
    position: relative;
    overflow: hidden;
    display: inline-block;
  }

  .upload-btn input {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    cursor: pointer;
    height: 100%;
    width: 100%;
  }
  /*end image button*/
  </style>
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
        <div class="col-12 col-xsm-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mt-3">
              <!-- Left: Profile Card -->
      <div class="card p-4 text-center d-flex flex-column align-items-center justify-content-center gap-3">
        <!-- Avatar -->
      <form action="{{ route('user.photo.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
        <div class="avatar-wrap mb-1">
          <div class="avatar-initials">
          <img id="previewImage" src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle img-thumbnail">
          </div>
        </div>
        <!-- Change Photo -->
        <div>
          <label class="btn btn-change-photo mb-1 upload-btn">
            <i class="fa fa-camera"></i> Change Photo
            <input type="file" id="imageInput" accept="image/*">
          </label>
          <div class="text-muted" style="font-size:0.76rem;">Max 2MB (JPG, PNG, WebP)</div>
        </div>
         <!-- Buttons -->
          <div class="col-12 justify-content-center">
            <button class="btn btn-save btn-sm p-2">
             Save Changes
            </button>
          </div>
      </form>

        <hr class="w-100 my-1" style="border-color: var(--border);">
        <!-- Name & Email -->
        <div>
          <div class="fw-bold" style="font-family:'Syne',sans-serif;font-size:1.15rem;">{{ ( auth()->user()->name) }}</div>
          <div style="font-size:0.85rem;color:var(--text-muted);">{{ ( auth()->user()->email) }}</div>
        </div>
        <!-- Unverified Badge -->
        <span class="badge-unverified">
          <i class="bi bi-exclamation-circle me-1"></i>Unverified
        </span>
        <hr class="w-100 my-1" style="border-color: var(--border);">
        <!-- Profile Meta -->
        <div class="w-100 text-start d-flex flex-column gap-2">
          <div>
            <span class="profile-info-label">Name</span><br/>
            <span class="profile-info-value">{{ ( auth()->user()->name) }}</span>
          </div>
          <div>
            <span class="profile-info-label">Mobile</span><br/>
            <span class="profile-info-value">{{ ( auth()->user()->phone) }}</span>
          </div>
          <div>
          </div>
        </div>
      </div>
    </form>
        </div>
        <!-- end left side bar -->
      <div class="col-12 col-xsm-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 mt-2 ">
        <!-- Right: Personal Info Form -->
         <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
      <div class="info-card p-lg-5 pb-3">
        <!-- Section Title -->
        <div class="section-title mb-0">
          <i class="fa fa-user" aria-hidden="true"></i> Personal Info
        </div>
        <hr class="section-divider"/>
        <div class="row">
          <!-- First Name -->
          <div class="col-sm-6">
            <label class="form-label">First Name</label>
            <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', auth()->user()->name) }}">
                        @error('name')
                <small class="text-danger">{{ $message }}</small>
                        @enderror
          </div>
          <!-- Last Name -->
          <div class="col-sm-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', auth()->user()->email) }}">
                  @error('email')
                <small class="text-danger">{{ $message }}</small>
                    @enderror
          </div>
          <!-- Phone -->
          <div class="col-sm-6">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control form-control-sm" value="{{ old('phone', auth()->user()->phone) }}">
                @error('phone')
              <small class="text-danger">{{ $message }}</small>
                @enderror
          </div>
          <!-- Buttons -->
          <div class="col-12 d-flex gap-3 justify-content-end pt-2">
            <button class="btn btn-save">
              <i class="fa fa-check" aria-hidden="true"></i> Save Changes
            </button>
          </div>
        </div>
      </div>
      </form>
      <!-- password changes -->
       <form action="{{ route('user.password.update') }}" method="POST">
             @csrf
        <div class="info-card p-lg-5 mt-3 pb-3">
        <!--  Title -->
        <div class="section-title mb-0">
          <i class="fa fa-unlock-alt" aria-hidden="true"></i> Password Change
        </div>
        <hr class="section-divider"/>
        <div class="row">
          <!-- First Name -->
          <div class="col-sm-6">
            <label class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                  @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
          </div>
          <!-- Last Name -->
          <div class="col-sm-6">
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="form-control form-control-sm" placeholder="New Password">
                @error('password')
                     <small class="text-danger">{{ $message }}</small>
                      @enderror
          </div>
          <!-- Phone -->
          <div class="col-sm-6">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Confirm Password">
          </div>
          <!-- Buttons -->
          <div class="col-12 d-flex gap-3 justify-content-end pt-2">
            <button class="btn btn-save">
              <i class="fa fa-check" aria-hidden="true"></i> Save Changes
            </button>
          </div>
        </div>
      </div>
    </form>
    </div>
      <!-- end profile -->
    </div>
    </div>
 <br><br><br>
<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
<!-- images scripts -->
<script>
  const imageInput = document.getElementById('imageInput');
  const previewImage = document.getElementById('previewImage');

  imageInput.addEventListener('change', function () {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        previewImage.src = e.target.result;
      }

      reader.readAsDataURL(file);
    }
  });
</script>
@endsection