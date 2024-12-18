<?php

use Daniser\Rubrica\DatabaseContract;
use Daniser\Rubrica\DatabaseFactory;
use Rubrica\Php\Components\ActionButton;
use Rubrica\Php\Components\Head;
use Rubrica\Php\Components\Modal;
use Rubrica\Php\Components\Navbar;
use Rubrica\Php\Components\SmallComponents;
use Rubrica\Php\QueryBuilder\QueryBuilder;


require_once __DIR__ ."/vendor/autoload.php";

$selectedContact = null;

$db = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);

$head = new Head();
$navbar = new Navbar();

$bsStrip = SmallComponents::bsStrip();

$deleteModalButton = new ActionButton([
    "id" => "delete-btn",
    "class" => "btn-danger",
    "text" => "Elimina",
]);
$deleteModal = new Modal([
    "id" => "deleteItem",
    "title" => "Eliminando contatto con id: <span id='to-delete'></span>",
    "text" => "Sei sicuro di voler eliminare il contatto?",
    "button" => $deleteModalButton->render()
]);
$search = $_GET['search'] ?? "";
$query = QueryBuilder::search();
$result = $db->getData($query, [
    "kw1" => "$search%",
    "kw2" => "%$search%",
    "kw3" => "%$search",
]);