<?php
class Cart {
    public static $cart;

    
    public static function getCart(){
        self::$cart = jsSession::getSessionParamDefault('Cart', array());
        if(!isset(self::$cart['Products'])){
            self::$cart['Products'] = array();
        }

        

        foreach(self::$cart['Products'] as &$product){
            $quantity = $product['quantity'];
            $productObject = new Product();
            $product = $productObject->getElement($product['ProductID']);
            $product['quantity'] = $quantity;

            $product['EndPrice'] = $quantity * $product['ProductGlobalPrice'];
        }

        
        
        return self::$cart;
    }

    public static function emptyCart(){
        jsSession::removeParam('Cart');
    }

    public static function getTotal(){
        $products = self::getCart();

        $totalSum = 0;

        foreach($products['Products'] as $product){
            $totalSum += $product['ProductGlobalPrice'] * $product['quantity'];
        }

        return $totalSum;
    }

    protected static function issetProduct($productId){
        $products = self::getCart();
//        dump($products); exit();
        foreach($products['Products'] as $product){
//            dump($product); exit();
            if($product['ProductID'] == $productId){
                return true;
            }
        }

        return false;
    }

    public static function getProductQuantity($productId){
         $products = self::getCart();

        if(self::issetProduct($productId)){
            foreach($products['Products'] as $product){
                if($product['ProductID'] == $productId){
                    return $product['quantity'];
                }
            }
        }
        else{
            return 0;
        }
    }

    public static function getProductKey($productId){
         $products = self::getCart();
        if(self::issetProduct($productId)){
            foreach($products['Products'] as $key => $product){
                if($product['ProductID'] == $productId){
                    return $key;
                }
            }
        }
        else{
            return null;
        }
    }

    public function updateQuantity($productId, $quantity){
        $productKey = self::getProductKey($productId);

        $_SESSION['Cart']['Products'][$productKey]['quantity']  = $quantity;
    }

    public static function removeProduct($productId){
        $key = self::getProductKey($productId);
//        if($key != null)
            unset($_SESSION['Cart']['Products'][$key]);
    }

    public static function insertProduct($productId, $quantity){
        $quantity += self::getProductQuantity($productId);

        self::removeProduct($productId);

        $record = new DBRecord('Products', 'ProductID');
        $product = $record->getRecordPK($productId);
        $product['quantity'] = $quantity;
        jsSession::addParam('Products', $product, 'Cart');
    }
}
?>
