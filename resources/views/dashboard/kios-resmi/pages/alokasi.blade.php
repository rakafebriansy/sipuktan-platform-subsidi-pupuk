@extends('dashboard.kios-resmi.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <div class="">
                        <p class="inline-block">Alokasi Pupuk</p>
                    </div>
                    <div class="flex justify-between items-center my-3">
                        <div class="flex items-center">
                            @if (count($alokasis))
                                @if ($alokasis[0]->status == 'Belum Tersedia')
                                    <button onclick="editStatusAlokasiPassId()" data-modal-target="konfirmasiKedatanganModal" data-modal-toggle="konfirmasiKedatanganModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Konfirmasi Kedatangan</button>
                                @else
                                    <button type="button" disabled data-modal-target="konfirmasiKedatanganModal" data-modal-toggle="konfirmasiKedatanganModal" class="text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 me-2 mb-2">Konfirmasi Kedatangan</button>
                                @endif
                            @else
                                <button type="button" disabled data-modal-target="konfirmasiKedatanganModal" data-modal-toggle="konfirmasiKedatanganModal" class="text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600">Konfirmasi Kedatangan</button>
                            @endif
                        </div>
                        <div class="inline-flex gap-4">
                            <button id="dropdownTahunButton" data-dropdown-toggle="dropdownTahun" data-dropdown-placement="bottom" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center " type="button"><p>{{ isset($tahun) ? $tahun : $tahuns[0]->tahun }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
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
                @if(count($alokasis))
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Nama Petani</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jumlah</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jenis Pupuk</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Status</p>
                        </th>
                        <th scope="col" class="py-3">
                            <span class="inline-block">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alokasis as $alokasi)
                        @php
                            $isDibayar = $alokasi->status == "Dibayar";
                            $isTidakDiambil = $alokasi->status == "Tidak Diambil";
                        @endphp
                        <tr @class([
                            'bg-white' => !$isDibayar && !$isTidakDiambil,
                            'hover:bg-gray-50' => !$isDibayar && !$isTidakDiambil,
                            'bg-[#A5E09B]' => $isDibayar,
                            'hover:bg-[#95D88A]' => $isDibayar,
                            'bg-[#F97B7B]' => $isTidakDiambil,
                            'hover:bg-[#F56262]' => $isTidakDiambil,
                            'border-b', 'dark:bg-gray-800', 'dark:border-gray-700', 'dark:hover:bg-gray-600'
                            ])>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $alokasi->petani }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $alokasi->jumlah_pupuk }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $alokasi->jenis_pupuk->jenis }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $alokasi->status }}
                            </td>
                            <td class="py-4" data-id="{{ $alokasi->id }}">
                                <button onclick="getPetaniFromAlokasi(this)" data-modal-target="detailAlokasiModal" data-modal-toggle="detailAlokasiModal" type="button"  class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">Detail</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                @else
                <div class="flex  justify-center">
                    <thead>
                        <th class="text-center">
                            <h1 class="p-5">Belum ada data.</h1>
                        </th>
                    </thead>
                    <tbody>
                        <td>
                        </td>
                    </tbody>
                </div>
                @endif
            </table>
        </div>
    </div>
</div>

{{-- DROPDOWN --}}

<div id="dropdownTahun" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="py-2 max-h-36 overflow-y-auto text-gray-700 dark:text-gray-200 cursor-pointer" aria-labelledby="dropdownUsersButton">
      @foreach ($tahuns as $tahun)
      <li onclick="getAlokasiFromTh(this,'kios-resmi')">
        <p class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white alokasi-tahun">
          {{ $tahun->tahun }}
        </p>
      </li>
      @endforeach
    </ul>
</div> 
<div id="dropdownMT" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="h-36 py-2 overflow-y-auto text-gray-700 dark:text-gray-200 cursor-pointer" aria-labelledby="dropdownUsersButton">
      <li onclick="getAlokasiFromMt(this,'kios-resmi')">
        <p data-value="1" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT1
        </p>
      </li>
      <li onclick="getAlokasiFromMt(this,'kios-resmi')">
        <p data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT2
        </p>
      </li>
      <li onclick="getAlokasiFromMt(this,'kios-resmi')">
        <p data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT3
        </p>
      </li>
      <li>
    </ul>
</div> 

<div id="detailAlokasiModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-sm max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Detail Petani
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detailAlokasiModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4">


                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="bg-white dark:bg-gray-800">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Nomor Telepon
                                </td>
                                <td class="px-6 py-4">
                                    
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Kelompok Tani
                                </th>
                                <td class="px-6 py-4">
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>
    
<div id="konfirmasiKedatanganModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <form action="/kios-resmi/alokasi" method="post" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            @csrf
            @method('patch')
            <input type="hidden" name="id" id="alokasiId">
            <input type="hidden" name="tahun" id="alokasiTahun">
            <input type="hidden" name="musim_tanam" id="alokasiMusimTanam">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="konfirmasiKedatanganModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin mengonfirmasi kedatangan seluruh pupuk?</h3>
                <button data-modal-hide="konfirmasiKedatanganModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Konfirmasi
                </button>
                <button data-modal-hide="konfirmasiKedatanganModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
            </div>
        </form>
    </div>
</div>
    
@endsection