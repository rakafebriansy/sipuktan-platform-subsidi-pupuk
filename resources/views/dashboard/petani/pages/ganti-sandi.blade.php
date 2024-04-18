@extends('homepage.layouts.main')
@section('wrapper')
<div class="flex justify-center flex-col gap-4 h-full items-center">
  @if ($errors->any())
  <div class="flex justify-center min-h-[5%]">
      <div class="mt-2  bg-red-100 border border-red-200 text-sm top-4 text-red-800 rounded-lg p-4 dark:bg-red-800/10 dark:border-red-900 dark:text-red-500" role="alert">
          <span class="font-bold">Danger</span> {{ $errors->first() }}
      </div>
  </div>
  @elseif (session('success'))
  <div class="flex justify-center min-h-[5%]">
      <div class="mt-2 bg-teal-100 border border-teal-200 text-sm top-4 text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
          <span class="font-bold">Success</span> {{ Session::get('success') }}
      </div>
  </div>
  @endif
  <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <div class="p-4 sm:p-7 w-[24rem]">
      <div class="text-center">
        <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Ganti kata sandi</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Gunakan kombinasi sandi yang kuat!
        </p>
      </div>
  
      <div class="mt-5">
        <form action="/petani/ganti-sandi" method="POST">
          @csrf
          @method('patch')
          <div class="grid">
            <div>
                <div class="mb-5">
                    <label for="sandi_lama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata sandi lama</label>
                    <input type="password" name="sandi_lama" id="sandi_lama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>
            </div>
            <div>
                <div class="mb-5">
                    <label for="sandi_baru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata sandi baru</label>
                    <input type="password" name="sandi_baru" id="sandi_baru" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>
            </div>
            <div>
                <div class="mb-5">
                    <label for="sandi_ulang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ulangi kata sandi baru</label>
                    <input type="password" name="sandi_ulang" id="sandi_ulang" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>
            </div>
  
            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Reset kata sandi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <a href="/petani/dashboard" class="text-sm">< <span class="hover:underline">Kembali ke Dashboard</span></a>
</div>
@endsection