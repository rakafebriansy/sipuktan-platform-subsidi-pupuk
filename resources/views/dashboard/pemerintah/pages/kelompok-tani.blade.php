@extends('dashboard.pemerintah.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="mainTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <p>Keluhan</p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Kelompok Tani</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Kios Resmi</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Kecamatan</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($kelompok_tanis))
                        @foreach ($kelompok_tanis as $kelompok_tani)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $kelompok_tani->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kelompok_tani->kios_resmi }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kelompok_tani->kecamatan }}
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

@if(count($kelompok_tanis))
<div id="editAlokasiModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Ubah Data Alokasi Pupuk
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editAlokasiModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <form  action="/pemerintah/alokasi" method="post" class="p-4 md:p-5">
                @csrf
                @method('patch')
                <input type="hidden" name="id" id="editAlokasiId">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="jumlah_pupuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                        <input type="number" name="jumlah_pupuk"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                        <input type="number" name="tahun"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="id_jenis_pupuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Pupuk</label>
                        <select name="id_jenis_pupuk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Pilih Jenis</option>
                            @if (isset($jenis_pupuks))
                            @foreach ($jenis_pupuks as $jenis_pupuk)
                                <option value="{{ $jenis_pupuk->id }}">{{ $jenis_pupuk->jenis }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="musim_tanam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Musim Tanam</label>
                        <select name="musim_tanam"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Pilih Musim Tanam</option>
                            <option value="MT1">MT1</option>
                            <option value="MT2">MT2</option>
                            <option value="MT3">MT3</option>
                        </select>
                    </div>

                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Ubah data
                </button>
            </form>
        </div>
    </div>
</div> 
<div id="deleteAlokasiModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-sm max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteAlokasiModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <form method="post" action="/pemerintah/alokasi" class="p-4 md:p-5 text-center">
            @csrf
            @method('delete')
            <input type="hidden" name="id" value="" id="deleteAlokasiId">
            <input type="hidden" name="tahun" value="" id="deleteAlokasiTahun">
            <input type="hidden" name="musim_tanam" value="" id="deleteAlokasiMT">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Data yang telah dihapus tidak dapat dipulihkan, apakah anda yakin ingin menghapus data?</h3>
                <button data-modal-hide="deleteAlokasiModal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Hapus
                </button>
                <button data-modal-hide="deleteAlokasiModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
            </form>
        </div>
    </div>
</div>
</div> 
@endif
@endsection