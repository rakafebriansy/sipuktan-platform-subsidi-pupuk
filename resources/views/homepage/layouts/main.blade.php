<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title : 'ERROR' }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>
  <body>
    <div class="wrapper relative">
      @if ($errors->any())
      <div id="alert-2" class="absolute z-50 left-1/2 transform -translate-x-1/2  top-5 flex border border-red-300 dark:border-red-800 min-h-[5%] items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
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
      <div id="alert-1" class="absolute z-50 left-1/2 transform -translate-x-1/2  top-5 flex items-center p-4 mb-4 text-blue-800 border  border-blue-300  dark:border-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
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
    @elseif (session('unverified'))
    <div class="absolute z-50 left-1/2 transform -translate-x-1/2  top-5 mt-2 bg-blue-100 border border-blue-200 text-sm text-blue-800 rounded-lg p-4 dark:bg-blue-800/10 dark:border-blue-900 dark:text-blue-500" role="alert">
      <span class="font-bold">Info</span> {{ Session::get('unverified') }}
    </div>
    @endif
      @yield("wrapper")
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
    @elseif (isset($kelompok_tanis))
    <div id="dropdownRegister" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
      <ul class="max-h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRegisterButton">
            @foreach ($kelompok_tanis as $kelompok_tani)
            <li>
              <p data-value="{{ $kelompok_tani->id }}" class="flex cursor-pointer items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
                {{ $kelompok_tani->nama }}
              </p>
            </li>
            @endforeach
        </ul>
      </div>  
    @endif
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
    <script src="../dist/script-homepage.js"></script>
  </body>
</html>