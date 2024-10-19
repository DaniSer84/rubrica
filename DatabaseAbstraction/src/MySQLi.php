<?php

namespace Test\DatabaseAbstraction;
use Exception;

class MySQLi extends \mysqli implements DatabaseContract
{

    public function __construct(DbConfig $dbConfig)
    {

        parent::__construct($dbConfig->host, $dbConfig->user, $dbConfig->password, $dbConfig->dbname, $dbConfig->port);

    }

    
    public function getData(string $query, array $params = []): DatabaseQueryResultContract
    {
        
        $statement = $this->prepare($query);
        
        $statement->execute($params);
        
        $result = $statement->get_result();
        
        return new MySQLiQueryResult($result);
        
    }
    
    // insert:
    public function setData(string $command, array $items): void
    {
        
        // come in my pdo..
        
        $statement = $this->prepare($command);
        
        foreach ($items as $item) {
            
            $statement->execute($item);
            
        }
        
    }
    
    // transaction:
    public function doWithTransaction(array $operations): void
    {
        
        // lo facciamo come il pdo
        try {
            
            $this->begin_transaction();
            
            foreach ($operations as $operation) {
                
                $this->query( $operation );
                
            }
            
            $this->commit();
            
        } catch ( Exception $e ) {
            
            $this->rollback();
            
            throw new Exception( "Transaction aborted: " . $e->getMessage() );
        }
        
    }
    
    public function deleteData(string $query, array $params = []): void {

        $stmt = $this->prepare($query);

        $stmt->execute($params);
        
    }
    
    // c'è il concetto di distruttore:
    public function __destruct()
    {

        // a noi basta fare questo:
        $this->close();

    }

}