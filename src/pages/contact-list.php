<?php

use Rubrica\Php\QueryBuilder\QueryBuilder;

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

$head->setParams([
    "title" => "Lista Contatti",
    "style" => "../css/style.css",
    "script" => "../js/main.js"
]);
$navbar->setParams([
    'items' => [
        '../../index.php' => 'Home',
        '#' => 'Lista Contatti',
    ],
    'active' => 'Lista Contatti',
    'search' => true
]);

$contacts = $db->getData(QueryBuilder::GetAll(), []);

?>

<!DOCTYPE html>
<html lang="en">
<?= $head->render() ?>

<body>
    <?= $navbar->render() ?>
    <main>
        <div class="container">
            <div class="add-contact-btn-container mt-4">
                <a href="insert.php">
                    <button type="button" class="btn btn-success add-contact-btn">
                        Aggiungi un contatto
                    </button>
                </a>
            </div>
            <div class="list-container">
                <?php
                while ($contact = $contacts->fetch()):
                    $picture = $db->getData(QueryBuilder::GetPicture(), [$contact['id']])->fetch()[0];
                    ?>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= $picture !== "" ? $picture : "https://placehold.co/200x200?text=Your+Pic" ?>"
                                    class="img-fluid normal-card-img" alt="...">
                            </div>
                            <div class="col-md-8 d-flex">
                                <div class="card-body">
                                    <h5 class="card-title mb-3"><?= $contact['name'] ?>     <?= $contact['surname'] ?> <i
                                            class='fa-solid fa-circle-check'
                                            style='color:<?= $contact['active'] == '1' ? '#3ad737' : '#aaaaaa' ?>'></i></h5>
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
                                                class="text-body-secondary">Altre info...</small></p>
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
        </div>
    </main>
    <!-- Modal - delete contact -->
    <?= $deleteModal->render() ?>
    <?= $bsStrip ?>
</body>

</html>