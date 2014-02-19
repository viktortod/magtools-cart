<?php
require 'include/magtools/init.php';

class CmsPage extends SitePage{
    protected $_templatesBase = 'pages';
}

class ShowPageAction extends Action{
    public function execute() {
        $pageId = getParamDefault('PageID', 0);
        
        $page = new DBRecord('Pages', 'PageID');
        $page->readDBRow("PageID", $pageId);

        $this->getController()->setTemplateArray($page->getRecord());

        return $this->getController();
    }
}

$layouts = array(
    'LeftColumnLayout'
);

$page = new CmsPage();
$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->getController()->getDispatcher()->setActionHandler("", 'ShowPage');
$page->showPage();
?>
