<?php

require_once __DIR__ . "/common.php";

use Daniser\Rubrica\Helper;

$head->setParams([
    "title" => "Contact",
    "style" => "../css/style.css",
    "script" => "../js/main.js"
]);
$navbar->setParams([
    'items' => [
        'home.php' => 'Home',
        'contact-list.php' => 'Contact list',
        '' => 'Info Contatto'
    ],
    'active' => 'Info Contatto',
]);

?>

<!DOCTYPE html>
<html lang="en">
<?= $head->render() ?>

<body>
    <?= $navbar->render() ?>
    <main>
        <!-- CONTACT CARD -->
        <?php
        $data = $formRequest->sendRequest();
        $contact = $data['contact'];
        $picture = $data['picture'];
        if ($contact): ?>
            <div class="container card-container">
                <div class="card">
                    <img src="<?= $picture[0] !== "" ? $picture[0] : "https://placehold.co/200x200?text=Your+Pic" ?>"
                        class="card-img-top normal-card-img">
                    <div class="card-body">
                        <h5 class="card-title display-6 text-center mb-5"><?= $contact['name'] ?>     <?= $contact['surname'] ?>
                        </h5>
                        <?php
                        foreach ($contact as $key => $value) {
                            echo Helper::createCardItem($key, $value);
                        }
                        ?>
                        <div class="button-container mt-4">
                            <button class="btn btn-secondary go-back-btn">Indietro</button>
                            <a href="update.php?item_id=<?= $contact['id'] ?>">
                                <button class="btn btn-primary">Modifica</button>
                            </a>
                            <button class="btn btn-danger set-to-delete" data-bs-toggle='modal' data-bs-target='#deleteItem'
                                data-id="<?= $contact['id'] ?>">
                                Cancella
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container container-fluid m-auto w-50 text-center mt-5">
                <p>Nessun contatto!</p>
                <p class="fw-light"><a href="contact-list.php">torna alla lista...</a></p>
            </div>
        <?php endif ?>
    </main>
    <?=$deleteModal->render()?>
    <?=$footer->render()?>
    <?=$bsStrip?>
</body>

</html>