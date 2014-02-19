<?php
require_once 'include/magtools/init.php';

jsSiteUserAuth::checkUserAuth();

class ViewCartPage extends SitePage{
    protected $_templatesBase = 'cart';
}

$layouts = array(
    'LeftColumnLayout'
);

$page = new ViewCartPage();
$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->getController()->getDispatcher()->setActionHandler("", 'ViewCart');
$page->getController()->getDispatcher()->setActionHandler("doUpdateCart", 'UpdateCart');
$page->getController()->getDispatcher()->setActionHandler("doEmptyCart", 'EmptyCart');
$page->showPage();
?>
