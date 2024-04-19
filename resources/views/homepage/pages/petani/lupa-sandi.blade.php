@extends('homepage.layouts.main')
@section('wrapper')
<div class="relative overflow-hidden top-0 start-1/2 bg-no-repeat bg-top size-full z-5 transform -translate-x-1/2 dark:bg-[url('/images/farmer.png')]">
  <img src="{{ asset('/../images/farmer.png') }}" class="w-full absolute z-20" alt="">
  <div class="bg-gradient-to-b from-[rgba(0,0,0,0)] to-[rgba(0,0,0,0.6)] w-full h-full absolute z-30"></div>
  <div class="flex justify-center flex-col gap-4 h-full items-center relative z-40">
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 sm:p-7 w-[24rem]">
          <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Lupa kata sandi?</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Sudah ingat kata sandi-mu?
                <a class="text-blue-600 decoration-2 hover:underline font-medium" href="/petani/login">
                    Masuk disini
                </a>
            </p>
          </div>
      
          <div class="mt-5">
            <form action="/petani/lupa-sandi">
              @csrf
              <div class="grid">
                <!-- Form Group -->
                <div>
                    <div class="mb-5">
                        <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" id="nomor_telepon" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                    </div>
                </div>
      
                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Reset kata sandi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <a href="/petani/login" class="text-sm text-white">< <span class="hover:underline">Kembali ke Log in</span></a>
  </div>
</div>

@endsection