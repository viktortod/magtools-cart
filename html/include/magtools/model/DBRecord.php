<?php
class DBRecord {
    private $_dbConnection;

    private $_tableName;
    private $_tablePk;
    private $_record;

    public function __construct($tableName, $tablePk=null){
        $this->_dbConnection = ConnectionInstance::getInstance();
        $this->_tableName = $tableName;
        $this->_tablePk = $tablePk;
        $this->_record = null;
    }

    public function getDataFields(){
        $query = 'DESCRIBE '. $this->_tableName;

        $described = $this->_dbConnection->fetchAll($query);
        $fields = array();
        foreach($described as $field){
            $fields[] = $field['Field'];

            if($field['Key'] == 'PRI'){
                $this->_tablePk = $field['Field'];
            }
        }

        return $fields;
    }

    public function readDBRow($columnName, $value){
        $query = 'SELECT * FROM ? WHERE ?=\'?\'';

        $params = array(
            $this->_tableName,
            $columnName,
            $value
        );

        
        $this->_record = $this->_dbConnection->fetch(DBQueryUtil::prepareQuery($query, $params));
    }

    public function getNextRecordId(){
        $query = 'SELECT MAX('.$this->_tablePk.') as max FROM ' . $this->_tableName;

        $record = $this->_dbConnection->fetch($query);

        return $record['max'] + 1;
    }

    public function getPkFieldName(){
        return $this->_tablePk;
    }

    public function getRecordPK($value){
        $this->readDBRow($this->_tablePk, $value);

        return $this->getRecord();
    }

    public function getRecord(){
        return $this->_record;
    }

    public function get($columnName){
        return $this->_record[$columnName];
    }

    public function setDBRow($record){
        $this->_record =$record;
    }

    public function set($column, $value){
        $this->_record[$column] = $value;
    }

    public function update(){
        $query = DBQueryUtil::constructUpdateQuery($this->_tableName, $this->_record);

        $query .= ' WHERE ' . $this->_tablePk . '=' . $this->_record[$this->_tablePk];

//        dump($query); 
        $this->_dbConnection->query($query);
    }

    public function insert(){
        $query = DBQueryUtil::constructInsertQuery($this->_tableName, $this->getRecord());
        if($this->_dbConnection->query($query)){
            return ($this->getNextRecordId() - 1);
        }
    }

    public function delete($value){
        $query = DBQueryUtil::constructDeleteQuery($this->_tableName, $this->_tablePk, $value);
        $this->_dbConnection->query($query);
    }
}


?>
