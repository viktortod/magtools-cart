<?php
final class DataMapUtil {
    private $_records = array();
    private $_page;
    private $_requestParams;
    private $_validators;
    private $_validatorErrors = array();

    public function  __construct(PageAbstract $page, $requestParams) {
        $this->_page = $page;

        $this->_requestParams = $requestParams;
    }

    public function setRequestParam($paramName, $paramValue)
    {
        $this->_requestParams[$paramName] = $paramValue;
    }

    public function setValidatorsArray($validators){
        $this->_validators = $validators;
    }

    public function getController(){
        return $this->_page->getController();
    }
    
    public function mapRequestParametters(){
        $this->_records = array();

        $domainObject = $this->_page->getDomainObject();

        $primaryTable = $domainObject->getTableName();
        $tables = array();
        try{
            $tables = $this->getJoinTables($domainObject);
        } catch(Exception $e){
            $tables = array();
        }

        array_unshift($tables, $primaryTable);
        $primaryKeyValue = null;

        foreach($tables as $table){
            $record = new DBRecord($table);
            $recordFields = $record->getDataFields();

            if( $primaryKeyValue == null && !isset($this->_requestParams[$record->getPkFieldName()])){
                $primaryKeyValue = $record->getNextRecordId();
                $this->_requestParams[$record->getPkFieldName()] = $primaryKeyValue;
            }

            $dbRow = array();
            $validatorErrors = array();

            foreach($recordFields as $recordField){               
                if( isset($this->_requestParams[$recordField]) ){
                    $dbRow[$recordField] = $this->_requestParams[$recordField];
                }
            }

            $record->setDBRow($dbRow);

            $this->_records[] = $record;
        }
    }

    public function getValidatorErrors(){
        return $this->_validatorErrors;
    }

    public function getRecords(){
        return $this->_records;
    }

    public function getJoinTables(DefaultDomainObject $domainObject){
        $joinTables = $domainObject->getJoinTables();

        if( count($joinTables) > 0){
            return $joinTables;
        }
        else{
            throw new Exception('No join tables found');
        }
    }


}
?>
