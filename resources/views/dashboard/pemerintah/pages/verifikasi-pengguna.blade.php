@extends('dashboard.pemerintah.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        @if ($errors->any())
        <div id="alert-2" class="min-h-[5%] flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Peringatan</span>
            <div class="ms-3 text-sm font-medium">
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
        <div class="flex justify-center min-h-[5%]">
            <div class="mt-2 bg-teal-100 border border-teal-200 text-sm top-4 text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
                <span class="font-bold">Success</span> {{ Session::get('success') }}
            </div>
        </div>
        @endif
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-h-[50%]">
            <form action="/pemerintah/verifikasi-pengguna/petani" method="post">
                @csrf
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class=" w-full  px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <div class="flex justify-between">
                            <p class="inline-block">Petani</p>
                            @if(count($petanis))
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Setujui</button>
                            @else
                            <button disabled type="submit" class="text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600">Setujui</button>
                            @endif
                        </div>
                    </caption>
                    @if(count($petanis))
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4 sr-only">
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Petani
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nomor Telepon
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Foto KTP
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelompok Tani
                            </th>
    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petanis as $petani)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input name="id_petanis[]" value="{{ $petani->id }}" id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $petani->nik }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $petani->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $petani->nomor_telepon }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="/../download/foto_ktps/{{ $petani->foto_ktp }}" class="hover:underline">{{ $petani->foto_ktp }}</a>
                            </td>
                            <td class="px-6 py-4">
                                {{ $petani->nama_poktan }}
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
            </form>

        </div>
        <div class="min-h-[5%]"></div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-h-[50%]">
            <form action="/pemerintah/verifikasi-pengguna/kios-resmi" method="post">
                @csrf
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <div class="flex justify-between">
                            <p class="inline-block">Kios Resmi</p>
                            @if(count($kios_resmis))
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Setujui</button>
                            @else
                            <button disabled type="submit" class="text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600">Setujui</button>
                            @endif
                        </div>
                    </caption>
                    @if(count($kios_resmis))
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4 sr-only">
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIB
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Kios
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Alamat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pemilik
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nomor Telepon
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Foto KTP
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kios_resmis as $kios_resmi)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input name="id_kios_resmis[]" value="{{ $kios_resmi->id }}" id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $kios_resmi->nib }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $kios_resmi->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kios_resmi->jalan }}, {{ $kios_resmi->kecamatan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kios_resmi->nik }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kios_resmi->nama_pemilik }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $kios_resmi->nomor_telepon }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="/download/foto_ktps/{{ $kios_resmi->foto_ktp }}" class="hover:underline">{{ $kios_resmi->foto_ktp }}</a>
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
            </form>
        </div>
    </div>

  
</div>
@endsection