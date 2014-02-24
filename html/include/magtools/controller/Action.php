<?php
/**
 * Interface of Actions
 * Uses Command Design Pattern to execute the action
 * @access public
 *
 * @author Vik
 */
interface IAction {
    function prepare();
    function execute();
    function postExecute();
    function getData();
}

class Action implements IAction{
    protected $_data;
    protected $_dataMapper;
    
    /**
     * inits the data parametter
     * @access public
     * @package Action
     * 
     */
    public function prepare(){
        $this->_data = array();

        if(count(jsSession::getSessionParam('validate'))){
            throw new ValidationException('There are errors in your data', ValidationException::INVALID_DATA_TYPE_EXCEPTION);
        }
    }

    /**
     * @method is called when dispatched
     * @access public
     *
     */
    public function execute(){
        throw new Exception('Not implemented');
    }

    /**
     * @method is called after the execute
     * @access public
     * @return bool
     */
    public function  postExecute() {
        return true;
    }

    /**
     * Gets the data of the executed action
     * @return array
     */
    public function getData(){
        return true;
    }

    public function addDataMapper(DataMapUtil $Mapper){
        $this->_dataMapper = $Mapper;
    }

    protected function getDataMapper(){
        return $this->_dataMapper;
    }

    protected function getController(){
        return $this->_dataMapper->getController();
    }
}

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

class ClearFiltersAction extends Action{
    public function execute(){
        jsSession::removeFilters();
    }
    
    public function  postExecute() {
        Controller::redirect('?page=');
    }
}

