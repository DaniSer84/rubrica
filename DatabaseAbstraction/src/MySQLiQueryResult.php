<?php

namespace Daniser\Rubrica;

use mysqli_result;

class MySQLiQueryResult implements DatabaseQueryResultContract {

    private mysqli_result $result;

    public function __construct( mysqli_result $result) {
        $this->result = $result;
    }

    public function fetch(): bool|array|null {

        return $this->result->fetch_assoc();
        
    }
    
    public function fetchAll(): array {

        return $this->result->fetch_all();

    }

    public function rowCount() {

        return $this->result->num_rows;
        
    }
}