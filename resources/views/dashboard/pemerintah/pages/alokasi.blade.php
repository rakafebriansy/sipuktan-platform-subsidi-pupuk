@extends('dashboard.pemerintah.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <p>Alokasi Pupuk</p>
                    <div class="flex justify-between items-center my-3">
                        <button data-modal-target="tambahAlokasiModal" data-modal-toggle="tambahAlokasiModal" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                            Tambah data
                          </button>
                        <div class="flex gap-4">
                            <button id="dropdownTahunButton" data-dropdown-toggle="dropdownTahun" data-dropdown-placement="bottom" class="py-2.5 px-5 text-sm font-medium text-gray-900 justify-between focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center " type="button"><p>{{ isset($tahun) ? $tahun : $tahuns[0]->tahun }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                            <button id="dropdownMTButton" data-dropdown-toggle="dropdownMT" data-dropdown-placement="bottom" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none min-w-24 justify-between bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 text-center inline-flex items-center cursor-pointer" type="button"><p>{{ isset($mt) ? $mt : 'MT1' }}</p><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </caption>
                @if(count($alokasis))
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Petani</p>
                        </th>
                        
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jumlah</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jenis Pupuk</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Status</p>
                        </th>
                        <th scope="col" class="py-3 md:w-[40%] lg:w-[25%]">
                            <span class="inline-block">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alokasis as $alokasi)
                    <tr class="alokasi-rows bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $alokasi->nama }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $alokasi->jumlah_pupuk }}
                        </td>
                        <td class="px-6 py-4" data-value="{{ $alokasi->jenis_pupuk->id }}">
                            {{ $alokasi->jenis }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $alokasi->status }}
                        </td>
                        <td data-id="{{ $alokasi->id_alokasi }}" data-poktan="{{ $alokasi->poktan }}" data-kios="{{ $alokasi->kios_resmi }}" data-nik="{{ $alokasi->nik }}" data-ktp="{{ $alokasi->foto_ktp }}" data-nomor="{{ $alokasi->nomor_telepon }}" class="py-4 flex flex-row ">
                            <button  data-modal-target="detailAlokasiModal" data-modal-toggle="detailAlokasiModal" onclick="detailPassId(this)" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Detail</button>
                            <button data-modal-target="editAlokasiModal" data-modal-toggle="editAlokasiModal" onclick="editPassId(this)" class=" bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Edit</button>
                            <button data-modal-target="deleteAlokasiModal" data-modal-toggle="deleteAlokasiModal" onclick="deletePassId(this)" class=" bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Hapus</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                @else
                <div class="flex justify-center">
                    <thead>
                        <th class="text-center">
                            <h1 class="p-5">Belum ada data.</h1>
                        </th>
                    </thead>
                    <tbody>
                        <td>
                        </td>
                    </tbody>
                </div>
                @endif
            </table>
        </div>
    </div>
</div>

{{-- DROPDOWN --}}

<div id="dropdownTahun" class="z-50 hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="py-2 max-h-36 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
      @foreach ($tahuns as $tahun)
      <li onclick="getAlokasiFromTh(this,'pemerintah')">
        
        <p class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer alokasi-tahun">
          {{ $tahun->tahun }}
        </p>
      </li>
      @endforeach
    </ul>
</div> 
<div id="dropdownMT" class="z-50 cursor-pointer hidden bg-white rounded-lg shadow w-24 dark:bg-gray-700">
    <ul class="h-36 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
      <li onclick="getAlokasiFromMt(this,'pemerintah')">
        <p href="#" data-value="1" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT1
        </p>
      </li>
      <li onclick="getAlokasiFromMt(this,'pemerintah')">
        <p href="#" data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT2
        </p>
      </li>
      <li onclick="getAlokasiFromMt(this,'pemerintah')">
        <p href="#" data-value="2" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white poktan">
          MT3
        </p>
      </li>
    </ul>
</div> 
<div id="tambahAlokasiModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Data Alokasi Pupuk
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="tambahAlokasiModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <form  action="/pemerintah/alokasi" method="post" class="p-4 md:p-5">
              @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                        <input type="text" name="nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="jumlah_pupuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                        <input type="number" name="jumlah_pupuk"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                        <input type="number" name="tahun"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="id_jenis_pupuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Pupuk</label>
                        <select name="id_jenis_pupuk"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Pilih Jenis</option>
                            @if (isset($jenis_pupuks))
                              @foreach ($jenis_pupuks as $jenis_pupuk)
                                <option value="{{ $jenis_pupuk->id }}">{{ $jenis_pupuk->jenis }}</option>
                              @endforeach
                            @endif
                        </select>
                    </div>
  
                    <div class="col-span-2 sm:col-span-1">
                        <label for="musim_tanam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Musim Tanam</label>
                        <select name="musim_tanam"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Pilih Musim Tanam</option>
                            <option value="MT1">MT 1</option>
                            <option value="MT2">MT 2</option>
                            <option value="MT3">MT 3</option>
                        </select>
                    </div>
   
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Tambah data
                </button>
            </form>
        </div>
    </div>
  </div> 
  <div id="editAlokasiModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Data Alokasi Pupuk
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editAlokasiModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <form  action="/pemerintah/alokasi" method="post" class="p-4 md:p-5">
              @csrf
              @method('patch')
              <input type="hidden" name="id" id="editAlokasiId">
              <div class="grid gap-4 mb-4 grid-cols-2">
                  <div class="col-span-2">
                      <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                      <input type="text" name="nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label for="jumlah_pupuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                      <input type="number" name="jumlah_pupuk"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                      <input type="number" name="tahun"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label for="id_jenis_pupuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Pupuk</label>
                      <select name="id_jenis_pupuk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                          <option selected="">Pilih Jenis</option>
                          @if (isset($jenis_pupuks))
                          @foreach ($jenis_pupuks as $jenis_pupuk)
                              <option value="{{ $jenis_pupuk->id }}">{{ $jenis_pupuk->jenis }}</option>
                          @endforeach
                          @endif
                      </select>
                  </div>
  
                  <div class="col-span-2 sm:col-span-1">
                      <label for="musim_tanam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Musim Tanam</label>
                      <select name="musim_tanam"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                          <option selected="">Pilih Musim Tanam</option>
                          <option value="MT1">MT1</option>
                          <option value="MT2">MT2</option>
                          <option value="MT3">MT3</option>
                      </select>
                  </div>
  
              </div>
              <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  Ubah data
              </button>
            </form>
        </div>
    </div>
  </div> 
  <div id="deleteAlokasiModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-sm max-h-full">
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteAlokasiModal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
              <form method="post" action="/pemerintah/alokasi" class="p-4 md:p-5 text-center">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="" id="deleteAlokasiId">
                <input type="hidden" name="tahun" value="" id="deleteAlokasiTahun">
                <input type="hidden" name="musim_tanam" value="" id="deleteAlokasiMT">
                  <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                  <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Data yang telah dihapus tidak dapat dipulihkan, apakah anda yakin ingin menghapus data?</h3>
                  <button data-modal-hide="deleteAlokasiModal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                      Hapus
                  </button>
                  <button data-modal-hide="deleteAlokasiModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
              </form>
          </div>
      </div>
  </div>
  <div id="detailAlokasiModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-sm max-h-full">
          <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <div class="flex flex-col items-center py-4 relative">
                  <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detailAlokasiModal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
                  <div id="detailAlokasiBody" class="flex flex-col justify-center items-center w-[90%]">
                      <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="" alt="Foto KTP"/>
                      <table class=" text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-full">
                          <tbody>
                              <tr class="bg-white dark:bg-gray-800">
                                  <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      NIK
                                  </th>
                                  <td class="detailNik pe-2 ps-4 py-1">
                                      -
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      No. telp
                                  </th>
                                  <td class="detailNomor pe-2 ps-4 py-1">
                                      -
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      Kelompok Tani
                                  </th>
                                  <td class="detailPoktan pe-2 ps-4 py-1">
                                      -
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      Kios Resmi
                                  </th>
                                  <td class="detailKios pe-2 ps-4 py-1">
                                      -
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
          
      </div>
  </div>
@endsection