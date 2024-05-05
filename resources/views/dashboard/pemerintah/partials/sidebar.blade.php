
<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
  <span class="sr-only">Open sidebar</span>
  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
  <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
  </svg>
</button>

<aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
  <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 flex flex-col justify-between">
     <ul class="space-y-2 font-normal">
        <li>
         <div class="flex items-center justify-between">
                        <button id="dropdownProfilButton" data-dropdown-toggle="dropdownProfil" data-dropdown-placement="right-end"  class="flex w-full px-2 items-center gap-4 cursor-pointer text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
              <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <span class="font-medium text-gray-600 dark:text-gray-300">{{ $initials }}</span>
              </div>
              <div class="font-medium dark:text-white">
                  <div>{{ $pemerintah->nama_pengguna }}</div>
              </div>
            </button> 
         </div>
        </li>
        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

        <li>
           <a href="/pemerintah/dashboard" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9 22V12H15V22" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
              <span class="ms-3">Dashboard</span>
           </a>
        </li>
        <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M5 18H3C2.4 18 2 17.6 2 17V7C2 6.4 2.4 6 3 6H13C13.6 6 14 6.4 14 7V18" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M14 9H18L22 13V17C22 17.6 21.6 18 21 18H19" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M7 20C8.10457 20 9 19.1046 9 18C9 16.8954 8.10457 16 7 16C5.89543 16 5 16.8954 5 18C5 19.1046 5.89543 20 7 20Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M15 18H9" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M17 20C18.1046 20 19 19.1046 19 18C19 16.8954 18.1046 16 17 16C15.8954 16 15 16.8954 15 18C15 19.1046 15.8954 20 17 20Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg> 
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Subsidi</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                  <li>
                     <a href="/pemerintah/verifikasi-pengguna" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Verifikasi Pengguna</a>
                  </li>
                  <li>
                     <a href="/pemerintah/alokasi" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Alokasi</a>
                  </li>
                  <li>
                     <a href="/pemerintah/laporan" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Laporan</a>
                  </li>
            </ul>
         </li>
         <li>
           <a href="/pemerintah/faq" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M14 9C14 9.53043 13.7893 10.0391 13.4142 10.4142C13.0391 10.7893 12.5304 11 12 11H6L2 15V4C2 2.9 2.9 2 4 2H12C12.5304 2 13.0391 2.21071 13.4142 2.58579C13.7893 2.96086 14 3.46957 14 4V9Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M18 9H20C20.5304 9 21.0391 9.21071 21.4142 9.58579C21.7893 9.96086 22 10.4696 22 11V22L18 18H12C11.4696 18 10.9609 17.7893 10.5858 17.4142C10.2107 17.0391 10 16.5304 10 16V15" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
               
              <span class="ms-3">FAQ</span>
           </a>
        </li>
        <li>
           <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M9.08997 9.00008C9.32507 8.33175 9.78912 7.76819 10.3999 7.40921C11.0107 7.05024 11.7289 6.91902 12.4271 7.03879C13.1254 7.15857 13.7588 7.52161 14.215 8.06361C14.6713 8.60561 14.921 9.2916 14.92 10.0001C14.92 12.0001 11.92 13.0001 11.92 13.0001" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M12 17H12.01" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>                
              <span class="ms-3">Keluhan</span>
           </a>
        </li>
     </ul>
     <a href="/logout" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-red-200 dark:hover:bg-red-200 group">
         <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16 17L21 12L16 7" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 12H9" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
         </svg>
     <span class="ms-3">Logout</span>
   </a>
  </div>
</aside>

{{-- DROPDOWN --}}

<div id="dropdownProfil" class="z-50 hidden">
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
                             Nama Pengguna
                         </th>
                         <td class="px-2 py-3">
                             {{ $pemerintah->nama_pengguna }}
                         </td>
                     </tr>
                     <tr>
                       <th>
                         <a href="/pemerintah/ganti-sandi" class="inline-flex px-2 pt-3 pb-2 font-medium whitespace-nowrap items-center text-blue-600 hover:underline">
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