@extends('user.layouts.app')
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-3">
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
    <span class="result-count text-dark fw-bold"><i class="fa fa-bars text-primary" aria-hidden="true"></i>  Available Jobs <span class="badge bg-danger">{{count($jobs)}}</span></span> 
    <div class="d-flex align-items-center gap-2 flex-wrap">
      <div class="cat-dropdown-wrapper">
        <select class="filter-select" id="catSelect" style="width:150px;" onchange="toggleDropdown(this)">
          <option value="">Categories</option>
          <option>Ads Click</option>
          <option>SEO</option>
          <option>Visit</option>
          <option>Search</option>
          <option>Engage</option>
        </select>
      </div>

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
</div>
<div class="col-12 mt-5">
    <table class="table table-striped">
  <thead class="table-light">

    <tr class="">
      <th scope="col">Zone</th>
      <th scope="col">Job Title</th>
      <th scope="col">Earning</th>
      <th scope="col">Worker</th>
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
      <td class="fw-bold">
        <a href="{{ route('user.job-details',$job->code)}}" class="btn btn-sm text-white" style="background-color:#6658dd;">Apply Job</a>
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