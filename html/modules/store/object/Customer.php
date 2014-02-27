<?php

class Customer extends DefaultDomainObject{
    public function  __construct($tableName = 'Pages') {
        $this->_tableName = 'Customers';
        $this->_recordSet = new DBRecordset($this->_tableName);
        $this->_record = new DBRecord($this->_tableName,'CustomerID');
        $this->_dataFields[] = '*';
    }

    public function  getElement($id) {
        $this->_recordSet->addWhereCondition(' CustomerID=' . $id);
        $result = $this->getAllElements();

        if(count($result) > 0){
            
            return $result[0];
        }
    }
}
?>
