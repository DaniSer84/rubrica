<?php

// questo namespace serve a far capire all'autoload in index di caricare il file -> per referenziare in maniera semplice le classi.
namespace Daniser\Rubrica;

class MyPDO extends \PDO implements DatabaseContract {

    // definiamo il costruttore:
    public function __construct( DbConfig $dbConfig ) {

        // stringa di connessione: 
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

    // implementiamo la funzione per fare le transazioni:
    public function doWithTransaction(array $operations): void {

        try {
            
            // in maniera molto generica la nostra astrazione attorno a MyPDO esegue lo statement andando a fare begin, commit e rollback se fallisce.

            // prendiamo il nostro db (pdo) e facciamo
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