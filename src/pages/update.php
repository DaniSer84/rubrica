<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

use Daniser\Rubrica\Helper;

$selectedContact = null;

$headParams = [
    "title" => "Update Contact", 
    "style" => "../css/style.css",
    "script" => "../js/main.js"
];
$head->setParams($headParams);

$referer = $_SERVER["HTTP_REFERER"];

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET["item_id"];

    $result = $db->getData("SELECT * FROM contacts WHERE id = ?", [$id]);

    $selectedContact = $result->fetch();

    if (!$selectedContact) {

        die("Actor not found.");

    }

}

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

    header("Location: $backTo");
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">
<?=$head->render();?>
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
    <div class="form-container mb-5 mt-2">
        <!-- TODO: Add 'active' and 'picture' fields -->
        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation">
            <div class="form-fields-container">
                <input type="text" name="back-to" value="<?=$referer?>" hidden>
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
                <a href="<?=$referer?>"><button class="btn btn-secondary">Indietro</button></a>
                <button type="submit" class="btn btn-primary">Modifica</button>
            </div>
        </form>
    </div>

    <?=$bsStrip?>
</body>

</html>