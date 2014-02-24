<?php
class AdminUIBlock extends UIBlock{
    public function  showBlock() {
        $this->getModulesStack();

        foreach($this->_modules as $module){
            $module->showModuleBlock();
        }
    }
}