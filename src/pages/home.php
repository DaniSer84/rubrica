<?php

require_once __DIR__ . '/common.php';

use Daniser\Rubrica\Helper;

$head->setParams([
    'title' => 'Rubrica',
    'style' => '../css/style.css',
    'script' => '../js/main.js'
]);
$searchInput->setParams(['filters' => $searchFilters->render()]);
$navbar->setParams([
    'items' => [
        'home.php' => 'Home',
        'contact-list.php' => 'Lista Contatti',
    ],
    'active' => 'Home',
    'search' => $searchInput->render($_GET['search'] ?? '')
]);

?>

<!DOCTYPE html>
<html lang='en'>
<?= $head->render(); ?>

<body>
    <?= $navbar->render(); ?>
    <main>
        <div class='container-fluid mt-5 rubrica-container m-auto'>
            <h5 class='title text-center mb-3 mt-5'>Contatti</h5>
            <table class='table table-striped' style="min-width:1310px">
                <thead>
                    <tr id="t-head">
                        <th scope='col' style="color:crimson;">Id <i class="fa-solid fa-arrow-down" data-index="0" data></i></th>
                        <th scope='col'>Nome <i class="fa-solid fa-arrows-up-down" data-index="1"></i></th>
                        <th scope='col'>Cognome <i class="fa-solid fa-arrows-up-down" data-index="2"></i></th>
                        <th scope='col'>Telefono <i class="fa-solid fa-arrows-up-down" data-index="3"></i></th>
                        <th scope='col'>Compagnia <i class="fa-solid fa-arrows-up-down" data-index="4"></i></th>
                        <th scope='col'>Ruolo <i class="fa-solid fa-arrows-up-down" data-index="5"></i></th>
                        <th scope='col'>Email <i class="fa-solid fa-arrows-up-down" data-index="6"></i></th>
                        <th scope='col'>Data di nascita <i class="fa-solid fa-arrows-up-down" data-index="7"></i></th>
                        <th scope='col'>Data creazione <i class="fa-solid fa-arrows-up-down" data-index="8"></i></th>
                        <th scope='col'>Attivo <i class="fa-solid fa-arrows-up-down" data-index="9"></i></th>
                        <th scope='col'>Immagine <i class="fa-solid fa-arrows-up-down" data-index="10"></i></th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    <?php if ($data->rowCount()): ?>
                        <?php
                        while ($contact = $data->fetch()) {
                            $picture = $queryBuilder->getPicture($contact['id'])->fetch();
                            $hasImage = $picture[0] !== '' ? 'Yes' : 'No';
                            echo Helper::createContactTable($contact, $hasImage);
                        }
                        ?>
                    <?php else: ?>
                        <div class="container container-fluid m-auto w-50 text-center mt-5">
                            <p>Nessun contatto!</p>
                            <p class="fw-light"><a href="home.php">torna alla lista...</a></p>
                        </div>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        
        <hr>
        <a href='insert.php'>
            <button type='button' class='btn btn-success add-contact-btn'>
                Aggiungi un contatto
            </button>
        </a>
    </main>
    <?= $deleteModal->render()?>
    <?=$footer->render()?>
    <?=$bsStrip?>
</body>

</html>

<?php


