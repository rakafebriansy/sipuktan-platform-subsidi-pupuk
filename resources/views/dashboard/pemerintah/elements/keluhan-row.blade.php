<td class="px-6 py-4">
    {{ date('H:i d-m-Y',strtotime($keluhan->tanggal_keluhan))}}
</td>
<td class="px-6 py-4">
    @isset($keluhan->id_kios_resmi)
    {{ $keluhan->kios_resmi->nama }} <span class="font-bold">(K)</span>
    @endisset
    @isset($keluhan->id_petani)
        {{ $keluhan->petani->nama }} <span class="font-bold">(P)</span>
    @endisset
</td>
<td class="px-6 py-4">
    {{ $keluhan->subjek }}
</td>
<td class="px-6 py-4 italic">
    {{ isset($keluhan->balasan)? 'Dibalas' : 'Belum dibalas' }}
</td>
<td class="py-4 flex flex-row px-6" data-id="{{ $keluhan->id }}">
    <button type="button" onclick="getDetailKeluhan(this,'Ori')" class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">Detail</button>
    <button type="button" onclick="balasKeluhanPassId(this,'Ori')" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Balas</button>
</td>