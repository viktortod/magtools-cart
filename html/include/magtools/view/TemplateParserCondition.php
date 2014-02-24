<?php
class TemplateParserCondition{
    const CONDITION_EQUALS = 1;
    const CONDITION_NOT_EQUALS = 2;
    const CONDITION_LESS = 3;
    const CONDITION_GRATER = 4;
    const CONDITION_NOT_LESS = 5;
    const CONDITION_NOT_GRATER = 6;
    const CONDITION_EQUIVALLENT = 7;

    private $conditionType;
    private $conditionName;

    private $element;
    private $targetElement;

    public function __construct($condition_type, $templateName){
        $this->conditionType = $condition_type;

        $this->conditionName = $templateName;
    }

    public function setCondition($element, $targetElement){
        $this->element = $element;
        $this->targetElement = $targetElement;
    }

    public function getName(){
        return $this->conditionName;
    }

    public function isConditionTrue(){
        switch($this->conditionType){
            case self::CONDITION_EQUALS: {
                return ($this->element == $this->targetElement);
            }
            case self::CONDITION_NOT_EQUALS: {
                return ($this->element != $this->targetElement);
            }
            case self::CONDITION_LESS: {
                return ($this->element < $this->targetElement);
            }
            case self::CONDITION_GRATER: {
                return ($this->element > $this->targetElement);
            }
            case self::CONDITION_NOT_GRATER: {
                return ($this->element <= $this->targetElement);
            }
            case self::CONDITION_NOT_LESS: {
                return ($this->element >= $this->targetElement);
            }
            case self::CONDITION_EQUIVALLENT: {
                return ($this->element === $this->targetElement);
            }
        }
    }
}
