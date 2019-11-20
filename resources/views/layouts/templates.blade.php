<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="author" content="Fajar Sidiq Setiawan">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{ asset('assets/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="{{ asset('assets/vendors/@coreui/icons/css/free.min.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Main styles for this application-->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/pace-progress/css/pace.min.css')}}" rel="stylesheet">

    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  
   
    <link href="{{ asset('assets/vendors/@coreui/coreui-chartjs/css/coreui-chartjs.css')}}" rel="stylesheet">
    @yield('styles')
  </head>
  <body class="c-app">
    @include('partials.sidebar')
    
    <div class="c-wrapper">
        @include('partials.header')
      
      <div class="c-body">
        <main class="c-main">
            <div class="fade-in">
                @yield('content')
            </div>
        </main>
      </div>

      @include('partials.footer')
      
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset("assets/vendors/pace-progress/js/pace.min.js")}}"></script>
    <script src="{{ asset("assets/vendors/@coreui/coreui/js/coreui.bundle.min.js")}}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset("assets/vendors/chart.js/js/Chart.min.js")}}"></script>
    <script src="{{ asset("assets/vendors/@coreui/coreui-chartjs/js/coreui-chartjs.js")}}"></script>
    <script src="{{ asset("assets/js/main.js")}}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
      $('.c-sidebar-minimizer').on('click', function(){
        $('.c-sidebar-nav-icon').toggleClass('mr-3') ;
      }) ;
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/js/autoNumeric-autoNumeric-c426664/autoNumeric.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    @yield('scripts')

  </body>
</html>