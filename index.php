<?php

require_once __DIR__ . "/common.php";
use Daniser\Rubrica\Helper;

const UPLOAD_DIR = __DIR__ . "/uploads";
const ALLOWED_FILES = [
    'image/png' => 'png',
    'image/jpeg' => 'jpg'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $string = Helper::setString($_POST);
    $tokens = Helper::setTokens($_POST);
    $values = Helper::setQueryValues($_POST);
    
    
    if ($_FILES["picture"]["name"]) {
        
        $string .= ",picture";
        $tokens .= ",?";
        array_push($values, $_FILES["picture"]["name"]);
        
        // TODO: https://www.phptutorial.net/php-tutorial/php-file-upload/
        $filename = $_FILES["picture"]["name"];
        $tmp = $_FILES["picture"]["tmp_name"];
    
        $uploadedFile = pathinfo($filename, PATHINFO_FILENAME) . '.png';
    
        $filepath = UPLOAD_DIR . '/' . $uploadedFile;
    
        $success = move_uploaded_file($tmp, $filepath);
        if (!$success) {
            echo "Error moving the file to the upload folder";
            die();
        }
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
    <link rel="stylesheet" href="src/css/style.css">
    <script src="https://kit.fontawesome.com/fb85e57258.js" crossorigin="anonymous"></script>
    <script src="src/js/main.js" type="module"></script>
</head>

<body>
    <header class="d-flex justify-content-between align-items-center px-5 border-2 border-bottom">
        <h1>Rubrica</h1>
        <a href="src/pages/contact-list.php">Contact list</a>
    </header>
    <main>
        <div class="container-fluid rubrica-container m-auto">
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
                        <th scope="col">Picture</th>
                        <th scope="col">Email</th>
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
        <!-- Modal - delete contact -->
        <div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting contact with id: <span
                                id="to-delete"></span></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you really want to procede?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="" id="delete-btn">
                            <button type="button" class="btn btn-danger">Delete</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <button type="button" class="btn btn-success add-contact-btn" data-bs-toggle="modal" data-bs-target="#addContact">
            Aggiungi un contatto
        </button>
        <!-- Modal add contact-->
        <div class="modal fade" id="addContact" tabinfile-uploaddex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-container mb-5">
                            <h4 class="mb-5 text-center">Aggiungi un contatto:</h4>
                            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation">
                                <div class="mb-3 ">
                                    <label for="file-upload" class="position-relative text-center">
                                        <img src="img/user-account.png" class="w-50 m-auto add-img-file">
                                    </label><br>
                                    <span class="img-check d-none"></span>
                                    <input type="file" id="file-upload" accept="image/png, image/jpeg" name="picture" class="form-control d-none">
                                    <div class="invalid-feedback">
                                        Please choose a file.
                                    </div>
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
                                    <button type="submit" class="btn btn-primary">Crea</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

<?php


