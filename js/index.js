import { Helper } from "./utilities/Helper.js";

let deleteButton = document.querySelectorAll('.delete-btn')

deleteButton.forEach(button => {
    button.addEventListener('click', (e) => {
        
        let id = e.target.closest('tr').firstChild.textContent;

        Helper.setIdtoDelete(id);

    })
});

