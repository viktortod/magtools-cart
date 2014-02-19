<?php
require 'include/magtools/init.php';

class ErrorPage extends SitePage{
    protected $_templatesBase = 'error';
}


class ShowErrorAction extends Action {
    public function execute() {
        $errorMsg = getParam('msg');

        $this->getController()->setTemplateVariable('ERROR', $errorMsg);
    }
}

$layouts = array(
    'LeftColumnLayout'
);

$page = new ErrorPage();
//$page->getPageTemplate();
$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->getController()->getDispatcher()->setActionHandler("", 'ShowError');
$page->showPage(0);

?>
