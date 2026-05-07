@extends('user.layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-0">
  <span class="text-dark fw-bold">Withdraw </span>| <span><a class="fw-bold text-decoration-none text-dark" href="{{ route('user.deposit.history')}}" role="button">Withdraw History</a></span>
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
  </div>
</div>
<!-- Withdraw -->
<div class="col-8 col-xsm-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-3 card shadow border-0">
  <div class="card-body">
    <h6 class="text-dark fw-bold">Withdrawal will be confirmed within 96 hours. Minimum withdrawal is $8 and withdrawal fee 20%.</h6>
  <!-- Method Cards -->
  <div class="method-grid mt-4" id="methodGrid">
    <!-- Nagad -->
    <div class="method-card" data-method="nagad" data-label="Nagad" data-icon="" onclick="selectMethod(this)">
      <img class="method-logo" src="{{ asset('images/icons/nagad.webp') }}" alt="Nagad" onerror="this.src=''"/>
      <div class="withdraw-text">Withdraw</div>
      <div class="method-balance">100.00</div>
    </div>

    <!-- Binance -->
    <div class="method-card" data-method="binance" data-label="Binance" data-icon="" onclick="selectMethod(this)">
      <img class="method-logo" src="{{ asset('images/icons/binance.webp') }}" alt="Binance" onerror="this.src=''"/>
      <div class="withdraw-text">Withdraw</div>
      <div class="method-balance">0.000</div>
    </div>

    <!-- Litecoin -->
    <div class="method-card" data-method="litecoin" data-label="Litecoin" data-icon="" onclick="selectMethod(this)">
      <img class="method-logo" src="{{ asset('images/icons/litecoin.webp') }}" alt="Litecoin" onerror="this.src=''"/>
      <div class="withdraw-text">Withdraw</div>
      <div class="method-balance">0.000</div>
    </div>

    <!-- bKash -->
    <div class="method-card" data-method="bkash" data-label="bKash" data-icon="" onclick="selectMethod(this)">
      <img class="method-logo" src="{{ asset('images/icons/bkash.webp') }}" alt="bKash" onerror="this.src=''"/>
      <div class="withdraw-text">Withdraw</div>
      <div class="method-balance">0.000</div>
    </div>
  </div>
  <!-- Dynamic Form -->
  <div id="formContainer" style="display:none;"></div>
  </div>
      </div>
      <!-- Withdraw history -->
      <div class="col-4 col-xsm-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
  <div class="card">
    <div class="card-body">
      <h5 class="text-muted">Earning Balance</h5>
      <samp class="text-muted">Name</samp>
      <h6 class="text-dark fw-bold">Laith Sullivan</h6>
      <samp class="text-muted">Balance</samp>
      <h6 class="text-dark fw-bold">$0.000</h6>
    </div>
  </div>
      </div>
     </div>
 </div>


<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>

<script>
  // Toastr config
  toastr.options = {
    positionClass: 'toast-top-right',
    timeOut: 3000,
    closeButton: true,
    progressBar: true,
  };

  let currentMethod = null;

  // Method-specific input config
  const methodConfig = {
    nagad:    { placeholder: 'Nagad Personal Number',  label: 'Receive Nagad Personal Number',    type: 'tel' },
    binance:  { placeholder: 'Binance Pay ID / Email', label: 'Receive Binance Pay ID or Email',  type: 'text' },
    litecoin: { placeholder: 'Litecoin Wallet Address',label: 'Receive Litecoin Wallet Address',  type: 'text' },
    bkash:    { placeholder: 'bKash Personal Number',  label: 'Receive bKash Personal Number',   type: 'tel' },
  };

  function selectMethod(card) {
    // Toggle active
    document.querySelectorAll('.method-card').forEach(c => c.classList.remove('active'));
    card.classList.add('active');

    const method = card.dataset.method;
    const label  = card.dataset.label;
    const icon   = card.dataset.icon;
    currentMethod = method;

    const cfg = methodConfig[method];
    const container = document.getElementById('formContainer');

    container.innerHTML = `
      <div class="form-section">
        <h6>
          <img src="${icon}" onerror="this.style.display='none'" alt="${label}"/>
          ${cfg.label}
        </h6>
        <div class="mb-3">
          <label class="form-label">${cfg.label}</label>
          <input type="${cfg.type}" class="form-control" id="accountInput" placeholder="${cfg.placeholder}" autocomplete="off"/>
        </div>
        <div class="row g-3 align-items-center mb-3">
          <div class="col-sm-6">
            <label class="form-label">Payment Amount ($)</label>
            <input type="number" class="form-control" id="amountInput" placeholder="Payment amount" min="8" step="0.01" oninput="calcTotal()"/>
          </div>
          <div class="col-sm-6">
            <label class="form-label">Total (after 20% fee)</label>
            <div class="total-box">
              <span>Total</span>
              <span id="totalDisplay">$0.00</span>
            </div>
          </div>
        </div>
        <button class="btn-submit" onclick="submitWithdraw()">
          <i class="fa fa-paper-plane me-2"></i>SUBMIT
        </button>
      </div>
    `;

    container.style.display = 'block';
    toastr.info(`<b>${label}</b> selected as withdrawal method.`);
  }

  function calcTotal() {
    const amt = parseFloat(document.getElementById('amountInput').value) || 0;
    const total = amt - (amt * 0.20);
    document.getElementById('totalDisplay').textContent = '$' + total.toFixed(2);
  }

  function submitWithdraw() {
    const account = document.getElementById('accountInput').value.trim();
    const amount  = parseFloat(document.getElementById('amountInput').value);

    if (!account) {
      toastr.warning('Please enter your account / wallet number.');
      return;
    }
    if (!amount || amount < 8) {
      toastr.error('Minimum withdrawal amount is <b>$8</b>.');
      return;
    }

    const total = (amount - amount * 0.20).toFixed(2);
    toastr.success(`Withdrawal request of <b>$${total}</b> submitted via <b>${currentMethod}</b>! Confirmation within 96 hours.`);

    // Reset
    document.getElementById('accountInput').value = '';
    document.getElementById('amountInput').value  = '';
    document.getElementById('totalDisplay').textContent = '$0.00';
  }
</script>
@endsection