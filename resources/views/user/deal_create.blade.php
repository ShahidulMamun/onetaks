@extends('user.layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<!-- title -->
		<div class="col-7 col-xsm-7 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3 p-0">
			<h6 class="text-dark fw-bold"><i class="fa fa-pencil-square-o fw-bold" aria-hidden="true" style="color: #8A80A3;"></i> Post New Deal</h6>
		</div>
		<!-- butto -->
<div class="col-5 col-xsm-5 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 text-end mt-3 p-0">
			<a class="btn btn-post" href="#" role="button">All deals</a>
		</div>
	</div>
	<!-- post deal -->
	<div class="col-12 col-xsm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
		<div class="card">
			<div class="card-body">
				<!-- post deal -->
		<form class="row" method="post" action="{{route('user.store.babber.ads')}}" enctype="multipart/form-data">
      @csrf
		<div class="col-12">
    <label for="inputAddress" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" placeholder="Title">
  </div>			
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Select Duration</label>
   <select class="form-select" aria-label="" name="days">
  @php 
   $packages = App\Models\BannerAdsPrice::orderBy('days','asc')->get();
  @endphp
  <option selected>Select Category</option>
  @foreach($packages as $package)
  <option value="{{$package->days}}">{{$package->days}}Days --> Price  ${{$package->price}}</option>
  @endforeach
  
  </select>
  </div>
  
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Link</label>
   <input type="text" class="form-control" name="link" placeholder="www.facebook.com">
  </div>

   <div class="col-12">
    <label for="inputAddress2" class="form-label">image</label>
   <input type="file" class="form-control" name="thumbnail" >
  </div>

  <div class="col-12 mt-3">
    <button type="submit" class="btn btn-post ms-1 btn-lg">Submit</button>
  </div>
</form>
<!-- end post deal -->
		</div>
		</div>
	</div>
</div>
<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
@endsection