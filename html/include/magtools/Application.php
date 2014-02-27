<?php
	final class Application {
		public function registerPackages(){
			$autoloadPackages = array(
				"blocks",
				"controller",
				"core",
				"exceptions",
				"filters",
				"form",
				"grid",
				"js",
				"model",
				"util",
				"validators",
				"view",
			);
			
			foreach($autoloadPackages as $package){
			    Loader::singleton()->registerClassPackage($package, "include/magtools/{$package}");
			}
		}
		
		public function initDb(array $database){
			ConnectionInstance::setDBImplementation($database);
		}
		
		public function init(array $settings){
			$modules = $this->getSetting($settings, 'lib', array());
			foreach($modules as $module => $handler){
				$filename = MAIN_PATH. '/modules/'.$module.'/'.$handler.'.php';
				if(file_exists($filename)){
					require_once $filename;
				}
				
				if(!class_exists($handler)){
					throw new Exception("Module {$module} cannot be found");
				}
				
				$inst = new $handler();
				
				if(!$inst instanceof IModule){
					throw new Exception("{$module} is not a module");
				}
				
				$inst->init($settings);
				$inst->registerPackages();
			}
		}
		
		private function getSetting($settings, $id, $defaultValue){
			if(!isset($settings[$id])){
				return $defaultValue;
			}
			
			return $settings[$id];
		}
	}