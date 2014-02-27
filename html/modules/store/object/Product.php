<?php

class Product extends DefaultDomainObject{
    protected $_joinTables = array('ProductsML');

    public function  __construct($tableName = 'Pages') {
        $this->_tableName = 'Products';
        $this->_recordSet = new DBRecordset($this->_tableName);
        $this->_record = new DBRecord($this->_tableName,'ProductID');
        $this->_dataFields[] = '*, Products.ProductID';
    }

    public function  getAllElements() {
        $this->_recordSet->addJoinCondition('ProductsML', 'USING(ProductID)');
        $condition = ' ON(Products.ProductID=ProductImages.ProductID AND ProductImages.ProductImageIsLeading=1)';
        $this->_recordSet->addJoinCondition('ProductImages', $condition);
        return parent::getAllElements();
    }

    public function getActiveElements($categoryId = null){
        $this->_recordSet->addJoinCondition('ProductsML', 'USING(ProductID)');
        $this->_recordSet->addWhereCondition('ProductIsActive=1');

        if($categoryId != null){
            $whereCondition = 'Products.ProductID IN(SELECT ProductID FROM products_categories WHERE CategoryID='.$categoryId.')';
            $this->_recordSet->addWhereCondition($whereCondition);
        }

        $condition = ' ON(Products.ProductID=ProductImages.ProductID AND ProductImages.ProductImageIsLeading=1)';
        $this->_recordSet->addJoinCondition('ProductImages', $condition);
        return parent::getAllElements();
    }

    public function  getElement($id) {
        $this->_recordSet->addWhereCondition('Products.ProductID=' . $id);
        $result = $this->getAllElements();

        if(count($result) > 0){
            return $result[0];
        }
    }

    public function getProductImages($productId){
        $recordset = new DBRecordset("ProductImages");
        $recordset->addWhereCondition('ProductID='.$productId);
        $recordset->setOrder('ProductImageIsLeading', 'DESC');
        $recordset->read();

        $productImages = $recordset->getAllRecords();

        return $productImages;
    }
}
?>
