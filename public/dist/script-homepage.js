document.addEventListener('click', function(event){
    if (event.target.classList.contains('poktan')) {
        document.querySelector('#idPoktan').value = event.target.dataset.value;
    }
});