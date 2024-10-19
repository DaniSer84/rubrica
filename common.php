<?php

use Daniser\Rubrica\DatabaseContract;
use Daniser\Rubrica\DatabaseFactory;


require_once __DIR__ ."/vendor/autoload.php";

$db = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);