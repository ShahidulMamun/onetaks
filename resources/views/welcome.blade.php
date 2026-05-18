@extends('frontend.layouts.app')
@section('content')

<style>
  /* ── Google Fonts ── */
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap');

  /* ── CSS Variables ── */
  :root {
    --primary:       #5CA97C;
    --primary-dark:  #3d8a5e;
    --primary-light: #e8f5ee;
    --primary-mid:   #a8d8bc;
    --accent:        #2C3E50;
    --accent-light:  #f0f4f8;
    --accent-mid:    #8fa3b1;
    --text-dark:     #1a2433;
    --text-mid:      #4a5568;
    --text-light:    #718096;
    --white:         #ffffff;
    --bg-light:      #f7fbf8;
    --border:        rgba(92,169,124,0.18);
    --radius-sm:     8px;
    --radius-md:     14px;
    --radius-lg:     22px;
    --shadow-sm:     0 2px 12px rgba(92,169,124,0.10);
    --shadow-md:     0 8px 32px rgba(92,169,124,0.15);
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-dark);
    background: var(--white);
  }

  /* ═══════════════════════════════
     HERO SECTION
  ═══════════════════════════════ */
  .hero-section {
    background: linear-gradient(135deg, #f7fbf8 0%, #eaf5ef 50%, #d4edde 100%);
    padding: 90px 0 70px;
    position: relative;
    overflow: hidden;
  }
  .hero-section::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(92,169,124,0.15) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }
  .hero-section::after {
    content: '';
    position: absolute;
    bottom: -60px; left: -60px;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(44,62,80,0.06) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--white);
    border: 1px solid var(--border);
    color: var(--primary-dark);
    font-size: 13px;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 50px;
    margin-bottom: 22px;
    box-shadow: var(--shadow-sm);
  }
  .hero-badge .dot {
    width: 7px; height: 7px;
    background: var(--primary);
    border-radius: 50%;
    animation: pulse 2s infinite;
  }
  @keyframes pulse {
    0%,100%{opacity:1;transform:scale(1)}
    50%{opacity:.5;transform:scale(1.3)}
  }

  .hero-title {
    font-family: roboto;
    font-size: 46px;
    font-weight: 800;
    line-height: 1.15;
    color: var(--text-dark);
    margin-bottom: 18px;
  }
  .hero-title span { color: var(--primary); }

  .hero-subtitle {
    font-size: 17px;
    color: var(--text-mid);
    line-height: 1.7;
    margin-bottom: 34px;
    max-width: 460px;
  }

  .hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--primary);
    color: var(--white);
    font-size: 15px;
    font-weight: 700;
    padding: 14px 30px;
    border-radius: 50px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all .25s ease;
    box-shadow: 0 6px 24px rgba(92,169,124,0.35);
  }
  .hero-cta:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 10px 32px rgba(92,169,124,0.4);
    color: var(--white);
    text-decoration: none;
  }

  .hero-img-wrap {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    position: relative;
  }
  .hero-img-wrap img {
    max-width: 100%;
    filter: drop-shadow(0 20px 40px rgba(92,169,124,0.2));
    animation: floatY 4s ease-in-out infinite;
  }
  @keyframes floatY {
    0%,100%{transform:translateY(0)}
    50%{transform:translateY(-12px)}
  }

  /* ═══════════════════════════════
     SECTION TITLES
  ═══════════════════════════════ */
  .section-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--primary-dark);
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin-bottom: 12px;
  }
  .section-eyebrow::before {
    content: '';
    display: inline-block;
    width: 20px; height: 3px;
    background: var(--primary);
    border-radius: 2px;
  }

  .section-heading {
    font-family: roboto;
    font-size: 36px;
    font-weight: 800;
    color: var(--text-dark);
    line-height: 1.2;
    margin-bottom: 20px;
  }
  .section-heading span { color: var(--primary); }

  /* ═══════════════════════════════
     CHECK LIST
  ═══════════════════════════════ */
  .check-list-new {
    list-style: none;
    padding: 0;
    margin: 0 0 32px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .check-list-new li {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 15px;
    color: var(--text-mid);
    font-weight: 500;
  }
  .check-icon-new {
    width: 26px; height: 26px;
    min-width: 26px;
    background: var(--primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 12px;
  }

  /* ═══════════════════════════════
     CTA BUTTON
  ═══════════════════════════════ */
  .cta-btn-new {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--primary);
    color: var(--white);
    font-size: 14px;
    font-weight: 700;
    padding: 13px 28px;
    border-radius: 50px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all .25s ease;
    box-shadow: 0 6px 20px rgba(92,169,124,0.3);
    letter-spacing: .4px;
  }
  .cta-btn-new:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    color: var(--white);
    text-decoration: none;
  }
  .cta-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: transparent;
    color: var(--primary);
    font-size: 14px;
    font-weight: 700;
    padding: 12px 26px;
    border-radius: 50px;
    border: 2px solid var(--primary);
    cursor: pointer;
    text-decoration: none;
    transition: all .25s ease;
    letter-spacing: .4px;
  }
  .cta-btn-outline:hover {
    background: var(--primary);
    color: var(--white);
    text-decoration: none;
  }

  /* ═══════════════════════════════
     FIND JOBS SECTION
  ═══════════════════════════════ */
  .find-jobs-section {
    padding: 90px 0;
    background: var(--white);
  }
  .find-jobs-section .img-wrap {
    position: relative;
  }
  .find-jobs-section .img-wrap img {
    width: 100%;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
  }
  .img-badge {
    position: absolute;
    bottom: 24px; left: 24px;
    background: var(--white);
    border-radius: var(--radius-md);
    padding: 12px 18px;
    box-shadow: var(--shadow-md);
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-dark);
  }
  .img-badge .num { font-size: 22px; color: var(--primary); font-weight: 800; }

  /* ═══════════════════════════════
     MARKETPLACE SECTION
  ═══════════════════════════════ */
  .marketplace-section {
    background: var(--bg-light);
    padding: 90px 0;
  }

  .deal-title-new {
    font-family: roboto;
    font-size: 36px;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 40px;
  }
  .deal-title-new span { color: var(--primary); }

  .cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 14px;
  }

  .cat-card-new {
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    padding: 20px 14px 16px;
    text-align: center;
    transition: all .25s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .cat-card-new::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: var(--primary);
    transform: scaleX(0);
    transition: transform .25s ease;
    border-radius: 0 0 var(--radius-md) var(--radius-md);
  }
  .cat-card-new:hover {
    border-color: var(--primary);
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
  }
  .cat-card-new:hover::before { transform: scaleX(1); }

  .cat-icon-wrap {
    width: 52px; height: 52px;
    background: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 22px;
    transition: background .25s ease;
  }
  .cat-card-new:hover .cat-icon-wrap {
    background: var(--primary);
  }

  .cat-name-new {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 6px;
    line-height: 1.3;
  }

  .cat-deals-new {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11.5px;
    font-weight: 600;
    color: var(--primary-dark);
    background: var(--primary-light);
    padding: 3px 10px;
    border-radius: 50px;
  }
  .cat-deals-new::before {
    content: '';
    width: 5px; height: 5px;
    background: var(--primary);
    border-radius: 50%;
  }

  /* ═══════════════════════════════
     GIG CLICKERS / SERVICES SECTION
  ═══════════════════════════════ */
  .services-section {
    padding: 90px 0;
    background: var(--white);
  }

  /* ═══════════════════════════════
     EMPLOYERS SECTION
  ═══════════════════════════════ */
  .employers-section {
    padding: 90px 0;
    background: var(--accent);
    position: relative;
    overflow: hidden;
  }
  .employers-section::before {
    content: '';
    position: absolute;
    top: -100px; right: -100px;
    width: 350px; height: 350px;
    background: radial-gradient(circle, rgba(92,169,124,0.12) 0%, transparent 70%);
    border-radius: 50%;
  }

  .section-heading-light {
    font-family: roboto;
    font-size: 36px;
    font-weight: 800;
    color: var(--white);
    text-align: center;
    margin-bottom: 14px;
  }
  .section-sub-light {
    text-align: center;
    color: rgba(255,255,255,0.6);
    font-size: 15px;
    margin-bottom: 50px;
  }

  .emp-card-new {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: var(--radius-lg);
    padding: 32px 24px;
    text-align: center;
    transition: all .3s ease;
    height: 100%;
  }
  .emp-card-new:hover {
    background: rgba(92,169,124,0.15);
    border-color: rgba(92,169,124,0.4);
    transform: translateY(-6px);
  }

  .emp-icon-wrap {
    width: 64px; height: 64px;
    background: var(--primary);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
  }
  .emp-icon-wrap svg {
    width: 28px; height: 28px;
    stroke: var(--white);
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .emp-card-title {
    font-size: 17px;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 12px;
  }
  .emp-card-body {
    font-size: 14px;
    color: rgba(255,255,255,0.6);
    line-height: 1.7;
  }

  /* ═══════════════════════════════
     WORKERS SECTION
  ═══════════════════════════════ */
  .workers-section {
    padding: 90px 0;
    background: var(--bg-light);
  }

  .wrk-card-new {
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 30px 24px;
    text-align: center;
    transition: all .3s ease;
    height: 100%;
  }
  .wrk-card-new:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-md);
    transform: translateY(-5px);
  }

  .wrk-icon-wrap {
    width: 62px; height: 62px;
    background: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    transition: background .25s;
  }
  .wrk-card-new:hover .wrk-icon-wrap {
    background: var(--primary);
  }
  .wrk-icon-wrap svg {
    width: 26px; height: 26px;
    stroke: var(--primary);
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    transition: stroke .25s;
  }
  .wrk-card-new:hover .wrk-icon-wrap svg {
    stroke: var(--white);
  }

  .wrk-card-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 10px;
  }
  .wrk-card-body {
    font-size: 14px;
    color: var(--text-light);
    line-height: 1.7;
  }

  /* ═══════════════════════════════
     SHARE & EARN
  ═══════════════════════════════ */
  .share-section {
    padding: 90px 0;
    background: var(--white);
  }

  .earn-card {
    background: var(--primary-light);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 22px 24px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 16px;
    transition: all .25s ease;
  }
  .earn-card:hover {
    box-shadow: var(--shadow-sm);
    transform: translateX(4px);
  }

  .earn-icon {
    width: 42px; height: 42px;
    min-width: 42px;
    background: var(--primary);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
  }
  .earn-card-title {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 4px;
  }
  .earn-card-body {
    font-size: 13px;
    color: var(--text-mid);
    line-height: 1.5;
  }
  .earn-highlight {
    color: var(--primary-dark);
    font-weight: 800;
    font-size: 20px;
  }

  .share-illus-wrap {
    background: var(--bg-light);
    border-radius: var(--radius-lg);
    padding: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 360px;
    border: 1.5px solid var(--border);
  }

  /* ═══════════════════════════════
     FAQ SECTION
  ═══════════════════════════════ */
  .faq-section {
    padding: 90px 0;
    background: var(--bg-light);
  }

  .faq-item-new {
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden;
    transition: all .25s ease;
    margin-bottom: 0;
  }
  .faq-item-new.open {
    border-color: var(--primary);
    box-shadow: var(--shadow-sm);
  }

  .faq-btn-new {
    width: 100%;
    background: none;
    border: none;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    text-align: left;
    cursor: pointer;
    font-size: 15px;
    font-weight: 600;
    color: var(--text-dark);
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: color .2s;
  }
  .faq-item-new.open .faq-btn-new { color: var(--primary-dark); }

  .faq-plus {
    width: 28px; height: 28px;
    min-width: 28px;
    background: var(--primary-light);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 18px;
    font-weight: 400;
    line-height: 1;
    transition: all .25s;
  }
  .faq-item-new.open .faq-plus {
    background: var(--primary);
    color: var(--white);
    transform: rotate(45deg);
  }

  .faq-answer-new {
    display: none;
    padding: 0 20px 18px 62px;
    font-size: 14px;
    color: var(--text-mid);
    line-height: 1.75;
  }
  .faq-item-new.open .faq-answer-new { display: block; }

  /* ═══════════════════════════════
     DIVIDER
  ═══════════════════════════════ */
  .section-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--primary-mid), transparent);
    border: none;
    margin: 0;
  }

  /* ═══════════════════════════════
     RESPONSIVE
  ═══════════════════════════════ */
  @media (max-width: 992px) {
    .hero-title { font-size: 34px; }
    .section-heading, .section-heading-light, .deal-title-new { font-size: 28px; }
    .hero-section { padding: 60px 0 50px; }
    .find-jobs-section, .marketplace-section, .employers-section,
    .workers-section, .share-section, .faq-section, .services-section { padding: 60px 0; }
  }

  @media (max-width: 768px) {
    .hero-title { font-size: 28px; }
    .section-heading, .section-heading-light, .deal-title-new { font-size: 24px; }
    .cat-grid { grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 10px; }
    .hero-section { padding: 50px 0 40px; }
    .hero-img-wrap { margin-top: 30px; }
    .share-illus-wrap { min-height: 220px; padding: 24px; }
  }

  @media (max-width: 480px) {
    .hero-title { font-size: 24px; }
    .cat-grid { grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); gap: 8px; }
    .cat-card-new { padding: 16px 10px 12px; }
    .cat-icon-wrap { width: 44px; height: 44px; font-size: 18px; }
  }
</style>

<!-- ══════════════════════════════════
     HERO SECTION
══════════════════════════════════ -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-7">
        <div class="hero-badge">
          <span class="dot"></span>
          #1 Online Jobs Marketplace
        </div>
        <h1 class="hero-title">
          Onetaskmarket is a<br><span>Large Jobs</span><br>Marketplace
        </h1>
        <p class="hero-subtitle">OneTaskMarket is an open online marketplace that connects employers and skilled workers across the globe.</p>
        <a href="{{ route('register') }}" class="hero-cta">
          <i class="fa fa-long-arrow-right"></i>
          Get Started Free
        </a>
      </div>
      <div class="col-lg-6 col-md-5">
        <div class="hero-img-wrap">
          <img src="{{ asset('storage/home.png') }}" alt="Hero illustration">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════
     FIND JOBS SECTION
══════════════════════════════════ -->
<section class="find-jobs-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="img-wrap">
          <img src="{{ asset('images/jobs.png') }}" alt="Find Jobs">
          <div class="img-badge">
            <span class="num">500+</span>
            <span>Active Jobs</span>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="section-eyebrow">Find Jobs</div>
        <h2 class="section-heading">Get more done<br>in <span>less time</span></h2>
        <ul class="check-list-new">
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Target the right job for your skill set
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Read job details carefully and submit
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Never submit wrong or false proof
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Help grow the employer's business
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Take on promotions and special tasks
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Work across blogs, apps, social media and more
          </li>
        </ul>
        <a href="{{ route('login') }}" class="cta-btn-new">
          <i class="fa fa-long-arrow-right"></i> GET STARTED
        </a>
      </div>
    </div>
  </div>
</section>

<hr class="section-divider">

<!-- ══════════════════════════════════
     DEAL MARKETPLACE SECTION
══════════════════════════════════ -->
<section class="marketplace-section">
  <div class="container">
    <div class="section-eyebrow">Browse Categories</div>
    <h2 class="deal-title-new">Deal <span>Marketplace</span></h2>
    <div class="cat-grid">

      <div class="cat-card-new">
        <div class="cat-icon-wrap">▶️</div>
        <div class="cat-name-new">Application</div>
        <div class="cat-deals-new">39 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🎬</div>
        <div class="cat-name-new">Audio &amp; Video</div>
        <div class="cat-deals-new">23 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🗂️</div>
        <div class="cat-name-new">CMS</div>
        <div class="cat-deals-new">4 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🔒</div>
        <div class="cat-name-new">Cyber Security</div>
        <div class="cat-deals-new">1 Deal</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🛠️</div>
        <div class="cat-name-new">Digital Service</div>
        <div class="cat-deals-new">21 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">💲</div>
        <div class="cat-name-new">Dollar Service</div>
        <div class="cat-deals-new">22 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🌐</div>
        <div class="cat-name-new">Domain</div>
        <div class="cat-deals-new">5 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">⚡</div>
        <div class="cat-name-new">Ezoic</div>
        <div class="cat-deals-new">2 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">📘</div>
        <div class="cat-name-new">Facebook Service</div>
        <div class="cat-deals-new">80 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">💰</div>
        <div class="cat-name-new">Google Adsense</div>
        <div class="cat-deals-new">12 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🎨</div>
        <div class="cat-name-new">Graphics Design</div>
        <div class="cat-deals-new">26 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">📦</div>
        <div class="cat-name-new">Minute &amp; MB Package</div>
        <div class="cat-deals-new">3 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🔷</div>
        <div class="cat-name-new">Others</div>
        <div class="cat-deals-new">60 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🅿️</div>
        <div class="cat-name-new">Paypal Service</div>
        <div class="cat-deals-new">0 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">📈</div>
        <div class="cat-name-new">SEO Service</div>
        <div class="cat-deals-new">4 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🌍</div>
        <div class="cat-name-new">Web Service</div>
        <div class="cat-deals-new">15 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">🏷️</div>
        <div class="cat-name-new">Website Sell</div>
        <div class="cat-deals-new">8 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">✍️</div>
        <div class="cat-name-new">Writing</div>
        <div class="cat-deals-new">13 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">▶️</div>
        <div class="cat-name-new">Youtube Service</div>
        <div class="cat-deals-new">79 Deals</div>
      </div>

      <div class="cat-card-new">
        <div class="cat-icon-wrap">📧</div>
        <div class="cat-name-new">Email Marketing</div>
        <div class="cat-deals-new">32 Deals</div>
      </div>

    </div>
  </div>
</section>

<hr class="section-divider">

<!-- ══════════════════════════════════
     GIG CLICKERS / SERVICES SECTION
══════════════════════════════════ -->
<section class="services-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="section-eyebrow">OneTaskMarket</div>
        <h2 class="section-heading">Exchange online service<br>at <span>OneTaskMarket</span></h2>
        <ul class="check-list-new">
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Target the right job for your skill set
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Read job details carefully and submit
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Never submit wrong or false proof
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Help grow the employer's business
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Take on promotions and special tasks
          </li>
          <li>
            <span class="check-icon-new"><i class="fa fa-check fa-xs"></i></span>
            Work across blogs, apps, social media and more
          </li>
        </ul>
        <div class="d-flex gap-3 flex-wrap">
          <a href="{{ route('register') }}" class="cta-btn-new">
            <i class="fa fa-long-arrow-right"></i> GET STARTED
          </a>
          <a href="{{ route('login') }}" class="cta-btn-outline">Sign In</a>
        </div>
      </div>
      <div class="col-lg-6">
        <img src="{{ asset('images/jobs.png') }}" alt="OneTaskMarket Services" style="width:100%; border-radius:var(--radius-lg); box-shadow:var(--shadow-md);">
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════
     EMPLOYERS SECTION
══════════════════════════════════ -->
<section class="employers-section">
  <div class="container">
    <div class="section-eyebrow text-center" style="justify-content:center; color:rgba(255,255,255,0.6);">
      <span style="background:rgba(255,255,255,0.15); padding:6px 16px; border-radius:50px; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:1.2px;">For Employers</span>
    </div>
    <h2 class="section-heading-light mt-3">Employers</h2>
    <p class="section-sub-light">Full control over your posted jobs and worker performance</p>
    <div class="row g-4">
      <!-- Card 1 — Select Country -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="emp-card-new">
          <div class="emp-icon-wrap">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </div>
          <h5 class="emp-card-title">Select Country</h5>
          <p class="emp-card-body">Post jobs targeting any country. Run social tasks and other assignments easily through your chosen employees worldwide.</p>
        </div>
      </div>
      <!-- Card 2 — Review Job -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="emp-card-new">
          <div class="emp-icon-wrap">
            <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </div>
          <h5 class="emp-card-title">Review Job</h5>
          <p class="emp-card-body">Review and rate work within six days. If not rated in time, the system will auto-rate submitted work for you automatically.</p>
        </div>
      </div>
      <!-- Card 3 — Rate Job -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="emp-card-new">
          <div class="emp-icon-wrap">
            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <h5 class="emp-card-title">Rate Job</h5>
          <p class="emp-card-body">Control and review each employee's performance. Rate work as satisfactory or unsatisfactory based on quality delivered.</p>
        </div>
      </div>
      <!-- Card 4 — Report Job -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="emp-card-new">
          <div class="emp-icon-wrap">
            <svg viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          </div>
          <h5 class="emp-card-title">Report Job</h5>
          <p class="emp-card-body">Send work for revision when needed. Workers must resubmit within 24 hours or the job will be automatically marked unsatisfied.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════
     WORKERS SECTION
══════════════════════════════════ -->
<section class="workers-section">
  <div class="container">
    <div class="text-center mb-5">
      <div class="section-eyebrow" style="justify-content:center;">For Workers</div>
      <h2 class="section-heading mt-2">Workers</h2>
      <p style="color:var(--text-light); font-size:15px; max-width:480px; margin:0 auto;">Complete jobs, earn money, and build your reputation</p>
    </div>
    <div class="row g-4">
      <!-- Submit Job -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="wrk-card-new">
          <div class="wrk-icon-wrap">
            <svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><polyline points="3 6 4 7 6 5"/><polyline points="3 12 4 13 6 11"/><polyline points="3 18 4 19 6 17"/></svg>
          </div>
          <h5 class="wrk-card-title">Submit Job</h5>
          <p class="wrk-card-body">Browse and complete any job from the Finds Job list. Read each task carefully before submitting your work.</p>
        </div>
      </div>
      <!-- Revision Job -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="wrk-card-new">
          <div class="wrk-icon-wrap">
            <svg viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
          </div>
          <h5 class="wrk-card-title">Revision Job</h5>
          <p class="wrk-card-body">If your work is sent for revision by the employer, complete and resubmit it within 24 hours to avoid penalties.</p>
        </div>
      </div>
      <!-- Report Job -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="wrk-card-new">
          <div class="wrk-icon-wrap">
            <svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
          </div>
          <h5 class="wrk-card-title">Report Job</h5>
          <p class="wrk-card-body">If an employer pays incorrectly after job completion, you can report against the work within 24 hours of receiving your rating.</p>
        </div>
      </div>
      <!-- Complete Job -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="wrk-card-new">
          <div class="wrk-icon-wrap">
            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          </div>
          <h5 class="wrk-card-title">Complete Job</h5>
          <p class="wrk-card-body">Complete jobs with OneTaskMarket and earn consistently. Build your profile, grow your income, and remove unemployment.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<hr class="section-divider">

<!-- ══════════════════════════════════
     SHARE & EARN SECTION
══════════════════════════════════ -->
<section class="share-section" id="share_earn">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <div class="share-illus-wrap">
          <!-- Running People illustration preserved -->
          <div style="display:flex; align-items:flex-end; gap:8px; flex-wrap:wrap; justify-content:center;">
            <!-- Person 1 -->
            <svg width="72" height="140" viewBox="0 0 90 170" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="45" cy="28" r="18" fill="#8A80A3"/>
              <ellipse cx="45" cy="14" rx="18" ry="10" fill="#5CA97C"/>
              <rect x="28" y="46" width="34" height="55" rx="6" fill="#2784F5"/>
              <rect x="40" y="46" width="10" height="30" fill="#fff"/>
              <rect x="14" y="48" width="14" height="38" rx="7" fill="#3d8a5e" transform="rotate(15 14 48)"/>
              <rect x="62" y="48" width="14" height="38" rx="7" fill="#3d8a5e" transform="rotate(-20 76 48)"/>
              <circle cx="16" cy="86" r="7" fill="#5CA97C"/>
              <circle cx="76" cy="84" r="7" fill="#5CA97C"/>
              <rect x="28" y="99" width="15" height="52" rx="7" fill="#3d8a5e" transform="rotate(8 28 99)"/>
              <rect x="47" y="99" width="15" height="52" rx="7" fill="#3d8a5e" transform="rotate(-12 62 99)"/>
              <ellipse cx="29" cy="153" rx="12" ry="6" fill="#2C3E50"/>
              <ellipse cx="60" cy="153" rx="12" ry="6" fill="#2C3E50"/>
            </svg>
            <!-- Person 2 -->
            <svg width="64" height="124" viewBox="0 0 80 155" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="40" cy="24" r="16" fill="#f4c3a0"/>
              <ellipse cx="40" cy="12" rx="17" ry="9" fill="#5CA97C"/>
              <rect x="24" y="40" width="32" height="48" rx="6" fill="#3d8a5e"/>
              <rect x="10" y="42" width="13" height="35" rx="6" fill="#3d8a5e" transform="rotate(12 10 42)"/>
              <rect x="57" y="42" width="13" height="35" rx="6" fill="#3d8a5e" transform="rotate(-18 70 42)"/>
              <circle cx="11" cy="78" r="6" fill="#f4c3a0"/>
              <circle cx="70" cy="78" r="6" fill="#f4c3a0"/>
              <path d="M22 86 Q16 110 14 130 Q40 138 66 130 Q64 110 58 86 Z" fill="#5CA97C"/>
              <rect x="26" y="128" width="12" height="18" rx="6" fill="#f4c3a0" transform="rotate(10 26 128)"/>
              <rect x="44" y="128" width="12" height="18" rx="6" fill="#f4c3a0" transform="rotate(-10 56 128)"/>
              <ellipse cx="26" cy="148" rx="10" ry="5" fill="#2C3E50"/>
              <ellipse cx="55" cy="146" rx="10" ry="5" fill="#2C3E50"/>
            </svg>
            <!-- Person 3 Hero with bulb -->
            <div style="text-align:center; position:relative;">
              <div style="font-size:28px; margin-bottom:-8px;">💡</div>
              <svg width="96" height="176" viewBox="0 0 120 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="32" r="22" fill="#5CA97C"/>
                <ellipse cx="60" cy="20" rx="22" ry="12" fill="#3d8a5e"/>
                <ellipse cx="60" cy="48" rx="14" ry="8" fill="#3d8a5e"/>
                <rect x="34" y="54" width="52" height="72" rx="8" fill="#2C3E50"/>
                <rect x="52" y="54" width="16" height="42" fill="#5CA97C"/>
                <rect x="10" y="30" width="16" height="50" rx="8" fill="#3d8a5e" transform="rotate(30 18 30)"/>
                <circle cx="22" cy="75" r="9" fill="#c8a07a"/>
                <rect x="94" y="56" width="16" height="44" rx="8" fill="#3d8a5e" transform="rotate(-10 102 56)"/>
                <circle cx="105" cy="100" r="9" fill="#c8a07a"/>
                <rect x="34" y="124" width="20" height="68" rx="10" fill="#3d8a5e" transform="rotate(6 34 124)"/>
                <rect x="66" y="124" width="20" height="68" rx="10" fill="#3d8a5e" transform="rotate(-8 86 124)"/>
                <ellipse cx="38" cy="194" rx="16" ry="7" fill="#2C3E50"/>
                <ellipse cx="78" cy="192" rx="16" ry="7" fill="#2C3E50"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="section-eyebrow">Referral Program</div>
        <h2 class="section-heading">Share &amp; <span>Earn</span></h2>
        <p style="color:var(--text-mid); font-size:15px; line-height:1.7; margin-bottom:28px;">
          Invite your friends to the OneTaskMarket platform and earn special bonuses. Every deposit and job comes with referral rewards.
        </p>

        <h6 style="font-size:14px; font-weight:700; color:var(--text-dark); margin-bottom:16px;">What do you get for each invitation?</h6>

        <div class="earn-card">
          <div class="earn-icon">%</div>
          <div>
            <div class="earn-card-title">Work Bonus on Referral</div>
            <div class="earn-card-body">
              When your friend joins and completes work, you receive <span class="earn-highlight">3%</span> of their work bonus automatically.
            </div>
          </div>
        </div>

        <div class="earn-card">
          <div class="earn-icon">💳</div>
          <div>
            <div class="earn-card-title">Deposit Bonus</div>
            <div class="earn-card-body">
              You instantly earn a <span class="earn-highlight">5%</span> bonus on every deposit made by a friend who accepted your invitation.
            </div>
          </div>
        </div>

        <a href="{{ route('register') }}" class="cta-btn-new mt-3 d-inline-flex">
          <i class="fa fa-long-arrow-right"></i> GET STARTED
        </a>
      </div>
    </div>
  </div>
</section>

<hr class="section-divider">

<!-- ══════════════════════════════════
     FAQ SECTION
══════════════════════════════════ -->
<section class="faq-section" id="faq">
  <div class="container">
    <div class="text-center mb-5">
      <div class="section-eyebrow" style="justify-content:center;">Support</div>
      <h2 class="section-heading mt-2">Frequently Asked <span>Questions</span></h2>
    </div>
    <div class="row g-3">

      <div class="col-12 col-md-6">
        <div class="faq-item-new">
          <button class="faq-btn-new" onclick="toggleFaq(this)">
            <span class="faq-plus">+</span>
            What are the benefits for employers?
          </button>
          <div class="faq-answer-new">
            Employers can post jobs to a large pool of skilled workers, control work quality, review submissions, and pay only for satisfactory completed tasks — saving time and cost.
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="faq-item-new">
          <button class="faq-btn-new" onclick="toggleFaq(this)">
            <span class="faq-plus">+</span>
            Why would a worker spend time and effort here?
          </button>
          <div class="faq-answer-new">
            Workers earn real money by completing tasks from verified employers. They can choose jobs that fit their skills, work on their own schedule, and get paid promptly on approval.
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="faq-item-new">
          <button class="faq-btn-new" onclick="toggleFaq(this)">
            <span class="faq-plus">+</span>
            How long is the employer's job pending?
          </button>
          <div class="faq-answer-new">
            An employer's job remains pending until it is reviewed and rated. If the employer does not rate within six days, the system will auto-rate the submitted work automatically.
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="faq-item-new">
          <button class="faq-btn-new" onclick="toggleFaq(this)">
            <span class="faq-plus">+</span>
            Job approval fees?
          </button>
          <div class="faq-answer-new">
            A small platform fee is applied per job approval to maintain quality control and ensure timely payouts to workers. Check the pricing page for exact rates.
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="faq-item-new">
          <button class="faq-btn-new" onclick="toggleFaq(this)">
            <span class="faq-plus">+</span>
            Quick resolution of complaints?
          </button>
          <div class="faq-answer-new">
            All complaints are reviewed by our support team within 24 hours. If a dispute is not resolved in time, the system will apply an automatic fair resolution to protect both parties.
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<footer class="mt-0 footer-section">
  @include('frontend.layouts.partials.footer')
</footer>

<script>
  function toggleFaq(btn) {
    const item = btn.closest('.faq-item-new');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item-new').forEach(i => i.classList.remove('open'));
    if (!isOpen) item.classList.add('open');
  }
</script>
@endsection