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

    public function registerClassPackage($classPackage, $destination){
    	$this->classes[$classPackage] = $destination;
    }

    public function loadClass($class)
    {
    	foreach($this->classes as $package => $destination){
    		$filename = MAIN_PATH . "/{$destination}/" . $class . ".php";
    		if(file_exists($filename)){
    			require_once $filename;
    			return true;
    		}
    	}
    	
    	dump($class);
    	throw new MagtoolsException('__AutoLoading of class '. $class .' fail', MagtoolsException::AUTOLOAD_EXCEPTION);
    }


    private function __clone()
    {

    }
}
?>
