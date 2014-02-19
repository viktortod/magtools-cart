<?php
class Loader {
    private $classes;
    private static $instance = null;

    public static function singleton()
    {
        if(self::$instance == null){
            self::$instance = new Loader();
        }

        return self::$instance;
    }

    private function __construct()
    {
        
    }

    public function registerClass($class, $destination)
    {
        $this->classes[$class] = $destination;
    }

    public function loadClass($class)
    {
        if(isset($this->classes[$class])){
            require_once INCLUDE_PATH.'/magtools'.$this->classes[$class];
        }
        else{
            throw new MagtoolsException('__AutoLoading of class '. $class .' fail', MagtoolsException::AUTOLOAD_EXCEPTION);
        }
    }


    private function __clone()
    {

    }
}
?>
