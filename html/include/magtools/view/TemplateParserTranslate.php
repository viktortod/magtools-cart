<?php
class TemplateParserTranslate{
    private $pattern = '/<:text ([a-zA-Z0-9\.\-\!\:\/\\\(\)\,]+):>/';
    private $content = '';

    public function  __construct($content) {
        $this->content = $content;
    }

    public function parse(){
       $forTranslation = array();
       preg_match_all($this->pattern, $this->content, $forTranslation, PREG_PATTERN_ORDER  );

       if(isset($forTranslation[1])){
           foreach($forTranslation[1] as $textToTranslate){
               $translation = t($textToTranslate);
               $replacePattern = '<:text '.$textToTranslate.':>';
               $this->content = str_replace($replacePattern, $translation, $this->content);
           }
       }

       return $this->content;
    }
    
}