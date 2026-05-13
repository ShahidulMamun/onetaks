@extends('user.layouts.app')
@section('content')

<style>
  :root {
    --primary:     #006A4E;
    --success:     #1abc9c;
    --danger:      #e74c3c;
    --text-dark:   #2d3748;
    --text-muted:  #718096;
    --bg-card:     #ffffff;
    --bg-page:     #f7f8fc;
    --border:      #e2e8f0;
    --shadow:      0 2px 12px rgba(102,88,221,0.08);
    --radius:      12px;
    --boost:       #8b5cf6;
    --boost-dark:  #6d28d9;
    --boost-light: #ede9fe;
    --top-color:   #f39c12;
    --top-light:   #fef3cd;
  }

  body { background: var(--bg-page); }

  /* ─── Filter Bar ─── */
  .filter-bar {
    background: var(--bg-card);
    border-radius: var(--radius);
    padding: 14px 18px;
    box-shadow: var(--shadow);
    margin-bottom: 0;
  }

  .result-count { font-size: 14px; color: var(--text-dark); white-space: nowrap; }

  .filter-select, .filter-input, .filter-sort {
    border: 1.5px solid var(--border);
    border-radius: 8px;
    padding: 7px 10px;
    font-size: 12px;
    color: var(--text-dark);
    background: #fff;
    outline: none;
    transition: border-color .2s;
    height: 36px;
    width: 100%;
  }

  .filter-select:focus, .filter-input:focus, .filter-sort:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(0,106,78,.1);
  }

  .filter-controls {
    display: flex;
    gap: 8px;
    flex-wrap: nowrap;
    align-items: center;
    width: 100%;
  }

  .filter-controls > * { flex: 1 1 0; min-width: 0; }

  .search-wrapper { position: relative; flex: 1 1 0; min-width: 0; }
  .search-wrapper .search-icon {
    position: absolute;
    left: 9px; top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 11px;
    pointer-events: none;
  }
  .search-wrapper .filter-input { padding-left: 26px; }

  /* ─── Section Labels ─── */
  .section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 0 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
  }

  .section-label .sl-line {
    flex: 1;
    height: 1px;
    background: var(--border);
  }

  .section-label.boosted-label { color: var(--boost); }
  .section-label.top-label     { color: var(--top-color); }
  .section-label.normal-label  { color: var(--text-muted); }

  /* ─── Job Card (mobile) ─── */
  .job-card {
    background: var(--bg-card);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 14px 16px;
    margin-bottom: 10px;
    cursor: pointer;
    border-left: 4px solid var(--primary);
    transition: box-shadow .2s, transform .15s;
    text-decoration: none;
    color: inherit;
    display: block;
    position: relative;
    overflow: hidden;
  }

  .job-card:hover {
    box-shadow: 0 6px 20px rgba(102,88,221,.16);
    transform: translateY(-2px);
    text-decoration: none;
    color: inherit;
  }

  /* Boosted card */
  .job-card.card-boosted {
    border-left-color: var(--boost);
    background: linear-gradient(135deg, #fff 80%, #f5f0ff 100%);
  }

  .job-card.card-boosted::after {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 60px; height: 60px;
    background: radial-gradient(circle at top right, rgba(139,92,246,.12), transparent 70%);
    pointer-events: none;
  }

  /* Top card */
  .job-card.card-top {
    border-left-color: var(--top-color);
    background: linear-gradient(135deg, #fff 80%, #fffbf0 100%);
  }

  .job-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 8px;
  }

  .job-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-dark);
    white-space: normal;
    word-break: break-word;
    flex: 1;
  }

  .job-earn { font-size: 14px; font-weight: 700; white-space: nowrap; }

  .job-card-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 8px;
    flex-wrap: wrap;
    gap: 4px;
  }

  .job-zone {
    font-size: 11px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .worker-badge {
    font-size: 11px;
    background: #f1f5f9;
    border-radius: 20px;
    padding: 2px 10px;
    box-shadow: inset 0 1px 2px rgba(0,0,0,.06);
  }

  /* Badges */
  .pill-boost {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    background: linear-gradient(135deg, var(--boost), var(--boost-dark));
    color: #fff;
    border-radius: 20px;
    padding: 2px 8px;
    font-size: 10px;
    font-weight: 700;
    animation: boostGlow 2s ease-in-out infinite;
  }

  @keyframes boostGlow {
    0%, 100% { box-shadow: 0 0 0 0 rgba(139,92,246,.4); }
    50%       { box-shadow: 0 0 0 4px rgba(139,92,246,0); }
  }

  .pill-top {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    background: linear-gradient(135deg, var(--top-color), #e67e22);
    color: #fff;
    border-radius: 20px;
    padding: 2px 8px;
    font-size: 10px;
    font-weight: 700;
  }

  .boost-timer {
    font-size: 10px;
    color: var(--boost-dark);
    background: var(--boost-light);
    border-radius: 6px;
    padding: 1px 7px;
    font-weight: 600;
  }

  /* ─── Desktop Table ─── */
  .jobs-table-wrap {
    background: var(--bg-card);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .jobs-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
  }

  .jobs-table thead th {
    background: #f8f7ff;
    color: var(--text-dark);
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 13px 16px;
    border-bottom: 2px solid var(--border);
  }

  .jobs-table tbody tr {
    cursor: pointer;
    transition: background .15s;
    border-bottom: 1px solid var(--border);
  }

  .jobs-table tbody tr:last-child { border-bottom: none; }
  .jobs-table tbody tr:hover { background: #f8f7ff; }

  /* Desktop row highlights */
  .jobs-table tbody tr.row-boosted {
    background: linear-gradient(90deg, #f5f0ff 0%, #fff 100%);
  }
  .jobs-table tbody tr.row-boosted:hover { background: #ede9fe; }

  .jobs-table tbody tr.row-top {
    background: linear-gradient(90deg, #fffbf0 0%, #fff 100%);
  }
  .jobs-table tbody tr.row-top:hover { background: var(--top-light); }

  /* Section divider row in table */
  .section-divider-row td {
    background: #f8f9fa !important;
    padding: 6px 16px !important;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    border-bottom: 1px solid var(--border) !important;
    cursor: default !important;
  }

  .jobs-table tbody tr.section-divider-row:hover { background: #f8f9fa !important; }

  .jobs-table td {
    padding: 12px 16px;
    vertical-align: middle;
  }

  .td-title {
    max-width: 220px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 600;
    color: var(--text-dark);
  }

  /* ─── Empty state ─── */
  .empty-state {
    text-align: center;
    padding: 40px 20px;
    color: var(--text-muted);
    font-size: 13px;
  }
  .empty-state i { font-size: 32px; color: var(--border); margin-bottom: 10px; }

  /* ─── Responsive ─── */
  @media (max-width: 767px) {
    .desktop-view { display: none !important; }
    .mobile-view  { display: block !important; }
  }
  @media (min-width: 768px) {
    .mobile-view  { display: none !important; }
    .desktop-view { display: block !important; }
  }

  @media (max-width: 575px) {
   .filter-controls { flex-wrap: nowrap; gap: 5px; }
  .filter-select, .filter-sort { font-size: 11px; padding: 6px 4px; }
  .filter-input { font-size: 11px; padding: 6px 6px 6px 24px; }
  .filter-controls > * { flex: 1 1 0; min-width: 0; }
  }
</style>

<div class="container mt-4 mb-5">
  <div class="row">
    <div class="col-12">

      {{-- ── Filter Bar ── --}}
      <div class="filter-bar mb-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
          <span class="result-count fw-bold">
            <i class="fa fa-bars text-primary"></i>
            Available Jobs
            <span class="badge bg-danger ms-1" id="jobCount">{{ count($jobs) }}</span>
          </span>
          {{-- Legend --}}
          
        </div>
        <div class="filter-controls">
          @php
            $categories = App\Models\Category::where('is_active', true)->get();
          @endphp
          <select class="filter-select" id="catSelect" onchange="applyFilters()">
            <option value="">All Categories</option>
            @foreach($categories as $category)
              <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
          </select>
          <div class="search-wrapper">
            <i class="fa fa-search search-icon"></i>
            <input type="text" class="filter-input" id="searchInput" placeholder="Search title..." oninput="applyFilters()">
          </div>
          <select class="filter-sort" id="sortSelect" onchange="applyFilters()">
            <option value="default">Default (Priority)</option>
            <option value="highest">Highest Pay</option>
            <option value="lowest">Lowest Pay</option>
            <option value="newest">Most Recent</option>
          </select>
        </div>
      </div>

      {{-- ════════════════════════════════
           MOBILE VIEW
      ════════════════════════════════ --}}
      <div class="mobile-view" id="mobileList">

        {{-- 🚀 Boosted Section --}}
        @if($boostedJobs->count())
          <div class="section-label boosted-label">
            <span><i class="bi bi-rocket-takeoff-fill me-1"></i>Boosted</span>
            <span class="sl-line"></span>
          </div>
          @foreach($boostedJobs as $job)
          <a class="job-card card-boosted"
             href="{{ route('user.job-details', $job->code) }}"
             data-title="{{ strtolower($job->title) }}"
             data-earn="{{ $job->worker_earn }}"
             data-type="boosted"
             data-index="{{ $loop->index }}">
            <div class="job-card-top">
              <span class="job-title" title="{{ $job->title }}">{{ $job->title }}</span>
              <span class="job-earn" style="color:var(--boost);">${{ $job->worker_earn }}</span>
            </div>
            <div class="job-card-bottom">
              <span class="job-zone">
                <i class="fa fa-globe"></i>
                {{ $job->continent->name ?? 'Global' }}
              </span>
              <span class="d-flex align-items-center gap-2 flex-wrap">
                <span class="worker-badge">
                  <strong class="text-danger">{{ $job->worker_done }}</strong>
                  <span class="text-muted">/</span>
                  <strong class="text-success">{{ $job->worker_need }}</strong>
                  <span class="text-muted ms-1">slots</span>
                </span>
                <span class="pill-boost" style="font-size:9px;">
                  <i class="bi bi-rocket-takeoff-fill"></i>
                  {{ $job->boostRemainingMinutes() }}m left
                </span>
              </span>
            </div>
          </a>
          @endforeach
        @endif

        {{-- ⭐ Top Section --}}
        @if($topJobs->count())
          <div class="section-label top-label">
            <span><i class="bi bi-star-fill me-1"></i>Top Jobs</span>
            <span class="sl-line"></span>
          </div>
          @foreach($topJobs as $job)
          <a class="job-card card-top"
             href="{{ route('user.job-details', $job->code) }}"
             data-title="{{ strtolower($job->title) }}"
             data-earn="{{ $job->worker_earn }}"
             data-type="top"
             data-index="{{ $loop->index }}">
            <div class="job-card-top">
              <span class="job-title" title="{{ $job->title }}">{{ $job->title }}</span>
              <span class="job-earn" style="color:var(--top-color);">${{ $job->worker_earn }}</span>
            </div>
            <div class="job-card-bottom">
              <span class="job-zone">
                <i class="fa fa-globe"></i>
                {{ $job->continent->name ?? 'Global' }}
              </span>
              <span class="d-flex align-items-center gap-2">
                <span class="worker-badge">
                  <strong class="text-danger">{{ $job->worker_done }}</strong>
                  <span class="text-muted">/</span>
                  <strong class="text-success">{{ $job->worker_need }}</strong>
                  <span class="text-muted ms-1">slots</span>
                </span>
                <span class="pill-top" style="font-size:9px;">
                  <i class="bi bi-star-fill"></i> Top
                </span>
              </span>
            </div>
          </a>
          @endforeach
        @endif

        {{-- 📋 Normal Section --}}
        @if($normalJobs->count())
          <div class="section-label normal-label">
            <span><i class="bi bi-list-ul me-1"></i>All Jobs</span>
            <span class="sl-line"></span>
          </div>
          @foreach($normalJobs as $job)
          <a class="job-card"
             href="{{ route('user.job-details', $job->code) }}"
             data-title="{{ strtolower($job->title) }}"
             data-earn="{{ $job->worker_earn }}"
             data-type="normal"
             data-index="{{ $loop->index }}">
            <div class="job-card-top">
              <span class="job-title" title="{{ $job->title }}">{{ $job->title }}</span>
              <span class="job-earn" style="color:var(--text-dark);">${{ $job->worker_earn }}</span>
            </div>
            <div class="job-card-bottom">
              <span class="job-zone">
                <i class="fa fa-globe text-dark"></i>
                {{ $job->continent->name ?? 'Global' }}
              </span>
              <span class="worker-badge">
                <strong class="text-danger">{{ $job->worker_done }}</strong>
                <span class="text-muted">/</span>
                <strong class="text-success">{{ $job->worker_need }}</strong>
                <span class="text-muted ms-1">slots</span>
              </span>
            </div>
          </a>
          @endforeach
        @endif

        {{-- Empty --}}
        @if($jobs->isEmpty())
          <div class="empty-state">
            <div><i class="fa fa-inbox"></i></div>
            কোনো job পাওয়া যায়নি।
          </div>
        @endif

        <div class="empty-state" id="mobileEmpty" style="display:none;">
          <div><i class="fa fa-search-minus"></i></div>
          No jobs match your filters.
        </div>
      </div>

      {{-- ════════════════════════════════
           DESKTOP TABLE VIEW
      ════════════════════════════════ --}}
      <div class="desktop-view jobs-table-wrap">
        <table class="jobs-table">
          <thead>
            <tr>
              <th style="width:36px;"></th>
              <th>Zone</th>
              <th>Title</th>
              <th>Earning</th>
              <th>Workers</th>
            </tr>
          </thead>
          <tbody id="desktopBody">

            {{-- 🚀 Boosted rows --}}
            @if($boostedJobs->count())
            <tr class="section-divider-row">
              <td colspan="5">
                <span style="color:var(--boost);">
                  <i class="bi bi-rocket-takeoff-fill me-1"></i>
                  Boosted Jobs
                </span>
              </td>
            </tr>
            @foreach($boostedJobs as $job)
            <tr class="row-boosted"
                onclick="window.location.href='{{ route('user.job-details', $job->code) }}'"
                data-title="{{ strtolower($job->title) }}"
                data-earn="{{ $job->worker_earn }}"
                data-type="boosted"
                data-index="{{ $loop->index }}">
              <td>
                <span class="pill-boost" style="font-size:9px; padding:2px 6px;">
                  <i class="bi bi-rocket-takeoff-fill"></i>
                </span>
              </td>
              <td>
                <i class="fa fa-globe text-success"
                   data-bs-toggle="tooltip"
                   title="{{ $job->continent->name ?? 'Global' }}"></i>
              </td>
              <td>
                <span class="td-title" title="{{ $job->title }}">{{ $job->title }}</span>
                <div style="margin-top:2px;">
                  <span class="boost-timer">
                    <i class="bi bi-clock me-1"></i>{{ $job->boostRemainingMinutes() }}m left
                  </span>
                </div>
              </td>
              <td class="fw-bold" style="color:var(--boost);">${{ $job->worker_earn }}</td>
              <td>
                <span class="worker-badge">
                  <strong class="text-danger">{{ $job->worker_done }}</strong>/<strong class="text-success">{{ $job->worker_need }}</strong>
                </span>
              </td>
            </tr>
            @endforeach
            @endif

            {{-- ⭐ Top rows --}}
            @if($topJobs->count())
            <tr class="section-divider-row">
              <td colspan="5">
                <span style="color:var(--top-color);">
                  <i class="bi bi-star-fill me-1"></i>
                  Top Jobs
                </span>
              </td>
            </tr>
            @foreach($topJobs as $job)
            <tr class="row-top"
                onclick="window.location.href='{{ route('user.job-details', $job->code) }}'"
                data-title="{{ strtolower($job->title) }}"
                data-earn="{{ $job->worker_earn }}"
                data-type="top"
                data-index="{{ $loop->index }}">
              <td>
                <span class="pill-top" style="font-size:9px; padding:2px 6px;">
                  <i class="bi bi-star-fill"></i>
                </span>
              </td>
              <td>
                <i class="fa fa-globe text-success"
                   data-bs-toggle="tooltip"
                   title="{{ $job->continent->name ?? 'Global' }}"></i>
              </td>
              <td>
                <span class="td-title" title="{{ $job->title }}">{{ $job->title }}</span>
              </td>
              <td class="fw-bold" style="color:var(--top-color);">${{ $job->worker_earn }}</td>
              <td>
                <span class="worker-badge">
                  <strong class="text-danger">{{ $job->worker_done }}</strong>/<strong class="text-success">{{ $job->worker_need }}</strong>
                </span>
              </td>
            </tr>
            @endforeach
            @endif

            {{-- 📋 Normal rows --}}
            @if($normalJobs->count())
            <tr class="section-divider-row">
              <td colspan="5">
                <span style="color:var(--text-muted);">
                  <i class="bi bi-list-ul me-1"></i>
                  All Jobs
                </span>
              </td>
            </tr>
            @foreach($normalJobs as $job)
            <tr onclick="window.location.href='{{ route('user.job-details', $job->code) }}'"
                data-title="{{ strtolower($job->title) }}"
                data-earn="{{ $job->worker_earn }}"
                data-type="normal"
                data-index="{{ $loop->index }}">
              <td></td>
              <td>
                <i class="fa fa-globe text-success"
                   data-bs-toggle="tooltip"
                   title="{{ $job->continent->name ?? 'Global' }}"></i>
              </td>
              <td>
                <span class="td-title" title="{{ $job->title }}">{{ $job->title }}</span>
              </td>
              <td class="fw-bold" style="color:var(--text-dark);">${{ $job->worker_earn }}</td>
              <td>
                <span class="worker-badge">
                  <strong class="text-danger">{{ $job->worker_done }}</strong>/<strong class="text-success">{{ $job->worker_need }}</strong>
                </span>
              </td>
            </tr>
            @endforeach
            @endif

            {{-- Empty --}}
            @if($jobs->isEmpty())
            <tr>
              <td colspan="5" class="empty-state">
                <div><i class="fa fa-inbox"></i></div>
                কোনো job পাওয়া যায়নি।
              </td>
            </tr>
            @endif

          </tbody>
        </table>
        <div class="empty-state" id="desktopEmpty" style="display:none;">
          <div><i class="fa fa-search-minus"></i></div>
          No jobs match your filters.
        </div>
      </div>

    </div>
  </div>
</div>

<footer class="mt-5 footer-section">
  @include('user.layouts.partials.footer')
</footer>

<script>
  function applyFilters() {
    const search = document.getElementById('searchInput').value.toLowerCase().trim();
    const sort   = document.getElementById('sortSelect').value;

    const desktopRows = Array.from(document.querySelectorAll('#desktopBody tr:not(.section-divider-row)'));
    const mobileCards = Array.from(document.querySelectorAll('#mobileList .job-card'));

    function matches(title) {
      return title.includes(search);
    }

    // Filter
    let visibleDesktop = desktopRows.filter(r => {
      const show = matches(r.dataset.title || '');
      r.style.display = show ? '' : 'none';
      return show;
    });

    let visibleMobile = mobileCards.filter(c => {
      const show = matches(c.dataset.title || '');
      c.style.display = show ? '' : 'none';
      return show;
    });

    // Sort (only when non-default)
    if (sort !== 'default') {
      function sortItems(items, parent) {
        items.sort((a, b) => {
          if (sort === 'highest') return parseFloat(b.dataset.earn) - parseFloat(a.dataset.earn);
          if (sort === 'lowest')  return parseFloat(a.dataset.earn) - parseFloat(b.dataset.earn);
          return parseInt(b.dataset.index) - parseInt(a.dataset.index); // newest
        });
        items.forEach(el => parent.appendChild(el));
      }
      sortItems(visibleDesktop, document.getElementById('desktopBody'));
      sortItems(visibleMobile,  document.getElementById('mobileList'));
    }

    // Section divider visibility (hide if all rows in section hidden)
    const dividers = document.querySelectorAll('#desktopBody .section-divider-row');
    dividers.forEach(divider => {
      let nextSibling = divider.nextElementSibling;
      let hasVisible = false;
      while (nextSibling && !nextSibling.classList.contains('section-divider-row')) {
        if (nextSibling.style.display !== 'none') hasVisible = true;
        nextSibling = nextSibling.nextElementSibling;
      }
      divider.style.display = hasVisible ? '' : 'none';
    });

    // Mobile section labels
    document.querySelectorAll('#mobileList .section-label').forEach(label => {
      let next = label.nextElementSibling;
      let hasVisible = false;
      while (next && !next.classList.contains('section-label')) {
        if (next.classList.contains('job-card') && next.style.display !== 'none') hasVisible = true;
        next = next.nextElementSibling;
      }
      label.style.display = hasVisible ? '' : 'none';
    });

    // Empty states
    document.getElementById('desktopEmpty').style.display = visibleDesktop.length ? 'none' : 'block';
    document.getElementById('mobileEmpty').style.display  = visibleMobile.length  ? 'none' : 'block';

    // Count badge
    const total = window.innerWidth < 768 ? visibleMobile.length : visibleDesktop.length;
    document.getElementById('jobCount').textContent = total;
  }

  // Tooltips
  document.addEventListener('DOMContentLoaded', function () {
    [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      .forEach(el => new bootstrap.Tooltip(el));
  });
</script>

@endsection