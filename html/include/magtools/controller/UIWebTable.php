<?php
class UIWebTable{
    private $_columns = array();
    private $_data = array();

    public function init($colums){
        $this->_columns = $colums;
    }

    public function assignData($data){
        $this->_data = $data;
    }

    public function replaceRowField($rowField, $newDataValue){
        foreach($this->_data as $rowNum =>$dataRow){
            if(isset($dataRow[$rowField])){
                $this->_data[$rowNum] = $newDataValue;
            }
        }
    }

    public function addOperation($operationKey, $operationLink, $elementKey='id'){
        foreach($this->_data as $rowNum =>$dataRow){
            $this->_data[$rowNum][$operationKey] = str_replace('<%DataID%>',current($this->_data[$rowNum]),$operationLink);
            $this->_data[$rowNum][$operationKey] = str_replace('<%DATA_PKFIELD%>',$elementKey,$this->_data[$rowNum][$operationKey]);
        }

        $this->_colums[] = $operationKey;
    }

    public function parse(){
        $iteration = new TemplateParserIteration('tableRows', $this->_data);
        return $iteration;
    }
}
?>
