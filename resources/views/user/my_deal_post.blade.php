@extends('user.layouts.app')
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-0">
  <a class="btn btn-post fw-bold" href="#" role="button">Post New Deal</a>
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
    <h5 class="text-dark fw-bold mt-2">Deal Manage</h5>
  </div>
</div>
<span class="text-dark px-0 mt-2">0 Result</span>
<div class="col-12 mt-3 px-0">
    <table class="table table-striped table-borderless">
  <thead class="table-light">
    <tr class="">
      <th scope="col">Status</th>
      <th scope="col">Job Name</th>
      <th scope="col">Progress</th>
      <th scope="col">Not Rated</th>
      <th scope="col">Cost</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
         </div>
     </div>
 </div>
<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
@endsection