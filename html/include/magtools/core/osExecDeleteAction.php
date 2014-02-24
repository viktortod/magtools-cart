<?php
class osExecDeleteAction extends Action{
    public function prepare(){
        $this->_tableName = getParam('table');
        $this->_editPK = getParam('page');
    }

     public function execute(){
        $record = new DBRecord($this->_tableName, $this->_editPK);
        $record->readDBRow($this->_editPK, getParamDefault($this->_editPK, 0));
		try {
        	$record->delete(getParamDefault($this->_editPK, 0));
        	
        	MessageUtil::setMessage(MessageUtil::MESSAGE_TYPE_INFO, "Record deleted");
		} catch (Exception $e){
			MessageUtil::setMessage(MessageUtil::MESSAGE_TYPE_ERROR, "Operation failed.  Error: " . $e->getMessage());
		}
    }

    public function  postExecute() {
        Controller::redirect('?page=');
    }
}