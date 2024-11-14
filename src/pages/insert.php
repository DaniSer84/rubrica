<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

use Daniser\Rubrica\Helper;
use Rubrica\Php\ImageUpload;

$headParams = [
    "title" => "Update Contact",
    "style" => "../css/style.css",
    "script" => "../js/main.js"
];
$head->setParams($headParams);

$referer = $_SERVER["HTTP_REFERER"];

// TODO: abstract form methods
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $relevantKeys = array_filter($_POST, function($key) {
        return $key !== "back-to";
    }, ARRAY_FILTER_USE_KEY);
    
    $fields = Helper::setFields($relevantKeys);
    $tokens = Helper::setTokens($relevantKeys);
    $values = Helper::setQueryValues($relevantKeys);
    $backTo = $_POST['back-to'];
    
    // TODO: make class for Picture handling
    if ($_FILES["picture"]["name"]) {
        
        $status = $_FILES["picture"]["error"];
        $filename = str_replace(' ', '-', $_FILES["picture"]["name"]);
        $tmp = $_FILES["picture"]["tmp_name"];
        $filesize = filesize($tmp);
        $mime_type = ImageUpload::getMimeType($tmp);

        if ($status) {

            echo "Error uploading file (error code: $status) <br> <a href=$backTo>Back</a>";
            die();
            
        }
        
        if ($filesize > MAX_SIZE) {
            
            echo "File size exceeds limit: <br> File size: " . 
            ImageUpload::formatFileSize($filesize) . 
            "<br> allowed " . 
            ImageUpload::formatFileSize(MAX_SIZE) .
            "<br><a href=$backTo>Back</a>";
            
            die();
        }

        if (!in_array($mime_type, array_keys(ALLOWED_FILES))) {

            echo "file type not allowed<br><a href=$backTo>Back</a>";
            die();
            
        }

        $uploadedFile = pathinfo($filename, PATHINFO_FILENAME) . '.' . ALLOWED_FILES[$mime_type];
        
        $filepath = UPLOAD_DIR . "/" . $uploadedFile;

        if (!file_exists($filepath)) {
            $success = move_uploaded_file($tmp, $filepath);
            if (!$success) {
                    echo "Error moving the file to the upload folder<br><a href=$backTo>Back</a>";
                    die();
                }
        }
        
        $data = file_get_contents($filepath);
        $type = ALLOWED_FILES[$mime_type];
        $base64 = "data:image/$type;base64," . base64_encode($data);

    }
        

    $insertContact = "INSERT INTO contacts ( $fields ) VALUES ( $values )";

    if (!($base64 && $mime_type)) {
        $base64 = null;
        $mime_type = null;
    }

    $insertPicture = "INSERT INTO pictures ( content, type, contact_id ) VALUES ( '$base64', '$mime_type', last_insert_id() )";
    
    $db->doWithTransaction([
        $insertContact,
        $insertPicture,
    ]);
    
    
    header("Location: $backTo");
}

?>

<!DOCTYPE html>
<html lang="en">
<?= $head->render(); ?>

<body>
<div class="form-container mb-5">
                            <h4 class="mb-5 text-center">Aggiungi un contatto:</h4>
                            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation">
                            <input type="text" name="back-to" value="<?= $referer ?>" hidden>
                                <div class="mb-3 ">
                                    <label for="file-upload" class="position-relative text-center">
                                        <img src="../../img/user-account.png" class="w-50 m-auto add-img-file">
                                    </label><br>
                                    <span class="img-check d-none overflow-hidden"></span>
                                    <input type="file" id="file-upload" accept="image/png, image/jpeg" name="picture" class="form-control d-none">
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nome" name="name" placeholder="Mario">
                                    <label for="nome">Nome</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="cognome" name="surname"
                                        placeholder="Rossi">
                                    <label for="cognome">Cognome</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="telefono" name="phone_number"
                                        placeholder="02 2021010" required>
                                    <label for="telefono">Telefono</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="name@example.com">
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="società" name="company"
                                        placeholder="CDM">
                                    <label for="società">Società</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="qualifica" name="role"
                                        placeholder="Developer">
                                    <label for="qualifica">Qualifica</label>
                                </div>
                                <div class="form-floating mb-5">
                                    <input type="date" class="form-control" id="data_nascita" name="birthdate"
                                        placeholder="01/01/1980" required>
                                    <label for="data_nascita">Data di nascita</label>
                                </div>
                                <div class="button-container">
                                    <button type="reset" class="btn btn-secondary">Resetta</button>
                                    <a href="<?=$referer?>"><button type="button" class="btn btn-danger">Annulla</button></a>
                                    <button type="submit" class="btn btn-primary">Crea</button>
                                </div>
                            </form>
                        </div>

<?= $bsStrip ?>
</body>

</html>