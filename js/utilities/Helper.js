
class Helper {

    static setIdtoDelete(id) {

        let deleteButton = document.getElementById('delete-btn')
        let idToDelete = document.getElementById('id-to-delete')
    
        idToDelete.textContent = id
    
        deleteButton.setAttribute("href", `delete.php?item_id=${id}`)
    
    }
    
}



export { Helper }