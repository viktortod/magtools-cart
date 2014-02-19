<?php
require 'include/magtools/init.php';

class AjaxCartAction extends Action{
    public function  execute() {
        $json = array();

        $cart = Cart::getCart();

        $json['products'] = $cart['Products'];
        $shippingCost = Settings::getSetting(Settings::SETTINGS_SHIPPING_COST);
        $json['shipping'] = $shippingCost;
        $json['total'] = Cart::getTotal() + $shippingCost;
        
        echo json_encode($json);
        exit();
    }
}

class AjaxAddProductAction extends Action{
    public function  execute() {
        Cart::insertProduct(getParam('ProductId'), getParam('quantity'));
        exit();
    }
}

class AjaxRemoveProductAction extends Action{
    public function execute(){
        Cart::removeProduct(getParam('ProductId'));
    }
}

$page = new Page();
$page->getController()->getDispatcher()->setActionHandler("", 'AjaxCart');
$page->getController()->getDispatcher()->setActionHandler("add", 'AjaxAddProduct');
$page->getController()->getDispatcher()->setActionHandler("remove", 'AjaxRemoveProduct');
$page->getController()->dispatch();

?>
