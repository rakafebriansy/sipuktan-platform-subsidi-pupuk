@extends('dashboard.kios-resmi.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <div class="flex justify-between">
                        <div class="">
                            <p>Riwayat Transaksi</p>
                        </div>
                        <div class="inline-flex gap-4">
                            <button id="dropdownTahunButton" data-dropdown-toggle="dropdownTahun" data-dropdown-placement="bottom" data-id="{{ $tahun }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center " type="button"><p>{{ isset($tahun) ? $tahun : $tahuns[0]->tahun }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                            <button id="dropdownMTButton" data-dropdown-toggle="dropdownMT" data-dropdown-placement="bottom" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center " type="button"><p>{{ isset($mt) ? $mt : 'MT1' }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Waktu Transaksi</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Nama Petani</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jenis Pupuk</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Metode</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jumlah</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Nominal</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($riwayat_transaksis))
                        @foreach ($riwayat_transaksis as $riwayat_transaksi)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ date('H:i d-m-Y',strtotime($riwayat_transaksi->tanggal_transaksi))}}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $riwayat_transaksi->nama_petani }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $riwayat_transaksi->jenis }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $riwayat_transaksi->metode_pembayaran }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $riwayat_transaksi->jumlah_pupuk }}kg
                                </td>
                                <td class="px-6 py-4">
                                    Rp{{ $riwayat_transaksi->total_harga }}
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

<div id="dropdownTahun" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="py-2 max-h-36 overflow-y-auto text-gray-700 dark:text-gray-200 cursor-pointer" aria-labelledby="dropdownUsersButton">
      @foreach ($tahuns as $tahun)
      <li onclick="getRiwayatFromTh(this,'kios-resmi')">
        
        <p class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
          {{ $tahun->tahun }}
        </p>
      </li>
      @endforeach
    </ul>
</div> 
<div id="dropdownMT" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="h-36 py-2 overflow-y-auto text-gray-700 dark:text-gray-200 cursor-pointer" aria-labelledby="dropdownUsersButton">
      <li onclick="getRiwayatFromMt(this,'kios-resmi')">
        <p data-value="1" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT1
        </p>
      </li>
      <li onclick="getRiwayatFromMt(this,'kios-resmi')">
        <p data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT2
        </p>
      </li>
      <li onclick="getRiwayatFromMt(this,'kios-resmi')">
        <p data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT3
        </p>
      </li>
      <li>
    </ul>
</div> 
@endsection