@extends('user.layouts.app')
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-0">
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
    <h5 class="text-dark fw-bold mt-2">{{$pageTitle}}</h5>
  </div>
</div>
<span class="text-success px-0 mt-2">{{count($notifications)}} Result</span>
<div class="col-12 mt-3 px-0">
    <table class="table table-striped table-responsive">
  <thead class="table-light">
    <tr class="">
      <th scope="col">Notice</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach($notifications as $notification)
    <tr>
      <td>{{$notification->message}}</td>
      <td>
        @if($notification->status=="pending")
        <span class="text-dark"><i class="fa fa-spinner" aria-hidden="true"></i> {{$notification->status}}</span>

        @elseif($notification->status=="read")
        <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> {{$notification->status}}</span>
       
        @endif

      </td>
     
       <td>{{$notification->created_at->format('d M Y, h:i A')}}</td>
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