@extends('homepage.layouts.main')

@section('wrapper')
<div class="relative overflow-hidden top-0 start-1/2 bg-no-repeat bg-top size-full z-5 transform -translate-x-1/2 dark:bg-[url('/images/farmer.png')]">
    <img src="{{ asset('/../images/farmer.webp') }}" class="w-full absolute z-20" alt="">
    <div class="bg-gradient-to-b from-[rgba(0,0,0,0)] to-[rgba(0,0,0,0.6)] w-full h-full absolute z-30"></div>
    <div class="flex justify-center flex-col gap-4 items-center h-full z-40 relative">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700 p-5">
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
            <form action="/petani/register" method="POST" class=" mx-auto md:grid md:grid-cols-2 md:gap-x-6" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-between flex-col">
                    <div class="mb-5">
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik','') }}" id="nik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  />
                    </div>
                    <div class="mb-5">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama','') }}" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  />
                    </div>
                    <div class="mb-5">
                        <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon','') }}" id="nomor_telepon" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  />
                    </div>
                </div>
                <div class="flex flex-col w-full justify-between">    
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto KTP</label>
                    <div class="flex items-center justify-center w-full mb-5">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <div class="flex justify-center flex-col items-center">
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk mengunggah</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">JPG or PNG (MAX. 5MB)</p>
                                </div>
                            </div>
                            <input id="dropzone-file" type="file" onchange="fileAnnounce(this)" class="hidden" name="foto_ktp" />
                        </label>
                    </div> 
                    <div class="flex items-center gap-4 justify-between">
                        <div class="mb-5 ">
                            <label for="kata_sandi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                            <input type="password" name="kata_sandi" value="{{ old('kata_sandi','') }}" id="kata_sandi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"  />
                        </div>
                        <input type="hidden" value="{{ old('id_kelompok_tani') }}" name="id_kelompok_tani" id="idDropdown">
                        <input type="hidden" value="{{ old('kelompok_tani') }}" name="kelompok_tani" id="namaDropdown">
                        <button id="dropdownRegisterButton" data-dropdown-toggle="dropdownRegister" data-dropdown-placement="bottom" class="min-w-[13rem] justify-between py-2.5 px-5 mb-2 mt-4 text-sm font-medium text-gray-900 text-center focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center " type="button">
                            <span>{{ old('kelompok_tani','') == ''? 'Kelompok Tani' : old('kelompok_tani','') }}</span>
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none w-[40%] focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Daftar</button>
            </form>
        </div>
      <a href="/" class="text-sm text-white">< <span class="hover:underline">Kembali ke Homepage</span></a>
    </div>
  </div>
  @if (isset($kelompok_tanis))
  <div id="dropdownRegister" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
    <ul class="max-h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRegisterButton">
          @foreach ($kelompok_tanis as $kelompok_tani)
          <li onclick="dismissingDropdown('dropdownRegisterButton')">
            <p data-value="{{ $kelompok_tani->id }}" class="flex cursor-pointer items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
              {{ $kelompok_tani->nama }}
            </p>
          </li>
          @endforeach
      </ul>
    </div>  
  @endif
@endsection