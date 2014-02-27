<?php

class ProfileBlock extends UIBlock{
    protected $template = '/blocks/profile.tpl';

    public function  __construct($blockName = null) {
        parent::__construct($blockName);

        $this->template = SITE_THEME_DESTINATION.$this->template;
    }

    public function showBlock() {
        if(jsSiteUserAuth::isUserLogged()){
            $templateParser = new TemplateParser($this->template);

            $templateParser->assignVariable('CustomerID', jsSiteUserAuth::getLoggedUserProperty('CustomerID'));

            $templateParser->parseTemplate();
            
            return $templateParser->getContent();
        }
    }
}
?>
