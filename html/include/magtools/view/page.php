<?php
abstract class PageAbstract{
    protected $_templatesDestination = 'themes/site_default/';
    protected $_templatesBase = '';

    protected $_controller;

    protected $_templateId = 3;

    protected $_domainObject;

    protected $_pager;

    private $_widgets;

    protected $_dataFields = array(
        
    );

    /**
     * Page constructor.
     */
    public function __construct(){
        $this->_controller = new Controller($this);
        $this->_controller->setPage($this);
        
        $this->createDomainObject();
    }

    /**
     * Gets the controller object
     * @return Controller
     */
    public function getController(){
        return $this->_controller;
    }

    /**
     * Sets the main page elements of the page.
     * <code>
     * <?php
     *  $page->assignMainPageElements(array('PAGE_ELEMENT' => 'ELEMENT_VALUE'));
     * ?>
     * </code>
     */
    public function assignMainPageElements($elements = array()){

        $this->_controller->setTemplateArray($elements);
    }

    /**
     * Gets page data fields array
     * @return array
     */
    public function getDataFields(){
        return $this->_dataFields;
    }

    /**
     * creates domain object instance of page
     * @abstract
     */
    abstract public function createDomainObject();

    /**
     * Get page domain object
     * @return IDomainObject
     */
    public function getDomainObject(){
        return $this->_domainObject;
    }

    /**
     * Adds Widget to the page
     * @param string $name the display name of the widget
     * @param Widget $widget the widget instance to be shown
     * @access protected
     * @return null
     */
    protected function addWidget($name, Widget $widget){
        $this->_widgets[$name] = $widget;
    }

    /**
     * Gets widget instance by name
     * @access protected
     * @param string $name the name of the Widget
     * @return Widget
     */
    protected function getWidget($name){
        return $this->_widgets[$name];
    }

    /**
     * Parses the widget with given value
     * @access public
     * @param string $widgetName the name of the widget to be parsed
     * @param mixed $widgetValue the value to be parsed the widget
     * @return null
     */
    public function parseWidget($widgetName, $widgetValue){
        if(is_array(jsSession::getSessionParam('validate')) && key_exists($widgetName, jsSession::getSessionParam('validate'))){
            $errorMsg = jsSession::getSessionParamDefault($widgetName,'','validate');
            $this->_widgets[$widgetName]->onError($errorMsg[0]);
        }

        $this->_widgets[$widgetName] = $this->_widgets[$widgetName]->parseHtml(getParamDefault($widgetName, $widgetValue));
    }

    /**
     * Inits the web form using widgets of the page
     * @access protected
     * @return null
     */
    protected function initWebForm(){
        foreach($this->_dataFields as $dataField){
            $fieldKey = $dataField['type'];

            if( !isset($dataField['properties']) )
                $dataField['properties'] = array();

            if(!isset($dataField['displayName'])){
               
                $dataField['displayName'] = $dataField['name'];
            }
            
            $widget = WidgetFactory::getWidgetInstance($dataField['type'],
                                                         $dataField['name'], $dataField['properties']);

            $this->addWidget($dataField['displayName'], $widget);
        }

//        dump($this->_dataFields); 
    }

    /**
     * Creates and parses the form using page's widgets
     * @param array $data array with the data to be given to the widgets
     * @access public
     * @return null
     */
    public function parseWebForm($data = null){
        if(count($this->_widgets) > 0){
            foreach($this->_widgets as $widgetName=> $widget){
                $dataField['value'] = (isset($data[$widgetName]))?$data[$widgetName]:'';

                $this->parseWidget($widgetName, $dataField['value']);
                
                $this->_controller->setTemplateVariable(strtoupper($widgetName), $widget->getWidget());
            }
        }
    }

    /**
     * Gets assigned validators to the data fields
     * @access public
     * @return Validator[]
     */
    public function getValidators(){
        $validators = array();
        foreach($this->_dataFields as $dataField){
            if(isset($_POST[$dataField['name']])){
                if(isset($dataField['validator'])){
                   $validator = ValidatorFactory::getInstance($dataField['validator'],$_POST[$dataField['name']], $dataField['errorMsg']);
                   $validators[$dataField['name']] = $validator;
                }
            }
        }

        return $validators;
    }

    /**
     * Gets the value of the data field
     * @access protected
     * @param $field
     * @return mixed
     */
    protected function getDataValue($field){
        if(getParamDefault($field, null) != null){
            return getParam($field);
        }
        else{
            return null;
        }
    }

    /**
     * Create table with given from the domainObjects elements
     * @access public
     * @see UIWebTable
     * @see FiltersParser
     * @return UIWebTable
     */
    public function initTable(){
        $table = new UIWebTable();

        $FiltersParser = new FiltersParser(file_get_contents($this->getPageTemplate()));

        $this->_domainObject->assignFilters($FiltersParser->getFiltersSql());

        $rows = $this->_domainObject->getAllElements();
        
        $this->initTableRows($rows);

        $this->_pager = new Pager($rows);

        $table->assignData($this->_pager->setPageElements());
        $table->init($this->_domainObject->getDataFields());

        return $table;
    }

    /**
     * Inits a single row for the page table
     * @access public
     * @param array &$rows the rows in the table to be changed
     * @return null
     */
    public function initTableRows(&$rows){
        
    }

    /**
     * Constructs the page template destination using the page element of the URL given
     * @access public
     * @return string the full path to the template
     * @see PageTypes
     */
    public function getPageTemplate(){
        $showTypeParam = getParamDefault('page', '');

        $this->templateId = PageTypes::getPageType($showTypeParam);

        $templateSuffix = PageTypes::getTemplateSuffix($this->templateId);

        $template = $this->_templatesDestination.$this->_templatesBase . '/'.$this->_templatesBase . $templateSuffix . '.tpl';

        return $template;
    }

    /**
     * Contructs and parse the page to be shown
     * @access public
     * @param int $paramElementId The main page element of the page. Use for edit pages
     * @return null
     */
    public function showPage($paramElementId=0){
        $this->showHeader();
        try{
        $this->_controller->processValidators($this->getValidators());
        $this->_controller->dispatch();

        $this->getPageTemplate();
        
        switch($this->templateId){
            case PageTypes::PAGE_TYPE_CUSTOM:{
                $this->_controller->showTemplate($this->getPageTemplate());
                break;
            }
            case PageTypes::PAGE_TYPE_CHANGE:{
                if($paramElementId > 0){
                    $this->_controller->setTemplateVariable('PAGE_ELEMENT', $paramElementId);
                    $this->_controller->setTemplateVariable('MAIN_FORM_ACTION', '?page=edit&action=doEdit');
                    $this->createDomainObject();
                    $element = $this->getDomainObject()->getElement($paramElementId);
                    $this->initWebForm();
                    $this->parseWebForm($element);
                }
                
                $this->_controller->showTemplate($this->getPageTemplate());
                break;
            }
            case PageTypes::PAGE_TYPE_LIST:{
                $this->createDomainObject();
                $table = $this->initTable();

                $this->_controller->setTemplateVariable('PAGER', $this->_pager->getPagesVariable());
                $tableContents = $table->parse();
                $this->_controller->setTemplateVariable('FMT_TABLE_CONTENT', $tableContents);
                $this->_controller->showTemplate($this->getPageTemplate());
                break;
            }
            case PageTypes::PAGE_TYPE_VIEW:{
                $this->createDomainObject();
                $this->initWebForm();
                $this->parseWebForm();
                $this->_controller->setTemplateVariable('MAIN_FORM_ACTION', '?page=create&action=doCreate');

                $element = $this->getDomainObject()->getElement($paramElementId);
                
                if( $element !== false){
                    $this->_controller->setTemplateArray($element);
                }

//                echo $this->getPageTemplate();

                $this->_controller->showTemplate($this->getPageTemplate());
                break;
            }
            default:{
                return '';
            }
        }

        jsSession::removeParam('validate');

        } catch(Exception $e){
            $msg = $e->getMessage();
            Controller::redirect('error.php?msg='.urlencode($msg));
        }

        $this->showFooter();
    }

    /**
     * Shows the header of the page using skins header.tpl
     * @access protected
     * @return null
     */
    protected function showHeader(){
        $this->_controller->setTemplateVariable('SKINS_PATH', $this->_templatesDestination);
        $this->_controller->setTemplateVariable('USERNAME', jsUserAuth::getLoggedUserProperty('AdminUsername'));
        $this->_controller->showTemplate(MAIN_PATH . '/skin/admin/header.tpl');
        
    }

    /**
     * Shows the footer of the page using skins footer.tpl
     * @access protected
     * @return null
     */
    protected function showFooter(){
        $this->_controller->showTemplate(MAIN_PATH . '/skin/admin/footer.tpl');
    }
}

/**
 * PageAdministration
 *
 * The main administration page
 * @see PageAbstract
 */
class PageAdministration extends PageAbstract{
    protected $_templatesDestination = '../skin/admin/';
    protected $_templatesBase = '';

    /**
     * creates domain object instance of page
     * @see PageAbstract::createDomainObject()
     * @return null
     */
    public function createDomainObject() {
        $this->_domainObject =  new DefaultDomainObject();
    }
}

/**
 * Page
 *
 * The main site page
 * @see PageAbstract
 */
class Page extends PageAbstract{
    protected $_templatesDestination = 'skin/site/';
    protected $_templatesBase = '';

    /**
     * creates domain object instance of page
     * @see PageAbstract::createDomainObject()
     * @return null
     */
    public function createDomainObject() {
        $this->_domainObject =  new DefaultDomainObject();
    }

    protected function showHeader(){
       
        $this->_controller->showTemplate(MAIN_PATH . '/skin/site/header.tpl');
    }

    protected function showFooter(){
        $this->_controller->showTemplate(MAIN_PATH . '/skin/site/footer.tpl');
    }
}

class SitePage extends Page{
    public function  __construct() {
        parent::__construct();

        $recordset = new DBRecordset('Pages');
        $recordset->addWhereCondition('PageIsActive=1');

        $mainMenu = $recordset->getAllRecords();

        $iteration = new TemplateParserIteration('MAIN_MENU', $mainMenu);

        $userIdentity = new TemplateParserCondition(TemplateParserCondition::CONDITION_EQUALS, 'USER_IDENTITY');

        $userIdentity->setCondition(jsSiteUserAuth::isUserLogged(), true);

        try{
            $username = jsSiteUserAuth::getLoggedUserProperty('CustomerFirstName').' '.  jsSiteUserAuth::getLoggedUserProperty('CustomerLastName');
        } catch(Exception $e){
            $username = 'Guest';
        }

        $elements = array(
            'SITE_URL' => Paths::getPath(Paths::SITE_URL),
            'MAIN_MENU' => $iteration,
            'USER_IDENTITY' => $userIdentity,
            'USERNAME' => $username
        );

        $this->_controller->setTemplateVariable('PRODUCT_IMAGE_PATH', Paths::getPath(Paths::PRODUCTS_IMAGE_PATH));
        $this->_controller->setTemplateVariable('PRODUCT_LARGE_PATH', Paths::getPath(Paths::PRODUCTS_THICKBOX_IMAGE_PATH));
        $this->_controller->setTemplateVariable('PRODUCT_THUMB_PATH', Paths::getPath(Paths::PRODUCTS_THUMB_IMAGE_PATH));
        $this->assignMainPageElements($elements);
    }
}

class PageTypes{
    const PAGE_TYPE_VIEW = 0;
    const PAGE_TYPE_CHANGE = 1;
    const PAGE_TYPE_LIST = 2;
    const PAGE_TYPE_CUSTOM = 3;

    static protected  $pageTypesUrlParams = array(
         'create' => self::PAGE_TYPE_VIEW,
         'edit' => self::PAGE_TYPE_CHANGE,
         ''    =>     self::PAGE_TYPE_LIST,
         'dm'  =>   self::PAGE_TYPE_CUSTOM,
        'view' => self::PAGE_TYPE_VIEW
    );

    static protected  $pageTypesTemplateSuffix = array(
        self::PAGE_TYPE_CUSTOM => '',
        self::PAGE_TYPE_CHANGE => '_edit',
        self::PAGE_TYPE_LIST => '_list',
        self::PAGE_TYPE_VIEW => '_create'
    );

    static public function getPageType($pageTypesUrlParam){
        return self::$pageTypesUrlParams[$pageTypesUrlParam];
    }

    static public function getTemplateSuffix($templateId){
        return self::$pageTypesTemplateSuffix[$templateId];
    }
}
?>
