<?php
/**
 * Page
 *
 * The main site page
 * @see PageAbstract
 */
class Page extends PageAbstract{
    protected $_templatesDestination = 'skin/site/';
    protected $_templatesBase = '';

    /**
     * creates domain object instance of page
     * @see PageAbstract::createDomainObject()
     * @return null
     */
    public function createDomainObject() {
        $this->_domainObject =  new DefaultDomainObject();
    }

    protected function showHeader(){
       
        $this->_controller->showTemplate(MAIN_PATH . '/skin/site/header.tpl');
    }

    protected function showFooter(){
        $this->_controller->showTemplate(MAIN_PATH . '/skin/site/footer.tpl');
    }
}


?>
