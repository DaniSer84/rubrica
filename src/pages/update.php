<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

use Daniser\Rubrica\Helper;

$selectedContact = null;

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET["item_id"];

    $result = $db->getData("SELECT * FROM contacts WHERE id = ?", [$id]);

    $selectedContact = $result->fetch();

    if (!$selectedContact) {

        die("Actor not found.");

    }

}

// echo "<pre>";
// var_dump($_SERVER);
// echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phoneNumber = $_POST["phone_number"];
    $company = $_POST["company"];
    $role = $_POST["role"];
    $picture = $_FILES["picture"]["name"];
    $email = $_POST["email"];
    $birthdate = $_POST["birthdate"];

    $backTo = $_POST["back-to"];

    $db->setData(
        "UPDATE contacts SET " .
        "name = ?,  surname = ?, phone_number = ?, company = ?, role = ?, " .
        "picture = ?, email = ?, birthdate = ? WHERE id = ?",
        [
            [
                $name,
                $surname,
                $phoneNumber,
                $company,
                $role,
                $picture,
                $email,
                $birthdate,
                $id
            ]
        ]
    );

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    // die();
    header('Location: ' . $backTo);
    exit;

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
        header>* {
            min-width: 200px;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
            border: 1px solid lightgray;
            padding: 2.3rem 1.5rem;
            border-radius: 5px;
        }

        .fields-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            max-height: 100vh;
        }

        .button-container {
            display: flex;
            gap: .5rem;
        }

        .button-container button {
            flex: 1 0 auto;
        }
    </style>
    <script src="https://kit.fontawesome.com/fb85e57258.js" crossorigin="anonymous"></script>
    <script src="js/index.js" type="module"></script>
</head>

<body>
    <header class="d-flex justify-content-between align-items-center px-5 border-2 border-bottom text-center">
        <h1>Rubrica</h1>
        <h3>Modifica Contatto</h3>
        <nav>
            <a href="../../index.php">Home</a>
            |
            <a href="contact-list.php">Lista Contatti</a>
        </nav>
    </header>
    <div class="form-container mb-5">
        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation">
            <div class="fields-container">
                <input type="text" name="back-to" value="<?=$_SERVER["HTTP_REFERER"]?>" hidden>
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="file_upload" name="picture"
                        value="<?= Helper::AccessToValue($selectedContact, "picture") ?>">
                    <label for="file_upload">Immagine</label>
                    <div class="invalid-feedback">
                        Please choose a file.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="id" name="id" placeholder=""
                        value="<?= Helper::AccessToValue($selectedContact, "id") ?>" readonly>
                    <label for="id">Id</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="name" placeholder="Mario"
                        value="<?= Helper::AccessToValue($selectedContact, "name") ?>">
                    <label for="nome">Nome</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cognome" name="surname" placeholder="Rossi"
                        value="<?= Helper::AccessToValue($selectedContact, "surname") ?>">
                    <label for="cognome">Cognome</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" id="telefono" name="phone_number" placeholder="02 2021010"
                        value="<?= Helper::AccessToValue($selectedContact, "phone_number") ?>">
                    <label for="telefono">Telefono</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        value="<?= Helper::AccessToValue($selectedContact, "email") ?>">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="società" name="company" placeholder="CDM"
                        value="<?= Helper::AccessToValue($selectedContact, "company") ?>">
                    <label for="società">Società</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="qualifica" name="role" placeholder="Developer"
                        value="<?= Helper::AccessToValue($selectedContact, "role") ?>">
                    <label for="qualifica">Qualifica</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="date" class="form-control" id="data_nascita" name="birthdate" placeholder="01/01/1980"
                        value="<?= Helper::AccessToValue($selectedContact, "birthdate") ?>" required>
                    <label for="data_nascita">Data di nascita</label>
                </div>
            </div>
            <div class="button-container">
                <button type="reset" class="btn btn-secondary">Resetta</button>
                <button type="submit" class="btn btn-primary">Modifica</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>