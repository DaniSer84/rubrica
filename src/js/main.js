import { Helper } from "./utilities/Helper.js";
import { Style } from "./utilities/Style.js";

let deleteButton = document.querySelectorAll('.set-to-delete');
let addContactBtn = document.querySelector('.add-contact-btn')
let fileInput = document.querySelector('#file-upload')
let checkboxes = document.querySelectorAll('.form-check-input')
let active = document.querySelector('.fa-circle-check')
let cardImg = document.querySelectorAll('.normal-card-img')

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

// TODO: improve this behaviour
cardImg.forEach(img => {
    img.addEventListener('click', () => {
        
        let imgContainer = document.createElement('div')
        let image = document.createElement('img')

        imgContainer.classList.add('img-container')
        document.body.append(imgContainer)
        image.src = img.src
        image.classList.add('bigger-card-img')
        imgContainer.append(image)

        image.addEventListener('click', () => {
            imgContainer.remove()
        })
   }
)
})

let goBackBtn = document.querySelector('.go-back-btn')
if (goBackBtn) {
    goBackBtn.addEventListener('click', () => {
        history.back();
    })
}
