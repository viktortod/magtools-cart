<?php
class StaticTextField extends Widget{
    protected $_html = '<%value%>';
    
    protected $_doSetValue = true;
    
    protected function setValue($value){
    	if($this->_doSetValue){
    		parent::setValue($value);
    	}
    }
    
    public function setTextContent($value){
    	$this->_value = $value;
    	$this->_doSetValue = false;
    }
}