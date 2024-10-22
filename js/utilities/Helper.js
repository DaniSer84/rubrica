
class Helper {

    static setToDelete(name, id) {

        let deleteButton = document.getElementById('delete-btn')
        let toDelete = document.getElementById('to-delete')
    
        toDelete.textContent = name
    
        deleteButton.setAttribute("href", `delete.php?item_id=${id}`)
    
    }
    
}

export { Helper }