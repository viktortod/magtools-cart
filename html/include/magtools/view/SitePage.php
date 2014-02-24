<?php
class SitePage extends Page{
    public function  __construct() {
        parent::__construct();

        $recordset = new DBRecordset('Pages');
        $recordset->addWhereCondition('PageIsActive=1');

        $mainMenu = $recordset->getAllRecords();

        $iteration = new TemplateParserIteration('MAIN_MENU', $mainMenu);

        $userIdentity = new TemplateParserCondition(TemplateParserCondition::CONDITION_EQUALS, 'USER_IDENTITY');

        $userIdentity->setCondition(jsSiteUserAuth::isUserLogged(), true);

        try{
            $username = jsSiteUserAuth::getLoggedUserProperty('CustomerFirstName').' '.  jsSiteUserAuth::getLoggedUserProperty('CustomerLastName');
        } catch(Exception $e){
            $username = 'Guest';
        }

        $elements = array(
            'SITE_URL' => Paths::getPath(Paths::SITE_URL),
            'MAIN_MENU' => $iteration,
            'USER_IDENTITY' => $userIdentity,
            'USERNAME' => $username
        );

        $this->_controller->setTemplateVariable('PRODUCT_IMAGE_PATH', Paths::getPath(Paths::PRODUCTS_IMAGE_PATH));
        $this->_controller->setTemplateVariable('PRODUCT_LARGE_PATH', Paths::getPath(Paths::PRODUCTS_THICKBOX_IMAGE_PATH));
        $this->_controller->setTemplateVariable('PRODUCT_THUMB_PATH', Paths::getPath(Paths::PRODUCTS_THUMB_IMAGE_PATH));
        $this->assignMainPageElements($elements);
    }
}