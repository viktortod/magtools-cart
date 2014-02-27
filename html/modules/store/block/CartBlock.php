<?php
class CartBlock extends UIBlock{
    protected $_cartTemplate = '/blocks/cart.tpl';

    public function  __construct($blockName = null) {
        parent::__construct($blockName);

        $this->_cartTemplate =  SITE_THEME_DESTINATION. '/blocks/cart.tpl';
    }

    public function showBlock() {
        
        $templateParser = new TemplateParser($this->_cartTemplate);
        $templateParser->parseTemplate();

        return $templateParser->getContent();
    }
}
?>
