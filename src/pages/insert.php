<?php

require_once __DIR__ . "/common.php";

$headParams = [
    "title" => "Update Contact",
    "style" => "../css/style.css",
    "script" => "../js/main.js"
];
$head->setParams($headParams);

$referer = $_SERVER["HTTP_REFERER"];

?>

<!DOCTYPE html>
<html lang="en">
<?= $head->render(); ?>

<?php
$formRequest->sendRequest();
?>
<body>
    <div class="container mb-5 border p-3 my-3" style="max-width:500px">
        <h4 class="mb-5 text-center">Aggiungi un contatto:</h4>
        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation">
            <input type="text" name="back-to" value="<?= $referer ?>" hidden>
            <div class="mb-3 ">
                <label for="file-upload" class="position-relative text-center">
                    <img src="../img/user-account.png" class="w-50 m-auto add-img-file">
                </label><br>
                <span class="img-check d-none"></span>
                <input type="file" id="file-upload" accept="image/png, image/jpeg" name="picture"
                    class="form-control d-none">
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nome" name="name" placeholder="Mario">
                <label for="nome">Nome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="cognome" name="surname" placeholder="Rossi">
                <label for="cognome">Cognome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="telefono" name="phone_number" placeholder="02 2021010"
                    required>
                <label for="telefono">Telefono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="società" name="company" placeholder="CDM">
                <label for="società">Società</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="qualifica" name="role" placeholder="Developer">
                <label for="qualifica">Qualifica</label>
            </div>
            <div class="form-floating mb-5">
                <input type="date" class="form-control" id="data_nascita" name="birthdate" placeholder="01/01/1980"
                    >
                <label for="data_nascita">Data di nascita</label>
            </div>
            <div class="button-container">
                <button type="reset" class="btn btn-secondary">Resetta</button>
                <a href="<?= $referer ?>"><button type="button" class="btn btn-danger">Annulla</button></a>
                <button type="submit" class="btn btn-primary">Crea</button>
            </div>
        </form>
    </div>
    <?php 
    // $footer->render();
    // $bsStrip; 
    ?>
</body>

</html>