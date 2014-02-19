<?php
class Category extends DefaultDomainObject{
    protected $_joinTables = array('CategoriesML');

    public function  __construct($tableName = 'Categories') {
        $this->_tableName = $tableName;
        $this->_recordSet = new DBRecordset($tableName);
        $this->_record = new DBRecord($tableName,'CategoryID');
        $this->_dataFields[] = '*';
    }

    public function getElementsList(){
        

        $categories = $this->getAllElements();

        $formatedCategories = array();
        foreach($categories as $category)
        {
            $formatedCategories[$category['CategoryID']] = $category['CategoryName'];
        }



        return $formatedCategories;
    }

    public function getCategoriesHierarchy($keyField, $valueField)
    {
        $properties = array(
            'tableName' => 'Categories',
            'parentColum' => 'CategoryParentID',
            'keyField' => 'CategoryID',
            'valueField' => 'CategoryID'
        );
        $hierarchy = HierarchyUtil::getHierarchy($properties);
    }

    public function getAvailableCategories($productId)
    {
        
        $where = ' CategoryID NOT IN(SELECT CategoryID FROM Products_Categories WHERE ProductID='.$productId.')';
        $this->_recordSet->addWhereCondition($where);
        $this->_recordSet->addJoinCondition('CategoriesML', 'USING(CategoryID)');

        $this->_recordSet->read();
//        dump($this->_recordSet->constructQuery()); die();
        return $this->_recordSet->getAllRecords();
    }

    public function  getAllElements() {
        $this->_recordSet->addJoinCondition('CategoriesML', 'USING(CategoryID)');

        return parent::getAllElements();
    }

    public function  getElement($id) {
        $this->_recordSet->addWhereCondition(' CategoryID=' . $id);
        $result = $this->getAllElements();

        if(count($result) > 0){
            return $result[0];
        }
    }
}
?>
