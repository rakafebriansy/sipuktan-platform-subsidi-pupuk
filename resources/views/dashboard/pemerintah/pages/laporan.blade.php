@extends('dashboard.pemerintah.partials.body')
@section('wrapper')
<div id="content" class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="mainTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <div class="flex justify-between items-center my-3">
                        <div class="">
                            <p>Laporan</p>
                            <span class="block m-0"><svg class="w-4 h-4 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                              </svg> <p class="text-sm font-normal inline-block text-gray-500 dark:text-gray-400"> Tani Jaya</p></span>
                        </div>
                        <div class="inline-flex gap-4">
                            <button id="dropdownTahunButton" data-dropdown-toggle="dropdownTahun" data-dropdown-placement="bottom" data-id="{{ $tahun }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center " type="button"><p>{{ isset($tahun) ? $tahun : $tahuns[0]->tahun }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                            <button id="dropdownMTButton" data-dropdown-toggle="dropdownMT" data-dropdown-placement="bottom" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center " type="button"><p>{{ isset($musim_tanam) ? $musim_tanam : 'MT1' }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Waktu Pengambilan</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Nama Petani</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jenis Pupuk</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jumlah</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Status</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Aksi</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($laporans))
                        @foreach ($laporans as $laporan)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                                <button data-modal-target="detailLaporanModal" data-modal-toggle="detailLaporanModal" type="button" onclick="getDetailLaporanFiles(this)" class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">Detail</button>
                                @if($laporan->status_verifikasi == 'Belum Diverifikasi')
                                    <button data-modal-target="verifikasiLaporanModal" data-modal-toggle="verifikasiLaporanModal" type="button" onclick="document.getElementById('verifikasiLaporanId').value = this.parentElement.dataset.id" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Setujui</button>
                                    <button data-modal-target="tolakLaporanModal" data-modal-toggle="tolakLaporanModal" type="button"onclick="document.getElementById('tolakLaporanId').value = this.parentElement.dataset.id" class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Tolak</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr id="no-data" >
                            <td colspan="5" class="text-center py-4">Belum ada data</td> 
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- DROPDOWN --}}
@foreach ($laporans as $laporan)
    @include('dashboard.pemerintah.elements.laporan')
    @yield('detail')
    @if ($laporan->status_verifikasi == 'Belum Diverifikasi')
        @yield('verifikasi')    
    @endif
@endforeach

<div id="dropdownTahun" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="py-2 max-h-36 overflow-y-auto text-gray-700 dark:text-gray-200 cursor-pointer" aria-labelledby="dropdownUsersButton">
      @foreach ($tahuns as $tahun)
      <li onclick="getRiwayatLaporFromTh(this,'pemerintah')">
        
        <p class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
          {{ $tahun->tahun }}
        </p>
      </li>
      @endforeach
    </ul>
</div> 
<div id="dropdownMT" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="h-36 py-2 overflow-y-auto text-gray-700 dark:text-gray-200 cursor-pointer" aria-labelledby="dropdownUsersButton">
      <li onclick="getRiwayatLaporFromMt(this,'pemerintah')">
        <p data-value="1" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT1
        </p>
      </li>
      <li onclick="getRiwayatLaporFromMt(this,'pemerintah')">
        <p data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT2
        </p>
      </li>
      <li onclick="getRiwayatLaporFromMt(this,'pemerintah')">
        <p data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT3
        </p>
      </li>
      <li>
    </ul>
</div> 



@endsection