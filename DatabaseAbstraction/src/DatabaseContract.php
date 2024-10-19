<?php

namespace Test\DatabaseAbstraction;

interface DatabaseContract {

    const TYPE_PDO = "pdo";

    const TYPE_MySQLi = "mysqli";

    // select
    public function getData(string $query, array $params = [] ): DatabaseQueryResultContract;

    // insert:
    public function setData(string $command, array $items): void;

    // transaction:
    public function doWithTransaction(array $operations): void;

    public function deleteData( string $query, array $params = []): void;   

}



