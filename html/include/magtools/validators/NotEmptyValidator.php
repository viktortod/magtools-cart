<?php
class NotEmptyValidator extends Validator{
    public function validate() {
        if(empty($this->data)){
            return false;
        }

        return true;
    }
}
