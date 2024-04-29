@extends('dashboard.kios-resmi.partials.body')
@section('wrapper')
<form action="/kios-resmi/transaksi" method="post">
<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                @csrf
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class=" w-full  px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <div class="flex justify-between">
                            <div class="">
                                <p class="inline-block">Transaksi Tunai</p>
                            </div>
                            <div class="">
                                <h4 id="tampilan-total" class="inline me-4">TOTAL: Rp<span>0</span></h4>
                                @if(count($alokasis))
                                <button type="button" data-modal-target="lunas-modal" data-modal-toggle="lunas-modal" class="text-white inline bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Lunas</button>
                                @else
                                <button disabled type="submit" class="text-white bg-gray-500 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600">Checkout</button>
                                @endif
                            </div>
                        </div>
                    </caption>
                    @if(count($alokasis))
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4 sr-only">
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Petani
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jenis Pupuk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Pupuk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Harga
                            </th>
    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alokasis as $alokasi)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input name="id_alokasis[]" onclick="sumTotalCheck()" value="{{ $alokasi->id }}" data-harga="{{ $alokasi->total_harga }}" type="checkbox" class="transaksi-check w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $alokasi->nama_petani }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $alokasi->jenis }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $alokasi->jumlah_pupuk }}kg
                            </td>
                            <td class="px-6 py-4">
                                {{ $alokasi->total_harga }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <div class="flex justify-center">
                        <thead>
                            <th class="text-center">
                                <h1>Belum ada data.</h1>
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
    <div id="lunas-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="lunas-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.1172 8.28297C16.1172 9.8488 15.6529 11.3795 14.783 12.6814C13.913 13.9834 12.6766 14.9981 11.2299 15.5973C9.78327 16.1965 8.19142 16.3533 6.65568 16.0478C5.11993 15.7424 3.70925 14.9883 2.60204 13.8811C1.49483 12.7739 0.740809 11.3632 0.43533 9.8275C0.12985 8.29175 0.286633 6.69991 0.885852 5.25326C1.48507 3.80662 2.49981 2.57015 3.80176 1.70022C5.1037 0.830291 6.63437 0.365967 8.20021 0.365967C9.23992 0.365836 10.2695 0.570525 11.2301 0.968345C12.1907 1.36617 13.0635 1.94932 13.7987 2.68451C14.5339 3.4197 15.117 4.29251 15.5148 5.25311C15.9126 6.2137 16.1173 7.24325 16.1172 8.28297ZM11.2732 10.037C11.2724 9.49363 11.0749 8.96898 10.7172 8.55997L10.7162 8.55797C10.4796 8.28848 10.1968 8.06329 9.88121 7.89297L9.87821 7.89097C9.60459 7.74893 9.31341 7.64368 9.01221 7.57797H9.01021C8.74889 7.52228 8.4824 7.49446 8.21521 7.49497C8.05612 7.49592 7.89723 7.48354 7.74021 7.45797C7.56878 7.42942 7.40238 7.37621 7.24621 7.29997L7.24421 7.29897C7.10143 7.2261 6.97515 7.12467 6.87321 7.00097L6.87221 6.99997C6.7668 6.8767 6.70526 6.72196 6.69721 6.55997C6.70503 6.42701 6.74816 6.29854 6.82216 6.1878C6.89617 6.07707 6.99836 5.98806 7.11821 5.92997C7.45455 5.73242 7.83816 5.62978 8.22821 5.63297C8.36021 5.64359 8.49103 5.66567 8.61921 5.69897L8.66821 5.70897C8.83108 5.74818 8.98955 5.80379 9.14121 5.87497C9.28246 5.93908 9.4114 6.02741 9.52221 6.13597C9.59451 6.21471 9.68201 6.27799 9.77943 6.32201C9.87685 6.36603 9.98218 6.38987 10.0891 6.39209C10.1959 6.39432 10.3022 6.37489 10.4013 6.33496C10.5005 6.29504 10.5906 6.23545 10.6661 6.15979C10.7416 6.08414 10.801 5.99397 10.8408 5.89473C10.8805 5.79549 10.8998 5.68923 10.8973 5.58236C10.8949 5.47548 10.8709 5.3702 10.8267 5.27286C10.7825 5.17552 10.7191 5.08813 10.6402 5.01597C10.3941 4.77176 10.1062 4.57363 9.79021 4.43097C9.53855 4.31464 9.27546 4.22483 9.00521 4.16297H9.00421L8.99621 4.16097V3.37497C8.99999 3.26866 8.98231 3.16268 8.94424 3.06335C8.90616 2.96402 8.84847 2.87338 8.7746 2.79684C8.70073 2.7203 8.61219 2.65942 8.51428 2.61784C8.41637 2.57626 8.31108 2.55483 8.20471 2.55483C8.09833 2.55483 7.99305 2.57626 7.89513 2.61784C7.79722 2.65942 7.70869 2.7203 7.63482 2.79684C7.56095 2.87338 7.50325 2.96402 7.46518 3.06335C7.4271 3.16268 7.40943 3.26866 7.41321 3.37497V4.13797C7.00978 4.22212 6.62404 4.37574 6.27321 4.59197C5.92735 4.79269 5.63903 5.07911 5.43603 5.42364C5.23302 5.76816 5.12219 6.15916 5.11421 6.55897C5.12022 7.08542 5.30699 7.59382 5.64321 7.99897C5.88699 8.29866 6.19173 8.54306 6.53721 8.71597C6.83432 8.86384 7.1518 8.96664 7.47921 9.02097C7.72245 9.06123 7.96865 9.08097 8.21521 9.07997C8.36973 9.07912 8.52391 9.09454 8.67521 9.12597C8.83746 9.1616 8.99443 9.21807 9.14221 9.29397C9.28632 9.37387 9.41556 9.47807 9.52421 9.60197C9.62932 9.72305 9.68782 9.87763 9.68921 10.038C9.68921 10.135 9.68921 10.362 9.30421 10.611C8.96267 10.8171 8.57115 10.9258 8.17221 10.925C8.00633 10.9167 7.84125 10.8966 7.67821 10.865C7.52059 10.8313 7.3668 10.7817 7.21921 10.717C7.0804 10.6553 6.95734 10.5614 6.86221 10.443C6.79479 10.3621 6.71194 10.2956 6.61849 10.2471C6.52504 10.1987 6.42288 10.1694 6.31797 10.1609C6.21306 10.1524 6.10751 10.1649 6.00748 10.1976C5.90746 10.2304 5.81497 10.2827 5.73541 10.3517C5.65586 10.4206 5.59085 10.5047 5.54416 10.599C5.49748 10.6933 5.47007 10.796 5.46353 10.9011C5.457 11.0061 5.47147 11.1114 5.50609 11.2108C5.54072 11.3102 5.59481 11.4017 5.66521 11.48C5.92581 11.7904 6.25755 12.0333 6.63221 12.188C6.88103 12.2943 7.1405 12.3738 7.40621 12.425H7.41321V13.208C7.40943 13.3143 7.4271 13.4203 7.46518 13.5196C7.50325 13.6189 7.56095 13.7096 7.63482 13.7861C7.70869 13.8626 7.79722 13.9235 7.89513 13.9651C7.99305 14.0067 8.09833 14.0281 8.20471 14.0281C8.31108 14.0281 8.41637 14.0067 8.51428 13.9651C8.61219 13.9235 8.70073 13.8626 8.7746 13.7861C8.84847 13.7096 8.90616 13.6189 8.94424 13.5196C8.98231 13.4203 8.99999 13.3143 8.99621 13.208V12.418C9.41153 12.329 9.8077 12.1668 10.1662 11.939C10.5002 11.7461 10.778 11.4693 10.9721 11.136C11.1663 10.8028 11.2701 10.4246 11.2732 10.039V10.037Z" fill="#9CA3AF"/>
                    </svg>                    
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin petani telah melunasi?</h3>
                    <button data-modal-hide="lunas-modal" type="submit" class="focus:outline-none text-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Lunas
                    </button>
                    <button data-modal-hide="lunas-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>


@endsection