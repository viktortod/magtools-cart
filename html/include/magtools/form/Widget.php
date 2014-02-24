<?php
class Widget{
    protected $_name;
    protected $_html;
    protected $_properties;
    protected $_initValue = '';
    protected $_value = '';

    public function  __construct($name, $properties) {
        $this->_name = $name;
        $this->_properties = $properties;
    }

    protected function setValue($value){
        $this->_value = $value;
    }

    public function parseHtml($FieldValue){
        $propertiesList = '';
        $this->setValue($FieldValue);
        if( count($this->_properties) > 0){
            foreach($this->_properties as $key => $value){
                $propertiesList .= $key . '="' . $value .'"';
            }
        }
        $this->_html = str_replace(array('<%properties%>','<%name%>', '<%value%>'), 
                                   array($propertiesList,$this->_name, $FieldValue),
                                    $this->_html);

        return $this;
    }

    public function onError($error){
        if(!isset($this->_properties['class'])){
            $this->_properties['class'] = '';
        }

        $this->_properties['errorMsg'] = $error;

        $this->_properties['class'] .= ' error';
    }

    public function getWidgetValue(){
        return $this->_value;
    }

    public function show(){
        $content = $this->parseHtml($this->_value);

        echo $content->getWidget();
    }

    public function getWidget(){
        return $this->_html;
    }
}


















?>
