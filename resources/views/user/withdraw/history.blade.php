@extends('user.layouts.app')
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-0">
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
    <h5 class="text-dark fw-bold mt-2">Withdraw History</h5>
  </div>
</div>
<span class="text-success px-0 mt-2">{{$count}} Result</span>
<div class="col-12 mt-3 px-0">
    <table class="table table-striped table-responsive">
  <thead class="table-light">
    <tr class="">
      <th scope="col">Amount</th>
      <th scope="col">Charge</th>
      <th scope="col">Method</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
     
    </tr>
  </thead>
  <tbody>
    @foreach($withdraws as $withdraw)
    <tr>
      <td><strong class="text-success">${{$withdraw->amount}}</strong></td>
      <td><strong class="text-danger">${{$withdraw->charge}}</strong></td>
      <td>{{$withdraw->account_type}}</td>

      <td>
        @if($withdraw->status=="pending")
        <span class="text-dark"><i class="fa fa-spinner" aria-hidden="true"></i> {{$withdraw->status}}</span>

        @elseif($withdraw->status=="approved")
        <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> {{$withdraw->status}}</span>
         
        @elseif($withdraw->status=="rejected")
        <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> {{$withdraw->status}}</span>
        @endif

      </td>
      <td>

         @if($withdraw->status=="pending")
          Request Sent {{$withdraw->created_at->format('d M y')}}

         @elseif($withdraw->status=="approved")

         Approved {{ $withdraw->approved_at->diffForHumans() }} 

         @elseif($withdraw->status=="rejected")

          Rejected {{$withdraw->updated_at->diffForHumans()}}
         @endif


        </td>
        <td>{{$withdraw->reason}}</td>
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