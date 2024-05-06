
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
            <button id="dropdownProfilButton" data-dropdown-toggle="dropdownProfil" data-dropdown-offset-distance="25" data-dropdown-placement="bottom-start"  class="flex w-full px-2 items-center gap-4 cursor-pointer text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
              <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <span class="font-medium text-gray-600 dark:text-gray-300">{{ $initials }}</span>
              </div>
              <div class="font-medium dark:text-white">
                  <div id="kios-resmi" data-id="{{ $kios_resmi->id }}">{{ $kios_resmi->pemilik }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">Pemilik Kios</div>
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
           <a href="/kios-resmi/dashboard" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9 22V12H15V22" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
              <span class="ms-3">Dashboard</span>
           </a>
        </li>
        <li>
           <a href="/kios-resmi/alokasi" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M5 18H3C2.4 18 2 17.6 2 17V7C2 6.4 2.4 6 3 6H13C13.6 6 14 6.4 14 7V18" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M14 9H18L22 13V17C22 17.6 21.6 18 21 18H19" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M7 20C8.10457 20 9 19.1046 9 18C9 16.8954 8.10457 16 7 16C5.89543 16 5 16.8954 5 18C5 19.1046 5.89543 20 7 20Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M15 18H9" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M17 20C18.1046 20 19 19.1046 19 18C19 16.8954 18.1046 16 17 16C15.8954 16 15 16.8954 15 18C15 19.1046 15.8954 20 17 20Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>  
              <span class="ms-3">Alokasi</span>
           </a>
        </li>
        <li>
           <a href="/kios-resmi/transaksi" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8 22C8.55228 22 9 21.5523 9 21C9 20.4477 8.55228 20 8 20C7.44772 20 7 20.4477 7 21C7 21.5523 7.44772 22 8 22Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M19 22C19.5523 22 20 21.5523 20 21C20 20.4477 19.5523 20 19 20C18.4477 20 18 20.4477 18 21C18 21.5523 18.4477 22 19 22Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M2.05005 2.05005H4.05005L6.71005 14.47C6.80763 14.9249 7.06072 15.3315 7.42576 15.6199C7.7908 15.9083 8.24495 16.0604 8.71005 16.05H18.49C18.9452 16.0493 19.3865 15.8933 19.7411 15.6079C20.0956 15.3224 20.3422 14.9246 20.4401 14.48L22.09 7.05005H5.12005" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
              <span class="ms-3">Transaksi Pupuk</span>
           </a>
        </li>
        <li>
           <a href="/kios-resmi/riwayat-transaksi" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3 12C3 13.78 3.52784 15.5201 4.51677 17.0001C5.50571 18.4802 6.91131 19.6337 8.55585 20.3149C10.2004 20.9961 12.01 21.1743 13.7558 20.8271C15.5016 20.4798 17.1053 19.6226 18.364 18.364C19.6226 17.1053 20.4798 15.5016 20.8271 13.7558C21.1743 12.01 20.9961 10.2004 20.3149 8.55585C19.6337 6.91131 18.4802 5.50571 17.0001 4.51677C15.5201 3.52784 13.78 3 12 3C9.48395 3.00947 7.06897 3.99122 5.26 5.74L3 8" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M3 3V8H8" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M12 7V12L16 14" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
              <span class="ms-3">Riwayat Transaksi</span>
           </a>
        </li>
        <li>
           <a href="/kios-resmi/laporan" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M14.5 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V7.5L14.5 2Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M14 2V8H20" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M8 13H10" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M8 17H10" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M14 13H16" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M14 17H16" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>                
              <span class="ms-3">Laporan</span>
           </a>
        </li>
        <li>
           <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M9.08997 9.00008C9.32507 8.33175 9.78912 7.76819 10.3999 7.40921C11.0107 7.05024 11.7289 6.91902 12.4271 7.03879C13.1254 7.15857 13.7588 7.52161 14.215 8.06361C14.6713 8.60561 14.921 9.2916 14.92 10.0001C14.92 12.0001 11.92 13.0001 11.92 13.0001" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M12 17H12.01" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>                
              <span class="ms-3">Bantuan</span>
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

<div id="dropdownNotifikasi" data-token="{{ csrf_token() }}" class="z-50 hidden min-h-8 bg-white divide-y divide-gray-100 rounded-lg shadow min-w-44 max-w-80 dark:bg-gray-700 dark:divide-gray-600">
  <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
    <div>Notifikasi</div>
  </div>
  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
    @if (count($notifikasis))
      @foreach ($notifikasis as $notifikasi)
        <li>
          <div id="notifikasi-{{ $notifikasi->id }}" class="flex items-center p-4 text-blue-800 bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
              {{ $notifikasi->isi }}
            </div>
              <button data-id="{{ $notifikasi->id }}" type="button" onclick="deleteNotifikasi(this)" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#notifikasi-{{ $notifikasi->id }}" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
          </div>
        </li>
      @endforeach
    @else
      <li id="no-notification" class="flex justify-center p-2">
        <p class="font-medium text-gray-400 whitespace-nowrap dark:text-white">Belum ada notifikasi</p>
      </li>
    @endif
  </ul>
</div>

<div id="dropdownProfil" class="z-50 hidden">
   <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7] min-w-[16rem]">
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
                             {{ $kios_resmi->pemilik }}
                         </td>
                     </tr>
                     <tr class="bg-white dark:bg-gray-800">
                         <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                             Nama Kios
                         </th>
                         <td class="px-2 py-3">
                             {{ $kios_resmi->nama }}
                         </td>
                     </tr>
                     <tr class="bg-white dark:bg-gray-800">
                         <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                             Alamat Kios
                         </th>
                         <td class="px-2 py-3">
                             {{ $kios_resmi->jalan }}, {{ $kios_resmi->kecamatan }}
                         </td>
                     </tr>
                     <tr class="bg-white dark:bg-gray-800">
                         <th scope="row" class="px-2 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                             Nomor Telepon 
                         </th>
                         <td class="px-2 py-3">
                             <p class="inline">{{ $kios_resmi->nomor_telepon }}</p> <button data-modal-target="editNoTelpModal" data-modal-toggle="editNoTelpModal" onclick="editNoTelpPassId(this,'kios-resmi')" class="text-blue-500 hover:underline">ubah</button>
                         </td>
                     </tr>
                     <tr>
                       <th>
                         <a href="/kios-resmi/ganti-sandi" class="inline-flex px-2 pt-3 pb-2 font-medium whitespace-nowrap items-center text-blue-600 hover:underline">
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
<div id="editNoTelpModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                  Edit Nomor Telepon
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editNoTelpModal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          
          <form  action="/kios-resmi/ganti-nomor-telepon" method="post" class="p-4 md:p-5">
            @csrf
            @method('patch')
            <input type="hidden" name="id">
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="nomor_disabled" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon Lama</label>
                    <input type="text" name="nomor_disabled" disabled class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
                <div class="col-span-2">
                    <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon Baru</label>
                    <input type="text" name="nomor_telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
            </div>
            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Ubah data
            </button>
          </form>
      </div>
  </div>
</div> 