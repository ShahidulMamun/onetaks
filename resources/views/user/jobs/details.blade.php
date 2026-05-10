@extends('user.layouts.app')
@section('content')

<style>
  :root {
    --primary:    #006A4E;
    --success:    #1abc9c;
    --danger:     #e74c3c;
    --text-dark:  #2d3748;
    --text-muted: #718096;
    --bg-light:   #f7f8fc;
    --border:     #e2e8f0;
    --shadow:     0 2px 12px rgba(0,106,78,0.08);
    --radius:     10px;
  }

  /* ── Prevent horizontal scroll ── */
  *, *::before, *::after { box-sizing: border-box; }
  html, body { overflow-x: hidden; max-width: 100%; }
  img { max-width: 100%; height: auto; }

  body { font-size: 12px; background: var(--bg-light); }

  /* ── Cards ── */
  .section-card {
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 16px 18px;
    margin-bottom: 14px;
  }

  /* ── Job Header ── */
  .job-header {
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 16px 18px;
    margin-bottom: 14px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    flex-wrap: wrap;
  }

  .job-header-info { flex: 1; min-width: 0; }

  .job-header h4 {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0 0 4px;
    word-break: break-word;
  }

  .job-header .subtitle {
    font-size: 12px;
    color: var(--text-muted);
  }

  .earn-badge {
    background: var(--primary);
    color: #fff;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 15px;
    font-weight: 700;
    white-space: nowrap;
    flex-shrink: 0;
    align-self: flex-start;
  }

  /* ── Rules ── */
  .rules-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
  }

  .rules-row .rules-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-dark);
  }

  .rules-card {
    background: #e7faef;
    border-radius: 8px;
    border: 1px solid #c8e6c9;
    padding: 12px 16px;
    margin-top: 10px;
  }

  .rules-card .rules-title {
    font-size: 13px;
    font-weight: 700;
    color: #1b5e20;
    margin-bottom: 6px;
  }

  .rules-card ul {
    margin: 0;
    padding-left: 18px;
    font-size: 12px;
    color: var(--text-dark);
    line-height: 1.9;
  }

  /* ── Action Buttons ── */
  .action-row {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 12px;
  }

  /* ── Meta Info Grid ── */
  .meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px 16px;
  }

  .meta-label {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--text-muted);
    margin-bottom: 3px;
  }

  .meta-value {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-dark);
    word-break: break-word;
  }

  .meta-value a {
    color: var(--primary);
    text-decoration: none;
  }

  /* ── Section Header ── */
  .section-header {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-dark);
    display: flex;
    align-items: center;
    gap: 6px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 12px;
  }

  .section-header i { color: var(--danger); }

  /* ── Description ── */
  .job-description {
    font-size: 12px;
    color: var(--text-dark);
    line-height: 1.8;
    word-break: break-word;
  }

  /* ── Proof Fields ── */
  .proof-item { margin-bottom: 16px; }

  .proof-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-dark);
    display: flex;
    align-items: flex-start;
    gap: 6px;
    margin-bottom: 6px;
  }

  .proof-index {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    min-width: 20px;
    background: var(--primary);
    color: #fff;
    border-radius: 50%;
    font-size: 10px;
    font-weight: 700;
    flex-shrink: 0;
    margin-top: 1px;
  }

  /* ── Form Controls ── */
  .form-control {
    font-size: 12px;
    border-radius: 8px;
    border: 1.5px solid var(--border);
    transition: border-color .2s;
    width: 100%;
  }

  .form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(0,106,78,0.1);
    outline: none;
  }

  /* ── Secret Code ── */
  .secret-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .secret-input { max-width: 320px; }

  /* ── Submit Button ── */
  .btn-submit-job {
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 9px 32px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .3px;
    transition: background .2s;
    cursor: pointer;
  }

  .btn-submit-job:hover { background: #005240; color: #fff; }

  .submit-wrap {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
  }

  /* ════════════════════════════════
     MOBILE  ≤ 575px
  ════════════════════════════════ */
  @media (max-width: 575px) {
    .container {
      padding-left: 10px !important;
      padding-right: 10px !important;
    }

    .section-card,
    .job-header {
      padding: 12px 13px;
      border-radius: 8px;
    }

    /* Header stacks: title then badge */
    .job-header        { flex-direction: column; gap: 8px; }
    .job-header h4     { font-size: 14px; }
    .earn-badge        { font-size: 13px; padding: 5px 12px; }

    /* Rules label and button stack */
    .rules-row         { flex-direction: column; align-items: flex-start; }

    /* Action buttons fill row equally */
    .action-row        { gap: 6px; }
    .action-row .btn   {
      flex: 1 1 calc(50% - 3px);
      text-align: center;
      font-size: 11px !important;
      padding: 6px 4px;
    }

    /* Meta grid stays 2 cols but tighter */
    .meta-grid { gap: 10px 8px; }

    /* Secret code full width on mobile */
    .secret-input { max-width: 100%; }

    /* Submit button full width */
    .submit-wrap        { justify-content: stretch; }
    .btn-submit-job     { width: 100%; padding: 11px; font-size: 13px; text-align: center; }

    /* Modals fit screen */
    .modal-dialog       { margin: 8px; }

    /* Modal dialog full width */
    .modal-dialog:not(.modal-sm) { max-width: calc(100vw - 16px); }
  }

  /* ════════════════════════════════
     TABLET  576–767px
  ════════════════════════════════ */
  @media (min-width: 576px) and (max-width: 767px) {
    .job-header h4     { font-size: 15px; }
    .secret-input      { max-width: 260px; }
  }
</style>

<div class="container mt-4 mb-5">

  {{-- ── Back Button ── --}}
  <a href="{{ route('user.find.jobs') }}" class="btn btn-danger btn-sm mb-3 text-decoration-none" style="font-size:12px;">
    <i class="fa fa-arrow-circle-left text-white"></i>
    <span class="text-white fw-bold">Back</span>
  </a>

  {{-- ── Job Header ── --}}
  <div class="job-header">
    <div class="job-header-info">
      <h4>{{ $job->title }}</h4>
      <span class="subtitle">{{ $job->continent->name }} &mdash; {{ $job->category->name }}</span>
    </div>
    <div class="earn-badge">${{ $job->worker_earn }}</div>
  </div>

  {{-- ── Rules + Report/Hide ── --}}
  <div class="section-card">
    <div class="rules-row">
      <span class="rules-label">Read the job rules.</span>
      <button class="btn btn-success btn-sm" id="readRulesBtn" style="font-size:12px;">
        <i class="fa fa-book"></i> Read Rules
      </button>
    </div>
    <div id="rulesBox" class="rules-card" style="display:none;">
      <div class="rules-title">Job Rules</div>
      <ul>
        <li>Candidates must apply before the deadline.</li>
        <li>Provide accurate information in your application.</li>
        <li>No plagiarism in submitted work samples.</li>
        <li>Be professional during interview processes.</li>
      </ul>
    </div>
    <div class="action-row">
      <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#reportModal" style="font-size:12px;">
        <i class="fa fa-flag-checkered"></i> Report Job
      </a>
      <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#hideModal" style="font-size:12px;">
        <i class="fa fa-eye-slash"></i> Hide Job
      </a>
    </div>
  </div>

  {{-- ── Meta Info ── --}}
  <div class="section-card">
    <div class="meta-grid">
      <div>
        <div class="meta-label">Excluded Countries</div>
        <div class="meta-value">—</div>
      </div>
      <div>
        <div class="meta-label">Done</div>
        <div class="meta-value">
          {{ $job->worker_done }}
          <span style="color:var(--text-muted); font-weight:400;">of</span>
          {{ $job->worker_need }}
        </div>
      </div>
      <div>
        <div class="meta-label">Employer</div>
        <div class="meta-value">
          <a href="#">{{ $job->user->name }} <i class="fa fa-external-link" style="font-size:10px;"></i></a>
        </div>
      </div>
      <div>
        <div class="meta-label">Category</div>
        <div class="meta-value">{{ $job->category->name }} &rarr; {{ $job->subcategory->name }}</div>
      </div>
      <div>
        <div class="meta-label">Job ID</div>
        <div class="meta-value" style="color:var(--text-muted); font-weight:500; font-size:11px;">{{ $job->code }}</div>
      </div>
    </div>
  </div>

  {{-- ── Description ── --}}
  <div class="section-card">
    <div class="section-header">
      <i class="fa fa-question-circle"></i> What is expected from workers?
    </div>
    <div class="job-description">
      {!! nl2br(e($job->description)) !!}
    </div>
  </div>

  {{-- ── Proof Submission Form ── --}}
  <form action="{{ route('user.submit-job', [$job->code, $job->slug]) }}" method="post" enctype="multipart/form-data">
    @csrf

    {{-- Secret Code --}}
    @if($job->has_secret_code == 1)
    <div class="section-card">
      <div class="section-header">
        <i class="fa fa-key"></i> Secret Code
      </div>
      <div class="secret-label">
        <i class="fa fa-question-circle text-danger"></i> Type Secret Code
      </div>
      <input type="text" name="secret_code" class="form-control secret-input" required>
    </div>
    @endif

    {{-- Proof Fields --}}
    <div class="section-card">
      <div class="section-header">
        <i class="fa fa-question-circle"></i> Submit your proofs below
      </div>

      @foreach($job->proofs as $i => $proof)
      <div class="proof-item">
        <div class="proof-label">
          <span class="proof-index">{{ $i + 1 }}</span>
          <span>{{ $proof['label'] }}</span>
        </div>
        @if($proof['type'] == 'file')
          <input type="file" name="images[]" class="form-control">
        @else
          <input type="text" name="texts[]" class="form-control" placeholder="Enter your answer...">
        @endif
      </div>
      @endforeach

      <div class="submit-wrap">
        <button type="submit" class="btn-submit-job">
          <i class="fa fa-paper-plane me-1"></i> Submit
        </button>
      </div>
    </div>

  </form>

</div>

{{-- ── Report Modal ── --}}
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="font-size:12px;">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" style="font-size:14px;">Job Reporting</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <label class="fw-semibold mb-1 d-block">What is wrong with this job?</label>
        <textarea class="form-control" rows="3" placeholder="Describe the issue..."></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="font-size:12px;">Cancel</button>
        <button class="btn btn-success btn-sm" id="submitReportBtn" style="font-size:12px;">Submit Report</button>
      </div>
    </div>
  </div>
</div>

{{-- ── Hide Modal ── --}}
<div class="modal fade" id="hideModal" tabindex="-1" aria-labelledby="hideModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content text-center" style="font-size:12px;">
      <div class="modal-header border-0 pb-0 position-relative">
        <h5 class="modal-title w-100 fw-bold" style="font-size:14px;">Hide Job</h5>
        <button type="button" class="btn-close position-absolute end-0 me-2 top-50 translate-middle-y" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body py-2">
        <p class="text-muted mb-0">Do you want to permanently hide this job?</p>
      </div>
      <div class="modal-footer border-0 justify-content-center gap-2 pt-0">
        <button class="btn btn-success px-4 btn-sm" id="yesHideBtn" style="font-size:12px;">Yes</button>
        <button class="btn btn-danger px-4 btn-sm" data-bs-dismiss="modal" style="font-size:12px;">No</button>
      </div>
    </div>
  </div>
</div>

{{-- ── Toast ── --}}
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastMsg">Action completed.</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<footer class="mt-5 footer-section">
  @include('user.layouts.partials.footer')
</footer>

<script>
  // Rules toggle
  const readRulesBtn = document.getElementById('readRulesBtn');
  const rulesBox     = document.getElementById('rulesBox');
  let rulesVisible   = false;

  readRulesBtn.addEventListener('click', function () {
    rulesVisible = !rulesVisible;
    rulesBox.style.display = rulesVisible ? 'block' : 'none';
    readRulesBtn.innerHTML = rulesVisible
      ? '<i class="fa fa-eye-slash"></i> Hide Rules'
      : '<i class="fa fa-book"></i> Read Rules';
  });

  function showToast(msg) {
    document.getElementById('toastMsg').textContent = msg;
    const toast = new bootstrap.Toast(document.getElementById('successToast'), { delay: 3000 });
    toast.show();
  }

  document.getElementById('submitReportBtn').addEventListener('click', function () {
    bootstrap.Modal.getInstance(document.getElementById('reportModal')).hide();
    setTimeout(() => showToast('Report submitted successfully!'), 400);
  });

  document.getElementById('yesHideBtn').addEventListener('click', function () {
    bootstrap.Modal.getInstance(document.getElementById('hideModal')).hide();
    setTimeout(() => showToast('Job has been hidden!'), 400);
  });

  document.addEventListener('DOMContentLoaded', function () {
    [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      .forEach(el => new bootstrap.Tooltip(el));
  });
</script>

@endsection