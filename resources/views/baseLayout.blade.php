<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name')}}</title>
  <!--Resource-->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
  <!-- BS Script-->
  <script src="{{ asset('js/bootstrap.js') }}"></script>

  @stack('headResource')
</head>
<body>
  
  @yield('content')

  @stack('bodyResource')
  
</body>
</html>