@extends('frontend.layouts.app')
@section('content')
<br><br><br><br>
<div class="container">
  <h2 class="section-heading">Featured Courses</h2>
  <p class="section-sub">Learn from the best instructors and grow your skills</p>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-4">
    <!-- Card 1: Development -->
    <div class="col">
      <div class="course-card">
        <div class="card-img-area">
          <span class="cat-badge badge-development">Development</span>
          <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=80" alt="Web Development"/>
        </div>
        <div class="card-body-custom">
          <div class="course-title">Web Development Bootcamp</div>
          <div class="instructor">
            <img src="https://i.pravatar.cc/60?img=47" alt="Trisha Leo"/>
            <span class="instructor-name">Trisha Leo</span>
          </div>
          <div class="card-divider"></div>
          <div class="meta-row">
            <div class="meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              12 weeks
            </div>
            <div class="meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              2.4K
            </div>
            <div class="meta-item rating">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              4.9
            </div>
          </div>
          <div class="card-footer-custom">
            <span class="price">$49</span>
            <button class="enroll-btn">
              Enroll now
              <span class="arrow">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Card 2: Design -->
    <div class="col">
      <div class="course-card">
        <div class="card-img-area">
          <span class="cat-badge badge-design">Design</span>
          <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=600&q=80" alt="UI/UX Design"/>
        </div>
        <div class="card-body-custom">
          <div class="course-title">UI/UX Design Masterclass</div>
          <div class="instructor">
            <img src="https://i.pravatar.cc/60?img=5" alt="Sarah Johnson"/>
            <span class="instructor-name">Sarah Johnson</span>
          </div>
          <div class="card-divider"></div>
          <div class="meta-row">
            <div class="meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              8 weeks
            </div>
            <div class="meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              1.8K
            </div>
            <div class="meta-item rating">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              4.8
            </div>
          </div>
          <div class="card-footer-custom">
            <span class="price">$79</span>
            <button class="enroll-btn">
              Enroll now
              <span class="arrow">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Card 3: Data Science -->
    <div class="col">
      <div class="course-card">
        <div class="card-img-area">
          <span class="cat-badge badge-datascience">Data Science</span>
          <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&q=80" alt="Data Science"/>
        </div>
        <div class="card-body-custom">
          <div class="course-title">Data Science & Analytics</div>
          <div class="instructor">
            <img src="https://i.pravatar.cc/60?img=12" alt="Mike Chen"/>
            <span class="instructor-name">Mike Chen</span>
          </div>
          <div class="card-divider"></div>
          <div class="meta-row">
            <div class="meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              16 weeks
            </div>
            <div class="meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              3.2K
            </div>
            <div class="meta-item rating">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              4.9
            </div>
          </div>
          <div class="card-footer-custom">
            <span class="price">$129</span>
            <button class="enroll-btn">
              Enroll now
              <span class="arrow">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Card 4: Marketing -->
    <div class="col">
      <div class="course-card">
        <div class="card-img-area">
          <span class="cat-badge badge-marketing">Marketing</span>
          <img src="https://images.unsplash.com/photo-1533750349088-cd871a92f312?w=600&q=80" alt="Digital Marketing"/>
        </div>
        <div class="card-body-custom">
          <div class="course-title">Digital Marketing Pro</div>
          <div class="instructor">
            <img src="https://i.pravatar.cc/60?img=9" alt="Emma Davis"/>
            <span class="instructor-name">Emma Davis</span>
          </div>
          <div class="card-divider"></div>
          <div class="meta-row">
            <div class="meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              6 weeks
            </div>
            <div class="meta-item">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              1.5K
            </div>
            <div class="meta-item rating">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              4.7
            </div>
          </div>
          <div class="card-footer-custom">
            <span class="price">$69</span>
            <button class="enroll-btn">
              Enroll now
              <span class="arrow">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="mt-5 footer-section">
    @include('frontend.layouts.partials.footer')
</footer>
@endsection

