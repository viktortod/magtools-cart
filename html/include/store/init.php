<?php
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
    Loader::singleton()->registerClassPackage("store_" . $package, "store/{$package}");
}
?>
