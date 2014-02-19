<?php
class ViewCartAction extends Action{
    public function execute() {
        $cart = new Cart();

        $cartContent = $cart->getCart();

        $productsIteration = new TemplateParserIteration('PRODUCTS', $cartContent['Products']);

        $totalPrice = $cart->getTotal();

        $productsHasCondition = new TemplateParserCondition(TemplateParserCondition::CONDITION_GRATER, 'HAS_PRODUCTS');

        $productsHasCondition->setCondition(count($cartContent['Products']), 0);

        $shippingPrice = Settings::getSetting(Settings::SETTINGS_SHIPPING_COST);

        $endPrice = $totalPrice + $shippingPrice;

        $elements = array(
            'HAS_PRODUCTS' => $productsHasCondition,
            'PRODUCTS' => $productsIteration,
            'TOTALPRICE' => $totalPrice,
            'SHIPPINGPRICE' => $shippingPrice,
            'ENDPRICE' => $endPrice
        );

        $this->getController()->setTemplateArray($elements);

        return $this->getController();
    }
}

?>
