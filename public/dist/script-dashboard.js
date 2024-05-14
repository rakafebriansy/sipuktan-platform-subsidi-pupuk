//FETCH
function fetchRiwayatSearchBox(letters,list) {
    fetch('/kios-resmi/ajax/petani-riwayat', {
        method: 'POST',
        body: new URLSearchParams('letters='+letters)
    }).then(res => res.json())
      .then(res => viewRiwayatSearchBox(res,list))
      .catch(e => console.error('Error'+e));
}
function fetchDetailLaporanFiles(id) {
    fetch('/ajax/laporan-filenames', {  
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.json())
      .then(res => viewDetailLaporanFiles(res))
      .catch(e => console.error('Error'+e));
}
function fetchPetaniFromAlokasi(id) {
    fetch('/kios-resmi/ajax/petani-alokasi', {
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.json())
      .then(res => viewPetaniFromAlokasi(res))
      .catch(e => console.error('Error'+e));
}
function fetchPetaniFromAlokasiPemerintah(id) {
    fetch('/pemerintah/ajax/petani-alokasi', {
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.json())
      .then(res => viewPetaniFromAlokasiPemerintah(res))
      .catch(e => console.error('Error'+e));
}
function fetchDeleteNotifikasi(id) {
    fetch('/ajax/delete-notifikasi', {
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.json())
      .then(res => res)
      .catch(e => console.error('Error'+e));
}
function fetchGetFaqDetail(id) {
    fetch('/pemerintah/ajax/get-faq', {
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.json())
      .then(data => viewFaqDetail(data))
      .catch(e => console.error('Error'+e));
}
function fetchGetKeluhanDetail(id) {
    fetch('/ajax/get-keluhan', {
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.json())
      .then(data => viewGetKeluhanDetail(data))
      .catch(e => console.error('Error'+e));
}
function fetchGetKeluhanBalas(id) {
    fetch('/ajax/get-keluhan', { 
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.json())
      .then(data => viewGetKeluhanBalas(data))
      .catch(e => console.error('Error'+e));
}
function fetchTableRowLaporanNotifikasi(id) {
    fetch('/pemerintah/ajax/get-laporan-blade', { 
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.text())
      .then(data => viewTableRowLaporanNotifikasi(data))
      .catch(e => console.error('Error'+e));
}

//UTILS
function viewRiwayatSearchBox(data,list) {
    list.innerHTML = '';
    for(let i = 0; i < data.length; i++) {
        const a = document.createElement('a');
        a.innerHTML = `<p class="inline">${data[i]['nama']}</p> <p class="text-xs font-normal inline ms-2">${data[i]['jenis']} | ${data[i]['musim_tanam']} | ${data[i]['tahun']}</p>`;
        a.dataset.id = data[i]['id'];
        a.setAttribute('onclick','setRiwayatIdLaporan(this)');
        a.classList.add('search-li');
        list.appendChild(a);
    }
}
function viewDetailLaporanFiles(data) {
    const table_rows = document.querySelector('#detailLaporanModal table tbody');
    table_rows.querySelector('tr td:nth-child(2) > a').innerText = data['foto_bukti_pengambilan'];
    table_rows.querySelector('tr td:nth-child(2) > a').setAttribute('href','/download/foto_bukti_pengambilans/'+data['foto_bukti_pengambilan']);
    table_rows.querySelector('tr:nth-child(2) td:nth-child(2) > a').innerText = data['foto_ktp'];
    table_rows.querySelector('tr:nth-child(2) td:nth-child(2) > a').setAttribute('href','/download/foto_ktp_laporans/'+data['foto_ktp']);
    if(data['foto_surat_kuasa'] == null){
        table_rows.querySelector('tr:nth-child(3) td:nth-child(2) > a').innerText = 'tidak ada';
    } else {
        table_rows.querySelector('tr:nth-child(3) td:nth-child(2) > a').innerText = data['foto_surat_kuasa'];
        table_rows.querySelector('tr:nth-child(3) td:nth-child(2) > a').setAttribute('href','/download/foto_surat_kuasas/'+data['foto_surat_kuasa']);
        table_rows.querySelector('tr:nth-child(3) td:nth-child(2) > a').classList.replace('italic','underline');
    }
    
    table_rows.querySelector('tr:nth-child(4) td:nth-child(2) > a').innerText = data['foto_tanda_tangan'];
    table_rows.querySelector('tr:nth-child(4) td:nth-child(2) > a').setAttribute('href','/download/foto_tanda_tangans/'+data['foto_tanda_tangan']);    
}
function viewPetaniFromAlokasi(data) {
    const table_rows = document.querySelector('#detailAlokasiModal table tbody');
    table_rows.querySelector('tr td:nth-child(2)').innerText = data['nomor_telepon'];
    table_rows.querySelector('tr:nth-child(2) td:nth-child(2)').innerText = data['poktan'];
}
function viewPetaniFromAlokasiPemerintah(data) {
    document.querySelector('#detailAlokasiModal img').setAttribute('src','/storage/foto_ktps/' + data['foto_ktp']);
    const table_rows = document.querySelector('#detailAlokasiModal table tbody');
    table_rows.querySelector('tr td:nth-child(2)').innerText = data['nik'];
    table_rows.querySelector('tr:nth-child(2) td:nth-child(2)').innerText = data['nomor_telepon'];
    table_rows.querySelector('tr:nth-child(3) td:nth-child(2)').innerText = data['poktan'];
    table_rows.querySelector('tr:nth-child(4) td:nth-child(2)').innerText = data['kios_resmi'];
}
function viewFaqDetail(data) {
    const dropdownEditFaq = document.getElementById('editFaqModal');
    dropdownEditFaq.querySelector('[name="pertanyaan"]').value = data['pertanyaan'];
    dropdownEditFaq.querySelector('[name="jawaban"]').value = data['jawaban'];
    dropdownEditFaq.querySelectorAll('option').forEach(element => {
        if(element.innerText == data['jenis_pengguna']) element.setAttribute('selected','');
    });
}
function viewAlertNotifikasi(message,id,mode='blue') {
    const li = document.createElement('li');
    li.setAttribute('id',`notifikasi-${id}`);
    li.setAttribute('role','alert');
    let xmlString =
        `
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            ${message}
        </div>
            <button data-id="${id}" type="button" onclick="deleteRealtimeNotifikasi(this,'notifikasi-${id}')" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        `;
    if (mode == 'red') {
        xmlString = 
        `
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            ${message}
        </div>
            <button data-id="${id}" type="button" onclick="deleteRealtimeNotifikasi(this,'notifikasi-${id}')" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        `;
        li.classList.add('flex','items-center','p-4','mb-4','text-red-800','rounded-lg','bg-red-50','dark:bg-gray-800','dark:text-red-400')
    } else {
        li.classList.add('flex','items-center','p-4','text-blue-800','bg-blue-50','dark:bg-gray-800','dark:text-blue-400')
    }
    li.innerHTML = xmlString;
    target = document.querySelector('#dropdownNotifikasi ul');
    if (target.firstElementChild.id == 'no-notification') target.innerHTML = '';
    target.appendChild(li);
}
function viewAksiLaporanNotifikasi(id) {
    const lastElement = document.querySelector('#laporan-' + id).lastElementChild;
    lastElement.previousElementSibling.innerText = 'Ditolak';
    lastElement.lastElementChild.classList.replace('hidden','inline-block')
    lastElement.appendChild(btn);
}
function viewGetKeluhanDetail(data) {
    const detailKeluhanModalDivs = document.querySelectorAll('#detailKeluhanBody div');
    detailKeluhanModalDivs[0].children[1].innerText = data['subjek']
    detailKeluhanModalDivs[1].children[1].innerText = data['keluhan']
    if(data['balasan'] == null) {
        detailKeluhanModalDivs[2].children[1].innerText = 'Belum ada balasan';
        detailKeluhanModalDivs[2].children[1].classList.add('italic','text-gray-500');
    } else {
        detailKeluhanModalDivs[2].children[1].innerText = data['balasan'];
    }
}
function viewGetKeluhanBalas(data) {
    const detailKeluhanModalDivs = document.querySelectorAll('#balasKeluhanBody div');
    detailKeluhanModalDivs[0].children[1].innerText = data['subjek']
    detailKeluhanModalDivs[1].children[1].innerText = data['keluhan']
}
function viewTableRowLaporanNotifikasi(xmlString) {
    xmlString = JSON.parse(xmlString)
    console.log(xmlString)
    const tr = document.createElement('tr');
    const tbody = document.querySelector('#mainTable > tbody');
    tr.classList.add('bg-white','border-b','dark:bg-gray-800','dark:border-gray-700','hover:bg-gray-50','dark:hover:bg-gray-600');
    tr.innerHTML = xmlString['row'];
    const btns = tr.querySelectorAll('button');
    if(tbody.firstElementChild.id == 'no-data') {
        tbody.innerHTML = '';
    }
    tbody.parentElement.appendChild(tr);
    document.getElementById('content').insertAdjacentHTML('beforeend',xmlString['dropdowns']);
}


//EVENTS
function editPassId(btn){
    const hiddenId = document.getElementById('editAlokasiId');
    let tds = btn.parentElement.parentElement.children;
    let inputs = hiddenId.nextElementSibling.querySelectorAll('input, option')
    let musim_tanam = document.getElementById('dropdownMTButton').innerText;
    hiddenId.value = btn.parentElement.dataset.id;
    inputs[0].value = tds[1].innerText;
    inputs[1].value = document.getElementById('dropdownTahunButton').innerText;
    for(let i = 2; i < inputs.length; i++) {
        let guess = inputs[i];
        if(guess.innerText == tds[2].innerText) {
            guess.setAttribute('selected','');
            guess.value = tds[2].dataset.value;
        } else if (guess.innerText == musim_tanam) {
            guess.setAttribute('selected','');
            guess.value = musim_tanam;
        }
    }
}
function deletePassId(btn){
    document.getElementById('deleteAlokasiMT').value = document.getElementById('dropdownMTButton').innerText;
    document.getElementById('deleteAlokasiTahun').value = document.getElementById('dropdownTahunButton').innerText;
    document.getElementById('deleteAlokasiId').value = btn.parentElement.dataset.id;
}
function getAlokasiFromMt(li, mode) {
    document.getElementById('dropdownMTButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/' + mode + '/alokasi?tahun=' + document.querySelector('#dropdownTahunButton').innerText  + '&&musim_tanam=' + li.querySelector('p').innerText );
}
function getAlokasiFromTh(li, mode) {
    document.getElementById('dropdownTahunButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/' + mode + '/alokasi?tahun=' + li.querySelector('p').innerText + '&&musim_tanam=' + document.querySelector('#dropdownMTButton').innerText);
}
function sumTotalCheck() {
    let total = 0;
    document.querySelectorAll('.transaksi-check:checked').forEach(e => {
        total += parseInt(e.dataset.harga);
    });
    document.querySelector('#tampilan-total > span').innerText = total;
    document.getElementById('total-harga').value = total;
}
function getRiwayatFromMt(li, mode) {
    document.getElementById('dropdownMTButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/' + mode + '/riwayat-transaksi?tahun=' + document.querySelector('#dropdownTahunButton').innerText  + '&&musim_tanam=' + li.querySelector('p').innerText );
}
function getRiwayatFromTh(li,mode) {
    document.getElementById('dropdownTahunButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/' + mode + '/riwayat-transaksi?tahun=' + li.querySelector('p').innerText);
}
function getRiwayatLaporFromMt(li, mode) {
    document.getElementById('dropdownMTButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/' + mode + '/laporan?tahun=' + document.querySelector('#dropdownTahunButton').innerText  + '&&musim_tanam=' + li.querySelector('p').innerText );
}
function getRiwayatLaporFromTh(li, mode) {
    document.getElementById('dropdownTahunButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/' + mode + '/laporan?tahun=' + li.querySelector('p').innerText + '&&musim_tanam=' + document.querySelector('#dropdownMTButton').innerText);
}
function setRiwayatIdLaporan(btn) {
    document.getElementById('musimTanamSaatIni').value = document.getElementById('dropdownMTButton').querySelector('p').innerText;
    document.getElementById('tahunSaatIni').value = document.getElementById('dropdownTahunButton').querySelector('p').innerText;
    document.getElementById('idRiwayatTransaksi').value = btn.dataset.id;
    document.getElementById('riwayatSearch').value = btn.innerText;
    document.getElementById('riwayatSearchBox').innerHTML = '';
    btn.value = '';
}
function searchRiwayat(input) {
    const list = document.getElementById('riwayatSearchBox');
    if(input.value.length > 1) {
        fetchRiwayatSearchBox(input.value,list)
    } else {
        list.innerHTML = '';
    }
}
function getDetailLaporanFiles(btn) {
    fetchDetailLaporanFiles(btn.parentElement.dataset.id);
}
function getPetaniFromAlokasi(btn) {
    fetchPetaniFromAlokasi(btn.parentElement.dataset.id);
}
function getPetaniFromAlokasiPemerintah(btn) {
    fetchPetaniFromAlokasiPemerintah(btn.parentElement.dataset.id);
}
function editStatusAlokasiPassId() {
    document.getElementById('alokasiTahun').value = document.getElementById('dropdownTahunButton').innerText;
    document.getElementById('alokasiMusimTanam').value = document.getElementById('dropdownMTButton').innerText;
}
function dismissingDropdown(id){
    document.getElementById(id).click()
}
function deleteNotifikasi(btn,id) {
    let notifikasi = document.querySelector('#'+id);
    let parent = notifikasi.parentElement;
    fetchDeleteNotifikasi(btn.dataset.id);
    notifikasi.remove();
    if(parent.children.length == 0){
        parent.appendChild(setNoNotification());
    }
}
function deleteRealtimeNotifikasi(btn,id) {
    let notifikasi = document.querySelector('#'+id);
    let parent = notifikasi.parentElement;
    fetchDeleteNotifikasi(btn.dataset.id);
    notifikasi.remove();
    if(parent.children.length == 0){
        parent.appendChild(setNoNotification());
    }
}
function setNoNotification(){
    const li = document.createElement('li');
    li.setAttribute('id','no-notification');
    li.classList.add('flex','justify-center','p-2')
    li.innerHTML = '<p class="font-medium text-gray-400 whitespace-nowrap dark:text-white">Belum ada notifikasi</p>'
    return li
}
function editFaqPassId(btn){
    let id = btn.parentElement.dataset.id;
    document.getElementById('editFaqModal').querySelector('[name="id"]').value = id;
    fetchGetFaqDetail(id);
}
function deleteFaqPassId(btn){
    let id = btn.parentElement.dataset.id;
    document.getElementById('deleteFaqModal').querySelector('[name="id"]').value = id;
}
function editNoTelpPassId(btn,mode) {
    const editNoTelpModal = document.getElementById('editNoTelpModal');
    document.getElementById('dropdownProfil').classList.replace('block','hidden');
    editNoTelpModal.querySelector('[name="id"]').value = document.getElementById(mode).dataset.id;
    editNoTelpModal.querySelector('[name="nomor_disabled"]').value = btn.previousElementSibling.innerText;
}
function getDetailKeluhan(btn) {
    const id = btn.parentElement.dataset.id;
    fetchGetKeluhanDetail(id);
}
function balasKeluhanPassId(btn) {
    let id = btn.parentElement.dataset.id;
    const balasKeluhanModal = document.getElementById('balasKeluhanModal');
    balasKeluhanModal.querySelector('[name="id"]').value = id;
    fetchGetKeluhanBalas(id);
}
function editLaporanPassId(btn) {
    document.getElementById('editLaporanId').value = btn.parentElement.dataset.id;
}

(function(){
    if(document.URL.includes('/petani/') || document.URL.includes('/kios-resmi/') || document.URL.includes('/pemerintah/')){
        if(window.screen.width > 640) {
            const profil = document.getElementById('dropdownProfilButton');
            const notifikasi = document.getElementById('dropdownNotifikasiButton');
            profil.dataset.dropdownPlacement = 'right-end';
            profil.dataset.dropdownOffsetDistance = '35';
            notifikasi.dataset.dropdownOffsetDistance = '20';
            notifikasi.dataset.dropdownPlacement = 'right-end';
            notifikasi.dataset.dropdownOffsetSkidding = 0;
        } 
    }
})();