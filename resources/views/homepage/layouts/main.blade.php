<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>
  <body>
    <div class="wrapper">
        @yield("wrapper")
    </div>
    

  
    <!-- Dropdown menu -->
    <div id="dropdownPoktan" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
      <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
        <li>
          <p href="#" data-value="1" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
            Jese Leos
          </p>
        </li>
        <li>
          <p href="#" data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
            Robert Gough
          </p>
        </li>
      </ul>
    </div>  
    <script src="../dist/script-homepage.js"></script>
  </body>
</html>