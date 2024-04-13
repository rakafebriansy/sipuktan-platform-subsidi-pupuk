document.addEventListener('click', function(event){
    if (event.target.id == 'poktan') {
        document.querySelector('#hapusModal .modal-footer > input').value = event.target.dataset.id;
    }
    console.log(event)
});