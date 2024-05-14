<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
      Pusher.logToConsole = true;

      var pusher = new Pusher('86f26363800bace9e231', {
        cluster: 'ap1'
      });

      var channel = pusher.subscribe('my-channel');
      channel.bind('alokasi-status-to-menunggu-pembayaran', function(data) {
        let id_notifikasi = data['data']['detail_notifikasi']['id'];
        let id_petani = data['data']['detail_notifikasi']['id_petani'];
        let pesan = data['data']['pesan'];
        const petani = document.getElementById('petani');
        if(petani !== null && id_kios_resmi == petani.dataset.id){
          viewAlertNotifikasi(pesan, id_notifikasi);
        }
      });
      channel.bind('laporan-status-to-ditolak', function(data) {
        let id_kios_resmi = data['data']['id_kios_resmi'];
        let id_laporan = data['data']['id_laporan'];
        let id_notifikasi = data['data']['id'];
        let pesan = data['data']['pesan'];
        if(kiosResmi !== null && id_kios_resmi == kiosResmi.dataset.id){
          viewAlertNotifikasi(pesan, id_notifikasi,'red');
          viewAksiLaporanNotifikasi(id_laporan);
        }
      });
      channel.bind('laporan-status-to-diverifikasi', function(data) {
        let id_kios_resmi = data['data']['id_kios_resmi'];
        let id_notifikasi = data['data']['id'];
        let pesan = data['data']['pesan'];
        const kiosResmi = document.getElementById('kios-resmi');
        if(kiosResmi !== null && id_kios_resmi == kiosResmi.dataset.id){
          viewAlertNotifikasi(pesan, id_notifikasi);
        }
      });
      channel.bind('laporan-dibuat', function(data) {
        const pemerintah = document.getElementById('pemerintah');
        if(pemerintah != null){
          viewAlertNotifikasi(data['data']['pesan'], data['data']['id']);
          if(document.URL.includes('/pemerintah/laporan')) {
            fetchTableRowLaporanNotifikasi(data['data']['id_laporan']);
          }
        }
      });
      channel.bind('keluhan-dibuat', function(data) {
        const pemerintah = document.getElementById('pemerintah');
        if(pemerintah != null){
          viewAlertNotifikasi(data['data']['pesan'], data['data']['id']);
          console.log('ok');
          if(document.URL.includes('/pemerintah/keluhan')) {
            console.log('ko');
            fetchTableRowKeluhanNotifikasi(data['data']['id_keluhan']);
          }
        }
      });
    </script>
  </head>
  <body>
    @yield('main')
    @isset($total_harga)
      <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
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