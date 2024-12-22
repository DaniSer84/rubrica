<?php

use Rubrica\Php\Components\ActionButton;
use Rubrica\Php\Components\Head;
use Rubrica\Php\Components\Modal;
use Rubrica\Php\Components\Navbar;
use Rubrica\Php\Components\OrderOptionBtn;
use Rubrica\Php\Components\SearchInput;
use Rubrica\Php\Components\SmallComponents;
use Rubrica\Php\FormRequest\FormRequest;
use Rubrica\Php\QueryBuilder\QueryBuilder;

require_once $_SERVER['DOCUMENT_ROOT'] ."/vendor/autoload.php";

$selectedContact = null;

$head = new Head();

$navbar = new Navbar();
$searchInput = new SearchInput();
$OrderOptionBtn = new OrderOptionBtn();

$bsStrip = SmallComponents::bsStrip();

$deleteModalButton = new ActionButton([
    "id" => "delete-btn",
    "class" => "btn-danger",
    "text" => "Elimina",
]);
$deleteModal = new Modal([
    "id" => "deleteItem",
    "title" => "Eliminando contatto con id: <span id='to-delete'></span>",
    "text" => "NB: Il contatto verrà eliminato definitivamente!",
    "button" => $deleteModalButton->render()
]);

$queryBuilder = new QueryBuilder();
$data = $queryBuilder->getData();

$formRequest = new FormRequest();

