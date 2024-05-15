Rincian pupuk subsidi yang Anda terima tahun ini adalah sebagai berikut:

@if(count($alokasis_1))
<b>Musim Tanam 1</b>
@foreach ($alokasis_1 as $alokasi)
@if ($alokasi->id_jenis_pupuk == 'urea')
    🌱 Urea: {{ $alokasi->jumlah_pupuk }}kg, {{ strtolower($alokasi->status) }}
@elseif ($alokasi->id_jenis_pupuk == 'sp36')
    🌱 SP-36: {{ $alokasi->jumlah_pupuk }}kg, {{ strtolower($alokasi->status) }}
@else
    🌱 Ponshka: {{ $alokasi->jumlah_pupuk }}kg, {{ strtolower($alokasi->status) }}
@endif
@endforeach
@endif
@if(count($alokasis_2))
<b>Musim Tanam 2</b>
@foreach ($alokasis_2 as $alokasi)
@if ($alokasi->id_jenis_pupuk == 'urea')
    🌱 Urea: {{ $alokasi->jumlah_pupuk }}kg, {{ strtolower($alokasi->status) }}
@elseif ($alokasi->id_jenis_pupuk == 'sp36')
    🌱 SP-36: {{ $alokasi->jumlah_pupuk }}kg, {{ strtolower($alokasi->status) }}
@else
    🌱 Ponshka: {{ $alokasi->jumlah_pupuk }}kg, {{ strtolower($alokasi->status) }}
@endif
@endforeach
@endif
@if(count($alokasis_3))
<b>Musim Tanam 3</b>
@foreach ($alokasis_3 as $alokasi)
@if ($alokasi->id_jenis_pupuk == 'urea')
    🌱 Urea: {{ $alokasi->jumlah_pupuk }}kg, {{ strtolower($alokasi->status) }}
@elseif ($alokasi->id_jenis_pupuk == 'sp36')
    🌱 SP-36: {{ $alokasi->jumlah_pupuk }}kg, {{ strtolower($alokasi->status) }}
@else
    🌱 Ponshka: {{ $alokasi->jumlah_pupuk }}kg, {{ strtolower($alokasi->status) }}
@endif
@endforeach
@endif