@extends('dashboard.layouts.main')
@section('main')
@include('dashboard.pemerintah.partials.sidebar') <?php //memanggil keseluruhan kode program dari file lain?>
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
                            Mohammad Faqih
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Kelompok Tani
                        </th>
                        <td class="px-2 py-3">
                            Makmur jaya
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Kios Resmi
                        </th>
                        <td class="px-2 py-3">
                            Jl. Mangga, no .15
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Nomor Telepon
                        </th>
                        <td class="px-2 py-3">
                            081242526781
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
<div id="tambah-alokasi-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                  Tambah Data Alokasi Pupuk
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="tambah-alokasi-modal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          <!-- Modal body -->
          <form class="p-4 md:p-5">
              <div class="grid gap-4 mb-4 grid-cols-2">
                  <div class="col-span-2">
                      <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                      <input type="text" name="nik" id="nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label for="jumlah_pupuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                      <input type="number" name="jumlah_pupuk" id="jumlah_pupuk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                      <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                          <option selected="">Select category</option>
                          <option value="TV">TV/Monitors</option>
                          <option value="PC">PC</option>
                          <option value="GA">Gaming/Console</option>
                          <option value="PH">Phones</option>
                      </select>
                  </div>

                  <div class="col-span-2 sm:col-span-1">
                      <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                      <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                          <option selected="">Select category</option>
                          <option value="TV">TV/Monitors</option>
                          <option value="PC">PC</option>
                          <option value="GA">Gaming/Console</option>
                          <option value="PH">Phones</option>
                      </select>
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                      <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                          <option selected="">Select category</option>
                          <option value="TV">TV/Monitors</option>
                          <option value="PC">PC</option>
                          <option value="GA">Gaming/Console</option>
                          <option value="PH">Phones</option>
                      </select>
                  </div>
 
              </div>
              <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                  Add new product
              </button>
          </form>
      </div>
  </div>
</div> 
@endsection