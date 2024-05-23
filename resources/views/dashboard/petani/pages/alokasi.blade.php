@extends('dashboard.petani.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <p>Alokasi Pupuk</p>
                    <span class="block m-0"><svg class="w-4 h-4 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                      </svg> <p class="text-sm font-normal inline-block text-gray-500 dark:text-gray-400"> {{ $petani->poktan }}</p></span>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jenis Pupuk</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Jumlah</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Status</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Musim Tanam</p>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <p class="inline-block">Tahun</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($alokasis))
                        @foreach ($alokasis as $alokasi)
                            @php
                            $isDibayar = $alokasi->status == "Dibayar";
                            $isTidakDiambil = $alokasi->status == "Tidak Diambil";
                            @endphp
                            <tr @class([
                                'bg-white' => !$isDibayar && !$isTidakDiambil,
                                'hover:bg-gray-50' => !$isDibayar && !$isTidakDiambil,
                                'bg-[#A5E09B]' => $isDibayar,
                                'hover:bg-[#95D88A]' => $isDibayar,
                                'bg-[#F97B7B]' => $isTidakDiambil,
                                'hover:bg-[#F56262]' => $isTidakDiambil,
                                'border-b', 'dark:bg-gray-800', 'dark:border-gray-700', 'dark:hover:bg-gray-600'
                                ])>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $alokasi->jenis }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $alokasi->jumlah_pupuk }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $alokasi->status }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $alokasi->musim_tanam }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $alokasi->tahun }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr id="no-data" >
                        <td colspan="5" class="text-center py-4">Belum ada data</td> 
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection