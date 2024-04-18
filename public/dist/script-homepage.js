let choose_id_poktan = document.querySelector('#idPoktan');
let dropdown_poktan = document.querySelector('#dropdownUsersButton');

function fileAnnounce(file) {
    file.previousElementSibling.children[1].innerHTML = `<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">${file.files[0].name}</p>`
}

document.querySelectorAll('.poktan').forEach(element => {
    element.addEventListener('click',function(e){
        choose_id_poktan.value = event.target.dataset.value;
        dropdown_poktan.innerHTML = event.target.innerText + 
        `
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
        `;
    });
})
