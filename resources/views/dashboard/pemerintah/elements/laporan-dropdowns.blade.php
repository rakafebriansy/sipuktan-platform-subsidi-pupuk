@include('dashboard.pemerintah.elements.laporan')
@yield('detail')
@if ($laporan->status_verifikasi == 'Belum Diverifikasi')
    @yield('verifikasi')    
@endif