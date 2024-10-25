import { Helper } from "./utilities/Helper.js";
import { Style } from "./utilities/Style.js";

let deleteButton = document.querySelectorAll('.set-to-delete');
let addContactBtn = document.querySelector('.add-contact-btn')
let check = document.querySelector('.img-check')
let fileInput = document.querySelector('#file-upload')

// uploaded image check
if (fileInput) {

    fileInput.addEventListener('change', () => {
        
        check.classList.remove('d-none')
        check.innerHTML = `<i class="fa-regular fa-circle-check" style="color: #17d924;"></i> ${fileInput.value}`
        
    })
    
}

// set delete buttons
deleteButton.forEach(button => {
    button.addEventListener('click', (e) => {
        
        let id = e.target.dataset.id

        if (e.target.tagName !== 'BUTTON') 
            id = e.target.closest('button').dataset.id

        Helper.setToDelete(id);
        
    })
});

// set add Contact Button to center
Style.centerElement(addContactBtn)
