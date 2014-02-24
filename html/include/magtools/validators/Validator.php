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








?>
