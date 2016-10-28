<?php
abstract class TableDataGateway{
    protected $dbAdapter;
    public function __construct($dbAdapter){
        if(is_null($dbAdapter)){
            throw new Exception("Database adapter is null");
        }
        $this->dbAdapter = $dbAdapter;
    }
    abstract protected function getSelectStatement();
    abstract protected function getPrimaryKeyName();
    //Returns all records in table
    public function findAll(){
        $sql = $this->getSelectStatment();
        $result = $this->dbAdapter->fetchAsArray($sql);
        return $result;
    }
    public function findById($id){
        $sql = $this->getSelectStatement();
        $sql .= " WHERE " . $this->getPrimaryKeyName() . "= ?";
        $result =$this->dbAdapter->fetchRow($sql, array($id));
        return $result;
    }
    public function findByField($parameters=array()){
        //parameter is key value pair where key is field value is value to compare
        if(!is_array($parameters)){
            $parameters = array($parameters);
        }
        $sql = $this->getSelectStatement();
        $count = 0;
        foreach($parameters as $key->$value){
            if($count == 0){
                $sql .= " WHERE " . $key ." = ?";
            }
            else{
                $sql .= " && " . $key . " = ?";
            }
        }
        $result = $this->dbAdapter->fetchRow($sql);
    }
    protected function closeConnection(){
        $dbAdapter->closeConnection();
        $dbadapter = null;
    }
    protected function createObject($data=array()){
        if(is_array($data)){
            $data = array($data);
        }
        $values = array();
        $class = getClassName();
        foreach($data as $value){
            $paintings[] = new $class($value);
        }
        return $values;
    }
}
?>