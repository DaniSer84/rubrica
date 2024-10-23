<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

use Daniser\Rubrica\Helper;

if ( $_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET["item_id"];

    $result = $db->getData("SELECT name, surname, phone_number, email, company, role, birthdate FROM contacts WHERE id = ?", [ $id ] );

    $contact = $result->fetch();

    if (!$contact) {

        die("Actor not found.");
        
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Contact Form</title>
    <script src="https://kit.fontawesome.com/fb85e57258.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="src/js/main.js" type="module"></script>
</head>

<body>
    <header class="d-flex justify-content-between align-items-center px-5 border-2 border-bottom text-center">
        <h1>Rubrica</h1>
        <h3>Info Contatto</h3>
        <nav>
        <a href="../../index.php">Home</a>
        |
        <a href="contact-list.php">Lista Contatti</a>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="card">
                <img src="https://placehold.co/200x200" class="card-img-top">
                <div class="card-body">
                    <?php
                    // $result = $db->getData("SELECT name, surname, phone_number, email, company, role, birthdate FROM contacts WHERE id = ?", [8]);
                    // $contact = $result->fetch(); ?>
                    <h5 class="card-title display-6 text-center mb-5"><?= $contact['name'] ?> <?= $contact['surname'] ?></h5>
                    <?php
                    foreach ($contact as $key => $value) {
                        echo Helper::createItem($key, $value);
                    }
                    ?>
                    <div class="button-container mt-4">
                        <!-- TODO: implement functions for these buttons -->
                        <button class="btn btn-primary">Modifica</button>
                        <button class="btn btn-danger">Cancella</button>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <!-- Modal - delete contact -->
    <div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting contact: <span id="to-delete"></span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this contact?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="" id="delete-btn">
                        <button type="button" class="btn btn-primary">Delete</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>