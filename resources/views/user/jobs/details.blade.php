@extends('user.layouts.app')
@section('content')
<div class="container mt-5">
	<div class="row">
		<!-- Back button -->
		<div class="col-12 col-xsm-12 col-md-12 col-lg-12 col-xl-12 col-xx-12">
		  <a href="{{ route('user.find.jobs')}}" class="text-decoration-none btn btn-danger btn-sm" role="button">
				<i class="fa fa-arrow-circle-left text-white" aria-hidden="true"></i>
				<samp class="text-white fw-bold">Back</samp></a>
		</div>
		<!-- job titles -->
		<div class="col-9 col-xsm-9 col-md-9 col-lg-9 col-xl-9 colxx-9 mt-3">
			<h4 class="text-dark fw-bold">{{$job->title}}</h4>
			<span class="text-muted h6">{{$job->continent->name}}- {{$job->category->name}}</span>
		</div>
		<!-- job price -->
		<div class="col-3 col-xsm-3 col-md-3 col-lg-3 col-xl-3 col-xx-3 text-end">
		  <a href="" class="text-decoration-none btn btn-sm btn-post pb-0" role="button" disabled>
				<samp class="text-white fw-bold h5">${{$job->worker_earn}}</samp></a>
		</div>
		<!-- job toster report,hide -->
		<div class="col-12 col-xsm-7 col-md-8 col-lg-8 col-xl-6 colxx-6 mt-3">
			<div class="card" style="background-color: #e7faef">
          <div class="card-body d-flex justify-content-between">
          	<span class="h5 text-dark fw-bold">Read the job rules.</span>
          	<button class="btn btn-success btn-sm" id="readRulesBtn"><i class="fa fa-book" aria-hidden="true"></i> Read Rules</button>
          </div>
        </div>
        <!-- show toster modal -->
          <div id="rulesBox" class="mt-3 p-3 rounded" style="display:none; border: 1px solid #c8e6c9;">
    <h6 class="fw-semibold mb-2" style="color: #1b5e20;">Job Rules</h6>
    <ul class="mb-0" style="font-size: 14px; color: var(--color-text-primary);">
      <li>Candidates must apply before the deadline.</li>
      <li>Provide accurate information in your application.</li>
      <li>No plagiarism in submitted work samples.</li>
      <li>Be professional during interview processes.</li>
    </ul>
  </div>
		</div>
		<!-- reort,hide button -->
		<div class="col-12 col-xsm-5 col-md-4 col-lg-4 col-xl-6 col-xx-6 mt-2">
			<br>
		<a href="#" class="text-white fw-medium text-decoration-none btn btn-danger btn-sm pb-2" data-bs-toggle="modal" data-bs-target="#reportModal"><i class="fa fa-flag-checkered" aria-hidden="true"></i> Report Job</a>
      <a href="#" class="text-white fw-medium text-decoration-none btn btn-success btn-sm pb-2" data-bs-toggle="modal" data-bs-target="#hideModal"><i class="fa fa-eye-slash" aria-hidden="true"></i> Hide Job</a>
		</div>
	<!-- all modal repoting and hide job -->
	<!-- repoting modal -->
	<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark fw-bold" id="reportModalLabel">Job Reporting</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label fw-medium">What is wrong with this job?</label>
          <textarea class="form-control" rows="3" placeholder="Describe the issue..."></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success btn-sm" id="submitReportBtn">Submit Report</button>
      </div>
    </div>
  </div>
</div>
<!-- hide job modal -->
<div class="modal fade" id="hideModal" tabindex="-1" aria-labelledby="hideModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content text-center">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title w-100 fw-bold text-dark" id="hideModalLabel">Hide Job</h5>
        <button type="button" class="btn-close position-absolute end-0 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-2">
        <p class="text-muted" style="font-size: 14px;">Do you want to permanently hide the job?</p>
      </div>
      <div class="modal-footer border-0 justify-content-center gap-2 pt-0">
        <button type="button" class="btn btn-success px-4 btn-sm" id="yesHideBtn">Yes</button>
        <button type="button" class="btn btn-danger px-4 btn-sm" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- hide job notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastMsg">Action completed.</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
<!-- end hide job notification -->
  </div>
</div>
<!-- second div -->
 <div class="container mt-5">
	 <div class="row">
		 <div class="col-lg-12">
		           <div class="row">
		            <div class="col-lg-12 bg-light">
		             <div class="row">
		             	<!-- job 1-->
		              <div class="col-6 mt-3 pb-4">
		              	<h5 class="text-dark fw-medium">Excluded Countries</h5>
		              	-
		              	<h5 class="text-dark fw-medium">Employer</h5>
		              	<a href="" class="text-decoration-none text-dark">{{$job->user->name}} <i class="fa fa-external-link fw-medium" aria-hidden="true"></i></a>
		              	<h5 class="text-dark fw-medium mt-3">Job ID</h5>
		              	<h6>{{$job->code}}</h6>
		              </div>
		              <!-- job 2  -->
		               <div class="col-6 mt-3 pb-4">
		              	<h5 class="text-dark fw-medium">Done</h5>
		              	<p class="text-muted">{{$job->worker_done}} of {{$job->worker_need}}</p>
	
		              	<h5 class="text-dark fw-medium mt-3">Category</h5>
		              	<h6>{{$job->category->name}} -> {{$job->subcategory->name}}</h6>
		              </div>
		             </div>
		            </div>
		       </div>
		 </div>
	 </div>
 </div>

  <div class="container mt-5">
	 <div class="row">
		 <div class="col-lg-12">
		           <div class="row">
		            <div class="col-lg-12 bg-light">
		             <div class="row">
		              <div class="col-12">
		              	<i class="fa fa-question-circle text-danger" aria-hidden="true"></i> What is expected from workers?
		              </div>
		             </div>
		            </div>
		            <div class="col-lg-12">
		              	<p class="p-4">
		              		{{$job->description}}
		              	</p>
		              </div>
		       </div>
		 </div>
	 </div>
 </div>

  <div class="container mt-5">
    
    <!-- row for secret code -->
    @if($job->has_secret_code==1)
      
       <div class="row">

         <div class="col-12 col-md-6 col-sm-6">
          <div class="form-group">
            <label class="secret-code-name"><i class="fa fa-question-circle text-danger" aria-hidden="true"></i> Type Secret Code</label>

              <input type="text" name="secret_code" class="form-control mt-2" required="">
          </div>
        
        </div>

       </div>
  
    
   @endif

   <!-- row for secretcode -->

	 <div class="row mt-3">



@foreach($job->proofs as $proof)
 
  <div class="form-group">
    <label>{{ $proof['label'] }}</label>
    <input type="{{ $proof['type'] }}" name="screenshot">
  </div>
  
@endforeach
		 <div class="col-lg-12">
		           <div class="row">
		            <div class="col-lg-12 bg-light">
		             <div class="row">
		               <div class="col-12">
		              	<i class="fa fa-question-circle text-danger" aria-hidden="true"></i> Submit your proofs below
		              </div>
		             </div>
		            </div>
		            <div class="col-lg-12 p-5">
		              	<!-- form -->
		              	<form>
		              		<!-- Example Screenshot images-->
		              		<div class="text-center">
						  <h6 class="text-dark fw-bold">Example Screenshot</h6>

						  <!-- Image -->
						  <img src="{{asset('images/jobs.png')}}"
						       class="img-thumbnail rounded mx-auto d-block w-25 h-25"
						       style="cursor:pointer;"
						       data-bs-toggle="modal"
						       data-bs-target="#imageModal"
						       alt="not found">
						</div>
             <!-- button -->
             <div class="d-flex justify-content-end gap-2 mt-5">
               <button type="button" class="btn btn-danger btn-sm mt-5">
                Cancel
               </button>
               <button type="submit" class="btn btn-success btn-sm mt-5">
              Submit
               </button>
               </div>
             </form>
		              </div>
		       </div>
		 </div>
	 </div>
	 <!-- modal images -->
	 <!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Screenshot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <img src="{{asset('images/jobs.png')}}" class="rounded mx-auto d-block" alt="not found">
      </div>

    </div>
  </div>
</div>
 </div>
	 
<!-- <footer -->
<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
<!-- job report,hide -->
<script>
  const readRulesBtn = document.getElementById('readRulesBtn');
  const rulesBox = document.getElementById('rulesBox');
  let rulesVisible = false;

  readRulesBtn.addEventListener('click', function() {
    rulesVisible = !rulesVisible;
    rulesBox.style.display = rulesVisible ? 'block' : 'none';
    readRulesBtn.textContent = rulesVisible ? 'Hide Rules' : 'Read Rules';
  });

  function showToast(msg) {
    document.getElementById('toastMsg').textContent = msg;
    const toastEl = document.getElementById('successToast');
    const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
    toast.show();
  }

  document.getElementById('submitReportBtn').addEventListener('click', function() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('reportModal'));
    modal.hide();
    setTimeout(() => showToast('Report submitted successfully!'), 400);
  });

  document.getElementById('yesHideBtn').addEventListener('click', function() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('hideModal'));
    modal.hide();
    setTimeout(() => {
      const card = document.querySelector('[style*="e8f5e9"]');
      if (card) {
        card.style.opacity = '0.4';
        card.style.pointerEvents = 'none';
        card.insertAdjacentHTML('afterend', '<div class="mt-2 text-muted" style="font-size:13px;">✔ Job hidden from your feed.</div>');
      }
      showToast('Job has been hidden!');
    }, 400);
  });
</script>

@endsection