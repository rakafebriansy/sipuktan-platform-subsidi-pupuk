@extends('homepage.layouts.main')
@section('wrapper')
<div class="relative overflow-hidden top-0 start-1/2 bg-[url('/images/farmer.png')] bg-no-repeat bg-top size-full z-5 transform -translate-x-1/2 dark:bg-[url('/images/farmer.png')]">
  <img src="{{ asset('/images/farmer.png') }}" class="w-full absolute z-20" alt="">
  <div class="bg-gradient-to-b from-[rgba(0,0,0,0)] to-[rgba(0,0,0,0.6)] w-full h-full absolute z-30"></div>
  <div class="w-full h-full justify-center items-center flex z-40 relative">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 ">
      <div class="flex justify-center">
        <span class="inline-flex items-center gap-x-2 bg-[rgba(255,255,255,0.7)] border border-gray-200 text-xs text-gray-600 p-2 px-3 rounded-full transition hover:border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:border-gray-600 dark:text-gray-400" href="#">
          Sudah memiliki akun?
          <button type="button" id="dropdownLoginButton" data-dropdown-toggle="dropdownLogin" data-dropdown-placement="right" data-dropdown-offset-distance="25" class="flex items-center gap-x-1">
            <p class="border-s border-gray-200 text-blue-600 ps-2 dark:text-blue-500 dark:border-gray-700">Log in</p>
            <svg class="flex-shrink-0 size-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
          </button>
        </span>
      </div>
  
      <div class="mt-5 max-w-4xl text-center mx-auto">
        <h1 class="block font-bold text-white text-4xl md:text-5xl lg:text-6xl dark:text-gray-200">
          Sistem Informasi Subsidi Pupuk Petani Terintegrasi
        </h1>
      </div>
  
      <div class="mt-5 max-w-3xl text-center mx-auto">
        <p class="text-lg text-white dark:text-gray-400">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem, possimus!</p>
      </div>
  
      <div class="mt-8 gap-3 flex justify-center">
        <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
          Daftar sekarang!
        </button>
      </div>
    </div>
  </div>
  </div>
@endsection