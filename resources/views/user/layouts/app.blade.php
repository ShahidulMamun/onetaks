<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Onetaskmarket</title>
     <!-- font-awesome -->
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/font-awesome/css/font-awesome.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/font-awesome/css/font-awesome.min.css')}}">
     <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
     <!-- for widthdrow -->
     <!-- Then plugins -->
      <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
     <!-- End widthdrow -->
     <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css')}}">
    <!-- widthdrow css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/withdraw.css')}}">
  @php 
  $setting = App\Models\WebsiteSetting::first();
  @endphp
    <link rel="icon" type="image/png" href="{{asset('storage/'.$setting->site_logo)}}">
    @stack('styles')
</head>

<body>
 @include('user.layouts.partials.navbar')
     <div id="app">
        <main class="py-0">
            @yield('content')
        </main>
    </div>
 @stack('scripts')

      <!--  sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- script sweet alert success show -->
@if(session('success'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    showConfirmButton: false,
    timer: 3000,
    text: '{{ session('success') }}'
});
</script>
@endif

<!-- script sweet alert error show -->

@if (session('error'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'error',
    timer: 5000,
    showConfirmButton: false,
    title: "{{ session('error') }}"
});
</script>
@endif
@if ($errors->any())
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'error',
    // title: 'Validation Error',
    timer: 5000,
    showConfirmButton: false,
    html: `{!! implode('<br>', $errors->all()) !!}`
});
</script>
@endif
</body>
</html>



