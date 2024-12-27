<?php

namespace Daniser\Rubrica;

class MyPDO extends \PDO implements DatabaseContract {

    public function __construct( DbConfig $dbConfig ) {

        $dsn = $this->getDsn( $dbConfig->host, $dbConfig->port, $dbConfig->dbname);
        $username = $dbConfig->user;
        $password = $dbConfig->password;
        $options = [] ;
        
        parent::__construct($dsn, $username, $password, $options);
        
    }

    public function getData( string $query, array $params = [] ): DatabaseQueryResultContract {

        $statement = $this->prepare( $query );
        $statement->execute($params);

        return new MyPDOQueryResult( $statement);

    }

    public function setData( string $command, array $items ): void {

        $statement = $this->prepare( $command );

        try {

            foreach ( $items as $item ) {
    
                $statement->execute($item);
                
            }

        } catch (\PDOException $e) {

            // TODO: IMPROVE this 
            if ($e->errorInfo[1] == 1062) {
                echo "<p class='sql-err'>This email already exists. <button class='go-back-btn'>Indietro</button></p>";
                die();
             }

            throw new \PDOException( "Transaction aborted" . $e->getMessage() );
            
        }

    } 

    public function doWithTransaction(array $operations): void {

        try {
            
            $this->beginTransaction();

            foreach ($operations as $operation) {

                $this->exec($operation);
                
            }

            $this->commit();

        } catch ( \PDOException $e ) {

            $this->rollBack();

            // TODO: IMPROVE this 
            if ($e->errorInfo[1] == 1062) {
                echo "<p class='sql-err'>This email already exists. <button class='go-back-btn'>Indietro</button></p>";
                die();
             }

            throw new \PDOException( "Transaction aborted" . $e->getMessage() );
        }
        
    }

    public function deleteData( string $query, array $params = []): void {

        $stmt = $this->prepare($query);

        $stmt->execute($params);
        
    }   


    private function getDsn($host, $port, $dbname ) {
        return "mysql:" .
        "host={$host};" .
        "port={$port};" .
        "dbname={$dbname}";
    }

}