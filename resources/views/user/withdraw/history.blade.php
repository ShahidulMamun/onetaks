@extends('user.layouts.app')
@section('content')
<div class="container mt-4 px-3">
    <div class="row">
        <div class="col-12 px-0">

            {{-- Header --}}
            <h5 class="text-dark fw-bold mb-1">Withdraw History</h5>
            <span class="text-success small">{{ $count }} Result{{ $count != 1 ? 's' : '' }}</span>

            {{-- Desktop Table (hidden on mobile) --}}
            <div class="d-none d-md-block mt-3">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Amount</th>
                            <th>Charge</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Date</th>
                          <!--   <th>Reason</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($withdraws as $withdraw)
                        <tr>
                            <td><strong class="text-success">${{ $withdraw->amount }}</strong></td>
                            <td><strong class="text-danger">${{ $withdraw->charge }}</strong></td>
                            <td>{{ $withdraw->account_type }}</td>
                            <td>
                                @if($withdraw->status == 'pending')
                                    <span class="text-secondary"><i class="fa fa-spinner"></i> Pending</span>
                                @elseif($withdraw->status == 'approved')
                                    <span class="text-success"><i class="fa fa-check"></i> Approved</span>
                                @elseif($withdraw->status == 'rejected')
                                    <span class="text-danger"><i class="fa fa-times"></i> Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($withdraw->status == 'pending')
                                    Request sent {{ $withdraw->created_at->format('d M y') }}
                                @elseif($withdraw->status == 'approved')
                                    Approved {{ $withdraw->updated_at->format('d M y') }}
                                @elseif($withdraw->status == 'rejected')
                                    Rejected {{ $withdraw->updated_at->format('d M y') }}
                                @endif
                            </td>
                         <!--    <td>{{ $withdraw->reason ?? '—' }}</td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards (visible on mobile only) --}}
            <div class="d-md-none mt-3">
                @forelse($withdraws as $withdraw)
                <div class="card mb-3 border shadow-sm">
                    <div class="card-body p-3">

                        {{-- Top row: amount + status badge --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="text-success fw-bold fs-6">${{ $withdraw->amount }} = {{$withdraw->amount*$settings->dolar_rate}}TK</span>
                              <!--   <span class="text-muted small ms-1">Amount</span> -->
                            </div>
                            @if($withdraw->status == 'pending')
                                <span class="badge bg-secondary">
                                    <i class="fa fa-spinner me-1"></i> Pending
                                </span>
                            @elseif($withdraw->status == 'approved')
                                <span class="badge bg-success">
                                    <i class="fa fa-check me-1"></i> Approved
                                </span>
                            @elseif($withdraw->status == 'rejected')
                                <span class="badge bg-danger">
                                    <i class="fa fa-times me-1"></i> Rejected
                                </span>
                            @endif
                        </div>

                        <hr class="my-2">

                        {{-- Detail rows --}}
                        <div class="row g-1 small">
                            <div class="col-6 text-muted">Charge</div>
                            <div class="col-6 text-end text-danger fw-semibold">${{ $withdraw->charge }}</div>

                            <div class="col-6 text-muted">Method</div>
                            <div class="col-6 text-end">{{ $withdraw->account_type }}</div>

                            <div class="col-6 text-muted">Date</div>
                            <div class="col-6 text-end">
                                @if($withdraw->status == 'pending')
                                    {{ $withdraw->created_at->format('d M y') }}
                                @elseif($withdraw->status == 'approved')
                                    {{ $withdraw->updated_at->format('d M y') }}
                                @elseif($withdraw->status == 'rejected')
                                    {{ $withdraw->updated_at->format('d M y') }}
                                @endif
                            </div>
<!-- 
                            @if($withdraw->reason)
                            <div class="col-6 text-muted">Reason</div>
                            <div class="col-6 text-end">{{ $withdraw->reason }}</div>
                            @endif -->
                        </div>

                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="fa fa-inbox fa-2x mb-2 d-block"></i>
                    No withdrawal history yet.
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
@endsection