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
				<form class="row">
		<div class="col-12">
    <label for="inputAddress" class="form-label">Service Title</label>
    <input type="text" class="form-control" placeholder="Service Title">
  </div>			
  <div class="col-md-4">
    <label for="inputEmail4" class="form-label">Service Price</label>
    <input type="text" class="form-control" placeholder="Service Price">
  </div>
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Category</label>
   <select class="form-select" aria-label="Default select example">
  <option selected>Select Category</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
  </select>
  </div>

  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Subcategory</label>
   <select class="form-select" aria-label="Default select example">
  <option selected>Select Subcategory</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
  </select>
  </div>

  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Delivery By</label>
   <select class="form-select" aria-label="Default select example">
  <option selected>Select</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
  </select>
  </div>

  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Delivery Date</label>
   <select class="form-select" aria-label="Default select example">
  <option selected>Select</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
  </select>
  </div>

  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Country</label>
   <select class="form-select" aria-label="Default select example">
  <option selected>Select Country</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
  </select>
  </div>
  
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>

   <div class="col-12">
    <label for="inputAddress2" class="form-label">image</label>
   <input type="file" class="form-control" placeholder="Service Title">
  </div>

  <div class="col-12 mt-3">
    <button type="submit" class="btn btn-post ms-1 btn-lg">Submite</button>
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