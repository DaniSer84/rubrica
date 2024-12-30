<?php session_start();

require_once __DIR__ . "/common.php";

$referer = $_SERVER["HTTP_REFERER"];

$action = str_contains($referer, 'update') ? 'modificato' : 'inserito';

$head->setParams([
    "title" => "Contatto $action!",
    "style" => "../css/style.css",
    "script" => "../js/main.js"
]);
$navbar->setParams([
    'items' => [
        'home.php' => 'Home',
        'contact-list.php' => 'Lista Contatti',
    ],
]);

$contact = $queryBuilder->getOne(str_contains($referer, 'update') ? $_SESSION['id'] : 'last')->fetch();

$_SESSION = [];
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<?= $head->render(); ?>

<body>
    <?= $navbar->render() ?>
    <div class="contact-insert-success">
        <p class="mt-5 pt-5">Il contatto <strong><?= $contact['name'] ?? '' ?> <?= $contact['surname'] ?? ''?></strong> è stato
            <?= $action ?> con successo!</p>
        <ul>
            <li><a href="contact.php?item_id=<?= $contact['id'] ?>">Vai alla scheda del contatto</a></li>
            <li><a href="home.php">Vai alla tabella</a></li>
            <li><a href="contact-list.php">Vai alla lista delle schede</a></li>
        </ul>
    </div>
</body>