import { Helper } from "./utilities/Helper.js";

let deleteButton = document.querySelectorAll('.set-to-delete');
let fileInput = document.querySelector('#file-upload')
let cardImg = document.querySelectorAll('.normal-card-img')
let goBackBtn = document.querySelector('.go-back-btn')
let tableHead = document.querySelector('#t-head') 
let clearPic = document.querySelector('#clear-picture')

// uploaded image check
if (fileInput) Helper.ImagePreview(fileInput)

// set delete buttons
if (deleteButton) deleteButton.forEach(button => Helper.setToDelete(button));

// manage check input Active/Inactive 
Helper.handleIsActive()

// zoom (modal) for card image
cardImg.forEach(img => {
    img.addEventListener('click', () => Helper.ShowCardImage(img))
})

if (goBackBtn) {
    goBackBtn.addEventListener('click', () => {
        history.back();
    })
}

// handle sorting data
if (tableHead) tableHead.addEventListener('click', (e) => {
    Helper.SortList(e)
})

if (clearPic) Helper.HandleRemovePic(clearPic)
