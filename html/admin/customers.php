<?php
    require_once '../include/magtools/init.php';

    jsUserAuth::checkUserAuth();

    class CustomerPage extends PageAdministration{
        protected $_templatesBase = 'customers';

        protected $_dataFields = array(
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerFirstName',
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerLastName',
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerPhone',
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerEmail',
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerCompany',
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerCompanyAddress',
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerUIC',
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerVAT',
            ),
        );

        public function createDomainObject() {
            $this->_domainObject = new Customer();
        }
    }

     class CustomerDeleteAction extends osExecDeleteAction{
        public function prepare(){
            $this->_tableName = 'Customers';
            $this->_editPK = 'CustomerID';
        }
    }

    $page = new CustomerPage();
    $page->getController()->getDispatcher()->setActionHandler('doDelete', 'CustomerDelete');
    $page->showPage(getParamDefault('CustomerID', '0'));
?>
