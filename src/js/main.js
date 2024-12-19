import { Helper } from "./utilities/Helper.js";

let deleteButton = document.querySelectorAll('.set-to-delete');
let fileInput = document.querySelector('#file-upload')
let checkboxes = document.querySelectorAll('.form-check-input')
let active = document.querySelector('.fa-circle-check')
let cardImg = document.querySelectorAll('.normal-card-img')
let goBackBtn = document.querySelector('.go-back-btn')
let tableHead = document.querySelector('#t-head') 
let clearPic = document.querySelector('#clear-picture')

// uploaded image check
if (fileInput) Helper.ImagePreview(fileInput)

// set delete buttons
if (deleteButton) deleteButton.forEach(button => Helper.setToDelete(button));

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

if (tableHead) tableHead.addEventListener('click', (e) => {
    Helper.SortList(e)
})

