<?php
class Message extends DefaultDomainObject{
    public function  __construct($tableName = 'Pages') {
        $this->_tableName = 'CustomerMessages';
        $this->_recordSet = new DBRecordset($this->_tableName);
        $this->_record = new DBRecord($this->_tableName,'CustomerMessageID');
        $this->_dataFields[] = '*';
    }

    public function getUserMessages($userId){
        $where = 'CustomerID = ' . $userId;
        $this->_recordSet->addWhereCondition($where);
    }

    public function  getAllElements() {
        $this->getUserMessages(jsSiteUserAuth::getLoggedUserProperty('CustomerID'));
        return parent::getAllElements();
    }
}
?>
