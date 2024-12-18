<?php

use Rubrica\Php\FormRequest\FormRequest;

require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";

$formRequest = new FormRequest();
$formRequest->sendRequest();
