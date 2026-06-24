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
        --boost: #8b5cf6;
        --boost-dark: #6d28d9;
        --boost-light: #ede9fe;
    }

    *, *::before, *::after { box-sizing: border-box; }
    html, body { overflow-x: hidden; max-width: 100%; }
    img { max-width: 100%; height: auto; }

    body { font-family: 'DM Sans', sans-serif; font-size: 12px; }

    /* ── Table Card ── */
    .jobs-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .jobs-card .card-top {
        padding: 13px 18px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
    }

    .jobs-card .card-top h6 {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 13px;
        color: var(--dark);
        margin: 0;
    }

    .result-count {
        background: var(--teal-light);
        color: var(--teal-dark);
        border-radius: 20px;
        padding: 3px 12px;
        font-size: 11px;
        font-weight: 700;
    }

    /* ── Desktop Table ── */
    table { margin: 0 !important; font-size: 12px; }

    thead th {
        font-family: 'Syne', sans-serif;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: var(--muted);
        background: #f8f9fa;
        border: none !important;
        padding: 11px 14px !important;
        font-weight: 700;
        white-space: nowrap;
    }

    tbody td {
        padding: 11px 14px !important;
        vertical-align: middle !important;
        border-color: var(--border) !important;
        font-size: 12px;
        color: #333;
    }

    tbody tr:hover { background: #f4fdfb; }

    .td-title {
        max-width: 160px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        font-weight: 600;
        font-size: 12px;
    }

    .earn-val { color: var(--teal); font-weight: 700; }

    .worker-badge {
        background: #f1f3f5;
        border-radius: 8px;
        padding: 3px 9px;
        font-size: 11px;
        display: inline-block;
    }

    /* ── Status Pill ── */
    .status-pill {
        border-radius: 20px;
        padding: 2px 10px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        white-space: nowrap;
    }
    .status-pill.active    { background:#d1f2eb; color:#0e8a6a; }
    .status-pill.pending   { background:#fef9e7; color:#b7770d; }
    .status-pill.paused    { background:#e8ecef; color:#555; }
    .status-pill.completed { background:#e3f0ff; color:#2563eb; }

    .top-job-badge {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        color: #fff;
        border-radius: 20px;
        padding: 2px 8px;
        font-size: 10px;
        font-weight: 700;
        display: inline-block;
        margin-top: 3px;
    }

    /* ── Boost Badge ── */
    .boost-badge {
        background: linear-gradient(135deg, var(--boost), var(--boost-dark));
        color: #fff;
        border-radius: 20px;
        padding: 2px 8px;
        font-size: 10px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        margin-top: 3px;
        animation: boostPulse 2s ease-in-out infinite;
    }

    @keyframes boostPulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(139,92,246,.4); }
        50%       { box-shadow: 0 0 0 5px rgba(139,92,246,.0); }
    }

    /* ── Action Buttons ── */
    .action-group { display: flex; gap: 5px; flex-wrap: wrap; }
    .action-group .btn {
        font-size: 11px;
        border-radius: 7px;
        padding: 4px 10px;
        border: none;
        font-weight: 600;
        white-space: nowrap;
    }
    .btn-proof  { background: var(--teal);  color: #fff; }
    .btn-proof:hover  { background: var(--teal-dark); color: #fff; }
    .btn-edit   { background: #3498db;      color: #fff; }
    .btn-edit:hover   { background: #2176ae; color: #fff; }
    .btn-top    { background: #f39c12;      color: #fff; }
    .btn-top:hover    { background: #c87f0a; color: #fff; }
    .btn-delete { background: #e74c3c;      color: #fff; }
    .btn-delete:hover { background: #c0392b; color: #fff; }

    /* Boost button */
    .btn-boost {
        background: linear-gradient(135deg, var(--boost), var(--boost-dark));
        color: #fff;
    }
    .btn-boost:hover {
        background: linear-gradient(135deg, var(--boost-dark), #4c1d95);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(109,40,217,.35);
    }

    /* ── Mobile Cards ── */
    .job-card-m {
        background: #fff;
        border-radius: 10px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        border-left: 4px solid var(--teal);
        padding: 13px 14px;
        margin-bottom: 10px;
    }

    .job-card-m.is-boosted-card {
        border-left-color: var(--boost);
    }

    .jcm-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 8px;
    }

    .jcm-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
        flex: 1;
    }

    .jcm-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 10px;
        font-size: 11px;
        color: var(--muted);
    }

    .jcm-actions {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    .jcm-actions .btn {
        font-size: 11px;
        border-radius: 7px;
        padding: 5px 10px;
        border: none;
        font-weight: 600;
        flex: 1 1 auto;
        text-align: center;
    }

    /* ── Empty state ── */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--muted);
        font-size: 13px;
    }

    /* ── Modals ── */
    .modal-header {
        background: linear-gradient(135deg, #006A4E, #181c20);
        color: #fff;
        border: none;
        border-radius: var(--radius) var(--radius) 0 0;
    }
    .modal-header .modal-title { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 14px; }
    .modal-header .btn-close { filter: invert(1) brightness(2); }
    .modal-content { border-radius: var(--radius); overflow: hidden; border: none; box-shadow: 0 16px 48px rgba(0,0,0,.18); }

    .form-label { font-size: 12px; font-weight: 600; color: #555; margin-bottom: 4px; }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1.5px solid var(--border);
        font-size: 12px;
        padding: 9px 12px;
        transition: border-color .2s, box-shadow .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--teal);
        box-shadow: 0 0 0 3px rgba(26,188,156,.15);
    }
    .input-group-text {
        background: var(--teal-light);
        color: var(--teal-dark);
        border: 1.5px solid var(--border);
        font-weight: 700;
        border-radius: 10px 0 0 10px;
        font-size: 12px;
    }
    .input-group .form-control { border-radius: 0 10px 10px 0; }

    .charge-preview {
        background: linear-gradient(135deg, #f8fffd, #f0faf7);
        border: 1.5px solid var(--teal-light);
        border-radius: 12px;
        padding: 14px 16px;
    }
    .charge-preview .cp-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #444;
        padding: 4px 0;
    }
    .charge-preview .cp-row.total {
        border-top: 1.5px dashed var(--teal-light);
        margin-top: 8px;
        padding-top: 10px;
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 13px;
        color: var(--dark);
    }
    .charge-preview .cp-row.total span:last-child { color: var(--teal); }

    /* Boost modal charge preview */
    .boost-preview {
        background: linear-gradient(135deg, #faf5ff, #f3e8ff);
        border: 1.5px solid #ddd6fe;
        border-radius: 12px;
        padding: 14px 16px;
    }
    .boost-preview .cp-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #444;
        padding: 4px 0;
    }
    .boost-preview .cp-row.total {
        border-top: 1.5px dashed #ddd6fe;
        margin-top: 8px;
        padding-top: 10px;
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 13px;
        color: var(--dark);
    }
    .boost-preview .cp-row.total span:last-child { color: var(--boost); }

    /* Hour selector */
    .hour-options {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        margin-bottom: 16px;
    }

    .hour-option input[type="radio"] { display: none; }

    .hour-option label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px 6px;
        border-radius: 10px;
        border: 1.5px solid var(--border);
        cursor: pointer;
        transition: all .2s;
        background: #fff;
        font-size: 11px;
        color: var(--muted);
        gap: 2px;
    }

    .hour-option label .hr-num {
        font-family: 'Syne', sans-serif;
        font-size: 16px;
        font-weight: 800;
        color: var(--dark);
        line-height: 1;
    }

    .hour-option label .hr-price {
        font-size: 10px;
        font-weight: 700;
        color: var(--boost);
    }

    .hour-option input:checked + label {
        border-color: var(--boost);
        background: var(--boost-light);
        color: var(--boost-dark);
        box-shadow: 0 0 0 3px rgba(139,92,246,.15);
    }

    .hour-option input:checked + label .hr-num { color: var(--boost-dark); }

    /* Boost timer display */
    .boost-timer-wrap {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--boost-light);
        border-radius: 8px;
        padding: 2px 8px;
        font-size: 10px;
        color: var(--boost-dark);
        font-weight: 600;
        margin-top: 2px;
    }

    .info-note {
        background: #fff8e1;
        border-left: 3px solid #f39c12;
        border-radius: 0 8px 8px 0;
        padding: 8px 12px;
        font-size: 11px;
        color: #7d5a00;
    }

    /* ── Thumbnail preview (Edit Modal) ── */
    .thumb-preview-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 12px;
    }

    .thumb-preview-wrap img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 12px;
        border: 1.5px solid var(--border);
        background: #f8f9fa;
    }

    /* ── Responsive show/hide ── */
    @media (max-width: 767px) {
        .desktop-view { display: none !important; }
        .mobile-view  { display: block !important; }
    }
    @media (min-width: 768px) {
        .mobile-view  { display: none !important; }
        .desktop-view { display: block !important; }
    }

    /* ── Mobile tweaks ── */
    @media (max-width: 575px) {
        .container { padding-left: 10px !important; padding-right: 10px !important; }
        .jobs-card .card-top { padding: 11px 13px; }
        .modal-dialog { margin: 8px; }
        .modal-dialog { max-width: calc(100vw - 16px); }
        .modal-body { padding: 14px !important; }
        .modal-footer { padding: 10px 14px !important; }
        .hour-options { grid-template-columns: repeat(4,1fr); gap: 6px; }
        .hour-option label { padding: 8px 4px; }
        .hour-option label .hr-num { font-size: 14px; }
    }
</style>

<div class="container mt-4 pb-5">

    {{-- ── Card Header ── --}}
    <div class="jobs-card">
        <div class="card-top">
            <h6><i class="bi bi-list-ul me-2 text-success"></i>{{ $pageTitle }}</h6>
            <span class="result-count">{{ count($jobs) }} Result{{ count($jobs) != 1 ? 's' : '' }}</span>
        </div>

        {{-- ── Desktop Table ── --}}
        <div class="desktop-view table-responsive">
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
                        <td style="font-size:12px; color:var(--muted);">{{ $job->continent->name }}</td>
                        <td>
                            <span class="td-title" title="{{ $job->title }}">{{ $job->title }}</span>
                            @if($job->is_top)
                                <span class="top-job-badge"><i class="bi bi-star-fill me-1"></i>Top</span>
                            @endif
                            @if($job->isBoostedActive())
                                <span class="boost-badge">
                                    <i class="bi bi-rocket-takeoff-fill"></i>
                                    Boosted · {{ $job->boostRemainingMinutes() }}m left
                                </span>
                            @endif
                        </td>
                        <td><span class="earn-val">${{ $job->worker_earn }}</span></td>
                        <td>
                            <span class="worker-badge">
                                <strong class="text-danger">{{ $job->worker_done }}</strong>
                                / <strong class="text-success">{{ $job->worker_need }}</strong>
                            </span>
                        </td>
                        <td>
                            <span class="status-pill {{ strtolower($job->status) }}">{{ ucfirst($job->status) }}</span>
                        </td>
                        <td>
                            <div class="action-group">
                                @if($job->status == 'active')
                                    <a href="{{ route('user.submit-job-proof', [$job->id, $job->code]) }}"
                                       class="btn btn-proof btn-sm">
                                        <i class="bi bi-eye me-1"></i>Proof
                                    </a>
                                    <button class="btn btn-edit btn-sm"
                                        onclick='openEditModal({{ $job->id }},{{ $job->worker_need }},{{ $job->worker_earn }},@json($job->title),@json($job->description),@json($job->thumbnail))'>
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </button>
                                    @if(!$job->is_top)
                                    <button class="btn btn-top btn-sm"
                                        onclick="openTopJobModal({{ $job->id }}, '{{ addslashes($job->title) }}')">
                                        <i class="bi bi-star me-1"></i>Top
                                    </button>
                                    @endif
                                    <button class="btn btn-boost btn-sm"
                                        onclick="openBoostModal({{ $job->id }}, '{{ addslashes($job->title) }}', {{ $job->isBoostedActive() ? 'true' : 'false' }})">
                                        <i class="bi bi-rocket-takeoff me-1"></i>Boost
                                    </button>
                                    <form action="{{ route('user.job.money-back', [$job->id, $job->code]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Stop this job?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-dark btn-sm">
                                            <i class="bi bi-wallet2 me-1"></i>Money Back
                                        </button>
                                    </form>
                                    <form action="{{ route('user.job.mute', [$job->id, $job->code]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Mute this job?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="bi bi-wallet2 me-1"></i>Mute
                                        </button>
                                    </form>

                                @elseif($job->status == 'mute')
                                    <form action="{{ route('user.job.unmute', [$job->id, $job->code]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Unmute this job?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi bi-wallet2 me-1"></i>Unmute
                                        </button>
                                    </form>

                                @elseif($job->status == 'completed')
                                    <a href="{{ route('user.submit-job-proof', [$job->id, $job->code]) }}"
                                       class="btn btn-proof btn-sm">
                                        <i class="bi bi-eye me-1"></i>Proof
                                    </a>
                                    <button class="btn btn-edit btn-sm"
                                        onclick='openEditModal({{ $job->id }},{{ $job->worker_need }},{{ $job->worker_earn }},@json($job->title),@json($job->description),@json($job->thumbnail))'>
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </button>
                                    <form action="{{ route('user.job.delete', [$job->id, $job->code]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this job?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-sm">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </button>
                                    </form>

                                @elseif(in_array($job->status, ['reject', 'stop']))
                                    <form action="{{ route('user.job.delete', [$job->id, $job->code]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this job?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-sm">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </button>
                                    </form>

                                @endif
                                {{-- status == 'pending' → no action button --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No jobs posted yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- ── Mobile Cards ── --}}
        <div class="mobile-view p-3">
            @forelse($jobs as $job)
            <div class="job-card-m {{ $job->isBoostedActive() ? 'is-boosted-card' : '' }}">
                <div class="jcm-top">
                    <span class="jcm-title" title="{{ $job->title }}">{{ $job->title }}</span>
                    <span class="earn-val" style="font-size:13px; white-space:nowrap;">${{ $job->worker_earn }}</span>
                </div>
                <div class="jcm-meta">
                    <span><i class="bi bi-globe2 me-1"></i>{{ $job->continent->name }}</span>
                    <span>
                        <span class="worker-badge">
                            <strong class="text-danger">{{ $job->worker_done }}</strong>
                            / <strong class="text-success">{{ $job->worker_need }}</strong>
                        </span>
                    </span>
                    <span>
                        <span class="status-pill {{ strtolower($job->status) }}">{{ ucfirst($job->status) }}</span>
                        @if($job->is_top)
                            <span class="top-job-badge ms-1"><i class="bi bi-star-fill"></i> Top</span>
                        @endif
                        @if($job->isBoostedActive())
                            <span class="boost-badge ms-1">
                                <i class="bi bi-rocket-takeoff-fill"></i>
                                {{ $job->boostRemainingMinutes() }}m
                            </span>
                        @endif
                    </span>
                </div>
                    <div class="jcm-actions">
                        <div class="action-group" style="width:100%;">
                            @if($job->status == 'active')
                                <a href="{{ route('user.submit-job-proof', [$job->id, $job->code]) }}"
                                   class="btn btn-proof btn-sm">
                                    <i class="bi bi-eye me-1"></i>Proof
                                </a>
                                <button class="btn btn-edit btn-sm"
                                    onclick='openEditModal({{ $job->id }},{{ $job->worker_need }},{{ $job->worker_earn }},@json($job->title),@json($job->description),@json($job->thumbnail))'>
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </button>
                                @if(!$job->is_top)
                                <button class="btn btn-top btn-sm"
                                    onclick="openTopJobModal({{ $job->id }}, '{{ addslashes($job->title) }}')">
                                    <i class="bi bi-star me-1"></i>Top
                                </button>
                                @endif
                                <button class="btn btn-boost btn-sm"
                                    onclick="openBoostModal({{ $job->id }}, '{{ addslashes($job->title) }}', {{ $job->isBoostedActive() ? 'true' : 'false' }})">
                                    <i class="bi bi-rocket-takeoff me-1"></i>Boost
                                </button>
                                <form action="{{ route('user.job.money-back', [$job->id, $job->code]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Stop this job?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-dark btn-sm">
                                        <i class="bi bi-wallet2 me-1"></i>Money Back
                                    </button>
                                </form>
                                <form action="{{ route('user.job.mute', [$job->id, $job->code]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Mute this job?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="bi bi-wallet2 me-1"></i>Mute
                                    </button>
                                </form>

                            @elseif($job->status == 'mute')
                                <form action="{{ route('user.job.unmute', [$job->id, $job->code]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Unmute this job?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-wallet2 me-1"></i>Unmute
                                    </button>
                                </form>

                            @elseif($job->status == 'completed')
                                <a href="{{ route('user.submit-job-proof', [$job->id, $job->code]) }}"
                                   class="btn btn-proof btn-sm">
                                    <i class="bi bi-eye me-1"></i>Proof
                                </a>
                                <button class="btn btn-edit btn-sm"
                                    onclick='openEditModal({{ $job->id }},{{ $job->worker_need }},{{ $job->worker_earn }},@json($job->title),@json($job->description),@json($job->thumbnail))'>
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </button>
                                <form action="{{ route('user.job.delete', [$job->id, $job->code]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this job?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-sm">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </form>

                            @elseif(in_array($job->status, ['reject', 'stop']))
                                <form action="{{ route('user.job.delete', [$job->id, $job->code]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this job?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-sm">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </form>

                            @endif
                        </div>
                    </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                No jobs posted yet.
            </div>
            @endforelse
        </div>

    </div>
</div>

{{-- ══ EDIT MODAL ══ --}}
<div class="modal fade" id="editWorkerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editWorkerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">
                    <div class="info-note mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                      <strong>
                          শুধু Worker সংখ্যা বাড়ালে জব লাইভ থাকবে 
                      </strong>কিন্তু Title, Description বা Thumbnail পরিবর্তন করলে job আবার <strong>Pending</strong> এ চলে যাবে এবং re-approval লাগবে।
                    </div>

                    {{-- Thumbnail Preview + Upload --}}
                    <div class="thumb-preview-wrap">
                        <img id="current_thumbnail_preview" src="" alt="Thumbnail">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" id="jobThumbnail" name="thumbnail" class="form-control"
                               accept="image/png, image/jpeg, image/jpg, image/webp"
                               onchange="previewNewThumbnail(event)">
                        <small class="text-muted mt-1 d-block" style="font-size:11px;">
                            বর্তমান thumbnail রাখতে চাইলে খালি রাখুন। JPG/PNG/WEBP, max 2MB.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" id="jobTitle" name="job_title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea id="jobDescription" name="job_description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Add Workers</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                            <input type="number" id="extra_workers" name="extra_workers"
                                   class="form-control" min="1"
                                   placeholder="e.g. 10" oninput="recalcEdit()">
                        </div>
                        <small class="text-muted mt-1 d-block" style="font-size:11px;">
                            Current total: <strong id="current_total">—</strong> workers
                        </small>
                    </div>

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
                            <span>Job post charge ({{ $setting->jobpost_charge ?? 0 }}%)</span>
                            <span id="prev-charge">$0.00</span>
                        </div>
                        <div class="cp-row total">
                            <span>Total to pay</span>
                            <span id="prev-total">$0.00</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-3 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" style="font-size:12px;">Cancel</button>
                    <button type="submit" class="btn btn-edit rounded-pill px-4 fw-bold" style="font-size:12px;">
                        <i class="bi bi-check-circle me-1"></i>Update Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ TOP JOB MODAL ══ --}}
<div class="modal fade" id="topJobModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg,#f39c12,#e67e22);">
                <h6 class="modal-title" style="font-size:13px;"><i class="bi bi-star-fill me-2"></i>Promote to Top Job</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="topJobForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">
                    <div class="text-center mb-3">
                        <div style="font-size:2rem;">⭐</div>
                        <h6 class="fw-bold mt-2" id="top-job-title-display" style="font-size:13px;"></h6>
                        <p class="text-muted" style="font-size:11px;">
                            Top Jobs appear at the top of listings and attract more workers faster.
                        </p>
                    </div>
                    <div class="charge-preview">
                        <div class="cp-row">
                            <span>Top Job Promotion Fee</span>
                            <span class="fw-bold text-warning">${{ $setting->topjob_charge ?? '0.00' }}</span>
                        </div>
                    </div>
                    <div class="info-note mt-3">
                        <i class="bi bi-lightning-fill me-1 text-warning"></i>
                        This amount will be deducted from your wallet immediately.
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-3 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" style="font-size:12px;">Cancel</button>
                    <button type="submit" class="btn btn-top rounded-pill px-4 fw-bold" style="font-size:12px;">
                        <i class="bi bi-star-fill me-1"></i>Make it Top Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ BOOST MODAL ══ --}}
<div class="modal fade" id="boostModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #6d28d9, #4c1d95);">
                <h6 class="modal-title" style="font-size:13px;">
                    <i class="bi bi-rocket-takeoff-fill me-2"></i>Boost Job
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="boostForm" method="POST">
                @csrf
                <div class="modal-body p-4">

                    {{-- Job name --}}
                    <div class="text-center mb-4">
                        <div style="font-size:2rem; line-height:1;">🚀</div>
                        <h6 class="fw-bold mt-2 mb-1" id="boost-job-title" style="font-size:13px;"></h6>
                        <p class="text-muted mb-0" style="font-size:11px;">
                            Boost করলে job টি সবার উপরে দেখাবে নির্দিষ্ট সময়ের জন্য।
                        </p>
                        {{-- Already boosted notice --}}
                        <div id="boost-extend-notice" class="mt-2" style="display:none;">
                            <span style="background:#ede9fe; color:#6d28d9; border-radius:8px; padding:3px 10px; font-size:11px; font-weight:600;">
                                <i class="bi bi-info-circle me-1"></i>Already boosted — new time will be added on top
                            </span>
                        </div>
                    </div>

                    {{-- Hour selector --}}
                    <label class="form-label mb-2">Boost Duration বেছে নিন</label>
                    <div class="hour-options">
                        @foreach([1,2,3,4,5,6,7,8,9,10,12,24] as $h)
                        <div class="hour-option">
                            <input type="radio" name="boost_hours" id="h{{ $h }}" value="{{ $h }}"
                                {{ $h === 1 ? 'checked' : '' }}
                                onchange="recalcBoost()">
                            <label for="h{{ $h }}">
                                <span class="hr-num">{{ $h }}h</span>
                                <span class="text-muted" style="font-size:9px;">hour{{ $h > 1 ? 's' : '' }}</span>
                                {{-- Price label: calculated as hours × boost_charge_per_hour from admin setting --}}
                                <span class="hr-price" id="price-{{ $h }}">${{ number_format(($setting->boost_charge_per_hour ?? 1) * $h, 2) }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>

                    {{-- Cost preview --}}
                    <div class="boost-preview">
                        <div class="cp-row">
                            <span>Duration</span>
                            <span id="bprev-hours">1 hour</span>
                        </div>
                        <div class="cp-row">
                            <span>Charge per hour</span>
                            <span id="bprev-rate">${{ number_format($setting->boost_charge_per_hour ?? 1, 2) }}</span>
                        </div>
                        <div class="cp-row total">
                            <span>Total to pay</span>
                            <span id="bprev-total">${{ number_format($setting->boost_charge_per_hour ?? 1, 2) }}</span>
                        </div>
                    </div>

                    <div class="info-note mt-3">
                        <i class="bi bi-wallet2 me-1"></i>
                        আপনার wallet থেকে কেটে নেওয়া হবে। Current balance:
                        <strong>${{ number_format(auth()->user()->current_deposit ?? 0, 2) }}</strong>
                    </div>

                </div>
                <div class="modal-footer border-0 pt-0 pb-3 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" style="font-size:12px;">Cancel</button>
                    <button type="submit" class="btn btn-boost rounded-pill px-4 fw-bold" style="font-size:12px;">
                        <i class="bi bi-rocket-takeoff-fill me-1"></i>Boost Now
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
    // Admin-configured values passed from backend
    const JOB_POST_CHARGE_PERCENT = {{ $setting->jobpost_charge ?? 0 }};   // e.g. 10 means 10%
    const BOOST_CHARGE_PER_HOUR   = {{ $setting->boost_charge_per_hour ?? 1 }}; // e.g. 0.50
    let _editEarn = 0;

    /* ── Edit Modal ── */
    function openEditModal(jobId, currentWorkers, workerEarn, jobTitle, jobDescription, jobThumbnail) {
        _editEarn = parseFloat(workerEarn);
        document.getElementById('editWorkerForm').action = '/user/jobs/' + jobId + '/update-workers';
        document.getElementById('current_total').textContent  = currentWorkers;
        document.getElementById('jobTitle').value             = jobTitle;
        document.getElementById('jobDescription').value       = jobDescription;
        document.getElementById('extra_workers').value        = '';
        document.getElementById('jobThumbnail').value         = '';
        document.getElementById('prev-earn').textContent      = '$' + _editEarn.toFixed(2);

        // Show current thumbnail (or a placeholder if none exists)
        const preview = document.getElementById('current_thumbnail_preview');
        if (jobThumbnail) {
            preview.src = '/storage/' + jobThumbnail;
        } else {
            preview.src = 'https://via.placeholder.com/100x100?text=No+Image';
        }

        recalcEdit();
        new bootstrap.Modal(document.getElementById('editWorkerModal')).show();
    }

    // Live preview when a new thumbnail file is chosen
    function previewNewThumbnail(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('current_thumbnail_preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    }

    function recalcEdit() {
        const extra      = parseInt(document.getElementById('extra_workers').value) || 0;
        const workerCost = extra * _editEarn;
        // jobpost_charge is a percentage: charge = workerCost × (percent / 100)
        const feeAmount  = workerCost * (JOB_POST_CHARGE_PERCENT / 100);
        const total      = workerCost + feeAmount;

        document.getElementById('prev-extra').textContent  = extra;
        document.getElementById('prev-charge').textContent = '$' + feeAmount.toFixed(2);
        document.getElementById('prev-total').textContent  = '$' + total.toFixed(2);
    }

    /* ── Top Job Modal ── */
    function openTopJobModal(jobId, jobTitle) {
        document.getElementById('topJobForm').action = '/user/jobs/' + jobId + '/make-top';
        document.getElementById('top-job-title-display').textContent = jobTitle;
        new bootstrap.Modal(document.getElementById('topJobModal')).show();
    }

    /* ── Boost Modal ── */
    function openBoostModal(jobId, jobTitle, isBoosted) {
        document.getElementById('boostForm').action = '/user/jobs/' + jobId + '/boost';
        document.getElementById('boost-job-title').textContent = jobTitle;

        // Show extend notice if already boosted
        document.getElementById('boost-extend-notice').style.display = isBoosted ? 'block' : 'none';

        // Reset to 1 hour selected
        document.getElementById('h1').checked = true;

        // Update per-hour price labels dynamically from the admin setting
        // (Blade already rendered them server-side; this keeps JS in sync
        //  in case the modal is opened multiple times without page reload)
        [1,2,3,4,5,6,7,8,9,10,12,24].forEach(h => {
            const el = document.getElementById('price-' + h);
            if (el) el.textContent = '$' + (BOOST_CHARGE_PER_HOUR * h).toFixed(2);
        });

        recalcBoost();
        new bootstrap.Modal(document.getElementById('boostModal')).show();
    }

    function recalcBoost() {
        const selected = document.querySelector('input[name="boost_hours"]:checked');
        const h        = selected ? parseInt(selected.value) : 1;
        const total    = (BOOST_CHARGE_PER_HOUR * h).toFixed(2);

        document.getElementById('bprev-hours').textContent = h + (h === 1 ? ' hour' : ' hours');
        document.getElementById('bprev-total').textContent = '$' + total;
        // Also keep rate row accurate (static but nice to confirm)
        document.getElementById('bprev-rate').textContent  = '$' + BOOST_CHARGE_PER_HOUR.toFixed(2);
    }
</script>

@endsection