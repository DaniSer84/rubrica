<?php

use Daniser\Rubrica\DatabaseContract;
use Daniser\Rubrica\DatabaseFactory;
use Rubrica\Php\Components\ActionButton;
use Rubrica\Php\Components\Head;
use Rubrica\Php\Components\Modal;
use Rubrica\Php\Components\SmallComponents;


require_once __DIR__ ."/vendor/autoload.php";

const UPLOAD_DIR = __DIR__ . "/src/pictures";

const ALLOWED_FILES = [
    'image/png' => 'png',
    'image/jpeg' => 'jpg'
];
const MAX_SIZE = 2 * 1024 * 1024;

$selectedContact = null;

$db = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);

$head = new Head();

$bsStrip = SmallComponents::bsStrip();

$deleteModal = new Modal();

$deleteModalButton = new ActionButton([
    "id" => "delete-btn",
    "class" => "btn-danger",
    "text" => "Elimina"
]);
$deleteModal->setParams([
    "id" => "deleteItem",
    "title" => "Eliminando contatto con id: <span id='to-delete'></span>",
    "text" => "Sei sicuro di voler eliminare il contatto?",
    "button" => $deleteModalButton->render()
]);
