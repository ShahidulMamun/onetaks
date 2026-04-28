@extends('frontend.layouts.app')
@section('content')

<section class="hero-section px-4">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-7 py-4">
        <h1 class="hero-title">Location Of Small And<br>Large Jobs</h1>
        <p class="hero-subtitle">GigClickers is an open online marketplace that connects employers and skilled workers.</p>
        <a href="{{route('register')}}"><button class="btn-cta">Get Sign Up</button></a>
      </div>
      <div class="col-lg-6 col-md-5 d-flex justify-content-center align-items-end pt-4 pt-md-0">
        <div style="position:relative; width:100%; max-width:420px;">
          <svg viewBox="0 0 420 320" xmlns="http://www.w3.org/2000/svg" width="100%">
            <rect x="200" y="30" width="160" height="100" rx="8" fill="#b2e5c8" stroke="#22a55b" stroke-width="1.5"/>
            <rect x="212" y="42" width="136" height="76" rx="4" fill="#6dccaa"/>
            <rect x="212" y="42" width="136" height="76" rx="4" fill="url(#leafPattern)" opacity="0.7"/>
            <defs>
              <pattern id="leafPattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <ellipse cx="10" cy="10" rx="8" ry="5" fill="#22a55b" opacity="0.4"/>
              </pattern>
            </defs>
            <circle cx="370" cy="30" r="8" fill="#22a55b" opacity="0.8"/>
            <line x1="370" x2="370" y1="38" y2="80" stroke="#b2e5c8" stroke-width="2"/>
            <circle cx="320" cy="90" r="28" fill="none" stroke="#aaa" stroke-width="2"/>
            <line x1="320" y1="62" x2="320" y2="90" stroke="#888" stroke-width="2"/>
            <line x1="320" y1="90" x2="340" y2="100" stroke="#888" stroke-width="2"/>
            <rect x="100" y="160" width="200" height="120" rx="8" fill="#d0f0e0" stroke="#22a55b" stroke-width="1.5"/>
            <rect x="110" y="168" width="180" height="104" rx="4" fill="#c5ecda"/>
            <rect x="118" y="176" width="60" height="8" rx="2" fill="#22a55b" opacity="0.5"/>
            <rect x="118" y="190" width="80" height="6" rx="2" fill="#aaa" opacity="0.4"/>
            <rect x="118" y="202" width="70" height="6" rx="2" fill="#aaa" opacity="0.3"/>
            <rect x="118" y="214" width="50" height="12" rx="3" fill="#22a55b" opacity="0.7"/>
            <rect x="180" y="176" width="100" height="70" rx="4" fill="#e8f8f0" stroke="#b2e5c8" stroke-width="1"/>
            <rect x="188" y="183" width="85" height="10" rx="2" fill="#b2e5c8"/>
            <rect x="188" y="198" width="65" height="6" rx="2" fill="#ddd"/>
            <rect x="188" y="208" width="75" height="6" rx="2" fill="#ddd"/>
            <rect x="188" y="218" width="55" height="6" rx="2" fill="#ddd"/>
            <line x1="80" y1="280" x2="400" y2="280" stroke="#22a55b" stroke-width="1.5" opacity="0.3"/>
            <rect x="120" y="260" width="160" height="20" rx="4" fill="#b2e5c8" opacity="0.5"/>
            <ellipse cx="150" cy="270" rx="20" ry="18" fill="#22a55b" opacity="0.15"/>
            <circle cx="195" cy="145" r="22" fill="#22a55b" opacity="0.9"/>
            <rect x="173" y="167" width="44" height="28" rx="4" fill="#1a8f4d"/>
            <circle cx="185" cy="152" r="4" fill="#cfe" opacity="0.6"/>
            <circle cx="205" cy="152" r="4" fill="#cfe" opacity="0.6"/>
            <rect x="178" y="160" width="34" height="2" rx="1" fill="#cfe" opacity="0.5"/>
            <rect x="160" y="245" width="70" height="8" rx="3" fill="#aaa" opacity="0.4"/>
            <rect x="175" y="255" width="40" height="5" rx="2" fill="#bbb" opacity="0.3"/>
            <rect x="365" y="230" width="30" height="40" rx="4" fill="#444" opacity="0.7"/>
            <rect x="355" y="248" width="50" height="20" rx="3" fill="#333" opacity="0.7"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- jobs -->
<section class="get-jobs bg-white">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 mt-5">
          <div class="logo-row">
    <div class="logo-box"></div>
    <span class="logo-text">Finds Jobs</span>
    </div>
        </div>
        <div class="col-lg-6">
           <img src="{{ asset('images/jobs.png') }}" alt="">
        </div>
        <div class="col-lg-6">
                  <h2 class="heading">Get more in less time</h2>
      <ul class="check-list">
        <li>
          <span class="check-icon"><i class="fa fa-check text-white fa-xs" aria-hidden="true"></i></span>
          Target is the right Job
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white fa-xs" aria-hidden="true"></i></span>
          Read job details and submit
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white fa-xs" aria-hidden="true"></i></span>
          Do not submit wrong proof
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white fa-xs" aria-hidden="true"></i></span>
          To increase the employer's business
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white fa-xs" aria-hidden="true"></i></span>
          Take any promotion
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white fa-xs" aria-hidden="true"></i></span>
          Blog, application, social media etc
        </li>
      </ul>
       <a href="{{route('login')}}"><button class="cta-btn">
        GET STARTED
        <span class="btn-arrow">
          <svg viewBox="0 0 10 10"><path d="M2 5h6M5 2l3 3-3 3"/></svg>
        </span>
      </button></a>
        </div>
    </div>
    </div>
</section>
<!-- market places -->
<section class="marketplace mt-5">
  <div class="container mt-5">
  <h2 class="deal-title mt-5">Deal <span>Marketplace</span></h2>
  <div class="row g-3">
    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">▶️</div>
        <div class="cat-name">Application</div>
        <div class="cat-deals"><span class="badge-dot"></span>39 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🎬</div>
        <div class="cat-name">Audio &amp; Video</div>
        <div class="cat-deals"><span class="badge-dot"></span>23 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🗂️</div>
        <div class="cat-name">CMS</div>
        <div class="cat-deals"><span class="badge-dot"></span>4 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🔒</div>
        <div class="cat-name">Cyber Security</div>
        <div class="cat-deals"><span class="badge-dot"></span>1 Deal</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🛠️</div>
        <div class="cat-name">Digital Service</div>
        <div class="cat-deals"><span class="badge-dot"></span>21 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">💲</div>
        <div class="cat-name">Dollar Service</div>
        <div class="cat-deals"><span class="badge-dot"></span>22 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🌐</div>
        <div class="cat-name">Domain</div>
        <div class="cat-deals"><span class="badge-dot"></span>5 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">⚡</div>
        <div class="cat-name">Ezoic</div>
        <div class="cat-deals"><span class="badge-dot"></span>2 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">📘</div>
        <div class="cat-name">Facebook Service</div>
        <div class="cat-deals"><span class="badge-dot"></span>80 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">💰</div>
        <div class="cat-name">Google Adsense</div>
        <div class="cat-deals"><span class="badge-dot"></span>12 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🎨</div>
        <div class="cat-name">Graphics Design</div>
        <div class="cat-deals"><span class="badge-dot"></span>26 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">📦</div>
        <div class="cat-name">Minute &amp; MB Package</div>
        <div class="cat-deals"><span class="badge-dot"></span>3 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🔷</div>
        <div class="cat-name">Others</div>
        <div class="cat-deals"><span class="badge-dot"></span>60 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🅿️</div>
        <div class="cat-name">Paypal Service</div>
        <div class="cat-deals"><span class="badge-dot"></span>0 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">📈</div>
        <div class="cat-name">SEO Service</div>
        <div class="cat-deals"><span class="badge-dot"></span>4 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🌍</div>
        <div class="cat-name">Web Service</div>
        <div class="cat-deals"><span class="badge-dot"></span>15 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">🏷️</div>
        <div class="cat-name">Website Sell</div>
        <div class="cat-deals"><span class="badge-dot"></span>8 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">✍️</div>
        <div class="cat-name">Writing</div>
        <div class="cat-deals"><span class="badge-dot"></span>13 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2 ">
      <div class="cat-card">
        <div class="cat-icon">▶️</div>
        <div class="cat-name">Youtube Service</div>
        <div class="cat-deals"><span class="badge-dot"></span>79 Deals</div>
      </div>
    </div>

    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div class="cat-card">
        <div class="cat-icon">📧</div>
        <div class="cat-name">Email Marketing</div>
        <div class="cat-deals"><span class="badge-dot"></span>32 Deals</div>
      </div>
    </div>

  </div>
</div>
</section>
<!-- services gigs -->
<section class="get-jobs bg-white pb-5">
    <div class="container">
        <div class="row">
        <div class="col-lg-6 mt-5">  
      <ul class="check-list">
           <h2 class="heading">Exchange online service at GigClickers</h2>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white" aria-hidden="true"></i></span>
          Target is the right Job
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white" aria-hidden="true"></i></span>
          Read job details and submit
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white" aria-hidden="true"></i></span>
          Do not submit wrong proof
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white" aria-hidden="true"></i></span>
          To increase the employer's business
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white" aria-hidden="true"></i></span>
          Take any promotion
        </li>
        <li>
          <span class="check-icon"><i class="fa fa-check text-white" aria-hidden="true"></i></span>
          Blog, application, social media etc
        </li>
      </ul>
      <button class="cta-btn">
        GET STARTED
        <span class="btn-arrow">
          <svg viewBox="0 0 10 10"><path d="M2 5h6M5 2l3 3-3 3"/></svg>
        </span>
      </button>
        </div>
         <div class="col-lg-6">
           <img src="{{ asset('images/jobs.png') }}" class="mt-5" alt="">
        </div>
    </div>
    </div>
</section>
<br><br><br><br>
<!-- empolye -->
<section class="empolye mt-5">
 <div class="container mt-5">
  <h2 class="employe-title text-center">Employers</h2>
  <div class="row g-4 justify-content-center">
    <!-- Card 1 — Select Country -->
    <div class="col-12 col-sm-6 col-lg-3 emp-col">
      <div class="emp-card">
        <div class="icon-wrap">
          <svg viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10
                     15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
        </div>
        <h5 class="card-title-text">Select Country</h5>
        <p class="card-body-text">The employer can follow any country as per his desire through post job, any social job and other tasks can be done easily through the employees.</p>
      </div>
    </div>

    <!-- Card 2 — Review Job -->
    <div class="col-12 col-sm-6 col-lg-3 emp-col">
      <div class="emp-card">
        <div class="icon-wrap">
          <svg viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <circle cx="12" cy="12" r="5"/>
            <circle cx="12" cy="12" r="1.5" class="filled"/>
          </svg>
        </div>
        <h5 class="card-title-text">Review Job</h5>
        <p class="card-body-text">The employer must review and rate the work given by the employer within a maximum of six days. If the employer does not rate the jobs within six days, the workers will get them auto-rated.</p>
      </div>
    </div>

    <!-- Card 3 — Rate Job -->
    <div class="col-12 col-sm-6 col-lg-3 emp-col">
      <div class="emp-card">
        <div class="icon-wrap">
          <svg viewBox="0 0 24 24" stroke="#fff" stroke-width="2.4">
            <line x1="19" y1="5" x2="5" y2="19"/>
            <circle cx="6.5" cy="6.5" r="2.5"/>
            <circle cx="17.5" cy="17.5" r="2.5"/>
          </svg>
        </div>
        <h5 class="card-title-text">Rate Job</h5>
        <p class="card-body-text">The employer will have control over the work performed by each employee. Employers will review each worker's performance and rate it satisfactorily or unsatisfactorily.</p>
      </div>
    </div>

    <!-- Card 4 — Report Job -->
    <div class="col-12 col-sm-6 col-lg-3 emp-col">
      <div class="emp-card">
        <div class="icon-wrap">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="3"/>
            <polyline points="9 12 11 14 15 10"
              stroke="#fff" fill="none"
              stroke-width="2.4"
              stroke-linecap="round"
              stroke-linejoin="round"/>
          </svg>
        </div>
        <h5 class="card-title-text">Report Job</h5>
        <p class="card-body-text">For any reason, the employer thinks that the worker will redo the work and submit it again, then the worker must be paid for revising the work. If the revision work is not done within 24 hours then it will be auto unsatisfied.</p>
      </div>
    </div>

  </div>
</div>
</section>
<br><br><br><br>
<!-- worker -->
<section class="worker mt-5">
  <div class="container mt-5">
  <h2 class="worker-title text-center mt-5">Workers</h2>
  <div class="row g-4 justify-content-center">
    <!-- Card 1 — Submit Job -->
    <div class="col-12 col-sm-6 col-lg-3 wrk-col">
      <div class="wrk-card">
        <div class="icon-worker">
          <!-- list / submit icon -->
          <svg viewBox="0 0 24 24">
            <line x1="8" y1="6"  x2="21" y2="6"/>
            <line x1="8" y1="12" x2="21" y2="12"/>
            <line x1="8" y1="18" x2="21" y2="18"/>
            <polyline points="3 6 4 7 6 5"/>
            <polyline points="3 12 4 13 6 11"/>
            <polyline points="3 18 4 19 6 17"/>
          </svg>
        </div>
        <h5 class="card-label">Submit Job</h5>
        <p class="card-desc">Worker can complete and submit any job as per his wish from Finds Job. The worker must read each task carefully and then complete it.</p>
      </div>
    </div>

    <!-- Card 2 — Revision Job -->
    <div class="col-12 col-sm-6 col-lg-3 wrk-col">
      <div class="wrk-card">
        <div class="icon-worker">
          <!-- refresh / revision icon -->
          <svg viewBox="0 0 24 24">
            <polyline points="23 4 23 10 17 10"/>
            <polyline points="1 20 1 14 7 14"/>
            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10
                     M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
          </svg>
        </div>
        <h5 class="card-label">Revision Job</h5>
        <p class="card-desc">The worker must be accountable to the employer for the work done. If the completed works are sent by the employer for revision then they should be completed and submitted within 24 hours.</p>
      </div>
    </div>

    <!-- Card 3 — Report Job -->
    <div class="col-12 col-sm-6 col-lg-3 wrk-col">
      <div class="wrk-card">
        <div class="icon-worker">
          <!-- trending-up / report icon -->
          <svg viewBox="0 0 24 24">
            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
            <polyline points="17 6 23 6 23 12"/>
          </svg>
        </div>
        <h5 class="card-label">Report Job</h5>
        <p class="card-desc">After the worker receives a rate from the employer for each job, if the employer does not pay correctly after the job is done, the worker can report against the work given by the employer. This must be done within 24 hours.</p>
      </div>
    </div>

    <!-- Card 4 — Complete Job -->
    <div class="col-12 col-sm-6 col-lg-3 wrk-col">
      <div class="wrk-card">
        <div class="icon-worker">
          <!-- check-circle icon -->
          <svg viewBox="0 0 24 24">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
          </svg>
        </div>
        <h5 class="card-label">Complete Job</h5>
        <p class="card-desc">Complete jobs with GigClickers. May unemployment always be removed. May life be sweeter.</p>
      </div>
    </div>

  </div>
</div>
</section>
<br><br><br><br>
<!-- share-earn -->
<section class="share-earn mt-5">
  <div class="container mt-5">
  <h2 class="share-title text-center mt-5">Share &amp; Earn</h2>
  <div class="row align-items-center g-5">
    <!-- Left: Illustration -->
    <div class="col-12 col-md-5">
      <div class="illus-wrap">

        <!-- Running People -->
        <div class="people-group">

          <!-- Person 1 (tall, green suit) -->
          <div class="person" style="animation-delay:0s">
            <svg class="svg-person" viewBox="0 0 90 170" fill="none" xmlns="http://www.w3.org/2000/svg">
              <!-- head -->
              <circle cx="45" cy="28" r="18" fill="#f4c3a0"/>
              <!-- hair -->
              <ellipse cx="45" cy="14" rx="18" ry="10" fill="#2d2d2d"/>
              <!-- body (green suit) -->
              <rect x="28" y="46" width="34" height="55" rx="6" fill="#2e7d32"/>
              <!-- tie -->
              <polygon points="45,50 42,72 45,76 48,72" fill="#f9a825"/>
              <!-- shirt -->
              <rect x="40" y="46" width="10" height="30" fill="#fff"/>
              <!-- left arm -->
              <rect x="14" y="48" width="14" height="38" rx="7" fill="#2e7d32" transform="rotate(15 14 48)"/>
              <!-- right arm -->
              <rect x="62" y="48" width="14" height="38" rx="7" fill="#2e7d32" transform="rotate(-20 76 48)"/>
              <!-- hand L -->
              <circle cx="16" cy="86" r="7" fill="#f4c3a0"/>
              <!-- hand R -->
              <circle cx="76" cy="84" r="7" fill="#f4c3a0"/>
              <!-- left leg -->
              <rect x="28" y="99" width="15" height="52" rx="7" fill="#1b5e20" transform="rotate(8 28 99)"/>
              <!-- right leg -->
              <rect x="47" y="99" width="15" height="52" rx="7" fill="#1b5e20" transform="rotate(-12 62 99)"/>
              <!-- shoes -->
              <ellipse cx="29" cy="153" rx="12" ry="6" fill="#111"/>
              <ellipse cx="60" cy="153" rx="12" ry="6" fill="#111"/>
            </svg>
          </div>

          <!-- Person 2 (girl, pink dress) -->
          <div class="person" style="margin-left:-20px">
            <svg class="svg-person" viewBox="0 0 80 155" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="40" cy="24" r="16" fill="#f4c3a0"/>
              <ellipse cx="40" cy="12" rx="17" ry="9" fill="#111"/>
              <!-- ponytail -->
              <path d="M52 10 Q70 5 65 24" stroke="#111" stroke-width="5" fill="none" stroke-linecap="round"/>
              <!-- body pink -->
              <rect x="24" y="40" width="32" height="48" rx="6" fill="#f06292"/>
              <!-- arms -->
              <rect x="10" y="42" width="13" height="35" rx="6" fill="#f06292" transform="rotate(12 10 42)"/>
              <rect x="57" y="42" width="13" height="35" rx="6" fill="#f06292" transform="rotate(-18 70 42)"/>
              <circle cx="11" cy="78" r="6" fill="#f4c3a0"/>
              <circle cx="70" cy="78" r="6" fill="#f4c3a0"/>
              <!-- skirt -->
              <path d="M22 86 Q16 110 14 130 Q40 138 66 130 Q64 110 58 86 Z" fill="#66bb6a"/>
              <!-- legs -->
              <rect x="26" y="128" width="12" height="18" rx="6" fill="#f4c3a0" transform="rotate(10 26 128)"/>
              <rect x="44" y="128" width="12" height="18" rx="6" fill="#f4c3a0" transform="rotate(-10 56 128)"/>
              <ellipse cx="26" cy="148" rx="10" ry="5" fill="#f48fb1"/>
              <ellipse cx="55" cy="146" rx="10" ry="5" fill="#66bb6a"/>
            </svg>
          </div>

          <!-- Person 3 (yellow outfit) -->
          <div class="person" style="margin-left:-15px">
            <svg class="svg-person" viewBox="0 0 85 160" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="42" cy="25" r="17" fill="#f4c3a0"/>
              <ellipse cx="42" cy="13" rx="17" ry="9" fill="#4a2c0a"/>
              <!-- body yellow -->
              <rect x="25" y="42" width="34" height="52" rx="6" fill="#f9a825"/>
              <!-- arms -->
              <rect x="11" y="44" width="13" height="36" rx="6" fill="#f9a825" transform="rotate(14 11 44)"/>
              <rect x="61" y="44" width="13" height="36" rx="6" fill="#f9a825" transform="rotate(-16 74 44)"/>
              <circle cx="12" cy="80" r="6" fill="#f4c3a0"/>
              <circle cx="73" cy="80" r="6" fill="#f4c3a0"/>
              <!-- pants -->
              <rect x="25" y="92" width="14" height="48" rx="7" fill="#f9a825" transform="rotate(10 25 92)"/>
              <rect x="45" y="92" width="14" height="48" rx="7" fill="#f9a825" transform="rotate(-14 59 92)"/>
              <ellipse cx="28" cy="142" rx="11" ry="5" fill="#66bb6a"/>
              <ellipse cx="57" cy="140" rx="11" ry="5" fill="#66bb6a"/>
            </svg>
          </div>
        </div>

        <!-- Hero figure (man with idea bulb) -->
        <div class="hero-figure" style="margin-left: -30px;">
          <div class="bulb">💡</div>
          <svg width="120" height="220" viewBox="0 0 120 220" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- head -->
            <circle cx="60" cy="32" r="22" fill="#c8a07a"/>
            <!-- beard / hair -->
            <ellipse cx="60" cy="20" rx="22" ry="12" fill="#1a1a1a"/>
            <ellipse cx="60" cy="48" rx="14" ry="8" fill="#5d3a1a"/>
            <!-- body dark green suit -->
            <rect x="34" y="54" width="52" height="72" rx="8" fill="#1b5e20"/>
            <!-- shirt white -->
            <rect x="52" y="54" width="16" height="42" fill="#fff"/>
            <!-- lapels -->
            <polygon points="52,54 44,80 52,80" fill="#1b5e20"/>
            <polygon points="68,54 76,80 68,80" fill="#1b5e20"/>
            <!-- left arm raised -->
            <rect x="10" y="30" width="16" height="50" rx="8" fill="#1b5e20" transform="rotate(30 18 30)"/>
            <circle cx="22" cy="75" r="9" fill="#c8a07a"/>
            <!-- right arm -->
            <rect x="94" y="56" width="16" height="44" rx="8" fill="#1b5e20" transform="rotate(-10 102 56)"/>
            <circle cx="105" cy="100" r="9" fill="#c8a07a"/>
            <!-- legs -->
            <rect x="34" y="124" width="20" height="68" rx="10" fill="#145214" transform="rotate(6 34 124)"/>
            <rect x="66" y="124" width="20" height="68" rx="10" fill="#145214" transform="rotate(-8 86 124)"/>
            <!-- shoes -->
            <ellipse cx="38" cy="194" rx="16" ry="7" fill="#111"/>
            <ellipse cx="78" cy="192" rx="16" ry="7" fill="#111"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- Right: Content -->
    <div class="col-12 col-md-7 content-side">
      <p class="intro-text">Invite your friend to GigClickers platform and get special bonus. Every deposit and job also has a special task bonus.</p>

      <h3 class="invite-heading">What are you getting in each invitation?</h3>

      <div style="display:flex; align-items:flex-start;">
        <div class="accent-bar mt-1"></div>
        <div>
          <div class="check-item">
            <div class="check-icon-share">
              <svg viewBox="0 0 14 14"><polyline points="2 7 5.5 10.5 12 3"/></svg>
            </div>
            <span>If your friend accepts the invitation, you will get <strong>3% of his work bonus</strong></span>
          </div>
          <div class="check-item">
            <div class="check-icon-share">
              <svg viewBox="0 0 14 14"><polyline points="2 7 5.5 10.5 12 3"/></svg>
            </div>
            <span>You will get an instant <strong>5% bonus</strong> on the deposit of the friend who accepts the invitation</span>
          </div>
        </div>
      </div>

      <a href="#" class="btn-get-started">GET STARTED</a>
    </div>

  </div>
</div>
</section>
<br><br><br>
<hr class="mt-5">
<!-- fuq -->
<section class="fuq">
  <div class="container">
  <h2 class="fuq-title text-center">Frequently asked Questions</h2>

  <div class="row g-3 faq-row">

    <!-- Q1 -->
    <div class="col-12 col-md-6 faq-col">
      <div class="faq-item">
        <button class="faq-btn" onclick="toggleFaq(this)">
          <span class="plus-icon"></span>
          What are the benefits for employers?
        </button>
        <div class="faq-answer">
          Employers can post jobs to a large pool of skilled workers, control work quality, review submissions, and pay only for satisfactory completed tasks — saving time and cost.
        </div>
      </div>
    </div>

    <!-- Q2 -->
    <div class="col-12 col-md-6 faq-col">
      <div class="faq-item">
        <button class="faq-btn" onclick="toggleFaq(this)">
          <span class="plus-icon"></span>
          Why would a worker spend time and effort here?
        </button>
        <div class="faq-answer">
          Workers earn real money by completing tasks from verified employers. They can choose jobs that fit their skills, work on their own schedule, and get paid promptly on approval.
        </div>
      </div>
    </div>

    <!-- Q3 -->
    <div class="col-12 col-md-6 faq-col">
      <div class="faq-item">
        <button class="faq-btn" onclick="toggleFaq(this)">
          <span class="plus-icon"></span>
          How long is the employer's job pending?
        </button>
        <div class="faq-answer">
          An employer's job remains pending until it is reviewed and rated. If the employer does not rate within six days, the system will auto-rate the submitted work automatically.
        </div>
      </div>
    </div>

    <!-- Q4 -->
    <div class="col-12 col-md-6 faq-col">
      <div class="faq-item">
        <button class="faq-btn" onclick="toggleFaq(this)">
          <span class="plus-icon"></span>
          Job approval fees?
        </button>
        <div class="faq-answer">
          A small platform fee is applied per job approval to maintain quality control and ensure timely payouts to workers. Check the pricing page for exact rates.
        </div>
      </div>
    </div>

    <!-- Q5 -->
    <div class="col-12 col-md-6 faq-col">
      <div class="faq-item">
        <button class="faq-btn" onclick="toggleFaq(this)">
          <span class="plus-icon"></span>
          Quick resolution of complaints?
        </button>
        <div class="faq-answer">
          All complaints are reviewed by our support team within 24 hours. If a dispute is not resolved in time, the system will apply an automatic fair resolution to protect both parties.
        </div>
      </div>
    </div>

  </div>
</div>
</section>
<footer class="mt-5 footer-section">
    @include('frontend.layouts.partials.footer')
</footer>
 
 <script>
  function toggleFaq(btn) {
    const item = btn.closest('.faq-item');
    const isOpen = item.classList.contains('open');

    // Close all
    document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));

    // Open clicked if it was closed
    if (!isOpen) item.classList.add('open');
  }
</script>
@endsection