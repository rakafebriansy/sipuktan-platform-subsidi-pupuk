@extends('dashboard.layouts.main')
@section('main')
@include('dashboard.petani.partials.sidebar') <?php //memanggil keseluruhan kode program dari file lain?>
<div class="wrapper">
    @if ($errors->any())
    <div id="alert-2" class="flex absolute z-50 left-1/2 transform -translate-x-1/2 border border-red-300 dark:border-red-800 min-h-[5%] items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
       <span class="sr-only">Peringatan</span>
       <div class="text-sm font-medium">
         {{ $errors->first() }}
       </div>
       <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
         <span class="sr-only">Close</span>
         <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
         </svg>
       </button>
   </div>
    @elseif (session('success'))
    <div id="alert-1" class="flex top-4 absolute z-50 left-1/2 transform -translate-x-1/2 items-center p-4 mb-4 text-blue-800 rounded-lg border  bg-blue-50 border-blue-300  dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400" role="alert">
       <span class="sr-only">Sukses</span>
       <div class="text-sm font-medium">
         {{ Session::get('success') }}
       </div>
         <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
           <span class="sr-only">Close</span>
           <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
           </svg>
       </button>
   </div>
    @endif
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