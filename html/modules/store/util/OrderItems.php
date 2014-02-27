<?php
class OrderItems {
    public static function calculateTotalLines($orderItems) {
        $orderProductTotal = 0.0;
        foreach($orderItems as $product) {
            if(isset($product['OrderItemSum']))
            $orderProductTotal += $product['OrderItemSum'];
        }

        $orderShipping = $orderItems['Shipping'];

        $orderTotal = $orderProductTotal + $orderShipping;

        return array(
            'OrderProductTotal' => $orderProductTotal,
            'OrderShippingCost' => $orderShipping,
            'OrderTotal' => $orderTotal
        );
    }

    
}
?>
