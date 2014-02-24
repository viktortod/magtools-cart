<?php
class RegexValidator extends Validator{
    protected $regex;

    public function  validate() {
        return (preg_match($this->regex, $this->data) == 1);
    }
}