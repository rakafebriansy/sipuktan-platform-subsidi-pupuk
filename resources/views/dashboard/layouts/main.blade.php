<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>
  <body>
    @include('dashboard.layouts.sidebar') <?php //memanggil keseluruhan kode program dari file lain?>
    <div class="wrapper">
        @yield("wrapper") <?php //inisiasi wadah kode program dari views?>
    </div>
    <div id="dropdownPetani" class="z-50 hidden">
      <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7] w-[22rem]">
        <div class="bg-gray-100 border-b rounded-t-xl py-1 px-4 md:py-1 md:px-4 dark:bg-slate-900 dark:border-gray-700">
          <p class="mt-1 text-sm text-gray-500 dark:text-gray-500">
            Informasi Akun
          </p>
        </div>
        <div class="p-1 md:p-2">
            <div class="relative overflow-x-auto">
                <table class=" text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Nama Lengkap
                            </th>
                            <td class="px-2 py-3">
                                Mohammad Faqih
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Kelompok Tani
                            </th>
                            <td class="px-2 py-3">
                                Makmur jaya
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Kios Resmi
                            </th>
                            <td class="px-2 py-3">
                                Jl. Mangga, no .15
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Nomor Telepon
                            </th>
                            <td class="px-2 py-3">
                                081242526781
                            </td>
                        </tr>
                        <tr>
                          <th>
                            <a href="#" class="inline-flex px-2 pt-3 pb-2 font-medium whitespace-nowrap items-center text-blue-600 hover:underline">
                              Ganti kata sandi
                            </a>
                          </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
  </div>
    <script src="../dist/script-dashboard.js"></script>
  </body>
</html>