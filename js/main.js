import { Helper } from "./utilities/Helper.js";

let deleteButton = document.querySelectorAll('.delete-btn')

deleteButton.forEach(button => {
    button.addEventListener('click', (e) => {
        

        let name = e.target.closest('tr').childNodes[1].textContent + 
                   " " + e.target.closest('tr').childNodes[2].textContent

        let id = e.target.closest('tr').firstChild.textContent;

        Helper.setToDelete(name, id)

    })
});

console.log('riprova')
