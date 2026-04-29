@extends('user.layouts.app')
@section('content')
<br><br><br>
<div class="container">
	<div class="row">
		<!-- title -->
		<div class="col-12 col-xsm-12 col-sm-12 col-md-12 col-lg-12 col-xxl-12">
			<h6 class="text-dark">My Jobs</h6>
			<hr>
		</div>
		<!-- search  -->
       <div class="col-6 col-xsm-6 col-sm-6 col-md-6 col-lg-6 col-xxl-6">
			<h6 class="text-muted">Submitted works must be rated within six days</h6>
			<span class="text-muted">Result</span>
		</div>
		<!-- search  bar-->
		 <div class="col-6 col-xsm-6 col-sm-6 col-md-6 col-lg-6 col-xxl-6">
	 <div class="d-flex align-items-center gap-2 flex-wrap">
      <div style="position:relative;">
        <input type="text" class="filter-input" placeholder="Search Job Title" style="width:180px;" oninput="filterTable(this.value)">
      </div>

      <div class="sort-wrapper">
        <select class="filter-sort" style="width:140px;">
          <option>Most Recent</option>
          <option>Oldest First</option>
          <option>Highest Pay</option>
          <option>Lowest Pay</option>
        </select>
      </div>
    </div>
	</div>
	<!-- table -->
<div class="col-12 mt-5">
    <table class="table table-striped table-borderless">
  <thead class="table-light">
    <tr class="">
      <th scope="col">Title</th>
      <th scope="col">Payment</th>
      <th scope="col">Progress</th>
      <th scope="col">Employer</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     
      <td> Watch Youtube Video + Like</td>
      <td class="fw-bold" style="color: #1abc9c;">0.0200</td>
      <td class="fw-bold"><span class="badge badge badge-light text-muted shadow">500/200</span></td>
      <td class="fw-bold"><button class="btn btn-sm text-white" style="background-color:#1abc9c;">95%</button></td>
       <td class="fw-bold"><button class="btn btn-sm text-white" style="background-color:#6658dd;">Done</button></td>
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