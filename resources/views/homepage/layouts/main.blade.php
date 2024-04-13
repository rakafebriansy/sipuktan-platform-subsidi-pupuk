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
          <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Jese Leos
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Robert Gough
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Bonnie Green
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Leslie Livingston
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Michael Gough
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Joseph Mcfall
          </a>
        </li>
              <li>
          <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Roberta Casas
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Neil Sims
          </a>
        </li>
      </ul>
    </div>  
    <script src="../dist/script.js"></script>
  </body>
</html>