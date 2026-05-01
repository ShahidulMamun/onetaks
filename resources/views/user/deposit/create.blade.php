@extends('user.layouts.app')
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-0">
  <span class="text-dark fw-bold">Deposit </span>| <span><a class="fw-bold text-decoration-none text-dark" href="{{ route('user.deposit.history')}}" role="button">Transaction History</a></span>
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
  </div>
</div>
<div class="col-12 mt-3 px-0 card border-0 shadow">
  <div class="card-body">
    <h5 class="text-dark">Manual Deposit</h5>
    <!-- Deposit -->
      <div class="row">
  <div class="col-12 col-xsm-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
       @foreach($methods as $method)
        <button 
        type="button" style="border: 1px solid #0d6850;margin: 5px" 
        class="btn editBtn btn-sm p-2"
        data-bs-toggle="modal" 
        data-bs-target="#editModal"
        data-id="{{ $method->id }}"
        data-name="{{ $method->name }}"
        data-type="{{ $method->type }}"
        data-number="{{ $method->number }}"
        data-logo="{{asset('storage/'.$method->logo)}}"
      >
        <img src="{{asset('storage/'.$method->logo)}}" width="150px" style="height: 50px;">
      </button>
      @endforeach
         
  </div>
  
    </div>
  </div>
      </div>
     </div>
     <!-- deposit modal open -->
     <div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Deposit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="post" action="{{route('user.deposit-store')}}"> 
          @csrf
        <div class="row">
           <img id="logoPreview" src="" width="100%" style="height: 150px">
         <input type="hidden" name="" id="name" >

         <input type="hidden" name="payment_method_id" id="method" class="form-control mb-2">
        </div>

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label id="name_type"></label>
                 <input type="text" id="number" class="form-control mb-2">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Amount</label>
                 <input type="text" name="amount" class="form-control mb-2" placeholder="1" min="1">
              </div>
            
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label>Transaction ID</label>
                 <input type="text" name="transaction_id" class="form-control mb-2" placeholder="LKHSTGFHKK">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Enter Payment Number</label>
                 <input type="text" name="sender_number" class="form-control mb-2" placeholder="01985XXXXXX">
              </div>
            
          </div>
        </div>
        <button type="submit" style="float: right;" class="btn btn-sm btn-success">Submit</button>
       </form>
      </div>

    </div>
  </div>
</div>
     <!-- deposit modal end -->

      @if(session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
    });
    </script>
    @endif
 </div>
<footer class="mt-5 footer-section">
    @include('user.layouts.partials.footer')
</footer>
@endsection

<!-- script for modal data set -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const editButtons = document.querySelectorAll('.editBtn');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {

            let method = this.getAttribute('data-id');
            let name = this.getAttribute('data-name');
            let type = this.getAttribute('data-type');
            let number = this.getAttribute('data-number');
            let logo = this.getAttribute('data-logo');

            document.getElementById('method').value = method;
            document.getElementById('number').value = number;
            document.getElementById('name').value = name;

            document.getElementById('name_type').innerHTML = name + ' (' + type + ')' +' Number ';

            document.getElementById('logoPreview').src =logo;
        });
    });

});
</script>

