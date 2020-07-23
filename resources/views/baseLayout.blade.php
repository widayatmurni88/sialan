<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ini mau dihapus</title>
  <!--Resource-->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!--
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  -->
  <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
  <!-- BS Script-->
  <script src="{{ asset('js/bootstrap.js') }}"></script>

  <!--adminlte-->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


  @stack('headResource')
</head>
<body>
  
  @yield('content')

  @stack('bodyResource')
  <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
</body>
</html>