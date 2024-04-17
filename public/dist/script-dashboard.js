function editPassId(btn){
    const hiddenId = document.querySelector('#editAlokasiId');
    let tds = btn.parentElement.parentElement.children;
    let inputs = hiddenId.nextElementSibling.querySelectorAll('input, option')
    hiddenId.value = btn.dataset.id;
    inputs[0].value = tds[1].innerText;
    inputs[1].value = tds[2].innerText;
    inputs[2].value = document.querySelector('#dropdownTahunButton').innerText;
    console.log(tds[3].dataset.value)
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