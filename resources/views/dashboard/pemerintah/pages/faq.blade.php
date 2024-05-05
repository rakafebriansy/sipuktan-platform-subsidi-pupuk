@extends('dashboard.pemerintah.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <div class="flex justify-between items-center my-3">
                        <p class="text-2xl">Frequently Asked Questions</p>
                        <button data-modal-target="tambahAlokasiModal" data-modal-toggle="tambahAlokasiModal" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                            Tambah data
                          </button>
                    </div>
                </caption>
                @if(count($faqs))
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Pertanyaan</p>
                        </th>
                        
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jawaban</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jenis Pengguna</p>
                        </th>
                        <th scope="col" class="py-3">
                            <span class="inline-block">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faqs as $faq)
                    <tr class="alokasi-rows bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row" class=" px-6 py-4">
                            {{ $faq->pertanyaan }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $faq->jawaban }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $faq->jenis_pengguna }}
                        </td>
                        <td data-id="{{ $faq->id }}" class="py-4 flex flex-row px-2">
                            <button data-modal-target="editAlokasiModal" data-modal-toggle="editAlokasiModal" onclick="editPassId(this)" class=" bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">Edit</button>
                            <button data-modal-target="deleteAlokasiModal" data-modal-toggle="deleteAlokasiModal" onclick="deletePassId(this)" class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Hapus</button>
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
            
            <form  action="/pemerintah/faq" method="post" class="p-4 md:p-5">
              @csrf
                <div class="mb-4">
                    <div class="mb-2">
                        <label for="pertanyaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertanyaan</label>
                        <textarea name="pertanyaan" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="resize: none" placeholder="Tuliskan pertanyaan..."></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="jawaban" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban</label>
                        <textarea name="jawaban" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="resize: none" placeholder="Tuliskan jawaban..."></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="jenis_pengguna" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Pengguna</label>
                        <select name="jenis_pengguna"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Pilih Jenis Pengguna</option>
                            <option value="Petani">Petani</option>
                            <option value="Kios Resmi">Kios Resmi</option>
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
                      <input type="text" name="nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label for="jumlah_pupuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                      <input type="number" name="jumlah_pupuk"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                      <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                      <input type="number" name="tahun"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
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