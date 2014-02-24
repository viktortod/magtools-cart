<?php
class SelectedValidator extends Validator{
    public function validate(){
        if(!empty($this->data)){
            if(is_numeric($this->data) && $this->data>0){
                return true;
            }
            elseif(is_numeric($this->data)){
                return false;
            }
            
            return true;
        }

        return false;
    }
}