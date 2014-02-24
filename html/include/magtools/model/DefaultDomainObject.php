<?php
class DefaultDomainObject implements IDomainObject{
    protected $_pk;
    protected $_record = null;
    protected $_recordSet = null;
    protected $_tableName = null;
    protected $_joinTables = array();
    protected $_dataFields=array();

    public function  __construct($tableName = 'Pages') {
        $this->_tableName = $tableName;
        $this->_recordSet = new DBRecordset('Pages');
        $this->_record = new DBRecord('Pages','PageID');
        $this->_dataFields[] = '*';
    }

    public final function getTableName(){
        return $this->_tableName;
    }

    public final function getJoinTables(){
        return $this->_joinTables;
    }

    public final function setRecord(DBRecord $record){
        if($this->_recordSet == null){
            $this->_record = $record;
        }
        else{
            throw new Exception('No more than one DBAbstraction elements');
        }
    }

    public function  insert($id, $row) {
        $this->_record->readDBRow($this->_pk, $row);
        $this->_record->setDBRow($row);
        $this->_record->insert();
    }

    public final function setRecordset(DBRecordset $recordSet){
        if($this->_record == null){
            $this->_recordSet = $recordSet;
        }
        else{
            throw new Exception('No more than one DBAbstraction elements');
        }
    }

    public function assignFilters($sql){
//        dump($sql);
        foreach($sql as $where){
            if(strlen($where) > 0)
                $this->_recordSet->addWhereCondition($where);
        }
    }
    
    public function delete($id) {
        $this->_record->readDBRow($this->_pk, $id);

        $this->_record->delete();
    }

    public function update($id, $row) {
        $this->_record->readDBRow($this->_pk, $row[$this->_pk]);
        
        $selective = array();
        
        foreach($row as $fieldName => $fieldValue){
            if( in_array($fieldName, $this->_dataFields)){
                $selective[$fieldName] = $fieldValue;
            }
        }

        $this->_record->setDBRow($row);
        $this->_record->update();
    }

    public function  getField($fieldName) {
        return $this->_dataFields[$fieldName];
    }

    public function getDataFields(){
        return $this->_dataFields;
    }

    public function getElement($id) {
        $this->_record->getRecordPK($id);
        
        return $this->_record->getRecord();
    }

    public function  getAllElements() {
        $this->_recordSet->setSelectFields($this->_dataFields);
        $this->_recordSet->read();
        
        return $this->_recordSet->getAllRecords();
    }
}
?>
