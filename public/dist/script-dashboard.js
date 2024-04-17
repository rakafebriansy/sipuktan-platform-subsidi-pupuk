function editPassId(btn){
    const hiddenId = document.querySelector('#editAlokasiId');
    let tds = btn.parentElement.parentElement.children;
    let inputs = hiddenId.nextElementSibling.querySelectorAll('input, option')
    let match = [tds[3].innerText,tds[4].innerText]
    hiddenId.value = btn.dataset.id;
    inputs[0].value = tds[1].innerText;
    inputs[1].value = tds[2].innerText;
    inputs[2].value = document.querySelector('#dropdownTahunButton').innerText;
    for(let i = 3; i < inputs.length; i++) {
        let guess = inputs[i];
        if(match.includes(guess.innerText)) guess.setAttribute('selected','');
    }
}
function deletePassId(btn){
    document.querySelector('#deleteAlokasiId').value = btn.dataset.id;
}
function getAlokasiFromMt(li) {
    document.querySelector('#dropdownMTButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/pemerintah/alokasi?tahun=' + document.querySelector('#dropdownTahunButton').innerText  + '&&musim_tanam=' + li.querySelector('p').innerText );
}
function getAlokasiFromTh(li) {
    document.querySelector('#dropdownTahunButton').querySelector('p').innerText = li.querySelector('p').innerText;
    location.replace('/pemerintah/alokasi?tahun=' + li.querySelector('p').innerText + '&&musim_tanam=' + document.querySelector('#dropdownMTButton').innerText);
}

(function(){

})();