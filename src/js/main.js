import { Helper } from "./utilities/Helper.js";

let deleteButton = document.querySelectorAll('.set-to-delete');

deleteButton.forEach(button => {
    button.addEventListener('click', (e) => {
        
        let id = e.target.dataset.id

        if (e.target.tagName !== 'BUTTON') 
            id = e.target.closest('button').dataset.id

        Helper.setToDelete(id);
        
    })
});

// TODO: implement a delete function for all the buttons

