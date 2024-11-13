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
        <a href="src/pages/contact-list.php">Lista contatti</a>
    </header>
    <main>
        <div class="container-fluid rubrica-container m-auto">
            <h5 class="title text-center mb-3 mt-5">Contatti</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Compagnia</th>
                        <th scope="col">Ruolo</th>
                        <th scope="col">Email</th>
                        <th scope="col">Data di nascita</th>
                        <th scope="col">Data creazione</th>
                        <th scope="col">Attivo</th>
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
         <?=$deleteModal->render()?>
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


