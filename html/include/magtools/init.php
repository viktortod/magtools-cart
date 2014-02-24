<?php
require_once dirname(__FILE__).'/constants.php';


require_once MAIN_PATH.'/include/magtools/core/Loader.php';
require_once dirname(__FILE__).'/autoload.php';
require INCLUDE_PATH.'/store/init.php';

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
    Loader::singleton()->registerClassPackage($package, "magtools/{$package}");
}

session_start();
jsSession::init();
header("Content-type: text/html; charset=utf-8");

$database = require_once dirname(__FILE__) . '/../../ini/database.php';

if(count($_POST) > 0)
{
    jsSession::setParam('send', $_POST);
}
else{
    jsSession::removeParam('send');
}

define("SEARCH_RECURSIVE", true);

require MAIN_PATH.'\plugins\ckeditor\ckeditor.php';

ConnectionInstance::setDBImplementation($database);

if(!isset($_REQUEST['action'])){
    $_REQUEST['action'] = '';
}

define('ADMIN_THEME_DESTINATION', '../'.SKINS_PATH.Settings::getSetting(Settings::SETTINGS_ADMIN_THEME));
define('SITE_THEME_DESTINATION', SKINS_PATH.Settings::getSetting(Settings::SETTINGS_SITE_THEME));


$translations = getTranslations();

function t($text){
    global $translations;

    if(isset($translations[$text])){
        return $translations[$text];
    }
    else{
        return $text;
    }
}

/**
 * Gets a parameter value from the request
 * if the parametter is not found an Exception is thrown
 * @param string $param the parametter name
 */
function getParam($param){
    if(isset($_REQUEST[$param])){
//        unset($_POST[$param], $_GET[$param]);

        return $_REQUEST[$param];
    }
    else{
        throw new Exception('Param '.$param.' is not set');
    }
}

/**
 *  Same as getParam($param). If the parametter don't exists the default value is returned
 * @param string $param the parametter
 * @param mixed $default the default value to return
 * @see getParam()
 */
function getParamDefault($param, $default){
    try{
        return getParam($param);
    }
    catch(Exception $e){
        return $default;
    }
}

function setParamValue($param, $value){
    $_REQUEST[$param] =
    $_GET[$param] = $value;
}


function getTranslations(){
    $Recordset = new DBRecordset('StaticTexts');
    $Recordset->addJoinCondition('StaticTextsContent', 'USING(StaticTextID)');
    $Recordset->setSelectFields(array(
        'StaticTexts.StaticTextDev',
        'StaticTextsContent.StaticTextContent'
    ));

    $translations = $Recordset->getAllRecords();
    $allTexts = array();
    foreach($translations as $translation){
        $allTexts[$translation['StaticTextDev']] = $translation['StaticTextContent'];
    }

    return $allTexts;
}