<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

  </head>
  <body>
    <div class="wrapper">
        @yield("wrapper")
    </div>
    <script src="../dist/script.js"></script>
  </body>
</html>