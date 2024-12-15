<?php

require_once __DIR__ . '/common.php';

use Daniser\Rubrica\Helper;
use Rubrica\Php\QueryBuilder\QueryBuilder;

$head->setParams([
    'title' => 'Rubrica',
    'style' => 'src/css/style.css',
    'script' => 'src/js/main.js'
]);
$navbar->setParams([
    'items' => [
        'index.php' => 'Home',
        'src/pages/contact-list.php' => 'Lista Contatti',
    ],
    'active' => 'Home',
    'search' => true
])

    ?>

<!DOCTYPE html>
<html lang='en'>
<?= $head->render(); ?>

<body>
    <?= $navbar->render(); ?>
    <main>
        <div class='container-fluid rubrica-container m-auto'>
            <h5 class='title text-center mb-3 mt-5'>Contatti</h5>
            <table class='table table-striped' style="min-width:1250px">
                <thead>
                    <tr id="t-head">
                        <th scope='col'>Id <i class="fa-solid fa-arrows-up-down" data-index="0"></i></th>
                        <th scope='col'>Nome <i class="fa-solid fa-arrows-up-down" data-index="1"></i></th>
                        <th scope='col'>Cognome <i class="fa-solid fa-arrows-up-down" data-index="2"></i></th>
                        <th scope='col'>Telefono <i class="fa-solid fa-arrows-up-down" data-index="3"></i></th>
                        <th scope='col'>Compagnia <i class="fa-solid fa-arrows-up-down" data-index="4"></i></th>
                        <th scope='col'>Ruolo <i class="fa-solid fa-arrows-up-down" data-index="5"></i></th>
                        <th scope='col'>Email <i class="fa-solid fa-arrows-up-down" data-index="6"></i></th>
                        <th scope='col'>Data di nascita <i class="fa-solid fa-arrows-up-down" data-index="7"></i></th>
                        <th scope='col'>Data creazione <i class="fa-solid fa-arrows-up-down" data-index="8"></i></th>
                        <th scope='col'>Attivo</th>
                        <th scope='col'>Image</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    <?php
                    $result = $db->getData(QueryBuilder::GetAll(), []);
                    if ($result->fetch()) {
                        while ($contact = $result->fetch()) {
                            $picture = $db->getData(QueryBuilder::GetPicture(), [$contact['id']])->fetch();
                            $hasImage = $picture[0] !== '' ? 'Yes' : 'No';
                            echo Helper::createContactTable($contact, $hasImage);
                        }
                    } else {
                        echo "<p class='text-center'>Nessun contatto trovato</p>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Modal - delete contact -->
        <?= $deleteModal->render() ?>
        <hr>
        <a href='src/pages/insert.php'>
            <button type='button' class='btn btn-success add-contact-btn'>
                Aggiungi un contatto
            </button>
        </a>
    </main>

    <?= $bsStrip ?>
</body>

</html>

<?php


