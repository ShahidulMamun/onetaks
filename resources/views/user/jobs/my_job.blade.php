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

    .page-header {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
        padding: 40px 0 28px;
        margin-bottom: 32px;
    }
    .page-header h4 {
        font-family: 'Syne', sans-serif;
        font-weight: 800; color: #fff; margin: 0; font-size: 1.6rem;
    }
    .page-header p { color: rgba(255,255,255,.5); font-size:.85rem; margin:4px 0 0; }

    /* Table card */
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

    .earn-val { color: var(--teal); font-weight: 700; }
    .worker-badge {
        background: #f1f3f5; border-radius: 8px;
        padding: 4px 10px; font-size: .82rem;
        display: inline-block;
    }

    /* Status */
    .status-pill {
        border-radius: 20px; padding: 3px 12px;
        font-size: .74rem; font-weight: 600;
        display: inline-block;
    }
    .status-pill.active   { background:#d1f2eb; color:#0e8a6a; }
    .status-pill.pending  { background:#fef9e7; color:#b7770d; }
    .status-pill.paused   { background:#e8ecef; color:#555; }
    .status-pill.completed{ background:#e3f0ff; color:#2563eb; }

    /* Action Buttons */
    .action-group { display: flex; gap: 6px; flex-wrap: wrap; }
    .btn-proof  { background: var(--teal);    color:#fff; }
    .btn-proof:hover { background: var(--teal-dark); color:#fff; }
    .btn-edit   { background: #3498db;         color:#fff; }
    .btn-edit:hover { background: #2176ae;     color:#fff; }
    .btn-top    { background: #f39c12;         color:#fff; }
    .btn-top:hover { background: #c87f0a;      color:#fff; }
    .btn-delete { background: #e74c3c;         color:#fff; }
    .btn-delete:hover { background: #c0392b;   color:#fff; }
    .action-group .btn { font-size:.78rem; border-radius:8px; padding:5px 12px; border:none; font-weight:600; }

    /* ── Modals ── */
    .modal-header {
    background: linear-gradient(135deg, #006A4E, #181c20);
    color: #fff;
    border: none;
    border-radius: var(--radius) var(--radius) 0 0;
}
    .modal-header .modal-title { font-family:'Syne',sans-serif; font-weight:700; }
    .modal-header .btn-close { filter: invert(1) brightness(2); }
    .modal-content { border-radius: var(--radius); overflow:hidden; border:none; box-shadow:0 16px 48px rgba(0,0,0,.18); }

    .form-label { font-size:.82rem; font-weight:600; color:#555; margin-bottom:4px; }
    .form-control, .form-select {
        border-radius:10px; border:1.5px solid var(--border);
        font-size:.9rem; padding: 10px 14px;
        transition: border-color .2s, box-shadow .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--teal); box-shadow: 0 0 0 3px rgba(26,188,156,.15);
    }
    .input-group-text {
        background: var(--teal-light); color: var(--teal-dark);
        border: 1.5px solid var(--border); font-weight:700; border-radius: 10px 0 0 10px;
    }
    .input-group .form-control { border-radius: 0 10px 10px 0; }

    /* Charge preview box */
    .charge-preview {
        background: linear-gradient(135deg, #f8fffd, #f0faf7);
        border: 1.5px solid var(--teal-light);
        border-radius: 12px; padding: 16px 20px;
    }
    .charge-preview .cp-row {
        display: flex; justify-content: space-between;
        font-size: .88rem; color: #444; padding: 4px 0;
    }
    .charge-preview .cp-row.total {
        border-top: 1.5px dashed var(--teal-light);
        margin-top: 8px; padding-top: 10px;
        font-family: 'Syne', sans-serif;
        font-weight: 700; font-size: 1rem; color: var(--dark);
    }
    .charge-preview .cp-row.total span:last-child { color: var(--teal); }

    .info-note {
        background: #fff8e1; border-left: 3px solid #f39c12;
        border-radius: 0 8px 8px 0; padding: 8px 14px;
        font-size: .8rem; color: #7d5a00;
    }

    .top-job-badge {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        color: #fff; border-radius: 20px; padding: 2px 10px;
        font-size: .7rem; font-weight: 700;
    }
</style>

<br><br><br>

<!-- Header -->

<div class="container pb-5">
    <div class="jobs-card">
        <div class="card-top">
            <h6><i class="bi bi-list-ul me-2 text-success"></i>{{$pageTitle}}</h6>
            <span class="result-count">{{ count($jobs) }} Result{{ count($jobs) != 1 ? 's' : '' }}</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Zone</th>
                        <th>Job Title</th>
                        <th>Earning</th>
                        <th>Workers</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($jobs as $job)
                    <tr>
                        <td>{{ $job->continent->name }}</td>
                        <td>
                            <div class="fw-semibold">{{ $job->title }}</div>
                            @if($job->is_top)
                                <span class="top-job-badge"><i class="bi bi-star-fill me-1"></i>Top Job</span>
                            @endif
                        </td>
                        <td><span class="earn-val">${{ $job->worker_earn }}</span></td>
                        <td>
                            <span class="worker-badge">
                                <strong class="text-success">{{ $job->worker_remaining }}</strong>
                                / <strong class="text-danger">{{ $job->worker_need }}</strong>
                            </span>
                        </td>
                        <td>
                            <span class="status-pill {{ strtolower($job->status) }}">{{ $job->status }}</span>
                        </td>
                        <td>
                            <div class="action-group">
                                <!-- Proof -->
                                <a href="{{ route('user.submit-job-proof', [$job->id, $job->code]) }}"
                                   class="btn btn-proof btn-sm">
                                    <i class="bi bi-eye me-1"></i>Proof
                                </a>

                                <!-- Edit Workers -->
                                <button class="btn btn-edit btn-sm"
                                    onclick='openEditModal({{ $job->id }},{{ $job->worker_need }},{{ $job->worker_earn }},@json($job->title),@json($job->description))'>
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </button>

                                <!-- Top Job (only if not already top) -->
                                @if(!$job->is_top)
                                <button class="btn btn-top btn-sm"
                                    onclick="openTopJobModal({{ $job->id }}, '{{ addslashes($job->title) }}')">
                                    <i class="bi bi-star me-1"></i>Top
                                </button>
                                @endif

                                <!-- Delete -->
                                <form action="{{ route('user.job.delete', [$job->id, $job->code]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this job?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-sm">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No jobs posted yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════
     EDIT WORKERS MODAL
══════════════════════════════════════════ -->
<div class="modal fade" id="editWorkerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editWorkerForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">

                    <div class="info-note mb-4">
                        <i class="bi bi-info-circle me-1"></i>
                        You can only <strong>increase</strong> the number of workers. Decreasing is not allowed.
                    </div>

                      <div class="mb-3">
                        <label class="form-label">Title</label>
                        <div class="input-group">
                            <input style="border-radius:10px" type="text" id="jobTitle" name="job_title" class="form-control">
                        </div>
                      
                       </div>

                        <div class="mb-3">
                        <label class="form-label">Desciption</label>
                        <div class="input-group">
                            <textarea style="border-radius: 10px" id="jobDescription"name="job_description" class="form-control">
                                
                            </textarea>
                           
                        </div>
                      
                       </div>


                    <div class="mb-3">
                        <label class="form-label">Add Workers</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                            <input type="number"
                                   id="extra_workers"
                                   name="extra_workers"
                                   class="form-control"
                                   min="1"
                                   placeholder="e.g. 10"
                                   oninput="recalcEdit()">
                        </div>
                        <small class="text-muted mt-1 d-block">
                            Current total: <strong id="current_total">—</strong> workers
                        </small>
                    </div>

                    <!-- Live Charge Preview -->
                    <div class="charge-preview">
                        <div class="cp-row">
                            <span>Extra workers</span>
                            <span id="prev-extra">0</span>
                        </div>
                        <div class="cp-row">
                            <span>Earn per worker</span>
                            <span id="prev-earn">$0.00</span>
                        </div>
                        <div class="cp-row">
                            <span>Job post charge</span>
                            <span id="prev-charge">{{ $setting->jobpost_charge ?? '0.00' }}%</span>
                        </div>
                        <div class="cp-row total">
                            <span>Total to pay</span>
                            <span id="prev-total">$0.00</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-edit rounded-pill px-5 fw-bold">
                        <i class="bi bi-check-circle me-1"></i>Update Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════
     TOP JOB MODAL
══════════════════════════════════════════ -->
<div class="modal fade" id="topJobModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg,#f39c12,#e67e22);">
                <h6 class="modal-title"><i class="bi bi-star-fill me-2"></i>Promote to Top Job</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="topJobForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">

                    <div class="text-center mb-4">
                        <div style="font-size:1rem;">⭐</div>
                        <h6 class="fw-bold mt-2" id="top-job-title-display"></h6>
                        <p class="text-muted" style="font-size:12px;">
                            Top Jobs appear at the top of listings and attract more workers faster.
                        </p>
                    </div>

                    <div class="charge-preview">
                        <div class="cp-row">
                            <span>Top Job Promotion Fee</span>
                            <span class="fw-bold text-warning">${{ $setting->topjob_charge ?? '0.00' }}</span>
                        </div>
                      <!--   <div class="cp-row total">
                            <span>Total charge</span>
                            <span>${{ $setting->topjob_charge ?? '0.00' }}</span>
                        </div> -->
                    </div>

                    <div class="info-note mt-3">
                        <i class="bi bi-lightning-fill me-1 text-warning"></i>
                        This amount will be deducted from your wallet immediately.
                    </div>

                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-top rounded-pill px-5 fw-bold">
                        <i class="bi bi-star-fill me-1"></i>Make it Top Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>

<script>
    const JOB_POST_CHARGE = {{ $setting->jobpost_charge ?? 0 }};

    let _editEarn = 0;

    function openEditModal(jobId, currentWorkers, workerEarn, jobTitle , jobDescription) {
        _editEarn = workerEarn;
        document.getElementById('editWorkerForm').action = '/user/jobs/' + jobId + '/update-workers';
        document.getElementById('current_total').textContent = currentWorkers;
        document.getElementById('jobTitle').value = jobTitle;
        document.getElementById('jobDescription').value = jobDescription;
        document.getElementById('extra_workers').value = '';
        document.getElementById('prev-earn').textContent = '$' + parseFloat(workerEarn).toFixed(2);
        recalcEdit();
        new bootstrap.Modal(document.getElementById('editWorkerModal')).show();
    }

    function recalcEdit() {
        const extra = parseInt(document.getElementById('extra_workers').value) || 0;
        const workerCost = extra * _editEarn;
        const total = workerCost + (extra > 0 ? JOB_POST_CHARGE : 0);
        document.getElementById('prev-extra').textContent  = extra;
        document.getElementById('prev-total').textContent  = '$' + total.toFixed(2);
    }

    function openTopJobModal(jobId, jobTitle) {
        document.getElementById('topJobForm').action = '/user/jobs/' + jobId + '/make-top';
        document.getElementById('top-job-title-display').textContent = jobTitle;
        new bootstrap.Modal(document.getElementById('topJobModal')).show();
    }
</script>

@endsection