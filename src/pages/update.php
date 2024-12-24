<?php

require_once __DIR__ . "/common.php";

use Daniser\Rubrica\Helper;

$head->setParams([
    "title" => "Update Contact",
    "style" => "../css/style.css",
    "script" => "../js/main.js"
]);
$navbar->setParams([
    'items' => [
        'home.php' => 'Home',
        'contact-list.php' => 'Lista Contatti',
        '#' => 'Modifica contatto',
    ],
    'active' => 'Modifica contatto',
]);

$referer = $_SERVER["HTTP_REFERER"];

$data = $formRequest->sendRequest();
$contact = $data['contact'];
$picture = $data['picture'];

?>

<!DOCTYPE html>
<html lang="en">
<?= $head->render(); ?>

<body>
    <?=$navbar->render()?>
    <div class="form-container mb-5">
        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation">
            <div class="form-fields-container justify-content-between">
                <input type="text" name="back-to" value="<?= $referer ?>" hidden>
                <div class="mb-3 ">
                    <label for="file-upload" class="position-relative text-center mb-4">
                        <img src="<?=$picture[0] !== "" ? $picture[0] : "https://placehold.co/200x200?text=Your+Pic"?>" class="w-50 m-auto add-img-file img-fluid rounded-circle">
                    </label><br>
                    <span class="img-check d-none"></span>
                    <input type="file" id="file-upload" accept="image/png, image/jpeg" name="picture"
                        class="form-control d-none">
                    <label for="clear-picture">Remove picture</label>
                    <input type="checkbox" name="clear-picture" id="clear-picture">
                </div>
                <div class="form-check form-switch">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                        name="active" value="<?= Helper::AccessToValue($contact, 'active') ?>">
                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="id" name="id" placeholder=""
                        value="<?= Helper::AccessToValue($contact, "id") ?>" readonly>
                    <label for="id">Id</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="name" placeholder="Mario"
                        value="<?= Helper::AccessToValue($contact, "name") ?>" required>
                    <label for="nome">Nome</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cognome" name="surname" placeholder="Rossi"
                        value="<?= Helper::AccessToValue($contact, "surname") ?>">
                    <label for="cognome">Cognome</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" id="telefono" name="phone_number" placeholder="02 2021010"
                        value="<?= Helper::AccessToValue($contact, "phone_number") ?>" required minlength="8"
                        >
                    <label for="telefono">Telefono</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        value="<?= Helper::AccessToValue($contact, "email") ?>" required>
                    <label for="email">Indirizzo email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="società" name="company" placeholder="CDM"
                        value="<?= Helper::AccessToValue($contact, "company") ?>">
                    <label for="società">Società</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="qualifica" name="role" placeholder="Developer"
                        value="<?= Helper::AccessToValue($contact, "role") ?>">
                    <label for="qualifica">Qualifica</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="date" class="form-control" id="data_nascita" name="birthdate" placeholder="01/01/1980"
                        value="<?= Helper::AccessToValue($contact, "birthdate") ?>">
                    <label for="data_nascita">Data di nascita</label>
                </div>
            </div>
            <div class="button-container">
                <a href="<?= $referer ?>" class="btn btn-secondary">Indietro</a>
                <button type="submit" class="btn btn-primary">Modifica</button>
            </div>
        </form>
    </div>
    <?=$footer->render()?>
    <?=$bsStrip?>
</body>

</html>