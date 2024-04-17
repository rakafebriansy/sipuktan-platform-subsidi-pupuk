function ajaxGetController (url, data){
    $.get(url, {
        musim_tanam : data[1],
        tahun : data[0],
    }, function(data, status){
        let rows = $.parseJSON(data);
        rows.forEach(e => {
            $('table tbody').append(`
            <tr class="alokasi-rows bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th scope="row" class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                ${e.nama}
            </th>
            <td class="px-6 py-4">
                ${e.nik}
            </td>
            <td class="px-6 py-4">
                ${e.jumlah_pupuk}
            </td>
            <td class="px-6 py-4">
                ${e.jenis}
            </td>
            <td class="px-6 py-4">
                ${e.musim_tanam}
            </td>
            <td class="py-4 flex flex-row ">
                <a href="#" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Detail</a>
                <button data-id="${e.id_alokasi}" data-modal-target="editAlokasiModal" data-modal-toggle="editAlokasiModal" class="edit-alokasi bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Edit</button>
                <button data-id="${e.id_alokasi}" data-modal-target="deleteAlokasiModal" data-modal-toggle="deleteAlokasiModal" class="delete-alokasi bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Hapus</button>
            </td>
            </tr>
            `)
        })
    })
}

(function(){
    const delete_alokasi_id = document.querySelector('#deleteAlokasiId');
    const edit_alokasi_id = document.querySelector('#editAlokasiId');
    const dropdownTHBtn = document.querySelector('#dropdownTahunButton');
    const dropdownMTBtn = document.querySelector('#dropdownMTButton');
    const dropdownTHLis = document.querySelectorAll('#dropdownTahun ul li');
    const dropdownMTLis = document.querySelectorAll('#dropdownMT ul li');
    dropdownTHLis.forEach(e => {
        e.addEventListener('click',function(e) {
            console.log(e)
            dropdownTHBtn.querySelector('p').innerText = e.target.innerText;
            location.replace('/pemerintah/alokasi?tahun=' + e.target.innerText + '&&musim_tanam=' + dropdownMTBtn.innerText);
        });
    });
    dropdownMTLis.forEach(e => {
        e.addEventListener('click',function(e) {
            console.log(dropdownMTBtn)
            dropdownMTBtn.querySelector('p').innerText = e.target.innerText;
            console.log('ok')
            location.replace('/pemerintah/alokasi?tahun=' + dropdownTHBtn.innerText  + '&&musim_tanam=' + e.target.innerText );
        });
    });

    

    document.querySelectorAll('.delete-alokasi').forEach(e => {
        e.addEventListener('click',function(e){
            delete_alokasi_id.value = e.target.dataset.id;
        });
    });
    document.querySelectorAll('.edit-alokasi').forEach(e => {
        e.addEventListener('click',function(e){
            edit_alokasi_id.value = e.target.dataset.id;
            let inputs = document.querySelectorAll('#deleteAlokasiModal input');
            let selects = document.querySelectorAll('#deleteAlokasiModal select');
        });
    });
})();