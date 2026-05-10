@extends('user.layouts.app')
@section('content')

<style>
  :root {
    --primary:    #006A4E;
    --success:    #1abc9c;
    --danger:     #e74c3c;
    --warning:    #f59e0b;
    --text-dark:  #2d3748;
    --text-muted: #718096;
    --bg-light:   #f7f8fc;
    --border:     #e2e8f0;
    --shadow:     0 2px 12px rgba(0,106,78,0.08);
    --radius:     10px;
  }

  *, *::before, *::after { box-sizing: border-box; }
  html, body { overflow-x: hidden; max-width: 100%; }

  body { font-size: 12px; background: var(--bg-light); }

  /* ── Page Header ── */
  .page-header {
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 16px 18px;
    margin-bottom: 14px;
  }

  .page-header h6 {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0 0 2px;
  }

  .page-header p {
    font-size: 12px;
    color: var(--text-muted);
    margin: 0;
  }

  /* ── Filter Bar ── */
  .filter-bar {
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 12px 16px;
    margin-bottom: 14px;
    display: flex;
    gap: 8px;
    flex-wrap: nowrap;
    align-items: center;
  }

  .filter-bar > * { flex: 1 1 0; min-width: 0; }

  .search-wrap { position: relative; }
  .search-wrap .fa { position: absolute; left: 9px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 11px; pointer-events: none; }

  .f-input, .f-select {
    width: 100%;
    height: 34px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 12px;
    color: var(--text-dark);
    background: #fff;
    outline: none;
    transition: border-color .2s;
  }

  .f-input  { padding: 0 10px 0 26px; }
  .f-select { padding: 0 10px; }

  .f-input:focus, .f-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(0,106,78,0.1); }

  /* ── Desktop Table ── */
  .table-wrap {
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .jobs-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
  }

  .jobs-table thead th {
    background: #f0f7f4;
    color: var(--text-dark);
    font-weight: 700;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 12px 14px;
    border-bottom: 2px solid var(--border);
    white-space: nowrap;
  }

  .jobs-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background .12s;
  }

  .jobs-table tbody tr:last-child { border-bottom: none; }
  .jobs-table tbody tr:hover { background: #f0f7f4; }

  .jobs-table td {
    padding: 11px 14px;
    vertical-align: middle;
    color: var(--text-dark);
  }

  .td-title {
    max-width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 600;
  }

  /* ── Status Badge ── */
  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
  }

  .s-pending  { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
  .s-approved { background: #ecfdf5; color: #065f46; border: 1px solid #6ee7b7; }
  .s-rejected { background: #fef2f2; color: #991b1b; border: 1px solid #fca5a5; }

  /* ── Earn badge ── */
  .earn-chip {
    font-weight: 700;
    color: var(--primary);
    font-size: 12px;
  }

  /* ── Submitted date ── */
  .date-chip {
    font-size: 11px;
    color: var(--text-muted);
  }

  /* ── Mobile Cards ── */
  .job-card {
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 13px 14px;
    margin-bottom: 10px;
    border-left: 4px solid var(--primary);
  }

  .jc-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 8px;
    margin-bottom: 8px;
  }

  .jc-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-dark);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 200px;
    flex: 1;
  }

  .jc-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
  }

  .jc-meta {
    font-size: 11px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* ── Empty state ── */
  .empty-state {
    text-align: center;
    padding: 40px 20px;
    color: var(--text-muted);
    font-size: 13px;
  }

  .empty-state i { font-size: 36px; color: var(--border); margin-bottom: 10px; display: block; }

  /* ── Responsive ── */
  @media (max-width: 767px) {
    .desktop-view { display: none !important; }
    .mobile-view  { display: block !important; }
    .filter-bar   { flex-wrap: wrap; }
  }

  @media (min-width: 768px) {
    .mobile-view  { display: none !important; }
    .desktop-view { display: block !important; }
  }

  @media (max-width: 575px) {
    .container { padding-left: 10px !important; padding-right: 10px !important; }
    .page-header, .filter-bar, .table-wrap { border-radius: 8px; }
  }
</style>

<div class="container mt-4 mb-5">

  {{-- ── Page Header ── --}}
  <div class="page-header">
    <h6>My Submitted Tasks</h6>
    <p>Your submitted work will be rated within a maximum of 6 days.</p>
  </div>

  {{-- ── Filter Bar ── --}}
  <div class="filter-bar">
    <div class="search-wrap">
      <i class="fa fa-search"></i>
      <input type="text" class="f-input" id="searchInput" placeholder="Search job title..." oninput="applyFilters()">
    </div>
    <select class="f-select" id="statusFilter" onchange="applyFilters()">
      <option value="">All Status</option>
      <option value="pending">Pending</option>
      <option value="approved">Approved</option>
      <option value="rejected">Rejected</option>
    </select>
    <select class="f-select" id="sortSelect" onchange="applyFilters()">
      <option value="newest">Most Recent</option>
      <option value="oldest">Oldest First</option>
      <option value="highest">Highest Pay</option>
      <option value="lowest">Lowest Pay</option>
    </select>
  </div>

  {{-- ── Desktop Table ── --}}
  <div class="desktop-view table-wrap">
    <table class="jobs-table">
      <thead>
        <tr>
          <th>Status</th>
          <th>Job Title</th>
          <th>Category</th>
          <th>Earning</th>
          <th>Submitted</th>
          <th>Reviewed</th>
        </tr>
      </thead>
      <tbody id="desktopBody">
        @forelse($submitjobs as $submit)
        <tr data-title="{{ strtolower($submit->job->title ?? '') }}"
            data-status="{{ $submit->status }}"
            data-earn="{{ $submit->job->worker_earn ?? 0 }}"
            data-date="{{ $submit->created_at }}">
          <td>
            @if($submit->status == 'pending')
              <span class="status-badge s-pending"><i class="fa fa-clock-o"></i> Pending</span>
            @elseif($submit->status == 'approved')
              <span class="status-badge s-approved"><i class="fa fa-check"></i> Approved</span>
            @else
              <span class="status-badge s-rejected"><i class="fa fa-times"></i> Rejected</span>
            @endif
          </td>
          <td>
            <span class="td-title" title="{{ $submit->job->title ?? '—' }}">
              {{ $submit->job->title ?? '—' }}
            </span>
          </td>
          <td style="font-size:11px; color:var(--text-muted);">
            {{ $submit->job->category->name ?? '—' }}
          </td>
          <td>
            <span class="earn-chip">${{ $submit->job->worker_earn ?? '0.00' }}</span>
          </td>
          <td class="date-chip">
            {{ \Carbon\Carbon::parse($submit->created_at)->format('d M Y') }}
          </td>
          <td class="date-chip">
            @if($submit->reviewed_at)
              {{ \Carbon\Carbon::parse($submit->reviewed_at)->format('d M Y') }}
            @else
              <span style="color:var(--warning);">—</span>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="empty-state">
          <i class="fa fa-inbox"></i> No submitted tasks yet.
        </td></tr>
        @endforelse
      </tbody>
    </table>
    <div class="empty-state" id="desktopEmpty" style="display:none;">
      <i class="fa fa-search-minus"></i> No results match your filters.
    </div>
  </div>

  {{-- ── Mobile Cards ── --}}
  <div class="mobile-view" id="mobileList">
    @forelse($submitjobs as $submit)
    <div class="job-card"
         data-title="{{ strtolower($submit->job->title ?? '') }}"
         data-status="{{ $submit->status }}"
         data-earn="{{ $submit->job->worker_earn ?? 0 }}"
         data-date="{{ $submit->created_at }}">
      <div class="jc-top">
        <span class="jc-title" title="{{ $submit->job->title ?? '—' }}">
          {{ $submit->job->title ?? '—' }}
        </span>
        <span class="earn-chip">${{ $submit->job->worker_earn ?? '0.00' }}</span>
      </div>
      <div class="jc-bottom">
        <div style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">
          @if($submit->status == 'pending')
            <span class="status-badge s-pending"><i class="fa fa-clock-o"></i> Pending</span>
          @elseif($submit->status == 'approved')
            <span class="status-badge s-approved"><i class="fa fa-check"></i> Approved</span>
          @else
            <span class="status-badge s-rejected"><i class="fa fa-times"></i> Rejected</span>
          @endif
          <span class="jc-meta">
            <i class="fa fa-tag"></i> {{ $submit->job->category->name ?? '—' }}
          </span>
        </div>
        <span class="jc-meta">
          <i class="fa fa-calendar"></i>
          {{ \Carbon\Carbon::parse($submit->created_at)->format('d M Y') }}
        </span>
      </div>
    </div>
    @empty
    <div class="empty-state">
      <i class="fa fa-inbox"></i> No submitted tasks yet.
    </div>
    @endforelse
    <div class="empty-state" id="mobileEmpty" style="display:none;">
      <i class="fa fa-search-minus"></i> No results match your filters.
    </div>
  </div>

</div>

<footer class="mt-5 footer-section">
  @include('user.layouts.partials.footer')
</footer>

<script>
function applyFilters() {
  const search = document.getElementById('searchInput').value.toLowerCase().trim();
  const status = document.getElementById('statusFilter').value.toLowerCase();
  const sort   = document.getElementById('sortSelect').value;

  const rows  = Array.from(document.querySelectorAll('#desktopBody tr[data-title]'));
  const cards = Array.from(document.querySelectorAll('#mobileList .job-card'));

  function matches(el) {
    const titleOk  = el.dataset.title.includes(search);
    const statusOk = !status || el.dataset.status === status;
    return titleOk && statusOk;
  }

  function sortItems(items, parent) {
    items.sort((a, b) => {
      if (sort === 'highest') return parseFloat(b.dataset.earn) - parseFloat(a.dataset.earn);
      if (sort === 'lowest')  return parseFloat(a.dataset.earn) - parseFloat(b.dataset.earn);
      if (sort === 'oldest')  return new Date(a.dataset.date)   - new Date(b.dataset.date);
      return new Date(b.dataset.date) - new Date(a.dataset.date); // newest
    });
    items.forEach(el => parent.appendChild(el));
  }

  const visibleRows  = rows.filter(r  => { const s = matches(r);  r.style.display  = s ? '' : 'none'; return s; });
  const visibleCards = cards.filter(c => { const s = matches(c);  c.style.display  = s ? '' : 'none'; return s; });

  sortItems(visibleRows,  document.getElementById('desktopBody'));
  sortItems(visibleCards, document.getElementById('mobileList'));

  document.getElementById('desktopEmpty').style.display = visibleRows.length  ? 'none' : 'block';
  document.getElementById('mobileEmpty').style.display  = visibleCards.length ? 'none' : 'block';
}
</script>

@endsection