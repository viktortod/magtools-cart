<?php
class OrderStatus {
    const ORDER_STATUS_NEW = 0;
    const ORDER_STATUS_PROCESSING = 1;
    const ORDER_STATUS_PROCESSED = 2;
    const ORDER_STATUS_IN_DELIVERING = 3;
    const ORDER_STATUS_DELIVERED = 4;
    const ORDER_STATUS_CANCELED = 5;

    private static $_orderStatusStyle = array(
        self::ORDER_STATUS_NEW => '#000000',
        self::ORDER_STATUS_PROCESSING => '#000000',
        self::ORDER_STATUS_PROCESSED => '#000000',
        self::ORDER_STATUS_IN_DELIVERING => '#000000',
        self::ORDER_STATUS_DELIVERED => '#000000',
        self::ORDER_STATUS_CANCELED => '#000000',
    );

    private static $_orderStatusName = array(
        self::ORDER_STATUS_NEW => 'New',
        self::ORDER_STATUS_PROCESSING => 'Processing',
        self::ORDER_STATUS_PROCESSED => 'Processed',
        self::ORDER_STATUS_IN_DELIVERING => 'Delivering',
        self::ORDER_STATUS_DELIVERED => 'Delivered',
        self::ORDER_STATUS_CANCELED => 'Canceled',
    );

    public static function getOrderStatusNames() {
        return self::$_orderStatusName;
    }

    public static function getOrderStatusStyles() {
        return self::$_orderStatusStyle;
    }

    public static function getOrderStatus($orderStatusId) {
        return self::$_orderStatusName[$orderStatusId];
    }

    public static function getOrderStatusStyle($orderStatusId) {
        return self::$_orderStatusStyle[$orderStatusId];
    }
}
?>
