<?php

require_once __DIR__ . "/common.php";
use Daniser\Rubrica\Helper;

$headParams = [
    "title" => "Rubrica",
    "style" => "src/css/style.css",
    "script" => "src/js/main.js"
];
$head->setParams($headParams);

?>

<!DOCTYPE html>
<html lang="en">
<?= $head->render(); ?>

<body>
    <header class="d-flex justify-content-between align-items-center px-5 border-2 border-bottom">
        <a href="index.php">
            <h1>Rubrica</h1>
        </a>
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
        <a href="src/pages/insert.php">
            <button type="button" class="btn btn-success add-contact-btn">
                Aggiungi un contatto
            </button>
        </a>
    </main>

    <?= $bsStrip ?>
</body>

</html>

<?php


