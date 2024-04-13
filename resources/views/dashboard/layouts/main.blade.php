<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>
  <body>
    @include('dashboard.layouts.sidebar') <?php //memanggil keseluruhan kode program dari file lain?>
    <div class="wrapper">
        @yield("wrapper") <?php //inisiasi wadah kode program dari views?>
    </div>
    <script src="../dist/script.js"></script>
  </body>
</html>