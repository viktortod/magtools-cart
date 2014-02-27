<?php
require_once 'include/magtools/init.php';

jsSiteUserAuth::checkUserAuth();

class CheckoutPage extends SitePage{
    protected $_templatesBase = 'checkout';

    public function changeTemplateBase($base){
        $this->_templatesBase = $base;
    }

    public function createDataFields($dataFields){
        $this->_dataFields = $dataFields;
    }

    public function createDomainObject() {
        $this->_domainObject =  new Customer();
    }
}

class ConfirmCartAction extends ViewCartAction{
    public function  prepare() {
        $this->getController()->getPage()->changeTemplateBase('cart');
    }
}

class CreateOrderAction extends Action{
    public function execute() {
        $dataFields = array(
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerFirstName',
                'validator' => 'NotEmptyValidator',
                'errorMsg' => 'This field is mandatory'
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerLastName',
                'validator' => 'NotEmptyValidator',
                'errorMsg' => 'This field is mandatory'
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerEmail',
                'validator' => 'EmailValidator',
                'errorMsg' => 'Invalid email'
            ),
            array(
                'type' => 'InputPasswordField',
                'name' => 'CustomerPassword',
                'validator' => 'NotEmptyValidator',
                'errorMsg' => 'Please enter valid password'
            ),
            array(
                'type' => 'InputPasswordField',
                'name' => 'CustomerConfirmPassword',
                'validator' => 'ConfirmPasswordValidator',
                'errorMsg' => 'Passwords don\'t match'
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'CustomerPhone',
                'validator' => 'PhoneValidator',
                'errorMsg' => 'Pleace enter valid cell phone'
            ),
            array(
                'type' => 'CustomerAddressWidget',
                'name' => 'ADDRESS'
            ),
        );

        $this->getController()->getPage()->createDataFields($dataFields);

        $ShippingModules = new DBRecordset('ShippingModules');
        $ShippingModules->addWhereCondition('ShippingModuleIsActive=1');

        $shippingModulesIteration = new TemplateParserIteration('SHIPPING', $ShippingModules->getAllRecords());

        $PaymentModules = new DBRecordset('PaymentModules');
        $PaymentModules->addWhereCondition('PaymentModuleIsActive=1');

        $paymentModulesIteration = new TemplateParserIteration('PAYMENT', $PaymentModules->getAllRecords());


        $this->getController()->setTemplateVariable('PAYMENT', $paymentModulesIteration);
        $this->getController()->setTemplateVariable('SHIPPING', $shippingModulesIteration);
    }
}

class SaveOrderAction extends Action{
    public function  execute() {
        dump($_POST);

        $order = new DBRecord('Orders', 'OrderID');

        $record = array(
            'OrderCustomerID' => jsSiteUserAuth::getLoggedUserProperty('CustomerID'),
            'OrderShippingAddressID' => getParamDefault('CustomerDefault',1),
            'OrderPaymentModuleID' => getParam('PaymentModuleID'),
            'OrderShippingModuleID' => getParam('ShippingModuleID'),
            'OrderAdditionalInfo' => getParam('OrderAdditionalInfo'),
            'OrderDate' => strtotime('Now'),
        );

        $order->setDBRow($record);

        $orderId = $order->insert();

        $cart = new Cart();

//        dump($orderId);

        $orderItems = $cart->getCart();

        foreach($orderItems['Products'] as $item){
            $orderItem  = new DBRecord('OrderItems', 'OrderItemID');
            $row = array(
                'OrderID' => $orderId,
                'ProductID' => $item['ProductID'],
                'OrderItemQuantity' => $item['quantity'],
                'OrderItemSinglePrice' => $item['ProductGlobalPrice'],
                'OrderItemSum' => $item['quantity'] * $item['ProductGlobalPrice'],
            );
            $orderItem->setDBRow($row);
            $orderItem->insert();
        }

        $cart->emptyCart();

//        exit();
    }

    public function  postExecute() {
        $this->getController()->redirect('index.php');
    }
}

$layouts = array(
    'LeftColumnLayout'
);

$page = new CheckoutPage();
$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->getController()->getDispatcher()->setActionHandler("", 'ConfirmCart');
$page->getController()->getDispatcher()->setActionHandler("doUpdateCart", 'UpdateCart');
$page->getController()->getDispatcher()->setActionHandler("doEmptyCart", 'EmptyCart');
$page->getController()->getDispatcher()->setActionHandler("doConfirmCart", 'CreateOrder');
$page->getController()->getDispatcher()->setActionHandler("createOrder", 'SaveOrder');
$page->showPage(getParamDefault('CustomerID', 0));
?>
