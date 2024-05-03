<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @isset($total_harga)
    @endisset
    <title>{{ $title }}</title>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
      Pusher.logToConsole = true;

      var pusher = new Pusher('86f26363800bace9e231', {
        cluster: 'ap1'
      });

      var channel = pusher.subscribe('my-channel');
      channel.bind('alokasi-changed', function(data) {
        const alertNotif = document.getElementById('alert-notification');
        alert(JSON.stringify(data['data']));
        alertNotif.querySelector('#text-notification').innerText = JSON.stringify(data['data']);
        alertNotif.classList.replace('hidden','flex');
      });
    </script>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>
  <body>
    @yield('main')
    @isset($total_harga)
      <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
      <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
          snap.pay('{{ $snap_token }}', {
            onSuccess: function(result){
              document.getElementById('checkout-form').submit();
            },
            onPending: function(result){
              document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
              document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
          });
        };
      </script>
    @endisset
    <script src="../dist/script-dashboard.js"></script>
  </body>
</html>