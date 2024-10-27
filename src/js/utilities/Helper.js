
class Helper {

    static setToDelete(button) {

        button.addEventListener('click', (e) => {

            let id = e.target.dataset.id
            let deleteButton = document.getElementById('delete-btn');
            let toDelete = document.getElementById('to-delete');
            let url = document.URL === "http://localhost:83/src/pages/contact-list.php" ?
                "delete.php" :
                "src/pages/delete.php"

            if (e.target.tagName !== 'BUTTON')
                id = e.target.closest('button').dataset.id

            toDelete.textContent = id;

            deleteButton.setAttribute("href", `${url}?item_id=${id}`);
        })
    }

    static setCheckInput(checkInput) {

        switch (checkInput.dataset.active) {
            case "1":
                checkInput.checked = true
                break
            case "0":
                checkInput.checked = false
                break
            default:
                checkInput = true
        }
    }

    static uploadingImage(input) {

        let check = document.querySelector('.img-check')

        input.addEventListener('change', () => {

            check.classList.remove('d-none')
            check.innerHTML = `<i class="fa-regular fa-circle-check" style="color: #17d924;"></i> ${input.value}`

        })

    }

    static isActive(active) {

        let span = active.nextElementSibling

        if (span) {
            if (span.textContent === '1') {

                active.style.color = '#3ad737'
                span.textContent = 'Active'
                span.style.color = '#3ad737'
    
            } else {
    
                active.style.color = '#aaaaaa'
                span.innerHTML = '<em class="field-label">Inactive</em'
    
            }
        }
        
        
    }
}

export { Helper }

