@extends('user.layouts.app')

@section('title', 'Post a Job')

@push('styles')
<style>
    .wizard-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.75rem;
        max-width: 720px;
        margin: 2rem auto;
    }

    .step-bar { display: flex; align-items: center; margin-bottom: 1.75rem; }
    .step-item { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #9ca3af; }
    .step-item.active { color: #111827; font-weight: 500; }
    .step-item.done   { color: #6b7280; }
    .step-dot {
        width: 26px; height: 26px; border-radius: 50%;
        border: 1.5px solid #d1d5db;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 500; flex-shrink: 0;
    }
    .step-item.active .step-dot { border-color: #7c3aed; color: #7c3aed; background: #f5f3ff; }
    .step-item.done   .step-dot { border-color: #7c3aed; background: #7c3aed; color: #fff; }
    .step-line { flex: 1; height: 1px; background: #e5e7eb; margin: 0 6px; }
    .step-line.done-line { background: #7c3aed; }

    .opt-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(145px, 1fr)); gap: 10px; margin-bottom: 1.25rem; }
    .opt-card {
        border: 1px solid #e5e7eb; border-radius: 8px; padding: 14px 10px;
        cursor: pointer; text-align: center; background: #f9fafb;
        transition: border-color .15s, background .15s;
    }
    .opt-card:hover { border-color: #a78bfa; }
    .opt-card.selected { border-color: #7c3aed; background: #f5f3ff; }
    .opt-card .ico  { font-size: 24px; line-height: 1; display: block; margin-bottom: 6px; }
    .opt-card .lbl  { font-size: 13px; font-weight: 500; color: #111827; }
    .opt-card .meta { font-size: 11px; color: #6b7280; margin-top: 2px; }

    .country-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 8px; margin-bottom: 1.25rem; max-height: 280px; overflow-y: auto; }
    .country-item {
        border: 1px solid #e5e7eb; border-radius: 8px; padding: 9px 12px;
        cursor: pointer; font-size: 13px; color: #374151;
        background: #f9fafb; display: flex; align-items: center; gap: 8px;
    }
    .country-item:hover  { border-color: #a78bfa; }
    .country-item.selected { border-color: #7c3aed; background: #f5f3ff; color: #5b21b6; font-weight: 500; }

    .sub-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 8px; margin-bottom: 1.25rem; }
    .sub-item {
        border: 1px solid #e5e7eb; border-radius: 8px; padding: 9px 12px;
        cursor: pointer; font-size: 13px; color: #374151; background: #f9fafb;
    }
    .sub-item:hover    { border-color: #34d399; }
    .sub-item.selected { border-color: #059669; background: #ecfdf5; color: #065f46; font-weight: 500; }

    .form-label { font-size: 13px; font-weight: 500; color: #6b7280; display: block; margin-bottom: 6px; }
    .form-control {
        width: 100%; padding: 9px 12px; border: 1px solid #d1d5db;
        border-radius: 8px; font-size: 14px; background: #f9fafb; color: #111827;
        margin-bottom: 14px; outline: none; transition: border-color .15s;
    }
    .form-control:focus { border-color: #7c3aed; background: #fff; }
    textarea.form-control { min-height: 90px; resize: vertical; }

    .thumb-area {
        border: 1.5px dashed #d1d5db; border-radius: 8px; padding: 1.25rem;
        text-align: center; cursor: pointer; font-size: 13px; color: #9ca3af;
        background: #f9fafb; margin-bottom: 14px; transition: border-color .15s;
    }
    .thumb-area:hover { border-color: #7c3aed; }
    #thumbPreview { width: 100%; max-height: 150px; object-fit: cover; border-radius: 6px; margin-bottom: 8px; display: none; }

    .check-row { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; cursor: pointer; }
    .check-row input[type=checkbox] { width: 16px; height: 16px; accent-color: #7c3aed; }
    .check-row span { font-size: 13px; color: #374151; }

    .proof-block { border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; margin-bottom: 10px; background: #f9fafb; }
    .proof-row   { display: flex; gap: 10px; align-items: center; }
    .proof-row select { flex: 0 0 110px; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px; background: #fff; }
    .proof-row input  { flex: 1; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px; background: #fff; }
    .del-btn { width: 34px; height: 34px; border: 1px solid #e5e7eb; border-radius: 8px; background: #fff; color: #9ca3af; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .del-btn:hover:not(:disabled) { border-color: #fca5a5; color: #ef4444; background: #fef2f2; }
    .del-btn:disabled { opacity: .4; cursor: not-allowed; }
    .add-proof-btn {
        width: 100%; padding: 9px; border: 1.5px dashed #d1d5db; border-radius: 8px;
        background: transparent; font-size: 13px; color: #6b7280; cursor: pointer;
        margin-bottom: 14px; transition: border-color .15s;
    }
    .add-proof-btn:hover { border-color: #7c3aed; color: #7c3aed; }

    .btn-row { display: flex; justify-content: space-between; align-items: center; margin-top: 8px; }
    .btn-back { padding: 9px 20px; border: 1px solid #d1d5db; border-radius: 8px; background: transparent; color: #6b7280; font-size: 14px; cursor: pointer; }
    .btn-back:hover { background: #f3f4f6; }
    .btn-next { padding: 9px 24px; border: none; border-radius: 8px; background: #7c3aed; color: #fff; font-size: 14px; font-weight: 500; cursor: pointer; }
    .btn-next:hover    { background: #6d28d9; }
    .btn-next:disabled { opacity: .45; cursor: not-allowed; }
    .btn-submit { padding: 9px 24px; border: none; border-radius: 8px; background: #059669; color: #fff; font-size: 14px; font-weight: 500; cursor: pointer; }
    .btn-submit:hover { background: #047857; }

    .loader { display: flex; gap: 8px; padding: 8px 0; }
    .skel { height: 42px; border-radius: 8px; background: #e5e7eb; animation: pulse 1.2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.5} }

    .alert-danger { background:#fef2f2; border:1px solid #fca5a5; color:#b91c1c; padding:10px 14px; border-radius:8px; font-size:13px; margin-bottom:14px; }

    /* ── Budget box ── */
    .budget-box {
        background: #f0fdf4; border: 1px solid #bbf7d0;
        border-radius: 8px; padding: 14px; margin-bottom: 14px;
    }
    .budget-grid {
        display: grid; grid-template-columns: 1fr 1fr 1fr;
        gap: 12px; text-align: center; margin-bottom: 12px;
    }
    .budget-grid .b-label { font-size: 11px; color: #6b7280; margin-bottom: 4px; }
    .budget-grid .b-val   { font-size: 16px; font-weight: 600; color: #374151; }
    .budget-grid .b-val.green { color: #059669; }
    .budget-grid .b-val.red   { color: #ef4444; }
    .budget-total {
        border-top: 1px solid #bbf7d0; padding-top: 12px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .budget-total span:first-child { font-size: 13px; font-weight: 500; color: #374151; }
    .budget-total span:last-child  { font-size: 20px; font-weight: 700; color: #059669; }

    h2 { font-size: 18px; font-weight: 500; color: #111827; margin-bottom: 4px; }
    .sub-head { font-size: 13px; color: #6b7280; margin-bottom: 1.25rem; }
    .section-label { font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 8px; display: block; }
</style>
@endpush

@section('content')

{{-- ═══ Traditional HTML Form (hidden) — submit হবে Step 3 থেকে ═══ --}}
<form id="jobForm"
      action="{{ route('user.create.job.store') }}"
      method="POST"
      enctype="multipart/form-data"
      style="display:none">
    @csrf

    {{-- Step 1 & 2 থেকে আসা hidden fields --}}
    <input type="hidden" name="continent_id"   id="hContinentId">
    <input type="hidden" name="country_id"     id="hCountryId">
    <input type="hidden" name="category_id"    id="hCategoryId">
    <input type="hidden" name="subcategory_id" id="hSubcategoryId">

    {{-- Step 3 fields --}}
    <input type="hidden" name="title"          id="hTitle">
    <input type="hidden" name="description"    id="hDescription">
    <input type="hidden" name="worker_need"    id="hWorkerNeed">
    <input type="hidden" name="has_secret_code" id="hHasSecretCode" value="0">
    <input type="hidden" name="secret_code"    id="hSecretCode">

    {{-- Thumbnail real file input --}}
    <input type="file"   name="thumbnail"      id="hThumbnail" accept="image/*">

    {{-- Proofs — JS দিয়ে dynamically যোগ হবে --}}
    <div id="hProofsContainer"></div>
</form>

<div class="wizard-card" id="wizardCard">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
   @endif
    <div class="step-bar" id="stepBar"></div>
    <div id="wizardContent"></div>
</div>
@endsection

@push('scripts')
<script>
const BASE_URL = '{{ url("/user") }}';
const CSRF     = '{{ csrf_token() }}';

// ── State ─────────────────────────────────────────────────────────────
const state = {
    step: 1,
    continentId: null, continentName: '', continentEmoji: '',
    countryId: null,   countryName: '',
    categoryId: null,  categoryName: '',
    subId: null,       subName: '',
    minCost: 0,
};

let form = {
    title: '', description: '',
    workerNeed: '',
    secretOn: false, secretCode: ''
};
let proofs       = [{ id: 1, type: 'text', label: '' }];
let proofCounter = 2;
let thumbDataUrl = null; // শুধু preview এর জন্য
let cache        = {};

// ── Helpers ───────────────────────────────────────────────────────────
async function apiFetch(url) {
    if (cache[url]) return cache[url];
    const r = await fetch(url, {
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
    });
    if (!r.ok) {
        console.error('apiFetch error:', r.status, await r.text());
        throw new Error('API error ' + r.status);
    }
    cache[url] = await r.json();
    return cache[url];
}

function skeleton(n = 4) {
    return `<div class="loader">${Array(n).fill('<div class="skel" style="flex:1"></div>').join('')}</div>`;
}

function escHtml(str) {
    return String(str ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// ── Step bar ──────────────────────────────────────────────────────────
function renderStepBar() {
    const steps = ['Location', 'Category', 'Job Details'];
    document.getElementById('stepBar').innerHTML = steps.map((s, i) => {
        const n = i + 1;
        const done = state.step > n, active = state.step === n;
        const cls  = done ? 'done' : active ? 'active' : '';
        const line = i < steps.length - 1
            ? `<div class="step-line${done ? ' done-line' : ''}"></div>` : '';
        return `<div class="step-item ${cls}">
            <div class="step-dot">${done ? '✓' : n}</div>
            <span>${s}</span>
        </div>${line}`;
    }).join('');
}

// ── Step 1: Continent → Country ───────────────────────────────────────
async function renderStep1() {
    document.getElementById('wizardContent').innerHTML = `
        <h2>Select location</h2>
        <p class="sub-head">Choose a continent then pick a country</p>
        <div id="continentGrid">${skeleton(6)}</div>
        <div id="countrySection"></div>
        <div class="btn-row">
            <span></span>
            <button class="btn-next" id="nextBtn1" onclick="goNext()" disabled>Next →</button>
        </div>`;

    try {
        const continents = await apiFetch(`${BASE_URL}/continents`);
        document.getElementById('continentGrid').innerHTML = `<div class="opt-grid">
            ${continents.map(c => `
                <div class="opt-card${state.continentId === c.id ? ' selected' : ''}"
                     data-id="${c.id}"
                     onclick="selectContinent(${c.id}, '${escHtml(c.name)}', '${c.emoji ?? ''}')">
                    <span class="ico">${c.emoji ?? ''}</span>
                    <span class="lbl">${escHtml(c.name)}</span>
                    <span class="meta">${c.country_count ?? 0} countries</span>
                </div>`).join('')}
        </div>`;
    } catch(e) {
        document.getElementById('continentGrid').innerHTML =
            `<div class="alert-danger">• Failed to load continents. Please refresh.</div>`;
    }

    if (state.continentId) await loadCountries(state.continentId);
    updateNextBtn1();
}

async function selectContinent(id, name, emoji) {
    if (state.continentId !== id) { state.countryId = null; state.countryName = ''; }
    state.continentId    = id;
    state.continentName  = name;
    state.continentEmoji = emoji;

    document.querySelectorAll('#continentGrid .opt-card').forEach(el => {
        el.classList.toggle('selected', parseInt(el.dataset.id) === id);
    });

    await loadCountries(id);
    updateNextBtn1();
}

async function loadCountries(id) {
    const cs = document.getElementById('countrySection');
    if (!cs) return;
    cs.innerHTML = `
        <span class="section-label">Select country in <strong>${escHtml(state.continentName)}</strong></span>
        <div id="countryGrid">${skeleton(6)}</div>`;
    try {
        const countries = await apiFetch(`${BASE_URL}/continents/${id}/countries`);
        document.getElementById('countryGrid').innerHTML = `<div class="country-grid">
            ${countries.map(c => `
                <div class="country-item${state.countryId === c.id ? ' selected' : ''}"
                     data-id="${c.id}"
                     onclick="selectCountry(${c.id}, '${escHtml(c.name)}')">
                    <span>${escHtml(c.name)}</span>
                </div>`).join('')}
        </div>`;
    } catch(e) {
        document.getElementById('countryGrid').innerHTML =
            `<div class="alert-danger">• Failed to load countries.</div>`;
    }
    updateNextBtn1();
}

function selectCountry(id, name) {
    state.countryId   = id;
    state.countryName = name;
    document.querySelectorAll('.country-item').forEach(el => {
        el.classList.toggle('selected', parseInt(el.dataset.id) === id);
    });
    updateNextBtn1();
}

function updateNextBtn1() {
    const btn = document.getElementById('nextBtn1');
    if (btn) btn.disabled = !state.countryId;
}

// ── Step 2: Category → Subcategory ────────────────────────────────────
async function renderStep2() {
    document.getElementById('wizardContent').innerHTML = `
        <h2>Job category</h2>
        <p class="sub-head">Pick a category then select a subcategory</p>
        <div id="catGrid">${skeleton(8)}</div>
        <div id="subSection"></div>
        <div class="btn-row">
            <button class="btn-back" onclick="goBack()">← Back</button>
            <button class="btn-next" id="nextBtn2" onclick="goNext()" disabled>Next →</button>
        </div>`;

    try {
        const cats = await apiFetch(`${BASE_URL}/job-categories`);
        document.getElementById('catGrid').innerHTML = `<div class="opt-grid">
            ${cats.map(c => `
                <div class="opt-card${state.categoryId === c.id ? ' selected' : ''}"
                     data-id="${c.id}"
                     onclick="selectCategory(${c.id}, '${escHtml(c.name)}')">
                    <span class="lbl">${escHtml(c.name)}</span>
                </div>`).join('')}
        </div>`;
    } catch(e) {
        document.getElementById('catGrid').innerHTML =
            `<div class="alert-danger">• Failed to load categories.</div>`;
    }

    if (state.categoryId) await loadSubs(state.categoryId);
    updateNextBtn2();
}

async function selectCategory(id, name) {
    if (state.categoryId !== id) { state.subId = null; state.subName = ''; state.minCost = 0; }
    state.categoryId   = id;
    state.categoryName = name;
    document.querySelectorAll('#catGrid .opt-card').forEach(el => {
        el.classList.toggle('selected', parseInt(el.dataset.id) === id);
    });
    await loadSubs(id);
    updateNextBtn2();
}

async function loadSubs(id) {
    const ss = document.getElementById('subSection');
    if (!ss) return;
    ss.innerHTML = `
        <span class="section-label">Subcategory — ${escHtml(state.categoryName)}</span>
        <div id="subGrid">${skeleton(6)}</div>`;
    try {
        const subs = await apiFetch(`${BASE_URL}/job-categories/${id}/subcategories`);
        document.getElementById('subGrid').innerHTML = `<div class="sub-grid">
            ${subs.map(s => `
                <div class="sub-item${state.subId === s.id ? ' selected' : ''}"
                     data-id="${s.id}"
                     data-cost="${s.minimum_cost ?? 0}"
                     onclick="selectSub(${s.id}, '${escHtml(s.name)}', ${parseFloat(s.minimum_cost) || 0})">
                    <div>${escHtml(s.name)}</div>
                    <div style="font-size:11px;color:#6b7280;margin-top:3px">
                        Min: $${parseFloat(s.minimum_cost || 0).toFixed(2)}/worker
                    </div>
                </div>`).join('')}
        </div>`;
    } catch(e) {
        document.getElementById('subGrid').innerHTML =
            `<div class="alert-danger">• Failed to load subcategories.</div>`;
    }
    updateNextBtn2();
}

function selectSub(id, name, minCost) {
    state.subId   = id;
    state.subName = name;
    state.minCost = parseFloat(minCost) || 0;
    document.querySelectorAll('.sub-item').forEach(el => {
        el.classList.toggle('selected', parseInt(el.dataset.id) === id);
    });
    updateNextBtn2();
}

function updateNextBtn2() {
    const btn = document.getElementById('nextBtn2');
    if (btn) btn.disabled = !state.subId;
}

// ── Step 3: Job Details ───────────────────────────────────────────────
function renderStep3() {
    const workers = parseInt(form.workerNeed) || 0;
    const budget  = workers * state.minCost;
    const charge  = budget * 0.1;
    const total   = budget + charge;

    document.getElementById('wizardContent').innerHTML = `
        <h2>Job details</h2>
        <p class="sub-head">${escHtml(state.subName)} · ${escHtml(state.countryName)}, ${escHtml(state.continentName)}</p>

        {{-- Laravel validation errors --}}
        @if($errors->any())
        <div class="alert-danger">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
        @endif

        <label class="form-label">Job title <span style="color:#ef4444">*</span></label>
        <input type="text" class="form-control" id="fTitle"
               placeholder="e.g. Senior React Developer"
               value="${escHtml(form.title)}">

        <label class="form-label">Job description <span style="color:#ef4444">*</span></label>
        <textarea class="form-control" id="fDesc"
                  placeholder="Role requirements, responsibilities...">${escHtml(form.description)}</textarea>

        <label class="form-label">Number of workers needed <span style="color:#ef4444">*</span></label>
        <input type="number" class="form-control" id="fWorkerNeed"
               placeholder="e.g. 5" min="1"
               value="${escHtml(form.workerNeed)}"
               oninput="calcBudget(this.value)">

        <div class="budget-box" id="budgetBox" style="display:${workers > 0 ? 'block' : 'none'}">
            <div class="budget-grid">
                <div>
                    <div class="b-label">Min Cost / Worker</div>
                    <div class="b-val" id="bMinCost">$${state.minCost.toFixed(2)}</div>
                </div>
                <div>
                    <div class="b-label">Total Budget</div>
                    <div class="b-val green" id="bBudget">$${budget.toFixed(2)}</div>
                </div>
                <div>
                    <div class="b-label">Service Charge (10%)</div>
                    <div class="b-val red" id="bCharge">+$${charge.toFixed(2)}</div>
                </div>
            </div>
            <div class="budget-total">
                <span>Total with charge:</span>
                <span id="bTotal">$${total.toFixed(2)}</span>
            </div>
        </div>

        <label class="form-label">Thumbnail image</label>
        <div class="thumb-area" onclick="document.getElementById('fThumbnail').click()">
            <img id="thumbPreview" src="${thumbDataUrl || ''}"
                 style="display:${thumbDataUrl ? 'block' : 'none'}">
            <span id="thumbText" style="display:${thumbDataUrl ? 'none' : 'inline'}">
                Click to upload thumbnail (JPEG, PNG, WebP — max 2MB)
            </span>
        </div>
        <input type="file" id="fThumbnail" accept="image/*"
               style="display:none" onchange="handleThumb(this)">

        <label class="check-row">
            <input type="checkbox" id="secretCk"
                   ${form.secretOn ? 'checked' : ''}
                   onchange="toggleSecret()">
            <span>Require secret code to apply</span>
        </label>

        <div id="secretBox" style="display:${form.secretOn ? 'block' : 'none'}">
            <label class="form-label">Secret code</label>
            <input type="password" class="form-control" id="fSecret"
                   placeholder="Enter secret code"
                   value="${escHtml(form.secretCode)}">
        </div>

        <label class="form-label">Proof requirements <span style="color:#ef4444">*</span></label>
        <div id="proofsWrap">${proofs.map(proofRowHtml).join('')}</div>
        <button type="button" class="add-proof-btn" onclick="addProof()">+ Add another proof field</button>

        <div class="btn-row">
            <button type="button" class="btn-back" onclick="saveForm(); goBack()">← Back</button>
            <button type="button" class="btn-submit" onclick="submitJob()">Post Job ✓</button>
        </div>`;
}

// ── Budget calculator ─────────────────────────────────────────────────
function calcBudget(val) {
    const workers = parseInt(val) || 0;
    const budget  = workers * state.minCost;
    const charge  = budget * 0.1;
    const total   = budget + charge;

    const box = document.getElementById('budgetBox');
    if (!box) return;

    box.style.display = workers > 0 ? 'block' : 'none';
    document.getElementById('bMinCost').textContent = '$' + state.minCost.toFixed(2);
    document.getElementById('bBudget').textContent  = '$' + budget.toFixed(2);
    document.getElementById('bCharge').textContent  = '+$' + charge.toFixed(2);
    document.getElementById('bTotal').textContent   = '$' + total.toFixed(2);
}

// ── Proof rows ────────────────────────────────────────────────────────
function proofRowHtml(p) {
    const canDel = proofs.length > 1;
    return `<div class="proof-block" id="proof_${p.id}">
        <div class="proof-row">
            <select onchange="updateProofType(${p.id}, this.value)">
                <option value="text"${p.type === 'text'   ? ' selected' : ''}>Text</option>
                <option value="image"${p.type === 'image' ? ' selected' : ''}>Image</option>
            </select>
            <input type="text"
                   placeholder="${p.type === 'text' ? 'Describe what text proof is needed' : 'Image proof label e.g. Certificate photo'}"
                   value="${escHtml(p.label)}"
                   oninput="updateProofLabel(${p.id}, this.value)">
            <button type="button" class="del-btn" onclick="removeProof(${p.id})"
                    ${canDel ? '' : 'disabled'} title="Remove">✕</button>
        </div>
    </div>`;
}

function addProof() {
    saveForm();
    proofs.push({ id: proofCounter++, type: 'text', label: '' });
    renderStep3();
}
function removeProof(id) {
    if (proofs.length <= 1) return;
    saveForm();
    proofs = proofs.filter(p => p.id !== id);
    renderStep3();
}
function updateProofType(id, val) {
    saveForm();
    proofs.find(p => p.id === id).type = val;
    renderStep3();
}
function updateProofLabel(id, val) {
    const p = proofs.find(p => p.id === id);
    if (p) p.label = val;
}

function toggleSecret() {
    form.secretOn = document.getElementById('secretCk').checked;
    document.getElementById('secretBox').style.display = form.secretOn ? 'block' : 'none';
}

function handleThumb(input) {
    if (!input.files?.[0]) return;

    // Hidden form এর file input এ copy করো
    const dt = new DataTransfer();
    dt.items.add(input.files[0]);
    document.getElementById('hThumbnail').files = dt.files;

    // Preview দেখাও
    const r = new FileReader();
    r.onload = e => {
        thumbDataUrl = e.target.result;
        document.getElementById('thumbPreview').src = thumbDataUrl;
        document.getElementById('thumbPreview').style.display = 'block';
        document.getElementById('thumbText').style.display = 'none';
    };
    r.readAsDataURL(input.files[0]);
}

function saveForm() {
    form.title      = document.getElementById('fTitle')?.value      ?? form.title;
    form.description= document.getElementById('fDesc')?.value       ?? form.description;
    form.workerNeed = document.getElementById('fWorkerNeed')?.value ?? form.workerNeed;
    form.secretCode = document.getElementById('fSecret')?.value     ?? form.secretCode;
    form.secretOn   = document.getElementById('secretCk')?.checked  ?? form.secretOn;
    proofs.forEach(p => {
        const inp = document.querySelector(`#proof_${p.id} input[type=text]`);
        if (inp) p.label = inp.value;
    });
}

// ── Submit — hidden form এ data ভরে submit ────────────────────────────
function submitJob() {
    saveForm();

    // Client-side validation
    const errs = [];
    if (!form.title.trim())                       errs.push('Job title is required.');
    if (!form.description.trim())                 errs.push('Job description is required.');
    if (!form.workerNeed || form.workerNeed < 1)  errs.push('Number of workers is required.');
    if (form.secretOn && !form.secretCode.trim()) errs.push('Secret code is required.');
    if (proofs.some(p => !p.label.trim()))        errs.push('All proof fields must have a label.');

    if (errs.length) {
        // Error দেখাও
        let errBox = document.getElementById('clientErrors');
        if (!errBox) {
            errBox = document.createElement('div');
            errBox.id = 'clientErrors';
            document.getElementById('wizardContent').prepend(errBox);
        }
        errBox.innerHTML = `<div class="alert-danger" style="margin-bottom:14px">
            ${errs.map(e => `<div>• ${e}</div>`).join('')}
        </div>`;
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
    }

    // Hidden form এ সব data ভরো
    document.getElementById('hContinentId').value   = state.continentId;
    document.getElementById('hCountryId').value     = state.countryId;
    document.getElementById('hCategoryId').value    = state.categoryId;
    document.getElementById('hSubcategoryId').value = state.subId;
    document.getElementById('hTitle').value         = form.title;
    document.getElementById('hDescription').value   = form.description;
    document.getElementById('hWorkerNeed').value    = form.workerNeed;
    document.getElementById('hHasSecretCode').value = form.secretOn ? '1' : '0';
    document.getElementById('hSecretCode').value    = form.secretOn ? form.secretCode : '';

    // Proofs — dynamic hidden inputs যোগ করো
    const proofsContainer = document.getElementById('hProofsContainer');
    proofsContainer.innerHTML = '';
    proofs.forEach((p, i) => {
        const typeInput  = document.createElement('input');
        typeInput.type   = 'hidden';
        typeInput.name   = `proofs[${i}][type]`;
        typeInput.value  = p.type;

        const labelInput = document.createElement('input');
        labelInput.type  = 'hidden';
        labelInput.name  = `proofs[${i}][label]`;
        labelInput.value = p.label;

        proofsContainer.appendChild(typeInput);
        proofsContainer.appendChild(labelInput);
    });

    // Form submit!
    document.getElementById('jobForm').submit();
}

// ── Navigation ────────────────────────────────────────────────────────
function goNext() { state.step++; render(); }
function goBack() { state.step--; render(); }

function render() {
    renderStepBar();
    if      (state.step === 1) renderStep1();
    else if (state.step === 2) renderStep2();
    else if (state.step === 3) renderStep3();
}

// ── Boot ──────────────────────────────────────────────────────────────
render();
</script>
@endpush