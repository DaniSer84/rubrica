<?php

namespace Daniser\Rubrica;

interface DatabaseQueryResultContract {

    public function fetch();

    public function fetchAll();
    
}
