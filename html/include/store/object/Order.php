<?php

class Order extends DefaultDomainObject{
//    protected $_joinTables = array('PaymentModules');

    public function  __construct($tableName = 'Pages') {
        $this->_tableName = 'Orders';
        $this->_recordSet = new DBRecordset($this->_tableName);
        $this->_record = new DBRecord($this->_tableName,'OrderID');
        $this->_dataFields[] = '*';
    }

    public function  getAllElements() {
        $this->_recordSet->addJoinCondition('Customers', 'ON(Customers.CustomerID=Orders.OrderCustomerID)');
        $this->_recordSet->addJoinCondition('PaymentModules', 'ON(PaymentModules.PaymentModuleID=Orders.OrderPaymentModuleID)');
        return parent::getAllElements();
    }

    public function  getElement($id) {
        $this->_recordSet->addJoinCondition('Customers', 'ON(Customers.CustomerID=Orders.OrderCustomerID)');
        $this->_recordSet->addJoinCondition('CustomerAddress', 'ON(CustomerAddress.CustomerAddressID = Orders.OrderShippingAddressID)');
        $this->_recordSet->addJoinCondition('PaymentModules', 'ON(PaymentModules.PaymentModuleID=Orders.OrderPaymentModuleID)');
        $this->_recordSet->addJoinCondition('ShippingModules', 'ON(ShippingModules.ShippingModuleID=Orders.OrderShippingModuleID)');
        $this->_recordSet->addWhereCondition('OrderID = ' . $id);
        $elements = $this->_recordSet->getAllRecords();

        $elements[0]['OrderDate'] = date('d/m/Y',  $elements[0]['OrderDate']);

        $orderItems = new DBRecordset('OrderItems');
        $orderItems->addJoinCondition('Products', 'USING(ProductID)');
        $orderItems->addJoinCondition('ProductsML', 'USING(ProductID)');
        $orderItems->addWhereCondition('OrderID='.$id);

        $items = $orderItems->getAllRecords();
        
        $elements[0]['OrderItems'] = $items;
        $elements[0]['OrderItems']['Shipping'] = $elements[0]['ShippingModulePrice'];
//        dump($elements); exit();
        return $elements[0];
    }
}
?>
