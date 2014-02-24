<?php
/**
 * The Block abstraction
 */
abstract class UIBlock{
    protected $_record;
    protected $_modules = array();
    protected $_controller = null;

    public function  __construct($blockName = null) {
        if($blockName != NULL){
            $this->_record = new DBRecord('Blocks', 'BlockID');
            $this->_record->readDBRow('BlockName', $blockName);
        }
    }

    /**
     * Set the controller instance
     * @param Controller $controller
     */
    public function setController(Controller $controller){
        $this->_controller = $controller;
    }

    /**
     * Gets Controller
     * @return Controller
     */
    public function getController(){
        return $this->_controller;
    }

    /**
     * Returns the cashed in the block
     * @return array
     */
    public function getBlockModules(){
        $blockId = $this->_record->get('BlockID');

        $modules = new DBRecordset('Modules');
        $modules->addWhereCondition('ModuleBlockID=' . $blockId);
        $modules->read();

        return $modules->getAllRecords();
    }

    /**
     * IDK
     * @todo Findout!!!! Must delete
     */
    public function getModulesStack() {
        $modules = $this->getBlockModules();

        foreach($modules as $module){
            $record = new DBRecord('Modules', 'ModuleID');
            $record->readDBRow('ModuleID', $module['ModuleID']);
            $this->_modules[] = ModulesDispatcher::dispatch($record);
        }
    }

    /**
     * Returns the DBRecord instance
     * @return DBRecord
     */
    public function getRecord(){
        return $this->_record;
    }

    /**
     * Implementation of the module
     * @access public
     * @abstract
     */
    public abstract function showBlock();
}