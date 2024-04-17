@extends('dashboard.layouts.main')
@section('main')
@include('dashboard.petani.partials.sidebar') <?php //memanggil keseluruhan kode program dari file lain?>
<div class="wrapper">
    @yield("wrapper") <?php //inisiasi wadah kode program dari views?>
</div>
<div id="dropdownProfilPetani" class="z-50 hidden">
  <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7] w-[22rem]">
    <div class="bg-gray-100 border-b rounded-t-xl py-1 px-4 md:py-1 md:px-4 dark:bg-slate-900 dark:border-gray-700">
      <p class="mt-1 text-sm text-gray-500 dark:text-gray-500">
        Informasi Akun
      </p>
    </div>
    <div class="p-1 md:p-2">
        <div class="relative overflow-x-auto">
            <table class=" text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nama Lengkap
                        </th>
                        <td class="px-2 py-3">
                            {{ $petani->nama }}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Kelompok Tani
                        </th>
                        <td class="px-2 py-3">
                            {{ $petani->poktan }}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Kios Resmi
                        </th>
                        <td class="px-2 py-3">
                            <p class="flex items-center text-sm text-gray-900 dark:text-white">{{ $petani->kios_resmi }} 
                                <button data-popover-target="popover-kiosresmi" data-popover-placement="bottom-start" type="button">
                                    <svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Show information</span>
                                </button>
                            </p>
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nomor Telepon
                        </th>
                        <td class="px-2 py-3">
                            {{ $petani->nomor_telepon }}
                        </td>
                    </tr>
                    <tr>
                      <th>
                        <a href="/petani/ganti-sandi" class="inline-flex px-2 pt-3 pb-2 font-medium whitespace-nowrap items-center text-blue-600 hover:underline">
                          Ganti kata sandi
                        </a>
                      </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div data-popover id="popover-kiosresmi" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
        <div class="p-3 space-y-2">
            <h3 class="font-semibold text-gray-900 dark:text-white">Alamat lengkap kios</h3>
            <p>{{ $petani->jalan }}, {{ $petani->kecamatan }}</p>
        </div>
        <div data-popper-arrow></div>
    </div>
  </div>
</div>
@endsection