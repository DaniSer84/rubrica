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

// TODO: MAKE one function for manageIsActive
// manage check input Active/Inactive 
if (checkboxes) checkboxes.forEach(checkbox => {

    if (!checkbox.classList.contains('dec')) {

        Helper.setCheckInput(checkbox)

        let checkLabel = document.querySelector('.form-check-label')
    
        if (checkLabel) {
    
            Helper.modifyCheckboxLabel(checkbox, checkLabel)
    
        }
        
    }
    
})

// manage 'isActiv' icon 
if (active) Helper.isActive(active)

// zoom (modal) for card image
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

if (clearPic) Helper.HandleRemovePic(clearPic)
