<?php
	class StoreModule implements IModule{
		public function init(array $settings){
			
		}
		
		public function registerPackages(){
			$autoloadPackages = array(
				"action",
				"block",
				"controller",
				"layout",
				"object",
				"util",
				"widget",
			);
			
			foreach($autoloadPackages as $package){
			    Loader::singleton()->registerClassPackage("store_" . $package, "modules/store/{$package}");
			}
		}
	}