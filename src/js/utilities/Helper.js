
class Helper {

    static setToDelete(button) {

        button.addEventListener('click', (e) => {

            let id = e.target.dataset.id;
            let deleteButton = document.getElementById('delete-btn');
            let toDelete = document.getElementById('to-delete');
            let url = "delete.php";

            if (e.target.tagName !== 'BUTTON')
                id = e.target.closest('button').dataset.id

            toDelete.textContent = id;

            deleteButton.setAttribute("href", `${url}?item_id=${id}`);
        })
    }

    static handleIsActive() {

        let checkboxes = document.querySelectorAll('.form-check-input')
        let active = document.querySelector('.fa-circle-check')

        if (checkboxes) checkboxes.forEach(checkbox => {
        
            if (!checkbox.classList.contains('dec')) {
        
                this.setCheckInput(checkbox)
        
                let checkLabel = document.querySelector('.form-check-label')
            
                if (checkLabel) {
            
                    this.modifyCheckboxLabel(checkbox, checkLabel)
            
                }
            }
        })

        if (active) this.isActive(active)

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

    static isActive(active) {

        let span = active.nextElementSibling

        if (span) {
            if (span.textContent === '1') {

                active.style.color = '#3ad737'
                span.textContent = 'Attivo'
                span.style.color = '#3ad737'

            } else {

                active.style.color = '#aaaaaa'
                span.innerHTML = '<em class="field-label">Inattivo</em>'

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

    static SortList(e) {

        let list = document.querySelector('.table-group-divider');
        let targetList = [...document.querySelectorAll('#t-head i')]
        let el = e.target
        
        if (el.tagName === 'I') {

            let sortedList = this.Sort([...list.children], Number(el.dataset.index))
            el.toggleAttribute('data')
    
            if (el.attributes.data /*&& !el.classList.contains('fa-arrow-down')*/) {
                sortedList.forEach(node => list.append(node));
                el.classList = 'fa-solid fa-arrow-down'
                el.parentElement.style.color = 'crimson';
            } else {
                sortedList.reverse().forEach(node => list.append(node));
                el.classList = 'fa-solid fa-arrow-up'
                el.parentElement.style.color = 'crimson';
            }
            
            targetList.map((e) => {
                if (e !== el) {
                    e.parentElement.style.color = 'black';
                    e.classList = 'fa-solid fa-arrows-up-down'
                    e.removeAttribute('data')
                }
            })
        }
        
    }

    static Sort(array, i) {

        switch (i) {

            case 0:
            case 3:
            case 9:
                return array.sort((a, b) => this.selectValue(a, i) - this.selectValue(b, i));
            case 1:
            case 2:
            case 4:
            case 5:
            case 6:
            case 10:
                return array.sort((a, b) => this.selectValue(a, i).localeCompare(this.selectValue(b, i)));
            case 7:
            case 8:
                return array.sort((a, b) => new Date(this.selectValue(a, i) !== '' ? this.selectValue(a, i) : '100-01-01') - 
                                            new Date(this.selectValue(b, i) !== '' ? this.selectValue(b, i) : '100-01-01'));
            default:
                return []; 

        }

    }

    static selectValue(el, i) {

        return i === 9 ? 
               el.children[i].children[0].children[0].value :
               el.children[i].outerText;
               
    }

    static ImagePreview(input) {

        let check = document.querySelector('.img-check')
        let img = document.querySelector('.add-img-file')

        input.addEventListener('change', () => {

            check.classList.remove('d-none')
            check.innerHTML = `<i class="fa-regular fa-circle-check" style="color: #17d924;"></i> ${input.value}`

            const [file] = input.files
            img.src = URL.createObjectURL(file)

        })
    }

    static HandleRemovePic(input) {

        let img = document.querySelector('.add-img-file')
        let imgSrc = img.src

        input.addEventListener('change', () => {

            if (input.checked) {
                img.src = 'https://placehold.co/200x200?text=Your+Pic'
            } else {
                img.src = imgSrc
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
}

export { Helper }

