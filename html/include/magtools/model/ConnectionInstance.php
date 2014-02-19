<?php
class ConnectionInstance {
    private static $instance = null;

    public static function getInstance(){
        return self::$instance;
    }

    public static function setDBImplementation($database){
        if( self::$instance == null){
            self::$instance = new DBConnection();
            self::$instance->connect($database);
        }
    }
}
?>
