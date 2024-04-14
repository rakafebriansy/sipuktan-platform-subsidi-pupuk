document.addEventListener('click', function(event){
    if (event.target.classList.contains('poktan')) {
        document.querySelector('#idPoktan').value = event.target.dataset.value;
        document.querySelector('#dropdownUsersButton').innerHTML = event.target.innerText + 
        `
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
        `;
        console.log()
    }
});