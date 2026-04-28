@extends('user.layouts.app')
@section('content')
<br><br>
<div class="container">
	<div class="row">
		<!-- title -->
		<div class="col-12 col-xsm-12 col-sm-12 col-md-12 col-lg-12 col-xxl-12">
			<h6 class="text-dark fw-bold">Finished Tasks</h6>
			<hr>
		</div>
		<!-- search  -->
       <div class="col-6 col-xsm-6 col-sm-6 col-md-6 col-lg-6 col-xxl-6">
			<h6 class="">Your submitted work will be rated within a maximum of 6 days</h6>
			<span class="fw-bold ">0 Tasks Submitted</span>
      <span class="fw-bold">0 Tasks Pending</span>
      <span class="fw-bold">0 Tasks Paid</span>
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
	<div class="col-12 col-xsm-12 col-sm-12 col-md-12 col-lg-12 col-xxl-12 mt-5">
   <table class="table table-striped table-borderless">
   <thead class="">
    <tr class="">
      <th scope="col">Status</th>
      <th scope="col">Job Name</th>
      <th scope="col">Progress</th>
      <th scope="col">Not Rated</th>
      <th scope="col">Cost</th>
    </tr>
  </thead>
  <tbody>
    <tr class="">
      <th scope="row">Mark</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Jacob</td>
      <td>Jacob</td>
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