@extends('dashboard.pemerintah.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <div class="flex justify-between items-center my-3">
                        <p class="text-2xl">Keluhan</p>
                    </div>
                </caption>
                @if (count($keluhans))
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Tanggal Keluhan</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Subjek</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Status</p>
                        </th>
                        <th scope="col" class="px-6 py-3 md:w-[24%] lg:w-[12%]">
                            <p class="inline-block">Aksi</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keluhans as $keluhan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ date('H:i d-m-Y',strtotime($keluhan->tanggal_keluhan))}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $keluhan->subjek }}
                        </td>
                        <td class="px-6 py-4 italic">
                            {{ isset($keluhan->balasan)? 'Dibalas' : 'Belum dibalas' }}
                        </td>
                        <td class="py-4 flex flex-row px-6" data-id="{{ $keluhan->id }}">
                            <button data-modal-target="detailKeluhanModal" data-modal-toggle="detailKeluhanModal"  type="button" onclick="getDetailKeluhan(this,'{{ csrf_token() }}')" class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">Detail</button>
                            <button data-modal-target="balasKeluhanModal" data-modal-toggle="balasKeluhanModal" type="button" onclick="balasKeluhanPassId(this, '{{ csrf_token() }}')" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Balas</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                @else
                <div class="flex justify-center">
                    <thead>
                        <th class="text-center">
                            <h1>Belum ada data.</h1>
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

@if(count($keluhans))
<div id="detailKeluhanModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-sm max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Detail Petani
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detailKeluhanModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                <div id="detailKeluhanBody" class="text-sm">
                    <div class="mb-3">
                        <h3 class="mb-1 font-medium text-gray-900 dark:text-white inline">Subjek: </h3>
                        <p class="inline"></p>
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium text-gray-900 dark:text-white">Keluhan:</label>
                        <p></p>
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium text-gray-900 dark:text-white">Balasan:</label>
                        <p></p>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<div id="balasKeluhanModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Keluhan
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="balasKeluhanModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="/kios-resmi/keluhan" method="post" class="p-4 md:p-5">
                @csrf
                @method('patch')
                <input type="hidden" name="id_pemerintah" value="{{ $pemerintah->id }}">
                <input type="hidden" name="id">
                <div id="balasKeluhanBody" class="mb-4 text-sm">
                    <div class="mb-3">
                        <h3 class="mb-1 font-medium text-gray-900 dark:text-white inline">Subjek: </h3>
                        <p class="inline"></p>
                    </div>
                    <div class="mb-3">
                        <label class="block font-medium text-gray-900 dark:text-white">Keluhan:</label>
                        <p></p>
                    </div>
                    <div class="mb-2">
                        <label for="balasan" class="block mb-1 font-medium text-gray-900 dark:text-white">Balasan:</label>
                        <textarea name="balasan" rows="3" class="block p-2.5 w-full bg-gray-50 text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="resize: none" placeholder="Ketikkan balasan anda..."></textarea>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Balas
                </button>
            </form>
        </div>
    </div>
</div> 
@endif
@endsection