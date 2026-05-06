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
			<h6 class="text-muted"></h6>
			<span class="text-muted text-success">Result {{count($jobs)}}</span>
		</div>
		<!-- search  bar-->
		
	<!-- table -->
<div class="col-12 mt-5">
     <table class="table table-striped table-responsive">
  <thead class="table-light">

    <tr class="">
      <th scope="col">Zone</th>
      <th scope="col">Job Title</th>
      <th scope="col">Earning</th>
      <th scope="col">Worker</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  @foreach($jobs as $job)
   <a href="">
     
   </a> <tr>
       <td>{{$job->continent->name}}</td>
       <td> {{$job->title}}</td>
      <td class="fw-bold" style="color: #1abc9c;">${{$job->worker_earn}}</td>
      <td class="fw-bold">
        <span class="badge badge badge-light text-muted shadow">
          <strong class="text-success">{{$job->worker_remaining}}</strong>/<strong class="text-danger">{{$job->worker_need}}</strong></span>
      </td>
       <td class="fw-bold">{{$job->status}}</td>
      <td class="fw-bold">
        <!-- <a href="{{ route('user.job-details',$job->code)}}" class="btn btn-sm text-white">Details</a> -->
        <a href="{{ route('user.submit-job-proof',[$job->id,$job->code])}}" class="btn btn-sm btn-success text-white">Proof</a>

      <form action="{{ route('user.job.delete', [$job->id,$job->code]) }}" method="POST" onsubmit="return confirm('Are you sure to delete job?')">
          @csrf
          @method('DELETE')
          
          <button type="submit" class="btn btn-danger btn-sm">
              Delete
          </button>
      </form>

        <button type="submit" class="btn btn-info btn-sm">
              Edit
          </button>
      </td>
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