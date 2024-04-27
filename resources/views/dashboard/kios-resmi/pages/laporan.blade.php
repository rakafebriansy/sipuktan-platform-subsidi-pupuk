@extends('dashboard.kios-resmi.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <div class="flex justify-between items-center">
                        <p class="inline-block">Alokasi Pupuk</p>
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
                            <span class="inline-block">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alokasis as $alokasi)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                        <td class="py-4">
                            <button onclick="getDetailAlokasiPetani(this)" data-poktan="{{ $alokasi->poktan }}" data-telp="{{ $alokasi->nomor_telepon }}" data-modal-target="detailAlokasiModal" data-modal-toggle="detailAlokasiModal" type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</button>
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
    <ul class="py-2 max-h-36 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
      @foreach ($tahuns as $tahun)
      <li onclick="getAlokasiFromTh(this,'kios-resmi')">
        <p class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer alokasi-tahun">
          {{ $tahun->tahun }}
        </p>
      </li>
      @endforeach
    </ul>
</div> 
<div id="dropdownMT" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="h-36 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
      <li onclick="getAlokasiFromMt(this,'kios-resmi')">
        <p data-value="1" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
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
                                    -
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Kelompok Tani
                                </th>
                                <td class="px-6 py-4">
                                    -
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</div>


@endsection