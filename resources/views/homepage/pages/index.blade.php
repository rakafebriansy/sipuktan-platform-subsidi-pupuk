@extends('homepage.layouts.main')
@section('wrapper')
<div id="beranda" class="relative overflow-hidden top-0 start-1/2 bg-no-repeat bg-top size-full z-5 transform -translate-x-1/2">
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
<div id="telegram" class="bg-[#F0FFE6] md:bg-gradient-to-l md:from-[rgba(97,129,35,0.8)] md:via-white md:via-40% md:to-white py-10 md:py-20">
  <div class="flex flex-col items-center justify-center">
    <div class="flex justify-start w-[80%] mb-5">
      <p class="text-3xl md:text-4xl font-semibold md:font-bold">Cara Menggunakan Bot Telegram SIPUKTAN</p>
    </div>
    <div class="flex flex-col-reverse md:grid md:grid-cols-3 h-full w-[80%]">
      <div class="col-span-2 mt-7">
        <div class="p-2 md:p-5 box-border text-sm md:text-base">
          <ul>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-7 md:w-10 h-7 md:h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center me-3">
                <div class="">1</div>
              </div>
              <div class="inline w-[90%]">Cari username sipuktan_bot pada kolom pencarian telegram atau klik <a class="text-blue-600 hover:underline" href="https://t.me/sipuktan_bot">disini</a>.</div>
            </li>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-7 md:w-10 h-7 md:h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center me-3">
                <div class="">2</div>
              </div>
              <div class="inline w-[90%]">Ketik pertanyaan atau permasalahan yang ingin ditanyakan.</div>
            </li>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-7 md:w-10 h-7 md:h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center me-3">
                <div class="">3</div>
              </div>
              <div class="inline w-[90%]">Sipuktan_bot akan otomatis membalas dengan mengirimkan pilihan kata kunci bot yang bisa digunakan.</div>
            </li>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-7 md:w-10 h-7 md:h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center me-3">
                <div class="">4</div>
              </div>
              <div class="inline w-[90%]">Pilih salah satu kata kunci yang mewakili pertanyaan atau permasalahan.</div>
            </li>
            <li class="w-full flex justify-between items-center mb-5">
              <div class="w-7 md:w-10 h-7 md:h-10 rounded-full inline-flex bg-[#B3DBC2] justify-center items-center me-3">
                <div class="">5</div>
              </div>
              <div class="inline w-[90%]">Telegram secara otomatis akan menjawab pertanyaan atau permasalahanmu.</div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-span-1 flex justify-center items-center mt-2">
        <img src="../images/Telegram Sipuktan.png" class="h-full" alt="">
      </div>
    </div>
  </div>
</div>
<div id="faq" class="flex flex-col items-center justify-center w-full mb-10">
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
<div id="kolaborasi" class="flex justify-center bg-[#F0FFE6] py-20">
  <div class="w-[80%] grid grid-cols-2 gap-[10%]">
    <div class="">
      <h2 class="text-4xl font-semibold">Pupuk Subsidi</h2>
      <h2 class="mt-1 text-4xl font-semibold text-[#4CAF4F]">Petani Membangun Negeri</h2>
      <p class="mt-2">Dedikasi Kolaborasi Program Pemerintah Pupuk Subsidi</p>
    </div>
    <div class="grid grid-cols-2 w-full">
      <div class="h-full grid grid-rows-2 gap-4">
        <div class="flex justify-end">
          <div class="flex justify-start gap-4 w-[60%]">
            <img src="{{ asset('images/petani-landing.png') }}" alt="">
            <div class="flex flex-col justify-center">
              <p class="text-xl font-bold">{{ $count_info['petani'] }}</p>
              <p class="text-xs">Petani</p>
            </div>
          </div>
        </div>
        <div class="flex justify-end">
          <div class="flex justify-start gap-4 w-[60%]">
            <img src="{{ asset('images/pupuk-landing.png') }}" alt="">      
            <div class="flex flex-col justify-center">
              <p class="text-xl font-bold">{{ $count_info['pupuk'] }}kg</p>
              <p class="text-xs">Pupuk</p>
            </div>
          </div>
        </div>
      </div>
      <div class="h-full grid grid-rows-2 gap-4">
        <div class="flex justify-end">
          <div class="flex justify-start gap-4 w-[60%]">
            <img src="{{ asset('images/poktan-landing.png') }}" alt="">
            <div class="flex flex-col justify-center">
              <p class="text-xl font-bold">{{ $count_info['poktan'] }}</p>
              <p class="text-xs">Kelompok Tani</p>
            </div>
          </div>
        </div>
        <div class="flex justify-end">
          <div class="flex justify-start gap-4 w-[60%]">
            <img src="{{ asset('images/kios-landing.png') }}" alt="">
            <div class="flex flex-col justify-center">
              <p class="text-xl font-bold">{{ $count_info['kios_resmi'] }}</p>
              <p class="text-xs">Kios Resmi</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="tujuan" class="flex justify-center py-20">
  <div class="w-[80%] text-center flex flex-col justify-center gap-2 font-thin">
    <h2 class="text-4xl font-bold">Tujuan Dedikasi Bersama</h2>
    <p>Kami hadir untuk</p>
    <div class="w-full grid grid-cols-3 text-center mt-10 gap-16">
      <div class="flex flex-col justify-center items-center border-box p-10 gap-1 shadow-md">
        <img src="{{ asset('images/transparansi-informasi.png') }}" alt="">
        <h3 class="text-3xl font-semibold mb-1">Transparansi Informasi</h3>
        <p>Kami memfasilitasi transparansi informasi alokasi subsidi pupuk bagi petani dan kios resmi</p>
      </div>
      <div class="flex flex-col justify-center items-center border-box p-10 gap-1 shadow-md">
        <img src="{{ asset('images/transparansi-informasi.png') }}" alt="">
        <h3 class="text-3xl font-semibold mb-1">Kualitas Hasil Panen</h3>
        <p>Kami membantu petani untuk bisa memastikan kualitas pupuk subsidi mampu membantu meningkatkan kualitas hasil panen</p>
      </div>
      <div class="flex flex-col justify-center items-center border-box p-10 gap-1 shadow-md">
        <img src="{{ asset('images/transparansi-informasi.png') }}" alt="">
        <h3 class="text-3xl font-semibold mb-1">Pengawasan Subsidi</h3>
        <p>Kami berusaha memberikan pengawasan yang maksimal terhadap penyebaran dan pembelian pupuk subsidi untuk mencegah keterlibatan pihak illegal</p>
      </div>
    </div>
  </div>
</div>
<div class="flex justify-center bg-[#F0FFE6] py-20">
  <img class="w-[30%]" src="{{ asset('images/sipuktan.png') }}" alt="">
</div>
<div class="flex flex-col items-center justify-center py-20 gap-4">
  <ul class="flex justify-center gap-8">
    <li><a href="#beranda" class="hover:underline">Beranda</a></li>
    <li><a href="#telegram" class="hover:underline">Bot Telegram</a></li>
    <li><a href="#faq" class="hover:underline">FAQ</a></li>
    <li><a href="#kolaborasi" class="hover:underline">Kolaborasi</a></li>
    <li><a href="#tujuan" class="hover:underline">Tujuan</a></li>
  </ul>
  <p class="text-small text-gray-500">© Copyright 2024 - SIPUKTAN</p>
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