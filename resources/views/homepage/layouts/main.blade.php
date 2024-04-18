<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>
  <body>
    <div class="wrapper">
        @yield("wrapper")
    </div>
    
    @if (isset($kecamatans))
    <div id="dropdownRegister" class="z-10 hidden bg-white rounded-lg shadow max-w-60 dark:bg-gray-700">
      <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
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
    <div id="dropdownRegisterButton" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
      <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRegisterButton">
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
      <ul class=" py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRegisterButton">
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
    <script src="../dist/script-homepage.js"></script>
  </body>
</html>