<?php
class DatabaseAdapterPDO implements DatabaseAdapterInterface{
    private $pdo;
    private $lastStatement = null;
    public function __construct($values){
        $this->setConnectionInfo($values);
        }

    public function closeConnection(){
        $this->lastStatement = null;
        $this->pdo = null;
        }

      public function setConnectionInfo($values=array()){
        try{
            $connection = $values[0];
            $dbuser = $values[1];
            $dbpass = $values[2];
            $pdo = new PDO($connection, $dbuser, $dbpass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        catch(PDOException $e){
            die( $e->getmessage() );
        }
    }
    public function runQuery($sql, $parameters=array()){
        if(!is_array($parameters)){
            $parameters = array($parameters);
        }
        try{
            $this->laststatement = null;
            if(count($parameters > 0)){
                $this->laststatement = $this->pdo->prepare($sql);
                $executed = $this->lastStatement->execute($parameters);
                if(!$executed){
                    throw new PDOException;
                    }
            }
            else{
                 $this->laststatement = $this->pdo->query($sql);
                if(!$this->lastStatement){
                    throw new PDOException;
                    }
                 }
            return $statement;
        }
        catch(PDOException $e){
            throw $e;
        }
    }

    public function fetchRow($sql, $parameters=array()){
        $statement = runQuery($sql, $parameters);
        return $statement->fetch();    
    }
    public function fetchAsArray($sql, $parameters=array()){
                $statement = runQuery($sql, $parameters);
                return $statement->fetchAll(); 
        }
}
?>