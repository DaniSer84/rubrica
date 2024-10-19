<?php

namespace Test\DatabaseAbstraction;

// una classe per astrarre il concetto della connessione a un db
class DbConfig {

    public string $host;
    
    public string $port;

    public string $dbname;
    
    public string $user;

    public string $password;

    public function __construct( $host, $dbname, $port, $user, $password ) {
        
        $this->host = $host;
        $this->dbname = $dbname;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        
    }

}