@extends('dashboard.layouts.main')
@section('main')
@include('dashboard.kios-resmi.partials.sidebar') <?php //memanggil keseluruhan kode program dari file lain?>
<div class="wrapper">
    @yield("wrapper") <?php //inisiasi wadah kode program dari views?>
</div>
<div id="dropdownTahun" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="py-2 h-36 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
      <li>
        <p href="#" data-value="1" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          2021
        </p>
      </li>
      <li>
        <p href="#" data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          2022
        </p>
      </li>
      <li>
        <p href="#" data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          2023
        </p>
      </li>
      <li>
        <p href="#" data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          2024
        </p>
      </li>
    </ul>
</div> 
<div id="dropdownMT" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="h-36 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
      <li>
        <p href="#" data-value="1" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT1
        </p>
      </li>
      <li>
        <p href="#" data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT2
        </p>
      </li>
      <li>
        <p href="#" data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT3
        </p>
      </li>
      <li>
    </ul>
</div> 
<div id="dropdownProfilKios" class="z-50 hidden">
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
                            {{ $kios_resmi->pemilik }}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nama Kios
                        </th>
                        <td class="px-2 py-3">
                            {{ $kios_resmi->nama }}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Alamat Kios
                        </th>
                        <td class="px-2 py-3">
                            {{ $kios_resmi->jalan }}, {{ $kios_resmi->kecamatan }}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nomor Telepon
                        </th>
                        <td class="px-2 py-3">
                            {{ $kios_resmi->nomor_telepon }}
                        </td>
                    </tr>
                    <tr>
                      <th>
                        <a href="#" class="inline-flex px-2 pt-3 pb-2 font-medium whitespace-nowrap items-center text-blue-600 hover:underline">
                          Ganti kata sandi
                        </a>
                      </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
@endsection