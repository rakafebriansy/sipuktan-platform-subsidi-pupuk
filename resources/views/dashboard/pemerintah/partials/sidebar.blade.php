
<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
  <span class="sr-only">Open sidebar</span>
  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
  <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
  </svg>
</button>

<aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
  <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 flex flex-col justify-start">
     <ul class="space-y-2 font-normal">
        <li>
         <div class="flex items-center justify-between">
            <button id="dropdownProfilButton" data-dropdown-toggle="dropdownProfil" data-dropdown-placement="right-end"  class="flex w-full px-2 items-center gap-4 cursor-pointer text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
              <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <span class="font-medium text-gray-600 dark:text-gray-300">{{ $initials }}</span>
              </div>
              <div class="font-medium dark:text-white">
                  <div id="pemerintah" data-id="{{ $pemerintah->id }}">{{ $pemerintah->nama_pengguna }}</div>
              </div>
            </button> 
            <button id="dropdownNotifikasiButton" data-dropdown-toggle="dropdownNotifikasi" data-dropdown-offset-skidding="100" data-dropdown-offset-distance="25" data-dropdown-placement="bottom-end" class="hover:bg-gray-200 rounded-full dark:hover:bg-gray-700 p-2">
               <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
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
           <a href="/pemerintah/keluhan" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M9.08997 9.00008C9.32507 8.33175 9.78912 7.76819 10.3999 7.40921C11.0107 7.05024 11.7289 6.91902 12.4271 7.03879C13.1254 7.15857 13.7588 7.52161 14.215 8.06361C14.6713 8.60561 14.921 9.2916 14.92 10.0001C14.92 12.0001 11.92 13.0001 11.92 13.0001" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M12 17H12.01" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>                
              <span class="ms-3">Keluhan</span>
           </a>
        </li>
        <li>
           <a href="/pemerintah/kelompok-tani" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.64002 14L6.59002 11.96M15.34 15L12.88 12.54M2.27002 21.7C2.27002 21.7 12.14 18.2 15 15.34C15.4183 14.9224 15.7502 14.4265 15.9768 13.8807C16.2034 13.3348 16.3203 12.7496 16.3208 12.1586C16.3212 11.5675 16.2053 10.9822 15.9795 10.4359C15.7538 9.88971 15.4226 9.39329 15.005 8.97503C14.5874 8.55677 14.0915 8.22486 13.5456 7.99825C12.9998 7.77164 12.4146 7.65476 11.8236 7.6543C11.2325 7.65383 10.6472 7.76979 10.1009 7.99554C9.5547 8.2213 9.05828 8.55243 8.64002 8.97003C5.77002 11.84 2.27002 21.7 2.27002 21.7Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M22 9C22 9 20.67 7 18.5 7C16.86 7 15 9 15 9C15 9 16.33 11 18.5 11C20.67 11 22 9 22 9Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M15 2C15 2 13 3.33 13 5.5C13 7.67 15 9 15 9C15 9 17 7.16 17 5.5C17 3.33 15 2 15 2Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>                             
              <span class="ms-3">Kelompok Tani</span>
           </a>
        </li>
        <li>
          <a href="/pemerintah/logout" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-red-200 dark:hover:bg-red-200 group">
              <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                 <path d="M16 17L21 12L16 7" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                 <path d="M21 12H9" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
          <span class="ms-3">Logout</span>
        </a>
        </li>
     </ul>
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
                         <a href="/pemerintah/ubah-sandi" class="inline-flex px-2 pt-3 pb-2 font-medium whitespace-nowrap items-center text-blue-600 hover:underline">
                           Ubah kata sandi
                         </a>
                       </th>
                     </tr>
                 </tbody>
             </table>
         </div>
     </div>
   </div>
 </div>
 <div id="dropdownNotifikasi" class="z-50 hidden min-h-8 bg-white divide-y divide-gray-100 rounded-lg shadow min-w-44 max-w-80 dark:bg-gray-700 dark:divide-gray-600">
   <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
     <div>Notifikasi</div>
   </div>
   <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
     @if (count($notifikasis))
       @foreach ($notifikasis as $notifikasi)
       @if (str_contains($notifikasi,'Keluhan'))
          <li id="notifikasi-{{ $notifikasi->id }}" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Pemberitahuan</span>
            <div class="ms-3 text-sm font-medium">
                {{ $notifikasi->isi }}
            </div>
            <button data-id="{{ $notifikasi->id }}" type="button" onclick="deleteNotifikasi(this,'notifikasi-{{ $notifikasi->id }}')" class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700" data-dismiss-target="#notifikasi-{{ $notifikasi->id }}" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
          </li>
          @else
         <li id="notifikasi-{{ $notifikasi->id }}" class="flex items-center p-4 text-blue-800 bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
           <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
             <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
           </svg>
           <span class="sr-only">Info</span>
           <div class="ms-3 text-sm font-medium">
             {{ $notifikasi->isi }}
           </div>
             <button data-id="{{ $notifikasi->id }}" type="button" onclick="deleteNotifikasi(this, 'notifikasi-{{ $notifikasi->id }}')" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#notifikasi-{{ $notifikasi->id }}" aria-label="Close">
               <span class="sr-only">Close</span>
               <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
               </svg>
           </button>
         </li>
       @endif
       @endforeach
     @else
       <li id="no-notification" class="flex justify-center p-2">
         <p class="font-medium text-gray-400 whitespace-nowrap dark:text-white">Belum ada notifikasi</p>
       </li>
     @endif
   </ul>
 </div>