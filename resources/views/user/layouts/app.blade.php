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
     <!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> -->
    <!-- css -->
    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css')}}">
    @stack('styles')
</head>

<body>
 @include('user.layouts.partials.navbar')
     <div id="app">
        <main class="py-0">
            @yield('content')
        </main>
    </div>
     <!-- Scripts -->
   <!--  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script> -->
 @stack('scripts')
</body>
</html>



