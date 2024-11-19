<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

use Daniser\Rubrica\Helper;
use Rubrica\Php\FileUpload\ImageUpload;
use Rubrica\Php\FormRequest\FormRequest;

$headParams = [
    "title" => "Update Contact",
    "style" => "../css/style.css",
    "script" => "../js/main.js"
];
$head->setParams($headParams);

$referer = $_SERVER["HTTP_REFERER"];

$formRequest = new FormRequest($_REQUEST, $_FILES, $_SERVER, $db);

$data = $formRequest->sendRequest();

// echo "<pre>";
// var_dump($data);
// echo "</pre>";

// if ($_SERVER["REQUEST_METHOD"] == "GET") {

    
//     $id = $_GET["item_id"];

//     $selectedContact = $db->getData("SELECT * FROM contacts WHERE id = ?", [$id])->fetch();
    
//     if (!$selectedContact) {
        
//         die("Actor not found.");
        
//     }
    
//     $picture = $db->getData("SELECT content FROM pictures WHERE contact_id = " . $selectedContact['id'])->fetch();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     var_dump($_REQUEST);
// // var_dump($_POST);
// // var_dump($_FILES);
// die();
    
    $id = $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phoneNumber = $_POST["phone_number"];
    $company = $_POST["company"];
    $role = $_POST["role"];
    $email = $_POST["email"];
    $birthdate = $_POST["birthdate"];
    $active = $_POST["active"];
    $backTo = $_POST["back-to"];
    $backLink = "<a href=$backTo>Back</a>";


    if ($_FILES["picture"]["name"]) {
        
        $imageUpload = new ImageUpload($_FILES['picture'], UPLOAD_DIR);
        $imageUpload->validateImage($backLink);
        $mime_type = $imageUpload->getMimeType();
        $base64 = $imageUpload->getBase64();
    
        $updatePicture = "UPDATE pictures SET 
                        content = '$base64',
                        type = '$mime_type' 
                        WHERE contact_id = '$id'";
        
        $db->doWithTransaction([
            $updatePicture
        ]);
    }

    $updateContact = "UPDATE contacts SET
                        name = '$name',  
                        surname = '$surname', 
                        phone_number = '$phoneNumber', 
                        company = '$company', 
                        role = '$role',
                        email = '$email', 
                        birthdate = '$birthdate', 
                        active = '$active' 
                        WHERE id = '$id'";


    $db->doWithTransaction([
        $updateContact
    ]);

    header("Location: $backTo");
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">
<?= $head->render(); ?>

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
        <!-- TODO: Improve picture for update: 1) set X for no picture 2) show preview if possible... -->
        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation">
            <div class="form-fields-container justify-content-between">
                <input type="text" name="back-to" value="<?= $referer ?>" hidden>
                <div class="mb-3 ">
                    <label for="file-upload" class="position-relative text-center">
                        <img src="<?=$data["picture"][0] !== "" ? $data["picture"][0] : "https://placehold.co/200x200?text=Your+Pic"?>" class="w-50 m-auto add-img-file img-fluid rounded-circle">
                    </label><br>
                    <span class="img-check d-none"></span>
                    <input type="file" id="file-upload" accept="image/png, image/jpeg" name="picture"
                        class="form-control d-none">
                </div>
                <div class="form-check form-switch">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                        name="active" value="<?= Helper::AccessToValue($data["contact"], 'active') ?>">
                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="id" name="id" placeholder=""
                        value="<?= Helper::AccessToValue($data["contact"], "id") ?>" readonly>
                    <label for="id">Id</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="name" placeholder="Mario"
                        value="<?= Helper::AccessToValue($data["contact"], "name") ?>">
                    <label for="nome">Nome</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cognome" name="surname" placeholder="Rossi"
                        value="<?= Helper::AccessToValue($data["contact"], "surname") ?>">
                    <label for="cognome">Cognome</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" id="telefono" name="phone_number" placeholder="02 2021010"
                        value="<?= Helper::AccessToValue($data["contact"], "phone_number") ?>">
                    <label for="telefono">Telefono</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        value="<?= Helper::AccessToValue($data["contact"], "email") ?>">
                    <label for="email">Indirizzo email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="società" name="company" placeholder="CDM"
                        value="<?= Helper::AccessToValue($data["contact"], "company") ?>">
                    <label for="società">Società</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="qualifica" name="role" placeholder="Developer"
                        value="<?= Helper::AccessToValue($data["contact"], "role") ?>">
                    <label for="qualifica">Qualifica</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="date" class="form-control" id="data_nascita" name="birthdate" placeholder="01/01/1980"
                        value="<?= Helper::AccessToValue($data["contact"], "birthdate") ?>" required>
                    <label for="data_nascita">Data di nascita</label>
                </div>
            </div>
            <div class="button-container">
                <a href="<?= $referer ?>"><button class="btn btn-secondary">Indietro</button></a>
                <button type="submit" class="btn btn-primary">Modifica</button>
            </div>
        </form>
    </div>

    <?= $bsStrip ?>
</body>

</html>