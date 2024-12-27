<?php

require_once __DIR__ . "/common.php";

$headParams = [
    "title" => "Insert Contact",
    "style" => "../css/style.css",
    "script" => "../js/main.js"
];
$head->setParams($headParams);

$referer = $_SERVER["HTTP_REFERER"] ?? "home.php";

?>

<!DOCTYPE html>
<html lang="it-IT">
<?= $head->render(); ?>
<?php
$formRequest->sendRequest();
?>

<body>
    <div class="container mb-5 border p-3 my-3" style="max-width:500px">
        <h4 class="mb-4 text-center">Aggiungi un contatto:</h4>
        <form name="form-to-validate" action="" method="POST" enctype="multipart/form-data" class="needs-validation">
            <input type="text" name="back-to" value="<?= $referer ?>" hidden>
            <div class="mb-3 ">
                <label for="file-upload" class="position-relative text-center">
                    <img src="../img/user-account.png" class="w-50 m-auto add-img-file" title="Inserisci un'immagine per il profilo.">
                </label><br>
                <span class="img-check d-none"></span>
                <input type="file" id="file-upload" accept="image/png, image/jpeg" name="picture"
                    class="form-control d-none">
            </div>
            <p class="required-fields">** I campi in rosso sono obbligatori! **</p>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Mario" pattern="(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)" required>
                <span></span>
                <label for="name">Nome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Rossi">
                <label for="cognome">Cognome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="phone" name="phone_number" placeholder="1234567890"
                    minlength="8" maxlength="14" required pattern="^[0-9]+$">
                <span></span>
                <label for="phone">Telefono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required>
                <span></span>
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="company" name="company" placeholder="CDM">
                <label for="società">Società</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="role" name="role" placeholder="Developer">
                <label for="qualifica">Qualifica</label>
            </div>
            <div class="form-floating mb-5">
                <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="01/01/1980">
                <label for="data_nascita">Data di nascita</label>
            </div>
            <div class="button-container">
                <button type="reset" class="btn btn-secondary">Resetta</button>
                <a href="<?= $referer ?>" class="btn btn-danger" type="button">Annulla</a>
                <button type="submit" class="btn btn-primary">Crea</button>
            </div>
        </form>
    </div>
    <?php
    $bsStrip
        ?>
</body>

</html>