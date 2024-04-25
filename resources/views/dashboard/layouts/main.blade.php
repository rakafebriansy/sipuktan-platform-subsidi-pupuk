<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>
  <body>
    @yield('main')
    @isset($total_harga)
      <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
      <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
          // SnapToken acquired from previous step
          snap.pay('{{ $snap_token }}', {
            // Optional
            onSuccess: function(result){
              /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onPending: function(result){
              /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
              /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
          });
        };
      </script>
    @endisset
    <script src="../dist/script-dashboard.js"></script>
  </body>
</html>