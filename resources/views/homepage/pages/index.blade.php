@extends('homepage.layouts.main')
@section('wrapper')
<div class="relative overflow-hidden top-0 start-1/2 bg-no-repeat bg-top size-full z-5 transform -translate-x-1/2">
  <img src="{{ asset('/images/farmer.webp') }}" class="w-full h-full absolute z-20" alt="">
  <div class="bg-gradient-to-b from-[rgba(0,0,0,0)] to-[rgba(0,0,0,0.6)] w-full h-full absolute z-30"></div>
  <div class="w-full h-full justify-center items-center flex z-40 relative">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 ">
      <div class="flex justify-center">
        <span class="inline-flex items-center gap-x-2 bg-[rgba(255,255,255,0.7)] border border-gray-200 text-xs text-gray-600 p-2 px-3 rounded-full transition hover:border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:border-gray-600 dark:text-gray-400" href="#">
          Sudah memiliki akun?
          <button type="button" id="dropdownLoginButton" data-dropdown-toggle="dropdownLogin" data-dropdown-placement="right" data-dropdown-offset-distance="25" class="flex items-center gap-x-1">
            <p class="border-s border-gray-200 text-blue-600 ps-2 dark:text-blue-500 dark:border-gray-700">Masuk</p>
            <svg class="flex-shrink-0 size-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
          </button>
        </span>
      </div>
  
      <div class="mt-5 max-w-4xl text-center mx-auto">
        <h1 class="block font-bold text-white text-4xl md:text-5xl lg:text-6xl dark:text-gray-200">
          Sistem Informasi Subsidi Pupuk Petani Terintegrasi
        </h1>
      </div>
  
      <div class="mt-5 max-w-6xl text-center mx-auto">
        <p class="text-lg text-white dark:text-gray-400">
          Solusi terdepan untuk meningkatkan kesejahteraan petani dan mendukung pertanian yang berkelanjutan! Dengan sistem ini, petani dapat dengan mudah mengakses subsidi pupuk yang dibutuhkan, memastikan produksi yang lebih baik dan keberlanjutan lingkungan dengan dukungan pemerintah yang efektif.
        </p>
      </div>
  
      <div class="mt-8 gap-3 flex justify-center">
        <button type="button" id="dropdownDaftarButton" data-dropdown-toggle="dropdownDaftar" data-dropdown-placement="bottom" data-dropdown-offset-distance="15" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
          Daftar sekarang!
        </button>
      </div>
    </div>
  </div>
</div>
<div class="grid grid-rows-5 bg-gradient-to-l from-[rgba(97,129,35,0.8)] via-white via-40% to-white">
  <div class="row-span-1"></div>
  <div class="flex flex-col items-center justify-center row-span-3">
    <div class="grid grid-cols-3 h-full w-[80%]">
      <div class="col-span-2">
        <div class="">
          <p class="text-4xl font-bold">Cara Menggunakan Telegram SIPUKTAN</p>
        </div>
        <div class="p-5 box-border">
          <ul>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-10 h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center">
                <div class="">1</div>
              </div>
              <div class="inline w-[90%]">Cari username sipuktan_bot pada kolom pencarian telegram atau klik <a class="text-blue-600 hover:underline" href="https://t.me/sipuktan_bot">disini</a>.</div>
            </li>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-10 h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center">
                <div class="">2</div>
              </div>
              <div class="inline w-[90%]">Ketik pertanyaan atau permasalahan yang ingin ditanyakan.</div>
            </li>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-10 h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center">
                <div class="">3</div>
              </div>
              <div class="inline w-[90%]">Sipuktan_bot akan otomatis membalas dengan mengirimkan pilihan kata kunci bot yang bisa digunakan.</div>
            </li>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-10 h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center">
                <div class="">4</div>
              </div>
              <div class="inline w-[90%]">Pilih salah satu kata kunci yang mewakili pertanyaan atau permasalahan.</div>
            </li>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-10 h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center">
                <div class="">5</div>
              </div>
              <div class="inline w-[90%]">Telegram secara otomatis akan menjawab pertanyaan atau permasalahanmu.</div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-span-1 flex justify-center items-center">
        <img src="../images/Telegram Sipuktan.png" class="h-full" alt="">
      </div>
    </div>
  </div>
</div>
<div class="flex flex-col items-center justify-center w-full">
  <div class=" h-24 flex items-center justify-center">
    <h1 class="text-4xl font-bold">FAQ</h1>
  </div> 
  <div class="w-[90%] grid grid-cols-2 gap-8">
    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
      @foreach ($faqs_petani as $faq_petani)
        <h2 id="accordion-flush-heading-{{ $faq_petani->id }}">
          <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-{{ $faq_petani->id }}" aria-expanded="true" aria-controls="accordion-flush-body-{{ $faq_petani->id }}">
            <span>{{ $faq_petani->pertanyaan }}</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
          </button>
        </h2>
        <div id="accordion-flush-body-{{ $faq_petani->id }}" class="hidden" aria-labelledby="accordion-flush-heading-{{ $faq_petani->id }}">
          <div class="py-5 border-b border-gray-200 dark:border-gray-700">
            <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $faq_petani->jawaban }}</p>
          </div>
        </div>
      @endforeach
    </div>
    <div id="accordion-flush2" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
      @foreach ($faqs_kios_resmi as $faq_kios_resmi)
        <h2 id="accordion-flush2-heading-{{ $faq_kios_resmi->id }}">
          <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush2-body-{{ $faq_kios_resmi->id }}" aria-expanded="true" aria-controls="accordion-flush2-body-{{ $faq_kios_resmi->id }}">
            <span class=" text-start">{{ $faq_kios_resmi->pertanyaan }}</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
          </button>
        </h2>
        <div id="accordion-flush2-body-{{ $faq_kios_resmi->id }}" class="hidden" aria-labelledby="accordion-flush2-heading-{{ $faq_kios_resmi->id }}">
          <div class="py-5 border-b border-gray-200 dark:border-gray-700">
            <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $faq_kios_resmi->jawaban }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>



{{-- DROPDOWN --}}
<div id="dropdownLogin" class="z-50 cursor-pointer hidden bg-white rounded-lg shadow-2xl w-28 dark:bg-gray-700">
  <ul class=" py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLoginButton">
    <li>
      <a href="/petani/login" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
        Petani
      </a>
    </li>
    <li>
      <a href="/kios-resmi/login" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
        Kios Resmi
      </a>
    </li>
  </ul>
</div> 
<div id="dropdownDaftar" class="z-50 cursor-pointer hidden bg-white rounded-lg shadow-2xl w-28 dark:bg-gray-700">
  <ul class=" py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDaftarButton">
    <li>
      <a href="/petani/register" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
        Petani
      </a>
    </li>
    <li>
      <a href="/kios-resmi/register" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
        Kios Resmi
      </a>
    </li>
  </ul>
</div> 
@endsection