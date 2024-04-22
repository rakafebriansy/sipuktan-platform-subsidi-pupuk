@extends('dashboard.pemerintah.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <p>Alokasi Pupuk</p>
                    <div class="flex justify-between items-center my-3">
                        <button data-modal-target="tambahAlokasiModal" data-modal-toggle="tambahAlokasiModal" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                            Tambah data
                          </button>
                        <div class="flex gap-4">
                            <button id="dropdownTahunButton" data-dropdown-toggle="dropdownTahun" data-dropdown-placement="bottom" class="py-2.5 px-5 text-sm font-medium text-gray-900 justify-between focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center " type="button"><p>{{ isset($tahun) ? $tahun : $tahuns[0]->tahun }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                            <button id="dropdownMTButton" data-dropdown-toggle="dropdownMT" data-dropdown-placement="bottom" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none min-w-24 justify-between bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center cursor-pointer" type="button"><p>{{ isset($mt) ? $mt : 'MT1' }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
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
                            <p class="inline-block">Petani</p>
                        </th>
                        
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jumlah</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jenis Pupuk</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Kelompok Tani</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Kios Resmi</p>
                        </th>
                        
                        <th scope="col" class="py-3 md:w-[40%] lg:w-[25%]">
                            <span class="inline-block">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alokasis as $alokasi)
                    <tr class="alokasi-rows bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $alokasi->nama }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $alokasi->jumlah_pupuk }}
                        </td>
                        <td class="px-6 py-4" data-value="{{ $alokasi->jenis_pupuk->id }}">
                            {{ $alokasi->jenis }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $alokasi->poktan }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $alokasi->kios_resmi }}
                        </td>
                        <td data-id="{{ $alokasi->id_alokasi }}" data-nik="{{ $alokasi->nik }}" data-ktp="{{ $alokasi->foto_ktp }}" data-nomor="{{ $alokasi->nomor_telepon }}" class="py-4 flex flex-row ">
                            <button  data-modal-target="detailAlokasiModal" data-modal-toggle="detailAlokasiModal" onclick="detailPassId(this)" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Detail</button>
                            <button data-modal-target="editAlokasiModal" data-modal-toggle="editAlokasiModal" onclick="editPassId(this)" class=" bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Edit</button>
                            <button data-modal-target="deleteAlokasiModal" data-modal-toggle="deleteAlokasiModal" onclick="deletePassId(this)" class=" bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Hapus</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                @else
                <div class="flex justify-center">
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
@endsection