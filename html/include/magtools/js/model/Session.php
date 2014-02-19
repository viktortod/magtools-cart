<?php
class jsSession {
    private static $_sessionParams;

    public static function init()
    {
        if(isset($_SESSION)){
            foreach($_SESSION as $sessionVar => $value){
                self::$_sessionParams[$sessionVar] = $value;
            }
        }
    }

    public static function getSessionParam($paramName)
    {
        if(isset(self::$_sessionParams[$paramName])){
            return self::$_sessionParams[$paramName];
        }
    }

    public static function getSessionParamDefault($paramName, $defaultValue, $mainSessionSection=null)
    {
        $params  = ($mainSessionSection == null )?self::$_sessionParams :
                                                 @self::$_sessionParams[$mainSessionSection] ;

        if(isset($params[$paramName])){
            return $params[$paramName];
        }
        else{
            return $defaultValue;
        }
    }

    public static function setParam($param,$value, $mainSessionSection = null)
    {
        if($mainSessionSection == null){
            $_SESSION[$param] = $value;
        }
        else{
            $_SESSION[$mainSessionSection][$param] = $value;
        }

        self::init();
    }

    public static function addParam($param,$value, $mainSessionSection = null)
    {
        if($mainSessionSection == null){
            $_SESSION[$param][] = $value;
        }
        else{
            $_SESSION[$mainSessionSection][$param][] = $value;
        }

        self::init();
    }

    public static function removeParam($paramName, $mainSessionSection = null)
    {
        if($mainSessionSection == null){
            if(isset($_SESSION[$paramName]))
            unset($_SESSION[$paramName]);

            if(isset(self::$_sessionParams[$paramName]))
            unset(self::$_sessionParams[$paramName]);
        }
        else{
            if(isset($_SESSION[$mainSessionSection][$paramName]))
            unset($_SESSION[$mainSessionSection][$paramName]);

            if(isset(self::$_sessionParams[$mainSessionSection][$paramName]))
            unset(self::$_sessionParams[$mainSessionSection][$paramName]);
        }
    }

    public static function removeArrayParamItem($paramName, $key, $mainSessionSection = null){
        if($mainSessionSection == null){
            if(isset($_SESSION[$paramName][$key]))
            unset($_SESSION[$paramName][$key]);

            if(isset(self::$_sessionParams[$paramName][$key]))
            unset(self::$_sessionParams[$paramName][$key]);
        }
        else{
            if(isset($_SESSION[$mainSessionSection][$paramName][$key]))
            unset($_SESSION[$mainSessionSection][$paramName][$key]);

            if(isset(self::$_sessionParams[$mainSessionSection][$paramName][$key]))
            unset(self::$_sessionParams[$mainSessionSection][$paramName][$key]);
        }
    }

    public static function getFilters(){
        if(isset($_SESSION[Filter::FILTER_SESSION_PARAM])){
            return $_SESSION[Filter::FILTER_SESSION_PARAM];
        }
        else{
            return array();
        }
    }

    public static function removeFilters(){
        unset($_SESSION[Filter::FILTER_SESSION_PARAM]);
    }
}
?>
