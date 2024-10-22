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

        button {
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
            while ($contact = $result->fetch()) {
                echo Helper::createNameSurnameListItem($contact);
            }
            ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>