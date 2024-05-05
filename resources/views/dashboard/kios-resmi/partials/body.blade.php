@extends('dashboard.layouts.main')
@section('main')
@include('dashboard.kios-resmi.partials.sidebar') <?php //memanggil keseluruhan kode program dari file lain?>
<div class="wrapper relative">
  @if ($errors->any())
  <div id="alert-2" class="absolute z-50 left-1/2 transform -translate-x-1/2 top-5 flex border border-red-300 dark:border-red-800 min-h-[5%] items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    <span class="sr-only">Peringatan</span>
    <div class="text-sm font-medium">
      {{ $errors->first() }}
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
    </button>
  </div>
  @elseif (session('success'))
  <div id="alert-1" class="absolute z-50 left-1/2 transform -translate-x-1/2 top-5 flex items-center p-4 mb-4 text-blue-800 border  border-blue-300  dark:border-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
    <span class="sr-only">Sukses</span>
    <div class="text-sm font-medium">
      {{ Session::get('success') }}
    </div>
      <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
  </div>
  @endif
    @yield("wrapper")
</div>

@endsection