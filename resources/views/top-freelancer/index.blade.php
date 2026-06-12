@extends('user.layouts.app')
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-0">
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
    <h5 class="text-success fw-bold mt-2">Top 20 Freelancers</h5>
  </div>
</div>

<div class="col-12 mt-3 px-0">
    <table class="table table-striped table-responsive">
  <thead class="table-light">
    <tr class="">
      <th scope="col">User</th>
      <th scope="col">Earn</th>
      <th scope="col">Joined</th>
     
    </tr>
  </thead>
  <tbody>
    @foreach($topfreelancers as $freelancer)
    <tr>
      <td>{{$freelancer->name}}</td>
      <td><strong class="text-success">${{$freelancer->total_earning}}</strong></td>
      <td>{{$freelancer->created_at->format('d M y')}}</td>


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