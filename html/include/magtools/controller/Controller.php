<?php
class Controller {
    protected $templates;

    protected $dispatcher;

    protected $layouts;

    protected $templateSet;

    protected $templateIterations = array();

    protected $templateConditions = array();

    protected $page;

    protected $dataMapper;

    public function  __construct(PageAbstract $page) {
        $this->dispatcher = new ActionDispatcher();
        $this->setTemplateVariable('ADMIN_SKIN_PATH', ADMIN_THEME_DESTINATION);
        $this->setTemplateVariable('SITE_SKIN_PATH', SITE_THEME_DESTINATION);
        $this->setPage($page);
        $this->setDataMapper(new DataMapUtil($page, $_POST));
    }
    /**
     * returns the dispatcher instance
     * @return ActionDispatcher
     */
    public function getDispatcher(){
        return $this->dispatcher;
    }

    public function setDataMapper(DataMapUtil $dataMapper){
        $this->dataMapper = $dataMapper;

        $this->dataMapper->setValidatorsArray($this->page->getValidators());
    }

    public function setPage(PageAbstract $page){
        $this->page = $page;
    }

    public function getPage(){
        return $this->page;
    }

    public function registerLayout($layoutName){
        $this->layouts[] = $layoutName;
    }

    public function processValidators($validators){
        $isOk = true;
//        dump($validators);
        foreach($validators as $fieldName => $validator){
            if(!$validator->validate()){
                jsSession::addParam($fieldName, $validator->getErrorMsg(), 'validate');
                $isOk = false;
            }
        }
//        dump($isOk); exit();
        return $isOk;
    }

    public function setLayoutArray($layouts){
        $this->layouts = $layouts;
    }

    public function dispatchLayouts(){
        foreach($this->layouts as $layout){
            $layoutObj = LayoutFactory::getLayout($layout);
            $templateContent = $layoutObj->dispatch();
            $templateName = strtoupper(get_class($layoutObj));
            $this->setTemplateVariable($templateName, $templateContent);
        }
    }

    public function setTemplateVariable($name, $value){
        if($value instanceof TemplateParserIteration){
            $this->templateIterations[] = $value;
        }
        elseif($value instanceof TemplateParserCondition){
            $this->templateConditions[] = $value;
        }
        else{
            $this->templateSet[$name] = $value;
        }
    }

    public function setTemplateArray($array){
        if(count($array) > 0){
            foreach($array as $name => $value){
                $this->setTemplateVariable($name, $value);
            }
        }
    }

    /**
     * calls the dispatch method of the dispatcher
     */
    public function dispatch(){
        $action = getParamDefault('action', '');

        $actionResult = $this->dispatcher->dispatch($action, $this->dataMapper);
//        dump($actionResult);
//        if($actionResult === false){
//            $this->setTemplateArray(array(
//                'MSG' => 'Invalid Data',
//            ) + jsSession::getSessionParam('send'));
//        }
//        elseif($actionResult instanceof Controller){
//            $this->templateConditions = $actionResult->templateConditions;
//            $this->templateIterations = $actionResult->templateIterations;
//            $this->templateSet = $actionResult->templateSet;
//        }
    }

    public function showTemplate($template){
        $templateParser = new TemplateParser($template);

        $filterParser = new FiltersParser($templateParser);
        $templateParser->setContent($filterParser->parseFilters());


        if(count($this->templateConditions) > 0){
            
            foreach($this->templateConditions as $templateCondition){
                $templateParser->setCondition($templateCondition);
            }
        }

        if(count($this->templateIterations) > 0){
//            echo $template;
//            dump($this->templateIterations); exit();
            foreach($this->templateIterations as $templateIteration){
                $templateParser->setIteration($templateIteration);
            }
        }

        
        $templateParser->setTempalateVariables($this->templateSet);
        $templateParser->parseTemplate();
        $templateParser->showTemplate();
    }

    /**
     * Perform a redirection to the given url address
     * @param string $url the url destination
     */
    public static function redirect($url){
        header('Location: '.$url);
        exit();
    }
}
?>