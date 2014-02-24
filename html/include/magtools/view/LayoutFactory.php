<?php
/**
 * A Factory class for layouts. Uses Factory Design Pattern
 */
class LayoutFactory{

    /**
     * Creates UILayout instance by given name
     * @param string $name The name of the given layout
     * @todo Change the Exception instanse.
     * @return UILayout
     */
    public static function getLayout($name){
        if(class_exists($name)){
            $obj = new $name;

            if($obj instanceof UILayout){
                return $obj;
            }
            else{
                throw new Exception('Object '.$name.' is not a layout!!!');
            }
        }
        else{
            throw new Exception('Invalid layout...');
        }
    }
}