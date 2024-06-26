<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('css')

    <title>@yield('title')</title>
  </head>
  <body>

    @yield('content')

    @vite(['resources/sass/app.scss','resources/js/app.js' ])
  </body>
</html>

