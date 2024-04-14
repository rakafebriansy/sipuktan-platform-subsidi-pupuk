<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>
  <body>
    @yield('main')
    <script src="../dist/script-dashboard.js"></script>
  </body>
</html>