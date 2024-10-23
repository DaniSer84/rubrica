
class Helper {

    static setToDelete(id) {

        let deleteButton = document.getElementById('delete-btn');
        let toDelete = document.getElementById('to-delete');
    
        toDelete.textContent = id;

        let url = document.URL === "http://localhost:83/src/pages/contact-list.php" ? 
                                   "delete.php" : 
                                   "src/pages/delete.php"
    
        deleteButton.setAttribute("href", `${url}?item_id=${id}`);
    
    }
    
}

export { Helper }

