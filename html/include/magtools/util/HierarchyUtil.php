<?php
class HierarchyUtil {
    public static function getHierarchy($properties, $level=0)
    {
        $elements =  self::getLevelElements($properties, $level);

        $fmtElements = self::getFormatedElements($elements, $properties);

        return $fmtElements;
    }

    protected static function getLevelElements($properties = array(), $level=0)
    {
        $recordset = new DBRecordset($properties['tableName']);

        if(isset($properties['join'])){
            $recordset->addJoinCondition($properties['join']['table'], $properties['join']['condition']);
        }

        $recordset->setSelectFields(array(
                $properties['valueField'], $properties['keyField']
            )
        );
        $whereCondition = $properties['parentColumn'].'='.$level;
        $recordset->addWhereCondition($whereCondition);
        $recordset->read();
        $levelElements = $recordset->getAllRecords();
        
        foreach($levelElements as $key => &$element){
//            dump($element);
//            exit();
            $element['children'] = self::getLevelElements($properties, $element[$properties['keyField']]);
        }

        return $levelElements;
    }

    protected static function getFormatedElements($elements, $properties){
        $fmtElements = array();

        foreach($elements as $element){
            $fmtElements[$element[$properties['keyField']]] = $element[$properties['valueField']];
            if(count($element['children']) > 0){
                $fmtElements['children'] = self::getFormatedElements($element['children'], $properties);
            }
        }

        return $fmtElements;
    }
}
?>
