<?php

class TemplateParserIteration{
    const PARSER_ITERATION_TYPE_ASSOC = 0;
    const PARSER_ITERATION_TYPE_ANONYMOUS = 1;

    private $data;
    private $name;
    private $iterationType;


    public function __construct($templateName, $data){
        $this->name = $templateName;
        $this->data = $data;

        $this->iterationType = self::PARSER_ITERATION_TYPE_ASSOC;
    }

    public function getData(){
        return $this->data;
    }

    public function getName(){
        return $this->name;
    }

    public function getIterationType(){
        return $this->iterationType;
    }

    public function setIterationType($iterationType){
        $this->iterationType = $iterationType;
    }
}