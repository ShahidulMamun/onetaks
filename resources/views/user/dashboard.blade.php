@extends('user.layouts.app')
@section('content')
 <div class="container mt-5">
     <div class="row">
<div class="filter-bar px-3">
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
    <span class="result-count">322 Result</span>

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