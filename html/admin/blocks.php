<?php
    require_once '../include/magtools/init.php';

    jsUserAuth::checkUserAuth();

    class BlocksAdminPage extends PageAdministration {
        protected $_templatesBase = 'blocks';

        protected $_dataFields = array(
            array(
                'type' => 'InputTextField',
                'name' => 'BlockName'
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'BlockDevClassName'
            ),
            array(
                'type' => 'InputFileField',
                'name' => 'CategoryImage'
            ),
            array(
                'type' => 'SelectBox',
                'name' => 'CategoryParentID'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CategoryImage',
                'displayName' => 'HTML_CategoryImage'
            )
        );

        public function  createDomainObject() {
            $this->_domainObject = new Block();
        }
    }


    $page = new BlocksAdminPage();
    $page->showPage(getParamDefault('LayoutID', '0'));
?>
