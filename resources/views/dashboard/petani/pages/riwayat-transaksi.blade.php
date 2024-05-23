@extends('dashboard.petani.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <div class="flex justify-between items-center">
                        <div class="">
                            <p>Riwayat Transaksi</p>
                            <span class="block m-0"><svg class="w-4 h-4 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                              </svg> <p class="text-sm font-normal inline-block text-gray-500 dark:text-gray-400"> {{ $petani->poktan }}</p></span>
                        </div>
                        <div class="flex gap-4">
                            <button id="dropdownTahunButton" data-dropdown-toggle="dropdownTahun" data-dropdown-placement="bottom" class="py-2.5 px-5 text-sm font-medium text-gray-900 justify-between focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center " type="button"><p>{{ $tahun }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
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
                            <p class="inline-block">Jenis Pupuk</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Metode Pembayaran</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jumlah</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Nominal</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Musim Tanam</p>
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
                                <td class="px-6 py-4">
                                    {{ $riwayat_transaksi->musim_tanam }}
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
    <ul class="py-2 max-h-36 overflow-y-auto text-gray-700 dark:text-gray-200 cursor-pointer" aria-labelledby="dropdownUsersButton" class="cursor-pointer">
      @foreach ($tahuns as $tahun)
      <li onclick="getRiwayatFromTh(this,'petani')">
        <p class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
          {{ $tahun->tahun }}
        </p>
      </li>
      @endforeach
    </ul>
  </div> 
@endsection