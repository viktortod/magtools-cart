<?php
class UpdateCartAction extends Action{
    public function execute() {
        $quantities = getParam('ProductQuantity');

        $cart = new Cart();

        foreach($quantities as $productId => $quantities){
            if($quantities > 0){
                $cart->updateQuantity($productId, $quantities);
            }
        }

        $this->getController()->redirect('view_cart.php');
    }
}
?>
