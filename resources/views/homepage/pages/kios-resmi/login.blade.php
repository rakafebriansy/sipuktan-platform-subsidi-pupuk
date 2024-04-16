@extends('homepage.layouts.main')

@section('wrapper')
<div class="flex justify-center flex-col gap-4 h-full items-center">
  @if ($errors->any())
  <div class="mt-2 bg-red-100 border border-red-200 text-sm absolute top-4 text-red-800 rounded-lg p-4 dark:bg-red-800/10 dark:border-red-900 dark:text-red-500" role="alert">
      <span class="font-bold">Danger</span> {{ $errors->first() }}
  </div>
@elseif (session('success'))
  <div class="mt-2 bg-teal-100 border border-teal-200 text-sm absolute top-4 text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
    <span class="font-bold">Success</span> {{ Session::get('success') }}
  </div>
@elseif (session('unverified'))
<div class="mt-2 bg-blue-100 border border-blue-200 text-sm text-blue-800 rounded-lg p-4 dark:bg-blue-800/10 dark:border-blue-900 dark:text-blue-500" role="alert">
  <span class="font-bold">Info</span> {{ Session::get('unverified') }}
</div>
@endif
  <div class="w-[25rem]">
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
      <div class="p-4 sm:p-7">
        <div class="text-center">
          <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Log in Kios</h1>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Belum memiliki akun?
            <a class="text-blue-600 decoration-2 hover:underline font-medium" href="/kios-resmi/register">
              Daftar disini
            </a>
          </p>
        </div>
        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
        <form action="/kios-resmi/login" method="POST">
          @csrf
          <div class="grid">
            <div class="mb-5">
              <label for="nib" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIB</label>
              <input type="text" name="nib" id="nib" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
            </div>
            <div class="mb-5">
              <div class="flex justify-between items-center">
                <label for="kata_sandi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                <a class="text-sm text-blue-600 decoration-2 hover:underline font-medium" href="/kios-resmi/lupa-sandi">Lupa sandi?</a>
              </div>
              <input type="password" name="kata_sandi" id="kata_sandi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
            </div> 
            <div class="flex items-center">
              <div class="flex">
                <input id="remember-me" name="remember-me" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
              </div>
              <div class="ms-3">
                <label for="remember-me" class="text-sm dark:text-white">Ingat saya</label>
              </div>
            </div>
            <button type="submit" class="w-full mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Masuk</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <a href="/" class="text-sm">< <span class="hover:underline">Kembali ke Homepage</span></a>
</div>
@endsection