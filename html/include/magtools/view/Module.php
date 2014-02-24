<?php

/*
interface IModule {
    function install();
    function deinstall();
    function deactivate();
    function isInstalled();
}


abstract class ModuleAbstract implements IModule{
    protected $_moduleName = '';
    protected $_currentVersion = '';
    protected $_moduleDescription = '';
    protected $_hookInto = 0;
    protected $_dbInstance = null;
    protected $_moduleBlock = null;

    public function  __construct() {
        $this->_dbInstance = ConnectionInstance::getInstance();
    }

    function  install() {
        $blocksInitQuery = 'CREATE TABLE IF NOT EXISTS `blocks`(
                    `BlockID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                    `BlockName` VARCHAR( 150 ) NOT NULL ,
                    `BlockTemplateName` VARCHAR( 150 ) NOT NULL ,
                    `BlockIsVisible` TINYINT( 1 ) NOT NULL DEFAULT \'1\'
                ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;';

        
        $this->_dbInstance->query($blocksInitQuery);

        $modulesInitQuery = 'CREATE TABLE IF NOT EXISTS `modules` (
                 `ModuleID` int(11) NOT NULL AUTO_INCREMENT,
                 `ModuleName` varchar(150) NOT NULL,
                 `ModuleDescription` text NOT NULL,
                 `ModuleClass` varchar(150) NOT NULL,
                 `ModuleBlockID` int(11) NOT NULL,
                 `ModuleIsInstalled` tinyint(1) NOT NULL DEFAULT \'0\',
                 PRIMARY KEY (`ModuleID`),
                 UNIQUE KEY `ModuleName` (`ModuleName`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8';

        $this->_dbInstance->query($modulesInitQuery);

        $module = new DBRecord('modules', 'ModuleID');

        $record = array(
            'ModuleName' => $this->_moduleName,
            'ModuleDescription' => $this->_moduleDescription,
            'ModuleBlockID' => $this->_hookInto,
            'ModuleClass' => __CLASS__,
            'ModuleIsInstalled' => 1
        );
        
        $module->setDBRow($record);

        $module->insert();
    }

    public function deinstall() {
        $module = new DBRecord('modules', 'ModuleID');
        $module->readDBRow('ModuleName', $this->_moduleName);
        $module->delete();
    }

    public function isInstalled() {
        return true;
    }

    public function getBlock(){
        return $this->_moduleBlock;
    }

    public function setBlock(UIBlock $block){
        $this->_moduleBlock = $block;
    }

    public function  deactivate() {
        $module = new DBRecord('modules', 'ModuleID');
        $module->readDBRow('ModuleName', $this->_moduleName);
        $module->set('ModuleIsInstalled', 0);
        $module->update();
    }

    public abstract function getWebTable();
    public abstract function getWebForm();

    public abstract function showModuleBlock();

    public abstract function showAdminBlock();
}

class ModulesDispatcher{
    public static function dispatch(DBRecord $module){
        $moduleClass = $module->get('ModuleClass');

        if(class_exists($moduleClass)){
            $moduleInstance = new $moduleClass();

            return $moduleInstance;
        }
        else{
            throw new Exception('Module Does not exists');
        }
    }
}
 * */
 





?>
