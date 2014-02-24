<?php
class FilterFactory{
    public static function get($filterClass, $field)
    {
        $filter = new $filterClass($field);

        if($filter instanceof Filter){
            return $filter;
        }
        else{
            throw new Exception("Class ".$filterClass. " is not a Filter");
        }
    }
}