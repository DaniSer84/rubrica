import { Helper } from "./utilities/Helper.js";
import { Style } from "./utilities/Style.js";

let deleteButton = document.querySelectorAll('.set-to-delete');
let addContactBtn = document.querySelector('.add-contact-btn')
let fileInput = document.querySelector('#file-upload')
let checkboxes = document.querySelectorAll('.form-check-input')
let active = document.querySelector('.fa-circle-check')
let cardImg = document.querySelectorAll('.normal-card-img')
let goBackBtn = document.querySelector('.go-back-btn')

// uploaded image check
if (fileInput) Helper.uploadingImage(fileInput)

// set delete buttons
if (deleteButton) deleteButton.forEach(button => Helper.setToDelete(button));

// set add Contact Button to center
if (addContactBtn) Style.centerElement(addContactBtn)

if (checkboxes) checkboxes.forEach(checkbox => {

    Helper.setCheckInput(checkbox)

    let checkLabel = document.querySelector('.form-check-label')

    if (checkLabel) {

        Helper.modifyCheckboxLabel(checkbox, checkLabel)

    }

})

if (active) Helper.isActive(active)

cardImg.forEach(img => {
    img.addEventListener('click', () => Helper.ShowCardImage(img))
})

if (goBackBtn) {
    goBackBtn.addEventListener('click', () => {
        history.back();
    })
}

let list = document.querySelector('.table-group-divider');
let tableHead = document.querySelector('#t-head') 
let i = 8;

function sort(array, i) {

    const byNum = [0, 3]
    const byName = [1, 2, 4, 5, 6]
    const byDate = [7, 8]
    
    if (byNum.includes(i)) {
        return array.sort((a, b) => a.children[i].outerText - b.children[i].outerText)
    } else if (byName.includes(i)) {
        return array.sort((a, b) => a.children[i].outerText.localeCompare(b.children[i].outerText))
    } else if (byDate.includes(i)) {
        return array.sort((a, b) => new Date(a.children[i].outerText) - new Date(b.children[i].outerText))
    } else {
        return []
    }

}

sort([...list.children], i).forEach(node => list.append(node));

tableHead.addEventListener('click', (e) => {
    let el = e.target
    const cols = [
        'Id', 
        'Nome', 
        'Cognome',
        'Telefono',
        'Compagnia',
        'Ruolo',
        'Email',
        'Data di nascita',
        'Data creazione'
    ]
    el.toggleAttribute('data')

    if (el.attributes.data) {
        sort([...list.children], cols.indexOf(el.innerText)).forEach(node => list.append(node));
    } else {
        sort([...list.children], cols.indexOf(el.innerText)).reverse().forEach(node => list.append(node));
    }
    
})

