function editPassId(btn){
    const hiddenId = document.querySelector('#editAlokasiId');
    let tds = btn.parentElement.parentElement.children;
    let inputs = hiddenId.nextElementSibling.querySelectorAll('input, option')
    hiddenId.value = btn.parentElement.dataset.id;
    inputs[0].value = btn.parentElement.dataset.nik;
    inputs[1].value = tds[1].innerText;
    inputs[2].value = document.querySelector('#dropdownTahunButton').innerText;
    for(let i = 3; i < inputs.length; i++) {
        let guess = inputs[i];
        if(guess.innerText == tds[3].innerText) {
            guess.setAttribute('selected','');
            guess.value = tds[3].dataset.value;
        } else if (guess.innerText == tds[4].innerText) {
            guess.setAttribute('selected','');
            guess.value = tds[4].innerText;
        }
    }
}
function deletePassId(btn){
    document.querySelector('#deleteAlokasiMT').value = document.querySelector('#dropdownMTButton').innerText;
    document.querySelector('#deleteAlokasiTahun').value = document.querySelector('#dropdownTahunButton').innerText;
    document.querySelector('#deleteAlokasiId').value = btn.parentElement.dataset.id;
}
function detailPassId(btn){
    const detailBody = document.querySelector('#detailAlokasiBody');
    const btnParent = btn.parentElement;
    detailBody.querySelector('img').setAttribute('src','/storage/foto_ktps/' + btnParent.dataset.ktp);
    detailBody.querySelector('td.detailNik').innerText = btnParent.dataset.nik
    detailBody.querySelector('td.detailNomor').innerText = btnParent.dataset.nomor
}
function getAlokasiFromMt(li, mode) {
    document.querySelector('#dropdownMTButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/' + mode + '/alokasi?tahun=' + document.querySelector('#dropdownTahunButton').innerText  + '&&musim_tanam=' + li.querySelector('p').innerText );
}
function getAlokasiFromTh(li, mode) {
    document.querySelector('#dropdownTahunButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/' + mode + '/alokasi?tahun=' + li.querySelector('p').innerText + '&&musim_tanam=' + document.querySelector('#dropdownMTButton').innerText);
}

(function(){

})();