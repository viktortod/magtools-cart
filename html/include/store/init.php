<?php
$storeAutoload = array(
    //Controllers
    'ShowProductsAction' => '/controller/ShowProductsAction.php',
    //objects
    'Category' => '/object/Category.php',
    'Block' => '/object/Block.php',
    'Product' => '/object/Product.php',
    'Cart' => '/object/Cart.php',
    'Message' => '/object/Message.php',
    'Order' => '/object/Order.php',
    'Customer' => '/object/Customer.php',
    //layout
    'LeftColumnLayout' => '/layout/LeftColumnLayout.php',
    'AdvertisingLayout' => '/layout/AdvertisingLayout.php',
    //block
    'CategoriesBlock' => '/block/CategoriesBlock.php',
    'ProfileBlock' => '/block/ProfileBlock.php',
    'AdvertisingBlock' => '/block/AdvertisingBlock.php',
    'CartBlock' => '/block/CartBlock.php',
    //util
    'OrderStatus' => '/util/OrderStatus.php',
    'Paths' => '/util/Paths.php',
    'OrderItems' => '/util/OrderItems.php',
    //widgets
    'CustomerAddressWidget' => '/widget/CustomerAddress.php',
    //action
    'ViewCartAction' => '/action/ViewCart.php',
    'UpdateCartAction' => '/action/UpdateCart.php',
    'EmptyCartAction' => '/action/EmptyCart.php'
);

foreach($storeAutoload as $className=>$classDestination){
    Loader::singleton()->registerClass($className,'/../store'. $classDestination);
}
?>
