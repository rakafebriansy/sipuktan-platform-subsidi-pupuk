@extends('homepage.layouts.main')

@section('wrapper')
<div class="relative overflow-hidden top-0 start-1/2 bg-no-repeat bg-top size-full z-5 transform -translate-x-1/2 dark:bg-[url('/images/farmer.png')]">
    <img src="{{ asset('/../images/farmer.png') }}" class="w-full absolute z-20" alt="">
    <div class="bg-gradient-to-b from-[rgba(0,0,0,0)] to-[rgba(0,0,0,0.6)] w-full h-full absolute z-30"></div>
    <div class="flex justify-center items-center h-full flex-col gap-4 relative z-40">
        <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700 p-5">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Registrasi Kios</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                  Sudah memiliki akun?
                  <a class="text-blue-600 decoration-2 hover:underline font-medium" href="/kios-resmi/login">
                    Masuk disini
                  </a>
                </p>
            </div>
            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
            <form action="/kios-resmi/register" method="POST" class=" mx-auto md:grid md:grid-cols-2 md:gap-x-6" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="mb-2">
                        <label for="nib" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIB</label>
                        <input type="text" name="nib" value="{{ old('nib','') }}" id="nib" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                    </div>
                    <div class="mb-2">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kios</label>
                        <input type="text" name="nama" value="{{ old('nama','') }}" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                    </div>
                    <div class="mb-2">
                        <label for="jalan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <input type="text" name="jalan" value="{{ old('jalan','') }}" id="jalan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-2">
                        <div class="flex flex-col justify-between">
                            <label for="kata_sandi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                            <input type="password" name="kata_sandi" value="{{ old('kata_sandi','') }}" id="kata_sandi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                        </div>
                        <div class="flex flex-col justify-end h-full">
                            <input type="hidden" value="{{ old('id_kecamatan','') }}" name="id_kecamatan" id="idPoktan">
                            <input type="hidden" value="{{ old('kecamatan','') }}" name="kecamatan" id="namaPoktan">
                            <button id="dropdownRegisterButton" data-dropdown-toggle="dropdownRegister" data-dropdown-placement="bottom" class="min-w-[10rem] justify-between inline-flex py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center items-center " type="button">{{ old('kecamatan','') == ''? 'Kecamatan' : old('kecamatan','') }}<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">    
                    <div class="mb-2">
                        <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik','') }}" id="nama_pemilik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                    </div>
                    <div class="mb-2">
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                        <input type="text" name="nik" id="nik" value="{{ old('nik','') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                    </div>
                    <div class="mb-2">
                        <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon','') }}" id="nomor_telepon" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                    </div>
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Foto KTP</label>
                        <input name="foto_ktp" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                        <p class="mt-1 text-sm b-2text-gray-500 dark:text-gray-300" id="file_input_help">JPG or PNG (MAX. 5MB)</p>
                    </div>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none w-[40%] focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Daftar</button>
            </form>
        </div>
      <a href="/" class="text-sm text-white">< <span class="hover:underline">Kembali ke Homepage</span></a>
    </div>
  </div>


  @if (isset($kecamatans))
  <div id="dropdownRegister" class="z-10 hidden bg-white rounded-lg shadow max-w-60 dark:bg-gray-700">
    <ul class="max-h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRegisterButton">
          @foreach ($kecamatans as $kecamatan)
            <li>
                <p data-value="{{ $kecamatan->id }}" class="flex cursor-pointer items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
                {{ $kecamatan->nama }}
                </p>
            </li>
          @endforeach
    </ul>
    </div>  
 @endif
@endsection