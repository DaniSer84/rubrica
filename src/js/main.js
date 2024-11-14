import { Helper } from "./utilities/Helper.js";
import { Style } from "./utilities/Style.js";

let deleteButton = document.querySelectorAll('.set-to-delete');
let addContactBtn = document.querySelector('.add-contact-btn')
let fileInput = document.querySelector('#file-upload')
let checkboxes = document.querySelectorAll('.form-check-input')
let active = document.querySelector('.fa-circle-check')

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
