<?php
class osExecInsertAction extends Action{
    protected $_tableName;

    public function prepare(){
        parent::prepare();
        $this->_dataMapper->mapRequestParametters();

        $validationErrors = $this->_dataMapper->getValidatorErrors();

        return $validationErrors;
    }

     public function execute(){
        $validatorErrors = $this->prepare();


        if( count($validatorErrors) > 0 ){
            ValidatorError::init($validatorErrors);
            return false;
        }
        else{

            $records = $this->_dataMapper->getRecords();
            foreach($records as $record){
                $record->insert();
            }

            Controller::redirect("?page=");
        }
    }

    public function  postExecute() {

    }
}
