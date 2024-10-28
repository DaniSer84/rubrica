<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

$headParams = [
    "title" => "Update Contact", 
    "style" => "../css/style.css",
    "script" => "../js/main.js"
];
$head->setParams($headParams);

$contacts = $db->getData("SELECT id, name, surname, phone_number, email, active FROM contacts ORDER BY surname", []);

?>

<!DOCTYPE html>
<html lang="en">
<?=$head->render()?>
<body>
    <header class="d-flex justify-content-between align-items-center px-5 border-2 border-bottom text-center">
    <a href="../../index.php"><h1>Rubrica</h1></a>
        <h3>Lista contatti</h3>
        <nav>
            <a href="../../index.php">Home</a>
        </nav>
    </header>
    <main>
        <div class="container">
            <button type="button" class="btn btn-success add-contact-btn mt-2" data-bs-toggle="modal"
                data-bs-target="#addContact">
                Aggiungi un contatto
            </button>
            <?php
            while ($contact = $contacts->fetch()): 
                $picture = $db->getData("SELECT content FROM pictures WHERE contact_id = " . $contact['id'])->fetch();
            ?>
                <div class="card mb-3" style="max-width: 540px; max-height: 250px">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?=$picture[0]?>" class="img-fluid rounded-circle" alt="...">
                        </div>
                        <div class="col-md-8 d-flex">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><?= $contact['name'] ?> <?= $contact['surname'] ?> <i class='fa-solid fa-circle-check' style='color:<?=$contact['active'] == '1' ? '#3ad737' : '#aaaaaa'?>'></i></h5> 
                                <a href="tel:<?= $contact['phone_number'] ?>">
                                    <p class="card-text mb-2"><i
                                            class="fa-solid fa-phone me-3"></i><?= $contact['phone_number'] ?></p>
                                </a>
                                <a href="mailto:<?= $contact['email'] ?>">
                                    <p class="card-text mb-2"><i
                                            class="fa-solid fa-envelope me-3"></i><?= $contact['email'] ?></p>
                                </a>
                                <a href="contact.php?item_id=<?= $contact['id'] ?>">
                                    <p class="card-text mb-2"><i class="fa-solid fa-circle-info me-3"></i><small
                                            class="text-body-secondary">more info</small></p>
                                </a>
                            </div>
                            <div class='list-item-btn-container me-2'>
                                <a href='update.php?item_id=<?= $contact['id'] ?>'>
                                    <button class='btn btn-info'><i class='fa-solid fa-pen-to-square'></i></button>
                                </a>
                                <button type='button' class='btn btn-danger set-to-delete' data-bs-toggle='modal'
                                    data-bs-target='#deleteItem' data-id='<?= $contact['id'] ?>'><i
                                        class='fa-solid fa-trash-can'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
    </main>
    <!-- Modal - delete contact -->
    <div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminando contatto con id: <span id="to-delete"></span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare il contatto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <a href="" id="delete-btn">
                        <button type="button" class="btn btn-danger">Elimina</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal - add contact -->
    <div class="modal fade" id="addContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="file_upload" class="position-relative text-center">
                                    <img src="../../img/user-account.png" class="w-50 m-auto add-img-file">
                                </label>
                                <input type="file" class="form-control d-none" id="file_upload" name="picture">
                                <div class="invalid-feedback">
                                    Please choose a file.
                                </div>
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
                                <input type="text" class="form-control" id="società" name="company" placeholder="CDM">
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

    <?=$bsStrip?>
</body>

</html>