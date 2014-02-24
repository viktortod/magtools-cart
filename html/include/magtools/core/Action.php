<?php
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