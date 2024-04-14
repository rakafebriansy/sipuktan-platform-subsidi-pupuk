@extends('homepage.layouts.main')

@section('wrapper')
<div class="flex justify-center h-full items-center">
  <div class="w-[25rem]">
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
      <div class="p-4 sm:p-7">
        <div class="text-center">
          <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Log in</h1>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Hanya untuk yang berwenang!
          </p>
        </div>
        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
        <form action="/pemerintah/login" method="post">
          <div class="grid">
            <div class="mb-5">
              <label for="nama_pengguna" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pengguna</label>
              <input type="text" name="nama_pengguna" id="nama_pengguna" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
            </div>
            <div class="mb-3">
              <div class="flex justify-between items-center">
                <label for="kata_sandi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
              </div>
              <input type="password" name="kata_sandi" id="kata_sandi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
            </div> 
            <button type="submit" class="w-full mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Masuk</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection