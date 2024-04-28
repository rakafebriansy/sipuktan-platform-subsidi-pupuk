@extends('dashboard.petani.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
    <form id="checkout-form" action="/petani/checkout" method="post">
    <div class="p-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                @csrf
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class=" w-full px-5 pt-5 pb-2 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        <h1 class="inline-block text-2xl">Checkout</h1>
                        <div class="text-sm font-normal">
                            <p>Nama: <span>{{ $petani->nama }}</span></p>
                            <p>NIK: <span>{{ $petani->nik }}</span></p>
                            <p>Musim Tanam: <span>{{ $alokasis[0]->musim_tanam }}</span></p>
                            <p>Kios: <span>{{ $petani->kios_resmi }}</span></p>
                        </div>
                    </caption>
                    @if(count($alokasis))
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Jenis Pupuk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Pupuk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alokasis as $alokasi)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <input type="hidden" name="id_alokasis[]" value="{{ $alokasi->id }}" id="">
                            <td scope="row" class="px-6 py-4">
                                {{ $alokasi->jenis }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $alokasi->jumlah_pupuk }}kg
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ $alokasi->total_harga }}
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">Total:</td>
                            <td scope="col" class="px-6 font-medium py-3 text-gray-900">Rp{{ $total_harga }}</td>
                        </tr>
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
        <div class="flex justify-center">
            <button type="button" id="pay-button" class="text-white inline bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Bayar</button>
        </div>
    </form>
</div>
@endsection