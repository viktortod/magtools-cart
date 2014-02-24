<?php
class Filter {
    const FILTER_SESSION_PARAM = 'filters';

    protected $_field;
    protected $_condition;
    protected $_value = null;
    protected $_widget = null;

    public function  __construct($field) {
        $this->_field = $field;
        $this->_condition = '=';

        $this->_widget = WidgetFactory::getWidgetInstance('InputTextField', $field, array());
    }

    public function commit(){
        $sessionKey = basename($_SERVER['REQUEST_URI']);

        jsSession::setParam($this->_field, $this->_value,Filter::FILTER_SESSION_PARAM);
    }

    public function setValue($value){
        $this->_value = $value;
    }

    public function getValue(){
        if($this->_value != null){
            return $this->_value;
        }

        
        $posted = getParamDefault($this->_field, '');
        
        if(!empty($posted)){
            $this->setValue($posted);
            $this->commit();

            return $this->_value;
        }
        else{
            $this->_value = jsSession::getSessionParamDefault($this->_field, '',Filter::FILTER_SESSION_PARAM);
        }

        return $this->_value;
    }

    public function getHtml($value){
        return $this->_widget->parseHtml($value);
    }

    public function getSql(){
        if($this->getValue() == ''){
            return '';
        }
        else{
            return $this->_field.$this->_condition.'\''.$this->getValue().'\'';
        }
    }
}





?>
