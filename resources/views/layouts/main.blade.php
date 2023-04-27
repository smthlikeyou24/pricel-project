<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <script src="https://unpkg.com/feather-icons"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
</head>
<body class="font-lato">

@include('partials.navbar')
  <div class="w-full bg-[#FFF3E2] min-h-screen">
    <div class="px-5 py-5">
        @yield('content')
    </div>
  </div>


  <script>
    feather.replace()
  </script>
</body>
</html>