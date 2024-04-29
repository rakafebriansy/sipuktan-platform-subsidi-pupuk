//FETCH
function fetchRiwayatSearchBox(letters,token,list) {
    fetch('/kios-resmi/ajax/petani-riwayat', {
        headers: {
            "X-CSRF-Token": token
          },    
        method: 'POST',
        body: new URLSearchParams('letters='+letters)
    }).then(res => res.json())
      .then(res => viewRiwayatSearchBox(res,list))
      .catch(e => console.error('Error'+e));
}
function fetchDetailLaporanFiles(id,token) {
    fetch('/ajax/laporan-filenames', {
        headers: {
            "X-CSRF-Token": token
          },    
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.json())
      .then(res => viewDetailLaporanFiles(res))
      .catch(e => console.error('Error'+e));
}
function fetchPetaniFromAlokasi(id,token) {
    fetch('/kios-resmi/ajax/petani-alokasi', {
        headers: {
            "X-CSRF-Token": token
          },    
        method: 'POST',
        body: new URLSearchParams('id='+id)
    }).then(res => res.json())
      .then(res => viewPetaniFromAlokasi(JSON.parse(res)))
      .catch(e => console.error('Error'+e));
}

//UTILS
function viewRiwayatSearchBox(data,list) {
    list.innerHTML = '';
    for(let i = 0; i < data.length; i++) {
        const a = document.createElement('a');
        a.innerHTML = `${data[i]['nama']} | ${data[i]['jenis']} | ${data[i]['musim_tanam']} | ${data[i]['tahun']}`;
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

//EVENTS
function editPassId(btn){
    const hiddenId = document.getElementById('editAlokasiId');
    let tds = btn.parentElement.parentElement.children;
    let inputs = hiddenId.nextElementSibling.querySelectorAll('input, option')
    let musim_tanam = document.getElementById('dropdownMTButton').innerText;
    hiddenId.value = btn.parentElement.dataset.id;
    inputs[0].value = btn.parentElement.dataset.nik;
    inputs[1].value = tds[1].innerText;
    inputs[2].value = document.getElementById('dropdownTahunButton').innerText;
    for(let i = 3; i < inputs.length; i++) {
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
function detailPassId(btn){
    const detailBody = document.querySelector('#detailAlokasiBody');
    const btnParent = btn.parentElement;
    detailBody.querySelector('img').setAttribute('src','/storage/foto_ktps/' + btnParent.dataset.ktp);
    detailBody.querySelector('td.detailNik').innerText = btnParent.dataset.nik
    detailBody.querySelector('td.detailNomor').innerText = btnParent.dataset.nomor
    detailBody.querySelector('td.detailPoktan').innerText = btnParent.dataset.poktan
    detailBody.querySelector('td.detailKios').innerText = btnParent.dataset.kios
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
function getDetailAlokasiPetani(btn) {
    const table_rows = document.querySelector('#detailAlokasiModal table tbody');
    table_rows.querySelector('tr td:nth-child(2)').innerText = btn.dataset.telp;
    table_rows.querySelector('tr:nth-child(2) td:nth-child(2)').innerText = btn.dataset.poktan;
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
        fetchRiwayatSearchBox(input.value,input.dataset.token,list)
    } else {
        list.innerHTML = '';
    }
}
function getDetailLaporanFiles(btn,token) {
    fetchDetailLaporanFiles(btn.parentElement.dataset.id,token);
}
function getPetaniFromAlokasi(btn,token) {
    fetchPetaniFromAlokasi(btn.parentElement.dataset.id,token);
}
function editStatusAlokasiPassId() {
    document.getElementById('alokasiTahun').value = document.getElementById('dropdownTahunButton').innerText;
    document.getElementById('alokasiMusimTanam').value = document.getElementById('dropdownMTButton').innerText;
}
(function(){

})();