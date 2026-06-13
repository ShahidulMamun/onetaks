@extends('user.layouts.app')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">

        <div class="col-12 px-0 px-md-3">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <h5 class="text-success fw-bold mb-0" style="margin:auto">
                    <i class="fa fa-crown text-warning me-1"></i> Top 20 Buyer
                </h5>
            </div>

            {{-- Desktop Table (md and above) --}}
            <div class="d-none d-md-block">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Buyer Name <i class="fa fa-crown text-warning ms-1"></i></th>
                            <th scope="col">Posted Jobs</th>
                            <th scope="col">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topbuyers as $index => $buyer)
                        <tr>
                            <td class="text-muted small">{{ $index + 1 }}</td>
                            <td class="fw-semibold">
                                @if($index === 0)
                                    <i class="fa fa-crown text-warning me-1"></i>
                                @endif
                                {{ $buyer->name }}
                            </td>
                            <td><span class="badge bg-success fs-6 px-3">{{ $buyer->total_job_post }}</span></td>
                            <td class="text-muted small">{{ $buyer->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards (below md) --}}
            <div class="d-md-none">
                @foreach($topbuyers as $index => $buyer)
                <div class="card mb-3 border-0 shadow-sm {{ $index === 0 ? 'border-start border-warning border-3' : '' }}">
                    <div class="card-body py-3 px-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                               {{ $index + 1 }}
                                <div>
                                    <div class="fw-semibold">
                                       
                                            <i class="fa fa-crown text-warning me-1"></i>
                                   
                                       <span style="font-size:13px"> {{ $buyer->name }}</span>
                                    </div>
                                    <div class="text-muted small mt-1">
                                        <i class="fa fa-calendar-alt me-1 text-success"></i> Joined {{ $buyer->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success fs-6 px-3 " style="font-size:13px">{{ $buyer->total_job_post }}</span>
                                <div class="text-muted" style="font-size:11px;">Posted Jobs</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
@endsection