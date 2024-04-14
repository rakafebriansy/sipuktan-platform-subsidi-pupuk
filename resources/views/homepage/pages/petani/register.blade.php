@extends('homepage.layouts.main')

@section('wrapper')
<div class="flex justify-center flex-col gap-4 items-center h-full">
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700 p-5">
        <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Registrasi Petani</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
              Sudah memiliki akun?
              <a class="text-blue-600 decoration-2 hover:underline font-medium" href="/petani/login">
                Masuk disini
              </a>
            </p>
        </div>
        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
        <form action="/petani/register" method="POST" class=" mx-auto md:grid md:grid-cols-2 md:gap-6">
            @csrf
            <div class="">
                <div class="mb-5">
                    <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                    <input type="text" name="nik" id="nik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>
                <div class="mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>
                <div class="mb-5">
                    <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" id="nomor_telepon" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>


                <button type="submit" class="text-white mb-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none w-[40%] mt-2 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Daftar</button>

            </div>
            <div class="flex flex-col">    
                <div class="flex items-center justify-center w-full mb-5">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">JPG or PNG (MAX. 5MB)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" />
                    </label>
                </div> 
                <div class="flex items-center gap-4 justify-between">
                    <div class="mb-5 ">
                        <label for="kata_sandi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                        <input data-popover-target="popover-password" data-popover-placement="bottom" type="password" name="kata_sandi" id="kata_sandi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                        <div data-popover id="popover-password" role="tooltip"
                            class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                            <div class="p-3 space-y-2">
                                <h3 class="font-semibold text-gray-900 dark:text-white">Must have at least 6 characters</h3>
                                <div class="grid grid-cols-4 gap-2">
                                    <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                    <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                    <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                                    <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                                </div>
                                <p>It's better to have:</p>
                                <ul>
                                    <li class="flex items-center mb-1">
                                        <svg class="w-3.5 h-3.5 me-2 text-green-400 dark:text-green-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M1 5.917 5.724 10.5 15 1.5" />
                                        </svg>
                                        Upper & lower case letters
                                    </li>
                                    <li class="flex items-center mb-1">
                                        <svg class="w-3 h-3 me-2.5 text-gray-300 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        A symbol (#$&)
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-3 h-3 me-2.5 text-gray-300 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        A longer password (min. 12 chars.)
                                    </li>
                                </ul>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                    <input type="hidden" value="" name="id_kelompok_tani" id="idPoktan">
                    <button id="dropdownUsersButton" data-dropdown-toggle="dropdownPoktan" data-dropdown-placement="bottom" class="min-w-[10rem] justify-between py-2.5 px-5 mb-2 mt-4 text-sm font-medium text-gray-900 text-center focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center " type="button">
                        <span>Kelompok Tani</span>
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                </div>
            </div>

        </form>
    </div>
  <a href="/" class="text-sm">< <span class="hover:underline">Kembali ke Homepage</span></a>
</div>
@endsection