
class Helper {

    static setToDelete(id) {

        let deleteButton = document.getElementById('delete-btn');
        let toDelete = document.getElementById('to-delete');
    
        toDelete.textContent = id;
    
        deleteButton.setAttribute("href", `src/pages/delete.php?item_id=${id}`);
    
    }
    
}

export { Helper }