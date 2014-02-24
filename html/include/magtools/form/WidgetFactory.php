<?php
class WidgetFactory{
    public static function getWidgetInstance($type, $name, $properties){
        if(class_exists($type)){
            return new $type($name, $properties);
        }
    }
}