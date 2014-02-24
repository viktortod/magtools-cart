<?php
class SelectBox extends Widget{
    private $_options = array();
    protected $_html = '<select name="<%name%>" id="<%name%>" <%properties%>><%options%></select>';

    public function setOptions($values){
        $this->_options = $values;
    }

    public function  parseHtml($FieldValue) {
        parent::parseHtml("");

        $optionsHtml = '';

        foreach($this->_options as $optionKey => $optionValue){
            if($FieldValue == $optionKey){
                $optionsHtml .= '<option value="'.$optionKey.'" selected="selected">'.$optionValue.'</option>';
            }
            else{
                $optionsHtml .= '<option value="'.$optionKey.'">'.$optionValue.'</option>';
            }
            
        }
        
        $this->_html = str_replace('<%options%>', $optionsHtml, $this->_html);

        return $this;
    }
}