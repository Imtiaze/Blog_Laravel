<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
 
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>@yield('title')</title>

  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <link href="{{ asset('assets/backend/plugins/bootstrap/css/bootstrap.css') }} " rel="stylesheet">
  <link href="{{ asset('assets/backend/plugins/node-waves/waves.css') }} " rel="stylesheet" />
  <link href="{{ asset('assets/backend/plugins/animate-css/animate.css') }} " rel="stylesheet" />
  <link href="{{ asset('assets/backend/plugins/morrisjs/morris.css') }} " rel="stylesheet" />
  <link href="{{ asset('assets/backend/css/style.css') }} " rel="stylesheet">
  <link href="{{ asset('assets/backend/css/themes/all-themes.css') }} " rel="stylesheet" />


  @stack('css')
  
 
</head>
<body class="theme-blue">
  <div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
  </div>

  <div class="overlay"></div>

  <div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
  </div>

  <!-- Top Bar -->
  @include('layouts.backend.partials.topbar')

  <section>
    <!-- Sidebar -->
    @include('layouts.backend.partials.sidebar')
  </section>

  <section class="content">
    @yield('content')
  </section>


  <script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/bootstrap/js/bootstrap.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/jquery-slimscroll/jquery.slimscroll.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/node-waves/waves.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/raphael/raphael.min.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/morrisjs/morris.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/chartjs/Chart.bundle.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.resize.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.pie.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.categories.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.time.js') }} "></script>
  <script src="{{ asset('assets/backend/plugins/jquery-sparkline/jquery.sparkline.js') }} "></script>
  <script src="{{ asset('assets/backend/js/admin.js') }} "></script>
  <script src="{{ asset('assets/backend/js/pages/index.js') }} "></script>
  <script src="{{ asset('assets/backend/js/demo.js') }} "></script>
        
    

  @stack('js')
</body>
</html>
