<?php
class osExecUpdateAction extends Action{
    protected $_tableName;

    public function prepare(){
        //$this->_tableName = $_GET['table'];
        parent::prepare();
    }

     public function execute(){
        $this->_dataMapper->mapRequestParametters();
        $records = $this->_dataMapper->getRecords();

        foreach($records as $record){
            $record->update();
        }

//        exit();
    }

    public function  postExecute() {
        Controller::redirect('?page=');
    }
}