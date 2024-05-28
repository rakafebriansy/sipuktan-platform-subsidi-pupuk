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
        if(petani !== null && id_petani == petani.dataset.id){
          viewAlertNotifikasi(pesan, id_notifikasi);
        }
      });
      channel.bind('laporan-status-to-ditolak', function(data) {
        const kiosResmi = document.getElementById('kios-resmi');
        if(kiosResmi !== null && data['data']['id_kios_resmi'] == kiosResmi.dataset.id){
          viewAlertNotifikasi(data['data']['pesan'], data['data']['id'],'red');
          viewAksiLaporanNotifikasi(data['data']['id_laporan']);
        }
      });
      channel.bind('laporan-status-to-diverifikasi', function(data) {
        const kiosResmi = document.getElementById('kios-resmi');
        if(kiosResmi !== null && data['data']['id_kios_resmi'] == kiosResmi.dataset.id){
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
          viewAlertNotifikasi(data['data']['pesan'], data['data']['id'],'yellow');
          if(document.URL.includes('/pemerintah/keluhan')) {
            fetchTableRowKeluhanNotifikasi(data['data']['id_keluhan']);
          }
        }
      });
    </script>
  </head>
  <body>
    @yield('main')
    @if (str_contains($_SERVER['REQUEST_URI'],'dashboard'))
      <script>
        const DATA_COUNT = 3;
        let pupuks =   {!! json_encode($alokasis_chart) !!};
        document.addEventListener('DOMContentLoaded', () => {
          const data = {
              labels: ['Urea', 'Ponshka', 'SP-36'],
              datasets: [
                {
                  label: 'Alokasi',
                  data: [pupuks.urea,pupuks.ponskha,pupuks.sp36],
                }
              ]
            };
          const config = {
              type: 'pie',
              data: data,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  },
                  title: {
                    display: false,
                  }
                }
              },
            };
          const ctx = document.getElementById('pie-chart').getContext('2d');
          new window.Chart(ctx, config);
        });
      </script>
    @endif
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