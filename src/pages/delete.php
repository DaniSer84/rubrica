<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

if ( $_SERVER["REQUEST_METHOD"] == "GET") {


    if ( $_GET["item_id"] ) {

        $id = $_GET["item_id"];
        
        $db->deleteData("DELETE FROM contacts WHERE id = ?", [ $id ] );
        
    } else {

        echo "<h3>Impossible to delete contact: contact not found</h3>" . PHP_EOL;

        echo "<a href='index.php'>back</a>";

        die();
        
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    
}