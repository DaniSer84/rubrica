<?php

require_once __DIR__ . "/common.php";

use Daniser\Rubrica\Helper;

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
    <style>
        .button-container {
            display: flex;
            gap: .5rem;
        }
        .list-item-btn-container {
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }
        .list-item-btn-container button {
            border-radius: 10px;
        }
        a {
            text-decoration: none;
            color: black; 
        }
        .button-container button {
            flex: 1 0 auto;
        }

        .card {
            max-width: 500px;
            margin: 2rem auto;
            border-width: 2px;
            /*
            padding: 2.3rem 1.5rem;
            */
        }

        .card img {
            border-radius: 50%;
            scale: .6;
            flex-grow: 0;
        }

        .field:not(i) {
            width: 100%;
            height: 3rem;
        }

        .field i {
            padding-right: 2rem;
            width: 10%;
        }

        .field span {
            border-bottom: 1px solid lightgray;
            padding: 0.6rem 0;
            width: 90%;
            display: inline-block;
        }

        .field em {
            color: #aaaaaa;
            font-size: .9rem;
        }
    </style>
</head>

<body>
    <header class="d-flex justify-content-between align-items-center px-5 border-2 border-bottom">
        <h1>Rubrica</h1>
        <a href="index.php">Home</a>
    </header>
    <main>
        <div class="container">
            <?php
            $result = $db->getData("SELECT * FROM contacts ORDER BY surname", []);
            while ($contact = $result->fetch()): ?>
                <div class="card mb-3" style="max-width: 540px; max-height: 250px">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://placehold.co/200x200" class="img-fluid rounded-circle" alt="...">
                        </div>
                        <div class="col-md-8 d-flex">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><?=$contact['name']?> <?=$contact['surname']?></h5>
                                <a href="tel:<?=$contact['phone_number']?>">
                                    <p class="card-text mb-2"><i class="fa-solid fa-phone me-3"></i><?=$contact['phone_number']?></p>
                                </a>
                                <a href="mailto:<?=$contact['email']?>">
                                    <p class="card-text mb-2"><i class="fa-solid fa-envelope me-3"></i><?=$contact['email']?></p>
                                </a>
                                <a href="">
                                    <p class="card-text mb-2"><i class="fa-solid fa-circle-info me-3"></i><small class="text-body-secondary">more info</small></p>
                                </a>
                            </div>
                            <div class='list-item-btn-container me-2'>
                                <a href='update.php?item_id=<?=$contact['id']?>'>
                                    <button class='btn btn-info'><i class='fa-solid fa-pen-to-square'></i></button>
                                </a>
                                <button type='button' class='btn btn-danger delete-btn' data-bs-toggle='modal' data-bs-target='#deleteItem'><i class='fa-solid fa-trash-can'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
        <div class="container">
            <div class="card">
                <img src="https://placehold.co/400x400" class="card-img-top">
                <div class="card-body">
                    <?php
                    $result = $db->getData("SELECT name, surname, phone_number, email, company, role, birthdate FROM contacts WHERE id = ?", [8]);
                    $contact = $result->fetch(); ?>
                    <h5 class="card-title text-center mb-5"><?= $contact['name'] ?> <?= $contact['surname'] ?></h5>
                    <?php
                    foreach ($contact as $key => $value) {
                        echo Helper::createItem($key, $value);
                    }
                    ?>
                    <div class="button-container mt-4">
                        <button class="btn btn-secondary">Fai qualcosa</button>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting contact: <span
                                id="to-delete"></span></h1>
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