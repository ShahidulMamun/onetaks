@extends('user.layouts.app')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>

<div class="container mt-5">

    <div class="row">

        <!-- LEFT SIDE -->
        <div class="col-12 col-md-8">

            <div class="filter-bar px-0 mb-3">
                <span class="text-dark fw-bold">Withdraw</span>
                |
                <span>
                    <a class="fw-bold text-decoration-none text-dark"
                       href="{{ route('user.deposit.history') }}">
                        Withdraw History
                    </a>
                </span>
            </div>

            <div class="card shadow border-0">

                <div class="card-body">

                    <h6 class="text-dark"
                        style="font-size:13px;font-weight:500">

                        Withdrawal will be confirmed within 72 hours.
                        Minimum withdrawal is
                        ${{ $setting->min_withdraw }}
                        and withdrawal fee
                        {{ $setting->withdraw_charge }}%.

                    </h6>

                    <!-- SESSION MESSAGE -->

                   <!--  @if(session('success'))

                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>

                    @endif

                    @if(session('error'))

                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>

                    @endif -->

                    <!-- VALIDATION ERRORS -->
<!-- 
                    @if ($errors->any())

                        <div class="alert alert-danger mt-3">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif -->

                    <!-- METHOD GRID -->

                    <div class="method-grid mt-4" id="methodGrid">

                        @foreach($methods as $method)

                            <div class="method-card"
                                 data-method="{{ $method->name }}"
                                 data-name="{{ $method->name }}"
                                 data-type="{{ $method->type ?? 'text' }}"
                                 data-placeholder="{{ $method->number }}"
                                 onclick="selectMethod(this)">

                                <img class="method-logo"
                                     src="{{ asset('storage/'.$method->logo) }}"
                                     alt="{{ $method->name }}"
                                     onerror="this.src=''"/>

                                <div class="withdraw-text">
                                    Withdraw
                                </div>

                            </div>

                        @endforeach

                    </div>

                    <!-- DYNAMIC FORM -->

                    <div id="formContainer" style="display:none;"></div>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->

        <div class="col-12 col-md-4 mt-3 mt-md-0">

            <div class="card shadow border-0">

                <div class="card-body">

                    <h5 class="text-muted">
                        Earning Balance
                    </h5>

                    <small class="text-muted">
                        Name
                    </small>

                    <h6 class="text-dark fw-bold">
                        {{ auth()->user()->name ?? 'User' }}
                    </h6>

                    <small class="text-muted">
                        Balance
                    </small>

                    <h6 class="text-dark fw-bold">
                        ${{ number_format(auth()->user()->current_earning ?? 0, 2) }}
                    </h6>

                    <small class="text-muted d-block mt-3">
                        Dollar Rate
                    </small>

                    <h6 class="text-success fw-bold">
                        1$ = ৳{{ number_format($setting->dolar_rate, 2) }}
                    </h6>

                </div>

            </div>

        </div>

    </div>

</div>

<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>

<style>

    .method-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(150px,1fr));
        gap:15px;
    }

    .method-card{
        border:1px solid #e5e5e5;
        border-radius:10px;
        padding:15px;
        cursor:pointer;
        transition:.3s;
        text-align:center;
        background:#fff;
    }

    .method-card:hover{
        transform:translateY(-3px);
        box-shadow:0 5px 20px rgba(0,0,0,.08);
    }

    .method-card.active{
        border:2px solid #0d6efd;
    }

    .method-logo{
        width:60px;
        height:60px;
        object-fit:contain;
        margin-bottom:10px;
    }

    .withdraw-text{
        font-weight:600;
        color:#333;
    }

    .form-section{
        margin-top:30px;
        border-top:1px solid #eee;
        padding-top:20px;
    }

    .total-box{
        border:1px solid #ddd;
        border-radius:8px;
        padding:10px 15px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        background:#f8f9fa;
    }

    .btn-submit{
        width:100%;
        border:none;
        padding:12px;
        border-radius:8px;
        background:#0d6efd;
        color:#fff;
        font-weight:600;
        transition:.3s;
    }

    .btn-submit:hover{
        background:#0b5ed7;
    }

    .receive-box{
        border:1px dashed #28a745;
        border-radius:10px;
        padding:12px;
        background:#f8fff9;
        margin-top:15px;
    }

</style>

<script>

    toastr.options = {
        positionClass: 'toast-top-right',
        timeOut: 3000,
        closeButton: true,
        progressBar: true,
    };

    let currentMethod = null;

    const withdrawCharge = {{ $setting->withdraw_charge }};
    const dollarRate = {{ $setting->dolar_rate }};

    function selectMethod(card)
    {
        document.querySelectorAll('.method-card').forEach(c => {
            c.classList.remove('active');
        });

        card.classList.add('active');

        const method      = card.dataset.method;
        const name        = card.dataset.name;
        const type        = card.dataset.type;
        const placeholder = card.dataset.placeholder;

        currentMethod = method;

        const container = document.getElementById('formContainer');

        container.innerHTML = `

        <div class="form-section">

            <form action="{{ route('user.withdraw.create') }}"
                  method="POST"
                  onsubmit="return submitWithdraw()">

                @csrf

                <input type="hidden"
                       name="method"
                       value="${method}">

                <div class="mb-3">

                    <label class="form-label">
                        Your ${name} Personal Number
                    </label>

                    <input type="${type}"
                           class="form-control"
                           id="accountInput"
                           placeholder="${placeholder}"
                           autocomplete="off"
                           name="number">

                </div>

                <div class="row g-3 align-items-center mb-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Withdraw Amount ($)
                        </label>

                        <input type="number"
                               class="form-control"
                               id="amountInput"
                               placeholder="Withdraw amount"
                               min="{{ $setting->min_withdraw }}"
                               step="0.01"
                               oninput="calcTotal()"
                               name="withdraw_amount">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Withdraw with charge ($)
                        </label>

                        <div class="total-box">

                            <span>Total</span>

                            <span id="totalDisplay">
                                $0.00
                            </span>

                        </div>

                    </div>

                </div>

                <div class="receive-box">

                    <div class="d-flex justify-content-between">

                        <span>
                            Charge ({{ $setting->withdraw_charge }}%)
                        </span>

                        <span id="chargeDisplay">
                            $0.00
                        </span>

                    </div>

                    <div class="d-flex justify-content-between mt-2">

                        <span>
                            You Will Receive (BDT)
                        </span>

                        <span id="tkDisplay"
                              class="fw-bold text-success">
                            ৳0.00
                        </span>

                    </div>

                </div>

                <button type="submit"
                        class="btn-submit mt-3">

                    <i class="fa fa-paper-plane me-2"></i>

                    SUBMIT

                </button>

            </form>

        </div>
        `;

        container.style.display = 'block';

        toastr.info(`${name} selected as withdrawal method.`);
    }

    function calcTotal()
    {
        const amt = parseFloat(
            document.getElementById('amountInput').value
        ) || 0;

        const charge = (amt * withdrawCharge) / 100;

        const receiveDollar = amt + charge;

        const receiveTk = amt * dollarRate;

        document.getElementById('chargeDisplay').textContent =
            '$' + charge.toFixed(2);

        document.getElementById('totalDisplay').textContent =
            '$' + receiveDollar.toFixed(2);

        document.getElementById('tkDisplay').textContent =
            '৳' + receiveTk.toFixed(2);
    }

    function submitWithdraw()
    {
        const account = document.getElementById('accountInput').value.trim();

        const amount = parseFloat(
            document.getElementById('amountInput').value
        );

        if (!account)
        {
            toastr.warning(
                'Please enter your account / wallet number.'
            );

            return false;
        }

        if (!amount ||
            amount < {{ $setting->min_withdraw }})
        {
            toastr.error(
                'Minimum withdrawal amount is ${{ $setting->min_withdraw }}.'
            );

            return false;
        }

        return true;
    }

</script>

@endsection