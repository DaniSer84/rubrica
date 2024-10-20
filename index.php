<?php

require_once __DIR__ . "/common.php";
use Daniser\Rubrica\Helper;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $string = Helper::setString($_POST);
    $tokens = Helper::setTokens($_POST);
    $values = Helper::setQueryValues($_POST);

    if ($_FILES["picture"]["name"]) {

        $string .= ",picture";
        $tokens .= ",?";
        array_push($values, $_FILES["picture"]["name"]);

    }

    $query = "INSERT INTO contacts ( $string ) VALUES ( $tokens )";

    $db->setData($query, [$values]);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-container {
            max-width: 500px;
            margin: auto;
            border: 1px solid lightgray;
            padding: 2.3rem 1.5rem;
            border-radius: 5px;
        }

        a {
            text-decoration: none;
            color: #434343;

            &:hover {
                text-decoration: underline;
                color: darkgray;
            }
        }

        .list-item-text {
            vertical-align: sub;
        }

        .list-item-btn-container button {
            scale: .8;
        }

        .button-container {
            display: flex;
            gap: .5rem;
        }

        .button-container button {
            flex: 1 0 auto;
        }

        .card {
            max-width: 500px;
            margin: 2rem auto;
            border: 1px solid lightgray;
            padding: 2.3rem 1.5rem;
            border-radius: 5px;
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
    <script src="https://kit.fontawesome.com/fb85e57258.js" crossorigin="anonymous"></script>
    <script src="js/index.js" type="module"></script>
</head>

<body>
    <div class="container">
        <h5 class="title text-center mb-3 mt-5">Contacts</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Company</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Active</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                $result = $db->getData("SELECT * FROM contacts ORDER BY surname", []);
                while ($contact = $result->fetch()) {
                    echo Helper::createContactTable($contact);
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete contact with id: <span id="id-to-delete"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this contact?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="" id="delete-btn">
                        <button type="button" class="btn btn-primary" >Delete</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-container">
        <h4 class="mb-5 text-center">Aggiungi un contatto:</h4>
        <?php
        function setInputValue($name)
        {
            return $_POST ? $_POST[$name] : null;
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation">
            <div class="form-floating mb-3">
                <input type="file" class="form-control" id="file_upload" name="picture">
                <label for="file_upload">Immagine</label>
                <div class="invalid-feedback">
                    Please choose a file.
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nome" name="name" placeholder="Mario"
                    >
                <label for="nome">Nome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="cognome" name="surname" placeholder="Rossi"
                >
                <label for="cognome">Cognome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="telefono" name="phone_number" placeholder="02 2021010"
                    >
                <label for="telefono">Telefono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                    >
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="società" name="company" placeholder="CDM"
                    >
                <label for="società">Società</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="qualifica" name="role" placeholder="Developer">                   >
                <label for="qualifica">Qualifica</label>
            </div>
            <div class="form-floating mb-5">
                <input type="date" class="form-control" id="data_nascita" name="birthdate" placeholder="01/01/1980">
                <label for="data_nascita">Data di nascita</label>
            </div>
            <div class="button-container">
                <button type="reset" class="btn btn-secondary">Cancella</button>
                <button type="submit" class="btn btn-primary">Crea</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

<?php


