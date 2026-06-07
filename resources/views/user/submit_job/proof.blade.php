@extends('user.layouts.app')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --teal: #1abc9c;
        --teal-dark: #148f77;
        --teal-light: #d1f2eb;
        --dark: #1a1a2e;
        --muted: #6c757d;
        --border: #e8ecef;
        --radius: 14px;
        --shadow: 0 4px 20px rgba(0,0,0,0.06);
    }

    body { font-family: 'DM Sans', sans-serif; }

    /* ── Card ── */
    .jobs-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        overflow: hidden;
    }
    .jobs-card .card-top {
        padding: 16px 22px;
        border-bottom: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 10px;
    }
    .jobs-card .card-top h6 {
        font-family: 'Syne', sans-serif; font-weight: 700;
        color: var(--dark); margin: 0;
    }
    .result-count {
        background: var(--teal-light); color: var(--teal-dark);
        border-radius: 20px; padding: 3px 14px;
        font-size: .78rem; font-weight: 700;
    }

    /* ── Table ── */
    table { margin: 0 !important; }
    thead th {
        font-family: 'Syne', sans-serif;
        font-size: .78rem; text-transform: uppercase;
        letter-spacing: .6px; color: var(--muted);
        background: #f8f9fa; border: none !important;
        padding: 14px 16px !important; font-weight: 700;
    }
    tbody td {
        padding: 14px 16px !important;
        vertical-align: middle !important;
        border-color: var(--border) !important;
        font-size: .9rem; color: #333;
    }
    tbody tr:hover { background: #f4fdfb; }
    tbody tr.row-selected { background: #edfaf5 !important; }

    /* ── Checkbox ── */
    .sub-checkbox, #select-all {
        cursor: pointer;
        width: 16px; height: 16px;
        accent-color: var(--teal);
    }

    /* ── Status Pills ── */
    .status-pill {
        border-radius: 20px; padding: 3px 12px;
        font-size: .74rem; font-weight: 600;
        display: inline-block;
    }
    .status-pill.approved { background:#d1f2eb; color:#0e8a6a; }
    .status-pill.pending  { background:#fef9e7; color:#b7770d; }
    .status-pill.rejected { background:#fde8e8; color:#c0392b; }

    /* ── Action Buttons ── */
    .action-group { display: flex; gap: 6px; flex-wrap: wrap; }
    .btn-view    { background: var(--teal);  color:#fff; }
    .btn-view:hover { background: var(--teal-dark); color:#fff; }
    .btn-approve { background: #27ae60; color:#fff; }
    .btn-approve:hover { background: #1e8449; color:#fff; }
    .btn-reject  { background: #e74c3c; color:#fff; }
    .btn-reject:hover  { background: #c0392b; color:#fff; }
    .action-group .btn { font-size:.78rem; border-radius:8px; padding:5px 12px; border:none; font-weight:600; }

    /* ── Bulk Approve Button ── */
    #bulk-approve-btn {
        display: none;
        align-items: center; gap: 6px;
        background: linear-gradient(135deg, #27ae60, #1e8449);
        color: #fff; border: none; border-radius: 20px;
        padding: 5px 16px; font-size: .8rem; font-weight: 700;
        cursor: pointer; transition: all .2s;
        box-shadow: 0 2px 8px rgba(39,174,96,.3);
    }
    #bulk-approve-btn:hover {
        background: linear-gradient(135deg, #1e8449, #166336);
        box-shadow: 0 4px 14px rgba(39,174,96,.45);
        transform: translateY(-1px);
    }
    #bulk-approve-btn.visible { display: inline-flex; }

    /* ── Modals ── */
    .modal-header {
        background: linear-gradient(135deg, #006A4E, #181c20);
        color: #fff; border: none;
        border-radius: var(--radius) var(--radius) 0 0;
    }
    .modal-header .modal-title { font-family:'Syne',sans-serif; font-weight:700; }
    .modal-header .btn-close { filter: invert(1) brightness(2); }
    .modal-content { border-radius: var(--radius); overflow:hidden; border:none; box-shadow:0 16px 48px rgba(0,0,0,.18); }
    .modal-header.reject-header { background: linear-gradient(135deg, #c0392b, #6b0a04); }

    .form-label { font-size:.82rem; font-weight:600; color:#555; margin-bottom:4px; }
    .form-control {
        border-radius:10px; border:1.5px solid var(--border);
        font-size:.9rem; padding: 10px 14px;
        transition: border-color .2s, box-shadow .2s;
    }
    .form-control:focus {
        border-color: var(--teal); box-shadow: 0 0 0 3px rgba(26,188,156,.15);
    }
    .info-note {
        background: #fff8e1; border-left: 3px solid #f39c12;
        border-radius: 0 8px 8px 0; padding: 8px 14px;
        font-size: .8rem; color: #7d5a00;
    }

    /* ── Proof Slider ── */
    .slider-wrap { position: relative; background: #0d0d0d; border-radius: 10px; overflow: hidden; }
    .slider-stage { position: relative; width: 100%; height: 300px; display:flex; align-items:center; justify-content:center; }
    .slide { display: none; width:100%; height:100%; align-items:center; justify-content:center; }
    .slide.active { display: flex; }
    .slide img { max-height:280px; max-width:100%; object-fit:contain; border-radius:6px; cursor:zoom-in; }
    .slide-counter {
        position:absolute; top:10px; right:12px;
        background:rgba(0,0,0,.6); color:#fff;
        border-radius:20px; padding:2px 12px; font-size:.75rem;
        z-index: 2;
    }
    .slide-btn {
        position:absolute; top:50%; transform:translateY(-50%);
        background:rgba(26,188,156,.85); border:none; color:#fff;
        width:34px; height:34px; border-radius:50%; font-size:.85rem;
        cursor:pointer; z-index:5; display:flex; align-items:center; justify-content:center;
        transition: background .2s;
    }
    .slide-btn:hover { background:var(--teal-dark); }
    .slide-btn.prev { left:10px; }
    .slide-btn.next { right:10px; }
    .no-img-msg { color:var(--muted); padding:40px; text-align:center; width:100%; font-size:.9rem; }

    .thumb-strip { display:flex; gap:8px; padding:10px 12px; background:#111; overflow-x:auto; }
    .thumb-strip::-webkit-scrollbar { height:3px; }
    .thumb-strip::-webkit-scrollbar-thumb { background:var(--teal); }
    .thumb {
        flex-shrink:0; width:58px; height:44px; border-radius:6px;
        overflow:hidden; border:2px solid transparent; cursor:pointer;
        opacity:.5; transition:all .2s;
    }
    .thumb.active { border-color:var(--teal); opacity:1; }
    .thumb img { width:100%; height:100%; object-fit:cover; }

    .proof-text-item {
        background:#f8fffd;
        border:1px solid var(--teal-light);
        border-left:4px solid var(--teal);
        border-radius:10px; padding:12px 16px;
        font-size:.88rem; color:#333; line-height:1.6;
        white-space:pre-wrap; margin-bottom:10px;
    }

    /* ── Back Link ── */
    .back-link {
        display:inline-flex; align-items:center; gap:6px;
        color:var(--teal); font-size:.85rem; font-weight:600;
        text-decoration:none; margin-bottom:18px; transition:gap .2s;
    }
    .back-link:hover { gap:10px; color:var(--teal-dark); }

    /* ── Job Info Strip ── */
    .job-info-strip {
        background: linear-gradient(135deg, #0d462c 0%, #090a0a 100%);
        border-radius: var(--radius); padding:18px 24px;
        margin-bottom:24px;
        display:flex; flex-wrap:wrap; gap:20px; align-items:center;
    }
    .ji-title { font-family:'Syne',sans-serif; font-weight:800; color:#fff; font-size:1.1rem; margin:0; }
    .ji-meta  { color:rgba(255,255,255,.5); font-size:.8rem; margin:2px 0 0; }
    .ji-stat  {
        background:rgba(255,255,255,.07);
        border:1px solid rgba(255,255,255,.12);
        border-radius:10px; padding:8px 18px; text-align:center;
    }
    .ji-stat .v { font-family:'Syne',sans-serif; font-weight:800; color:var(--teal); font-size:1.1rem; }
    .ji-stat .l { font-size:.7rem; color:rgba(255,255,255,.45); text-transform:uppercase; letter-spacing:.7px; }

    /* ── Pagination ── */
    .pagination-wrap {
        padding: 16px 22px;
        border-top: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 10px;
    }
    .pagination-info { font-size: .82rem; color: var(--muted); }
    .pagination { margin: 0; }
    .page-link {
        border-radius: 8px !important; margin: 0 2px;
        font-size: .82rem; font-weight: 600;
        color: var(--teal); border-color: var(--border);
        padding: 6px 12px;
    }
    .page-link:hover { background: var(--teal-light); color: var(--teal-dark); border-color: var(--teal-light); }
    .page-item.active .page-link {
        background: var(--teal); border-color: var(--teal); color: #fff;
    }
    .page-item.disabled .page-link { color: #ccc; }

    /* ── Selection Banner ── */
    #selection-banner {
        display: none;
        background: linear-gradient(135deg, #edfaf5, #d1f2eb);
        border: 1px solid var(--teal-light);
        border-radius: 10px; padding: 10px 18px;
        margin-bottom: 16px;
        align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 8px;
        font-size: .85rem; color: var(--teal-dark); font-weight: 600;
    }
    #selection-banner.visible { display: flex; }
    #selection-banner .banner-note { font-size: .78rem; color: var(--muted); font-weight: 400; }
</style>

<br><br><br>

{{-- JSON data store --}}
<script type="application/json" id="submissions-data">
{!! json_encode([
    'items' => $submissions->map(function ($sub) {
        return [
            'id'     => $sub->id,
            'worker' => $sub->user->name ?? ('Worker #'.$sub->user_id),
            'images' => $sub->proof_image ?? [],
            'texts'  => $sub->proof_text  ?? [],
        ];
    })->values()
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>

{{-- Hidden Bulk Approve Form --}}
<form id="bulk-approve-form"
      action="{{ route('user.submit-job.approve-selected') }}"
      method="POST"
      style="display:none;">
    @csrf
    <div id="bulk-ids-container"></div>
</form>

<div class="container pb-5 mt-4">

    <a href="{{ url()->previous() }}" class="back-link">
        <i class="bi bi-arrow-left-circle-fill"></i> Back to My Jobs
    </a>

    {{-- Job Info Strip --}}
    <div class="job-info-strip">
        <div class="flex-grow-1">
            <p class="ji-title">{{ $job->title }}</p>
            <p class="ji-meta"><i class="bi bi-geo-alt me-1"></i>{{ $job->continent->name ?? '—' }}</p>
        </div>
        <div class="ji-stat">
            <div class="v">${{ $job->worker_earn }}</div>
            <div class="l">Per Worker</div>
        </div>
        <div class="ji-stat">
            <div class="v">
                <span class="text-danger">{{ $job->worker_done }}</span>/<span class="text-success">{{ $job->worker_need }}</span>
            </div>
            <div class="l">Remaining</div>
        </div>
        <div class="ji-stat">
            <div class="v">{{ $job->worker_done }}</div>
            <div class="l">Submissions</div>
        </div>
    </div>

    {{-- Selection Banner --}}
    <div id="selection-banner">
        <div>
            <i class="bi bi-check2-square me-2"></i>
            <span id="banner-count">0</span> submission(s) selected on this page
            <div class="banner-note mt-1">Only pending submissions on the current page can be selected.</div>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <button type="button" onclick="clearSelection()"
                    class="btn btn-sm btn-light rounded-pill px-3"
                    style="font-size:.78rem; font-weight:600;">
                <i class="bi bi-x me-1"></i>Clear
            </button>
            <button id="bulk-approve-btn" type="button" onclick="submitBulkApprove()">
                <i class="bi bi-check-all"></i>
                Approve Selected (<span id="sel-count">0</span>)
            </button>
        </div>
    </div>

    {{-- Submissions Table --}}
    <div class="jobs-card">
        <div class="card-top">
            <h6><i class="bi bi-card-checklist me-2 text-success"></i>Submitted Proofs</h6>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="result-count">{{ $submissions->total() }} total</span>
                <span class="text-muted" style="font-size:.78rem;">
                    Page {{ $submissions->currentPage() }} of {{ $submissions->lastPage() }}
                </span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:46px;">
                            <input type="checkbox" id="select-all"
                                   class="sub-checkbox"
                                   title="Select all pending on this page">
                        </th>
                        <th>#</th>
                        <th>Worker</th>
                        <th>Code</th>
                        <th>Submitted</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($submissions as $idx => $sub)
                    @php $status = strtolower($sub->status ?? 'pending'); @endphp
                    <tr id="row-{{ $sub->id }}" class="{{ $status === 'pending' ? '' : '' }}">
                        <td>
                            @if($status === 'pending')
                                <input type="checkbox"
                                       class="sub-checkbox row-cb"
                                       value="{{ $sub->id }}"
                                       data-row="row-{{ $sub->id }}">
                            @else
                                {{-- non-pending: empty cell --}}
                            @endif
                        </td>
                        <td class="text-muted fw-semibold">
                            {{ ($submissions->currentPage() - 1) * $submissions->perPage() + $idx + 1 }}
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $sub->user->name ?? 'Worker #'.$sub->user_id }}</div>
                        </td>
                        <td><code style="font-size:.8rem;">{{ $sub->submitted_code ?: '—' }}</code></td>
                        <td style="font-size:.8rem; color:var(--muted);">{{ $sub->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="status-pill {{ $status }}">{{ ucfirst($status) }}</span>
                            @if($status === 'rejected' && $sub->reject_reason)
                                <div class="text-danger mt-1" style="font-size:.72rem;">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ Str::limit($sub->reject_reason, 45) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-view btn-sm"
                                        onclick="openProofModal({{ $sub->id }})">
                                    <i class="bi bi-eye me-1"></i>View Proof
                                </button>

                                @if($status === 'pending')
                                    <form action="{{ route('user.submit-job.approve', $sub->id) }}"
                                          method="POST" style="display:inline;">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-approve btn-sm"
                                            onclick="return confirm('Approve this submission?')">
                                            <i class="bi bi-check-circle me-1"></i>Approve
                                        </button>
                                    </form>

                                    <button class="btn btn-reject btn-sm"
                                            onclick="openRejectModal({{ $sub->id }})">
                                        <i class="bi bi-x-circle me-1"></i>Reject
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No submissions yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($submissions->hasPages())
        <div class="pagination-wrap">
            <div class="pagination-info">
                Showing
                <strong>{{ $submissions->firstItem() }}–{{ $submissions->lastItem() }}</strong>
                of <strong>{{ $submissions->total() }}</strong> submissions
            </div>
            {{ $submissions->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

</div>


{{-- ══ PROOF VIEW MODAL ══ --}}
<div class="modal fade" id="proofModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-card-image me-2"></i>Proof — <span id="pm-name"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">

                <label class="form-label mb-2">
                    <i class="bi bi-images me-1 text-success"></i>Proof Images
                </label>
                <div class="slider-wrap mb-3">
                    <div class="slider-stage" id="pm-stage">
                        <span class="slide-counter" id="pm-counter">0 / 0</span>
                        <button class="slide-btn prev" onclick="slideNav(-1)">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="slide-btn next" onclick="slideNav(1)">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                    <div class="thumb-strip" id="pm-thumbs"></div>
                </div>

                <label class="form-label mb-2">
                    <i class="bi bi-chat-left-quote me-1 text-success"></i>Proof Texts
                </label>
                <div id="pm-texts"></div>

            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


{{-- ══ REJECT MODAL ══ --}}
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header reject-header">
                <h5 class="modal-title"><i class="bi bi-x-circle me-2"></i>Reject Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf @method('PATCH')
                <div class="modal-body p-4">
                    <div class="info-note mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Provide a reason so the worker understands why their submission was rejected.
                    </div>
                    <label class="form-label">Reject Reason</label>
                    <textarea name="reject_reason" class="form-control" rows="4"
                        placeholder="e.g. Screenshot does not match requirements…"
                        required></textarea>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-reject rounded-pill px-5 fw-bold">
                        <i class="bi bi-x-circle me-1"></i>Confirm Reject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Lightbox --}}
<div id="lightbox"
    style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.92); z-index:9999;
           align-items:center; justify-content:center;">
    <button onclick="document.getElementById('lightbox').style.display='none'"
        style="position:absolute;top:18px;right:22px;background:none;border:none;
               color:#fff;font-size:2.2rem;cursor:pointer;line-height:1;">&times;</button>
    <img id="lb-img" src="" style="max-width:92vw; max-height:88vh; border-radius:10px;">
</div>

<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>

<script>
/* ── Load submission data from JSON store ── */
var SUBMISSIONS = {};
(function () {
    try {
        var raw  = document.getElementById('submissions-data').textContent;
        var data = JSON.parse(raw);
        data.items.forEach(function (item) {
            SUBMISSIONS[item.id] = item;
        });
    } catch (e) {
        console.error('Failed to parse submissions-data:', e);
    }
})();

/* ════════════════════════════════════
   BULK SELECTION — current page only
   ════════════════════════════════════ */
var selectAllCb  = document.getElementById('select-all');
var banner       = document.getElementById('selection-banner');
var selCountEl   = document.getElementById('sel-count');
var bannerCount  = document.getElementById('banner-count');

function getChecked() {
    return document.querySelectorAll('.row-cb:checked');
}

function getAllRowCbs() {
    return document.querySelectorAll('.row-cb');
}

function updateUI() {
    var checked = getChecked();
    var count   = checked.length;
    var total   = getAllRowCbs().length;

    /* Update count displays */
    selCountEl.textContent  = count;
    bannerCount.textContent = count;

    /* Show / hide banner & button */
    if (count > 0) {
        banner.classList.add('visible');
        document.getElementById('bulk-approve-btn').classList.add('visible');
    } else {
        banner.classList.remove('visible');
        document.getElementById('bulk-approve-btn').classList.remove('visible');
    }

    /* Highlight selected rows */
    document.querySelectorAll('.row-cb').forEach(function (cb) {
        var row = document.getElementById(cb.dataset.row);
        if (row) {
            row.classList.toggle('row-selected', cb.checked);
        }
    });

    /* Select-all state */
    if (selectAllCb) {
        if (count === 0) {
            selectAllCb.checked       = false;
            selectAllCb.indeterminate = false;
        } else if (count === total) {
            selectAllCb.checked       = true;
            selectAllCb.indeterminate = false;
        } else {
            selectAllCb.checked       = false;
            selectAllCb.indeterminate = true;
        }
    }
}

/* Select All toggle — only touches current page checkboxes */
if (selectAllCb) {
    selectAllCb.addEventListener('change', function () {
        getAllRowCbs().forEach(function (cb) {
            cb.checked = selectAllCb.checked;
        });
        updateUI();
    });
}

/* Individual checkbox changes */
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('row-cb')) {
        updateUI();
    }
});

function clearSelection() {
    getAllRowCbs().forEach(function (cb) { cb.checked = false; });
    if (selectAllCb) {
        selectAllCb.checked       = false;
        selectAllCb.indeterminate = false;
    }
    updateUI();
}

/* ── Submit Bulk Approve ── */
function submitBulkApprove() {
    var checked = getChecked();
    if (checked.length === 0) return;

    if (!confirm('Approve ' + checked.length + ' selected submission(s) on this page?')) return;

    var form      = document.getElementById('bulk-approve-form');
    var container = document.getElementById('bulk-ids-container');
    container.innerHTML = '';

    checked.forEach(function (cb) {
        var input   = document.createElement('input');
        input.type  = 'hidden';
        input.name  = 'ids[]';
        input.value = cb.value;
        container.appendChild(input);
    });

    form.submit();
}

/* ════════════════════════
   PROOF MODAL
   ════════════════════════ */
var _slides = [], _cur = 0;

function openProofModal(subId) {
    var sub = SUBMISSIONS[subId];
    if (!sub) { alert('Data not found'); return; }

    _slides = Array.isArray(sub.images) ? sub.images : [];
    _cur    = 0;

    document.getElementById('pm-name').textContent = sub.worker;

    var stage  = document.getElementById('pm-stage');
    var thumbs = document.getElementById('pm-thumbs');

    stage.querySelectorAll('.slide, .no-img-msg').forEach(function (el) { el.remove(); });
    thumbs.innerHTML = '';

    var prevBtn = stage.querySelector('.slide-btn.prev');
    var nextBtn = stage.querySelector('.slide-btn.next');

    if (_slides.length === 0) {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
        thumbs.style.display  = 'none';
        document.getElementById('pm-counter').textContent = '0 / 0';
        var msg = document.createElement('div');
        msg.className = 'no-img-msg';
        msg.innerHTML = '<i class="bi bi-image" style="font-size:2rem;display:block;margin-bottom:8px;"></i>No images submitted';
        stage.appendChild(msg);
    } else {
        prevBtn.style.display = '';
        nextBtn.style.display = '';
        thumbs.style.display  = '';

        _slides.forEach(function (src, i) {
            var cleanSrc = src.replace(/\\/g, '/');
            var url      = '/storage/app/public/' + cleanSrc;

            var slide = document.createElement('div');
            slide.className = 'slide' + (i === 0 ? ' active' : '');

            var img     = document.createElement('img');
            img.src     = url;
            img.alt     = 'Proof ' + (i + 1);
            img.title   = 'Click to enlarge';
            img.onclick = (function (u) { return function () { openLightbox(u); }; })(url);
            slide.appendChild(img);
            stage.appendChild(slide);

            var thumb       = document.createElement('div');
            thumb.className = 'thumb' + (i === 0 ? ' active' : '');
            var ti          = document.createElement('img');
            ti.src          = url;
            ti.alt          = 'thumb';
            thumb.appendChild(ti);
            thumb.onclick = (function (n) { return function () { goSlide(n); }; })(i);
            thumbs.appendChild(thumb);
        });

        updateCounter();
    }

    /* Proof texts */
    var textWrap = document.getElementById('pm-texts');
    textWrap.innerHTML = '';
    var texts = Array.isArray(sub.texts) ? sub.texts : [];

    if (texts.length === 0) {
        textWrap.innerHTML = '<div class="text-muted" style="font-size:.85rem;padding:6px 0;">No proof text submitted.</div>';
    } else {
        texts.forEach(function (t, i) {
            var lbl = document.createElement('div');
            lbl.className = 'text-muted mb-1';
            lbl.style.fontSize = '.75rem';
            lbl.textContent = 'Text #' + (i + 1);

            var box = document.createElement('div');
            box.className = 'proof-text-item';
            box.textContent = t;

            textWrap.appendChild(lbl);
            textWrap.appendChild(box);
        });
    }

    new bootstrap.Modal(document.getElementById('proofModal')).show();
}

function goSlide(n) {
    if (_slides.length === 0) return;
    var slides = document.querySelectorAll('#pm-stage .slide');
    var thumbs = document.querySelectorAll('#pm-thumbs .thumb');
    slides[_cur] && slides[_cur].classList.remove('active');
    thumbs[_cur] && thumbs[_cur].classList.remove('active');
    _cur = (n + _slides.length) % _slides.length;
    slides[_cur] && slides[_cur].classList.add('active');
    thumbs[_cur] && thumbs[_cur].classList.add('active');
    thumbs[_cur] && thumbs[_cur].scrollIntoView({ behavior:'smooth', inline:'center', block:'nearest' });
    updateCounter();
}

function slideNav(dir) { goSlide(_cur + dir); }

function updateCounter() {
    document.getElementById('pm-counter').textContent = (_cur + 1) + ' / ' + _slides.length;
}

/* ── Reject Modal ── */
function openRejectModal(subId) {
    document.getElementById('rejectForm').action = '/user/submit-jobs/' + subId + '/reject';
    new bootstrap.Modal(document.getElementById('rejectModal')).show();
}

/* ── Lightbox ── */
function openLightbox(src) {
    document.getElementById('lb-img').src = src;
    document.getElementById('lightbox').style.display = 'flex';
}

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape')     document.getElementById('lightbox').style.display = 'none';
    if (e.key === 'ArrowRight') slideNav(1);
    if (e.key === 'ArrowLeft')  slideNav(-1);
});
</script>

@endsection