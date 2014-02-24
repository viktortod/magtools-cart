<?php
class DBRecordset{
    private $_selectFields = array('*');

    private $_primaryTable = '';

    private $_joinTables = array();

    private $_whereCondition = array('1=1');

    private $_limitCondition = '';

    private $_orderCondition = '';

    private $_query = '';

    private $_records;

    public function  __construct($table) {
        $this->_primaryTable = $table;
    }

    public function delete($field, $value){
        $query = DBQueryUtil::constructDeleteQuery($this->_primaryTable, $field, $value);
        ConnectionInstance::getInstance()->query($query);
    }

    public function setSelectFields($selectFields = array()){
        $this->_selectFields = $selectFields;
    }

    public function addJoinCondition($table, $condition){
        $this->_joinTables[] = array($table => $condition);
    }

    public function addWhereCondition($where){
        $this->_whereCondition[]  = $where;
    }

    public function setLimit($limitCount, $limitStartRecord){
        $this->_limitCondition = ' LIMIT '.$limitCount.','.$limitStartRecord;
    }

    public function setOrder($orderCondition, $orderType){
        $this->_orderCondition = ' ORDER BY '. $orderCondition . '  '.$orderType;
    }

    public function setQuery($query){
        $this->_query = $query;
    }

    public function read(){
        if($this->_query == ''){
            $this->_query = $this->constructQuery();
        }

        $this->_records = ConnectionInstance::getInstance()->fetchAll($this->_query);
    }

    public function getAllRecords(){
        if($this->_records == null){
            $this->read();
        }
        return $this->_records;
    }

    public function constructQuery(){
        $query = ' SELECT ' . join(',', $this->_selectFields) .
                 ' FROM '. $this->_primaryTable .
                 $this->constructJoin() .
                 ' WHERE '. join(' AND ', $this->_whereCondition);

        $query .= $this->_limitCondition . ' ';
        $query .= $this->_orderCondition;

        return $query;
    }

    protected function constructJoin(){
        $join = '';
        foreach($this->_joinTables as $joins){
            foreach($joins as $joinTable => $joinCondition){
                $join .= ' LEFT JOIN '. $joinTable . ' '. $joinCondition;
            }
        }

        return $join;
    }
}