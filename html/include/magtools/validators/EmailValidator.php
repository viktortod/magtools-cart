<?php
class EmailValidator extends NotEmptyValidator{
    public function  validate() {
        if(parent::validate()){
            return filter_var( $this->data, FILTER_VALIDATE_EMAIL);
        }
        else{
            return false;
        }
    }
}