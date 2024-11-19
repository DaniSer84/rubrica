<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

use Daniser\Rubrica\Helper;
use Rubrica\Php\FormRequest\FormRequest;

$headParams = [
    "title" => "Contact", 
    "style" => "../css/style.css",
    "script" => "../js/main.js"
];
$head->setParams($headParams);

$formRequest = new FormRequest($_REQUEST, $_FILES, $_SERVER, $db);

$data = $formRequest->sendRequest();
$contact = $data['contact'];
$picture = $data['picture'];

?>

<!DOCTYPE html>
<html lang="en">
<?=$head->render()?>
<body>
    <header class="d-flex justify-content-between align-items-center px-5 border-2 border-bottom text-center ">
    <a href="../../index.php"><h1>Rubrica</h1></a>
        <h3>Info Contatto</h3>
        <nav>
        <a href="../../index.php">Home</a>
        |
        <a href="contact-list.php">Lista Contatti</a>
        </nav>
    </header>
    <main>
        <!-- CONTACT CARD -->
        <?php if ($contact) :?>
        <div class="container">
            <div class="card">
                <img src="<?=$picture[0] !== "" ? $picture[0] : "https://placehold.co/200x200?text=Your+Pic"?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title display-6 text-center mb-5"><?= $contact['name'] ?> <?= $contact['surname'] ?></h5>
                    <?php
                    foreach ($contact as $key => $value) {
                        echo Helper::createCardItem($key, $value);
                    }
                    ?>
                    <div class="button-container mt-4">
                        <a href="update.php?item_id=<?=$contact['id']?>"><button class="btn btn-primary">Modifica</button></a>
                        <button class="btn btn-danger set-to-delete" data-bs-toggle='modal' data-bs-target='#deleteItem' data-id="<?=$contact['id']?>">Cancella</button>
                    </div>
                </div>
            </div>
        </div>
        <?php else:?>
            <div class="container container-fluid m-auto w-50 text-center mt-5">
                <p>Contatto cancellato!</p>
                <p class="fw-light"><a href="contact-list.php">torna alla lista...</a></p>
            </div>
        <?php endif ?>
    </main>
    <!-- Modal - delete contact -->
    <?=$deleteModal->render()?>
    <?=$bsStrip?>
</body>

</html>