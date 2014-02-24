<?php
/**
 * PageAdministration
 *
 * The main administration page
 * @see PageAbstract
 */
class PageAdministration extends PageAbstract{
    protected $_templatesDestination = '../skin/admin/';
    protected $_templatesBase = '';
    
    /**
     * creates domain object instance of page
     * @see PageAbstract::createDomainObject()
     * @return null
     */
    public function createDomainObject() {
        $this->_domainObject =  new DefaultDomainObject();
    }
}
