<?php

use Daniser\Rubrica\DatabaseContract;
use Daniser\Rubrica\DatabaseFactory;
use Rubrica\Php\Components\Head;


require_once __DIR__ ."/vendor/autoload.php";

$db = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);

$head = new Head();
