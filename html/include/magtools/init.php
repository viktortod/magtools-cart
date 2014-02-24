<?php
define("INCLUDE_PATH", dirname(dirname(__FILE__)));

define("MAIN_PATH", dirname(INCLUDE_PATH));

define('SKINS_PATH', 'skin/');


require_once MAIN_PATH.'/include/magtools/core/Loader.php';
require_once MAIN_PATH.'/include/magtools/core/autoload.php';

$autoloadClasses = array(
    //Controllers
    'IAction' => '/controller/Action.php',
    'Action' => '/controller/Action.php',
    'osExecInsertAction' => '/controller/Action.php',
    'osExecUpdateAction' => '/controller/Action.php',
    'osExecDeleteAction' => '/controller/Action.php',
    'ClearFiltersAction' => '/controller/Action.php',
    'ActionDispatcher' => '/controller/ActionDispatcher.php',
    'Controller' => '/controller/Controller.php',
    'UIWebTable' => '/controller/UIWebTable.php',
    //Model
    'ConnectionInstance' => '/model/ConnectionInstance.php',
    'DBConnection' => '/model/DBConnection.php',
    'DBQueryUtil' => '/model/DBQueryUtil.php',
    'IDomainObject' => '/model/DomainObject.php',
    'DefaultDomainObject' => '/model/DomainObject.php',
    'DBRecord' => '/model/Record.php',
    'DBRecordset' => '/model/Record.php',
    'Settings' => '/core/Settings.php',
    //View
    'UIWidget' => '/view/UIWidget.php',
    'UIWidgetTable' =>'/view/UIWidget.php',
    'TemplateParser' => '/view/TemplateParser.php',
    'TemplateParserCondition' => '/view/TemplateParser.php',
    'TemplateParserIteration' => '/view/TemplateParser.php',
    'TemplateParserTranslate' => '/view/TemplateParser.php',
    'PageAbstract' => '/view/page.php',
    'Page' => '/view/page.php',
    'SitePage' => '/view/page.php',
    'PageAdministration' => '/view/page.php',
    'PageTypes' => '/view/page.php',
    'Pager' => '/view/Pager.php',
    'Widget' => '/view/Widgets.php',
    'TableCommand' => '/view/TableCommand.php',
    'WidgetFactory' => '/view/Widgets.php',
    'UILayout' => '/view/Layout.php',
    'LayoutFactory' => '/view/Layout.php',
    'UIBlock' => '/view/Module.php',
    'Form' => '/view/form.php',
    'jsUserAuth' => '/js/model/UserAuth.php',
    'jsSiteUserAuth' => '/js/model/SiteAuth.php',
    'jsSession' => '/js/model/Session.php',
    'BreadCrumb' => '/view/BreadCrumb.php',
    //Utils
    'DataMapUtil' => '/util/DataMapUtil.php',
    'StringUtil' => '/util/StringUtil.php',
    'UploadUtil' => '/util/UploadUtil.php',
    'HierarchyUtil' => '/util/HierarchyUtil.php',
    'IniUtil' => '/util/IniUtil.php',
    'LogUtil' => '/util/LogUtil.php',
    'UIUtil' => '/util/UIUtil.php',
    'ImageUtil' => '/util/ImageUtil.php',
    'MessageUtil' => '/util/MessageUtil.php',
    //Vaidators
    'ValidatorFactory' => '/validators/ValidatorFactory.php',
    'NotEmptyValidator' => '/validators/Validator.php',
    'SelectedValidator' => '/validators/Validator.php',
    'RegexValidator' => '/validators/Validator.php',
    'Validator' => '/validators/Validator.php',
    'EmailValidator' => '/validators/Validator.php',
    'PhoneValidator' => '/validators/Validator.php',
    //Exceptions
    'ValidationException' => '/core/Exceptions.php',
    'MagtoolsException' => '/core/Exceptions.php',
    //Filters
    'Filter' => '/filters/Filter.php',
    'DateFilter' => '/filters/Filter.php',
    'FilterFactory' => '/filters/Filter.php',
    'FiltersParser' => '/filters/Filter.php',
);

foreach($autoloadClasses as $className=>$classDestination){
    Loader::singleton()->registerClass($className, $classDestination);
}

require INCLUDE_PATH.'/store/init.php';

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


require_once dirname(__FILE__).'/core/autoload.php';

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