
@extends('frontend.layouts.app')
@section('content')
<br><br><br><br>
<div class="container">
<!-- blog detalies images -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-5">
      <div class="card">
        <div class="card-body">
    <img class="rounded mx-auto d-block" src="{{ asset('images/article/1.jpg')}}" alt="not found"/>
    <div class="course-title text-center">
          Web Development Bootcamp
        </div>
         <p class="mt-5">Text here............</p>
      </div>
    </div>
</div>
 <!-- Related Blog -->
  <h2 class="section-heading mt-5">Related Blog</h2>
   <div class="card-divider"></div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-4">
    <!-- Card 1: Development -->
    <div class="col">
      <div class="course-card">
        <div class="card-img-area">
          <img src="{{ asset('images/article/1.jpg')}}" alt="not found"/>
        </div>
        <div class="card-body-custom">
          <div class="course-title">
          	<a class="text-decoration-none" href="{{ route('article.details')}}">
          Web Development Bootcamp
          </a>
          </div>
          <div class="article">
            <span class="article-descpriction">Learn from the best instructors and grow your skills</span>
          </div>
          <div class="card-divider"></div>
          <div class="card-footer-custom">
            <span class="date">05/02/2026</span>
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
          <img src="{{ asset('images/article/2.jpg')}}" alt="not found"/>
        </div>
        <div class="card-body-custom">
          <div class="course-title">
          	<a class="text-decoration-none" href="{{ route('article.details')}}">UI/UX Design Masterclass</a></div>
          <div class="article">
            <span class="article-descpriction">Navigating Deposits and Withdrawals</span>
          </div>
          <div class="card-divider"></div>
          <div class="card-footer-custom">
          <span class="date">05/02/2026</span>
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
          <img src="{{ asset('images/article/3.jpg')}}" alt="not found"/>
        </div>
        <div class="card-body-custom">
          <div class="course-title"><a class="text-decoration-none" href="{{ route('article.details')}}">Data Science & Analytics</a></div>
          <div class="article">
            <span class="article-descpriction">Navigating Deposits and Withdrawals on </span>
          </div>
          <div class="card-divider"></div>
          <div class="card-footer-custom">
           <span class="date">05/02/2026</span>
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
          <img src="{{ asset('images/article/4.jpg')}}" alt="not found"/>
        </div>
        <div class="card-body-custom">
          <div class="course-title"><a class="text-decoration-none" href="{{ route('article.details')}}">Digital Marketing Pro</a></div>
          <div class="article">
            <span class="article-descpriction">Navigating Deposits and Withdrawals on </span>
          </div>
          <div class="card-divider"></div>
          <div class="card-footer-custom">
            <span class="date">05/02/2026</span>
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
