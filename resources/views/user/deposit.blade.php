@extends('user.layouts.app')
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-0">
  <span class="text-dark fw-bold">Deposit </span>| <span><a class="fw-bold text-decoration-none text-dark" href="{{ route('user.deposit.history')}}" role="button">Transaction History</a></span>
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
  </div>
</div>
<div class="col-12 mt-3 px-0 card border-0 shadow">
  <div class="card-body">
    <h5 class="text-dark">Manual Deposit</h5>
    <!-- Deposit -->
      <div class="row">
        <div class="col-12 col-xsm-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
          <div class="card" data-bs-toggle="modal" data-bs-target="#usdt" style="cursor:pointer;">
            <div class="card-body bg-light">
              <img src="" class="text-center" alt="not found">
              <h5 class="text-center text-dark fw-bold">USDT Trc20</h5>
         <!-- Modal -->
            <div class="modal fade" id="usdt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
          <!-- end Modal -->
            </div>
          </div>
        </div>
        <div class="col-12 col-xsm-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
          <div class="card" data-bs-toggle="modal" data-bs-target="#nagad" style="cursor: pointer;">
            <div class="card-body bg-light">
             <img src="" class="text-center" alt="not found">
              <h5 class="text-center text-dark fw-bold">Nagad Cash Out</h5>
              <!-- Modal -->
            <div class="modal fade" id="nagad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
          <!-- end Modal -->
            </div>
          </div>
        </div>
        <div class="col-12 col-xsm-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
          <div class="card" data-bs-toggle="modal" data-bs-target="#bkash" style="cursor: pointer;">
            <div class="card-body bg-light">
              <img src="" class="text-center" alt="not found">
              <h5 class="text-center text-dark fw-bold">Bkash Cash Out</h5>
               <!-- Modal -->
            <div class="modal fade" id="bkash" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
          <!-- end Modal -->
            </div>
          </div>
        </div>
         <div class="col-12 col-xsm-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
          <div class="card" data-bs-toggle="modal" data-bs-target="#binance" style="cursor: pointer;">
            <div class="card-body bg-light">
              <img src="" class="text-center" alt="not found">
              <h5 class="text-center text-dark fw-bold">Binance</h5>
                <!-- Modal -->
            <div class="modal fade" id="binance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
          <!-- end Modal -->
            </div>
          </div>
        </div>
         <div class="col-12 col-xsm-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
          <div class="card" data-bs-toggle="modal" data-bs-target="#eastern" style="cursor: pointer;">
            <div class="card-body bg-light">
              <img src="" class="text-center" alt="not found">
              <h5 class="text-center text-dark fw-bold">Eastern Bank PLC</h5>
                 <!-- Modal -->
            <div class="modal fade" id="eastern" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
          <!-- end Modal -->
            </div>
          </div>
        </div>
    </div>
  </div>
      </div>
     </div>
 </div>
<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
@endsection