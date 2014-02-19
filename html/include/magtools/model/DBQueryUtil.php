<?php
class DBQueryUtil {
    public static function prepareQuery($query, $parameters = array()){
        $preparedString = $query;
        foreach($parameters as $parameter){
            $preparedString = StringUtil::replace('?', $parameter, $preparedString);
        }

        return $preparedString;
    }

    public static function constructUpdateQuery($tableName, $record){
        $set = array();

        foreach($record as $column => $value){
            $set[] = $column . '=' . "'$value'";
        }

        $query = 'UPDATE ' . $tableName . ' SET ' .
                 join(',', $set);

        return $query;
    }

    public static function constructInsertQuery($tableName, $record){
        $set = array();

        foreach($record as $column => $value){
            $set[] = $column . '=' . "'$value'";
        }

        $query = 'INSERT INTO ' . $tableName . ' SET ' .
                 join(',', $set);

        return $query;
    }

    public static function constructDeleteQuery($tableName, $primaryKeyTable, $value){
        $query = ' DELETE FROM '.$tableName. ' WHERE '.$primaryKeyTable . '=' . $value;

        return $query;
    }
}
?>
