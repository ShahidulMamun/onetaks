@extends('user.layouts.app')
@section('content')

<style>
  :root {
    --primary: #006A4E;
    --success: #1abc9c;
    --danger: #e74c3c;
    --text-dark: #2d3748;
    --text-muted: #718096;
    --bg-card: #ffffff;
    --bg-page: #f7f8fc;
    --border: #e2e8f0;
    --shadow: 0 2px 12px rgba(102,88,221,0.08);
    --radius: 12px;
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

  .result-count {
    font-size: 14px;
    color: var(--text-dark);
    white-space: nowrap;
  }

  .filter-select,
  .filter-input,
  .filter-sort {
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

  .filter-select:focus,
  .filter-input:focus,
  .filter-sort:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(102,88,221,0.1);
  }

  .filter-controls {
    display: flex;
    gap: 8px;
    flex-wrap: nowrap;
    align-items: center;
    width: 100%;
  }

  .filter-controls > * {
    flex: 1 1 0;
    min-width: 0;
  }

  .search-wrapper {
    position: relative;
    flex: 1 1 0;
    min-width: 0;
  }

  .search-wrapper .search-icon {
    position: absolute;
    left: 9px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 11px;
    pointer-events: none;
  }

  .search-wrapper .filter-input {
    padding-left: 26px;
  }

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
  }

  .job-card:hover {
    box-shadow: 0 6px 20px rgba(102,88,221,0.16);
    transform: translateY(-2px);
    text-decoration: none;
    color: inherit;
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
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 180px;
    flex: 1;
  }

  .job-earn {
    font-size: 14px;
    font-weight: 700;
    color: var(--success);
    white-space: nowrap;
  }

  .job-card-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 8px;
  }

  .job-zone {
    font-size: 11px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .job-zone i { color: var(--success); }

  .worker-badge {
    font-size: 11px;
    background: #f1f5f9;
    border-radius: 20px;
    padding: 2px 10px;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.06);
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

  .jobs-table td {
    padding: 12px 16px;
    vertical-align: middle;
  }

  /* title truncate in table */
  .td-title {
    max-width: 200px;
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

  /* ─── Responsive show/hide ─── */
  @media (max-width: 767px) {
    .desktop-view { display: none !important; }
    .mobile-view  { display: block !important; }
  }

  @media (min-width: 768px) {
    .mobile-view  { display: none !important; }
    .desktop-view { display: block !important; }
  }
</style>

<div class="container mt-4 mb-5">
  <div class="row">
    <div class="col-12">

      {{-- ── Filter Bar ── --}}
      <div class="filter-bar mb-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
          <span class="result-count fw-bold">
            <i class="fa fa-bars text-primary" aria-hidden="true"></i>
            Available Jobs
            <span class="badge bg-danger ms-1" id="jobCount">{{ count($jobs) }}</span>
          </span>
        </div>
        <div class="filter-controls">
          @php 
          $categories = App\Models\Category::where('is_active',true)->get();
          @endphp
          <select class="filter-select" id="catSelect" onchange="applyFilters()">
            <option value="">All Categories</option>
           @foreach($categories as $category)
            <option value="{{$category->name}}">{{$category->name}}</option>
            @endforeach
          </select>
          <div class="search-wrapper">
            <i class="fa fa-search search-icon"></i>
            <input type="text" class="filter-input" id="searchInput" placeholder="Search title..." oninput="applyFilters()">
          </div>
          <select class="filter-sort" id="sortSelect" onchange="applyFilters()">
            <option value="newest">Most Recent</option>
            <option value="oldest">Oldest First</option>
            <option value="highest">Highest Pay</option>
            <option value="lowest">Lowest Pay</option>
          </select>
        </div>
      </div>

      {{-- ── Mobile Cards ── --}}
      <div class="mobile-view" id="mobileList">
        @foreach($jobs as $job)
        <a class="job-card"
           href="{{ route('user.job-details', $job->code) }}"
           data-title="{{ strtolower($job->title) }}"
           data-earn="{{ $job->worker_earn }}"
           data-index="{{ $loop->index }}">
          <div class="job-card-top">
            <span class="job-title" title="{{ $job->title }}">{{ $job->title }}</span>
            <span class="job-earn" style="color: var(--text-dark);">${{ $job->worker_earn }}</span>
          </div>
          <div class="job-card-bottom">
            <span class="job-zone text-dark">
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
        <div class="empty-state" id="mobileEmpty" style="display:none;">
          <div><i class="fa fa-search-minus"></i></div>
          No jobs found.
        </div>
      </div>

      {{-- ── Desktop Table ── --}}
      <div class="desktop-view jobs-table-wrap">
        <table class="jobs-table">
          <thead>
            <tr>
              <th>Zone</th>
              <th>Title</th>
              <th>Earning</th>
              <th>Workers</th>
            </tr>
          </thead>
          <tbody id="desktopBody">
            @foreach($jobs as $job)
            <tr onclick="window.location.href='{{ route('user.job-details', $job->code) }}'"
                data-title="{{ strtolower($job->title) }}"
                data-earn="{{ $job->worker_earn }}"
                data-index="{{ $loop->index }}">
              <td>
                <i class="fa fa-globe text-success"
                   data-bs-toggle="tooltip"
                   title="{{ $job->continent->name ?? 'Global' }}"></i>
              </td>
              <td>
                <span class="td-title" title="{{ $job->title }}">{{ $job->title }}</span>
              </td>
              <td class="fw-bold" style="color: var(--text-dark);">${{ $job->worker_earn }}</td>
              <td>
                <span class="worker-badge">
                  <strong class="text-danger">{{ $job->worker_done }}</strong>/<strong class="text-success">{{ $job->worker_need }}</strong>
                </span>
              </td>
            </tr>
            @endforeach
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
    const search  = document.getElementById('searchInput').value.toLowerCase().trim();
    const cat     = document.getElementById('catSelect').value.toLowerCase();
    const sort    = document.getElementById('sortSelect').value;

    // ── collect rows/cards ──
    const desktopRows  = Array.from(document.querySelectorAll('#desktopBody tr'));
    const mobileCards  = Array.from(document.querySelectorAll('#mobileList .job-card'));

    function matches(title) {
      const titleOk = title.includes(search);
      const catOk   = !cat || title.includes(cat);
      return titleOk && catOk;
    }

    // ── filter ──
    let visibleDesktop = desktopRows.filter(r => {
      const show = matches(r.dataset.title);
      r.style.display = show ? '' : 'none';
      return show;
    });

    let visibleMobile = mobileCards.filter(c => {
      const show = matches(c.dataset.title);
      c.style.display = show ? '' : 'none';
      return show;
    });

    // ── sort ──
    function sortItems(items, parent) {
      items.sort((a, b) => {
        if (sort === 'highest') return parseFloat(b.dataset.earn) - parseFloat(a.dataset.earn);
        if (sort === 'lowest')  return parseFloat(a.dataset.earn) - parseFloat(b.dataset.earn);
        if (sort === 'oldest')  return parseInt(a.dataset.index) - parseInt(b.dataset.index);
        return parseInt(a.dataset.index) - parseInt(b.dataset.index); // newest = original order
      });
      items.forEach(el => parent.appendChild(el));
    }

    sortItems(visibleDesktop, document.getElementById('desktopBody'));
    sortItems(visibleMobile,  document.getElementById('mobileList'));

    // ── empty states ──
    document.getElementById('desktopEmpty').style.display = visibleDesktop.length ? 'none' : 'block';
    document.getElementById('mobileEmpty').style.display  = visibleMobile.length  ? 'none' : 'block';

    // ── update badge count ──
    const count = window.innerWidth < 768 ? visibleMobile.length : visibleDesktop.length;
    document.getElementById('jobCount').textContent = count;
  }

  // Bootstrap tooltips init
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipEls = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipEls.forEach(function (el) { new bootstrap.Tooltip(el); });
  });
</script>

@endsection