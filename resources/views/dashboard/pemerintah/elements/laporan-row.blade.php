<td class="px-6 py-4">
    {{ date('H:i d-m-Y',strtotime($laporan->tanggal_pengambilan))}}
</td>
<td class="px-6 py-4">
    {{ $laporan->nama_petani }}
</td>
<td class="px-6 py-4">
    {{ $laporan->jenis }}
</td>
<td class="px-6 py-4">
    {{ $laporan->jumlah_pupuk }}kg
</td>
<td class="px-6 py-4">
    @if ($laporan->telah_diedit == true)
        @php
            $satuan = 'menit';
            $selisih = now()->diffInMinutes($laporan->tanggal_diedit);
            if($selisih > 60) {
                $selisih = now()->diffInHours($laporan->tanggal_diedit);
                $satuan = 'jam';
                if($selisih > 24) {
                    $selisih = now()->diffInDays($laporan->tanggal_diedit);
                    $satuan = 'hari';
                }
            }
        @endphp
            <p class="italic">diedit {{ $selisih . ' ' . $satuan }} lalu</p>
    @else
        <p class="italic">{{ $laporan->status_verifikasi }}</p>
    @endif
</td>
<td class="py-4 flex flex-row px-6" data-id="{{ $laporan->id }}">
    <button type="button" onclick="detailLaporanPassModalOri(this)" class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">Detail</button>
    @if($laporan->status_verifikasi == 'Belum Diverifikasi')
        <button type="button" onclick="document.getElementById('verifikasiLaporanId').value = this.parentElement.dataset.id" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Setujui</button>
        <button type="button"onclick="document.getElementById('tolakLaporanId').value = this.parentElement.dataset.id" class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Tolak</button>
    @endif
</td>