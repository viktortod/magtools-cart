<?php
abstract class Validator {
    protected $data;
    protected $errorMsg;

    public function  __construct($data, $errorMsg) {
        $this->data = $data;

        $this->errorMsg = $errorMsg;
    }

    public abstract function validate();

    public function getErrorMsg(){
        return $this->errorMsg;
    }
}

class NotEmptyValidator extends Validator{
    public function validate() {
        if(empty($this->data)){
            return false;
        }

        return true;
    }
}

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

class RegexValidator extends Validator{
    protected $regex;

    public function  validate() {
        return (preg_match($this->regex, $this->data) == 1);
    }
}

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

class PhoneValidator extends RegexValidator{
    protected $regex = '/^(0)([0-9]{9})/';
}
?>
