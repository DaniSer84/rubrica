<?php

require_once __DIR__ ."/common.php";

// ci viene passato in get
if ( $_SERVER["REQUEST_METHOD"] == "GET") {


    if ( $_GET["item_id"] ) {

        $id = $_GET["item_id"];
        
        $db->deleteData("DELETE FROM contacts WHERE id = ?", [ $id ] );
        
    } else {

        echo "<h3>Impossible to delete contact: contact not found</h3>" . PHP_EOL;

        echo "<a href='index.php'>back</a>";

        die();
        
    }

    // $db2->deleteData("DELETE FROM actor WHERE actor_id = ?", [ $id ] );

    header("Location: index.php");
    
}