<?php
class DateFilter extends Filter{
    public function getSql() {
        if($this->getValue() == ''){
            return '';
        }
        else{
            $value = strtotime($this->getValue());
            return $this->_field.$this->_condition.$value;
        }
    }
}