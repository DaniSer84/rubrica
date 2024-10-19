<?php

namespace Test\DatabaseAbstraction;

interface DatabaseQueryResultContract {

    public function fetch();

    public function fetchAll();
    
}
