<?php
class EmptyCartAction extends Action{
    public function execute() {
        jsSession::removeParam('Cart');

        $this->getController()->redirect('view_cart.php');
    }
}
?>
