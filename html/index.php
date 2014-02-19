<?php
require 'include/magtools/init.php';

class IndexPage extends SitePage{
    protected $_templatesBase = 'index';
}

class HomeProductsAction extends ShowProductsAction{
    
}

$layouts = array(
    'LeftColumnLayout',
    'AdvertisingLayout'
);

$page = new IndexPage();
$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->getController()->getDispatcher()->setActionHandler("", 'HomeProducts');
$page->showPage();
?>
