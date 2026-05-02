@extends('user.layouts.app')
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-0">
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
    <h5 class="text-dark fw-bold mt-2">Deposit History</h5>
  </div>
</div>
<span class="text-success px-0 mt-2">{{$count}} Result</span>
<div class="col-12 mt-3 px-0">
    <table class="table table-striped table-responsive">
  <thead class="table-light">
    <tr class="">
      <th scope="col">Method</th>
      <th scope="col">TrnxID</th>
      <th scope="col">Amount</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
      <th scope="col">Reason</th>
    </tr>
  </thead>
  <tbody>
    @foreach($deposits as $deposit)
    <tr>
      <td>{{$deposit->method->name}}</td>
      <td>{{$deposit->transaction_id}}</td>
      <td><strong class="text-success">${{$deposit->amount}}</strong></td>
     
      <td>
        @if($deposit->status=="pending")
        <span class="text-dark"><i class="fa fa-spinner" aria-hidden="true"></i> {{$deposit->status}}</span>

        @elseif($deposit->status=="approved")
        <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> {{$deposit->status}}</span>
         
        @elseif($deposit->status=="rejected")
        <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> {{$deposit->status}}</span>
        @endif



      </td>
      <td>

         @if($deposit->status=="pending")
          Request Sent {{$deposit->created_at->diffForHumans()}}

         @elseif($deposit->status=="approved")

         Approved {{ $deposit->approved_at->diffForHumans() }} 

         @elseif($deposit->status=="rejected")

          Rejected {{$deposit->updated_at->diffForHumans()}}
         @endif


        </td>
        <td>{{$deposit->reason}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
         </div>
     </div>
 </div>
<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
@endsection