
class Helper {

    static setToDelete(button) {

        button.addEventListener('click', (e) => {

            let id = e.target.dataset.id
            let deleteButton = document.getElementById('delete-btn');
            let toDelete = document.getElementById('to-delete');
            let url = document.URL === "http://localhost:83/index.php" ||  
                      document.URL === "http://localhost:83/" ?
                      "src/pages/delete.php" :
                      "delete.php"

            if (e.target.tagName !== 'BUTTON')
                id = e.target.closest('button').dataset.id

            toDelete.textContent = id;

            deleteButton.setAttribute("href", `${url}?item_id=${id}`);
        })
    }

    static setCheckInput(checkInput) {

        switch (checkInput.value) {
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
                span.textContent = 'Attivo'
                span.style.color = '#3ad737'
    
            } else {
    
                active.style.color = '#aaaaaa'
                span.innerHTML = '<em class="field-label">Inattivo</em'
    
            }
        }
    }

    static modifyCheckboxLabel(checkbox, checkLabel) {

        checkbox.checked ? checkLabel.textContent = 'Attivo' : checkLabel.textContent = 'Inattivo'
    
        checkbox.addEventListener('change', () => {
    
            if (checkbox.checked) {
                checkbox.value = 1
                checkLabel.textContent = 'Attivo'
            } else {
                checkbox.value = 0
                checkLabel.textContent = 'Inattivo'
            }
    
        })
       
    }

    static ShowCardImage(img) {

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

    static SortList(e) {

        let list = document.querySelector('.table-group-divider');
        let el = e.target
        let sortedList = this.Sort([...list.children], Number(el.dataset.index))
        el.toggleAttribute('data')
        
        if (el.attributes.data) {
            sortedList.forEach(node => list.append(node));
        } else {
            sortedList.reverse().forEach(node => list.append(node));
        }
        
    }

    static Sort(array, i) {

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
    
}

export { Helper }

