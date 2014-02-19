<?php
class Filter {
    const FILTER_SESSION_PARAM = 'filters';

    protected $_field;
    protected $_condition;
    protected $_value = null;
    protected $_widget = null;

    public function  __construct($field) {
        $this->_field = $field;
        $this->_condition = '=';

        $this->_widget = WidgetFactory::getWidgetInstance('InputTextField', $field, array());
    }

    public function commit(){
        $sessionKey = basename($_SERVER['REQUEST_URI']);

        jsSession::setParam($this->_field, $this->_value,Filter::FILTER_SESSION_PARAM);
    }

    public function setValue($value){
        $this->_value = $value;
    }

    public function getValue(){
        if($this->_value != null){
            return $this->_value;
        }

        
        $posted = getParamDefault($this->_field, '');
        
        if(!empty($posted)){
            $this->setValue($posted);
            $this->commit();

            return $this->_value;
        }
        else{
            $this->_value = jsSession::getSessionParamDefault($this->_field, '',Filter::FILTER_SESSION_PARAM);
        }

        return $this->_value;
    }

    public function getHtml($value){
        return $this->_widget->parseHtml($value);
    }

    public function getSql(){
        if($this->getValue() == ''){
            return '';
        }
        else{
            return $this->_field.$this->_condition.'\''.$this->getValue().'\'';
        }
    }
}

class DateFilter extends Filter{
    public function getSql() {
        if($this->getValue() == ''){
            return '';
        }
        else{
            $value = strtotime($this->getValue());
            return $this->_field.$this->_condition.$value;
        }
    }
}

class FilterFactory{
    public static function get($filterClass, $field)
    {
        $filter = new $filterClass($field);

        if($filter instanceof Filter){
            return $filter;
        }
        else{
            throw new Exception("Class ".$filterClass. " is not a Filter");
        }
    }
}

class FiltersParser{
    private $parser;

    public function  __construct($parser) {
            $this->parser = $parser;
    }

    public function parseFilters(){
        $formated = $this->getTemplateFilters();
        $template = $this->parser->getContent();
        foreach($formated as $field => $condition){
            $parts = explode('_',$condition);
            switch($parts[0]){
                case '<':
                case '>':
                case '=':
                        $filter = FilterFactory::get('Filter', 'FILTER_'.$field);
                        $widget = $filter->getHtml($filter->getValue())->getWidget();
                    break;
                default:
                        $widget = '';
                    break;
            }

            $template = str_replace($parts[1], $widget, $template);
        }

        return $template;
    }

    public function getContent(){
        if($this->parser instanceof  TemplateParser){
            return $this->parser->getContent();
        }
        else{
            return $this->parser;
        }
    }

    public function getTemplateFilters(){
        $templateContent = $this->getContent();
        $filters = array();
        $pattern = '/<%FILTER NAME="([A-Z0-9]+)" CONDITION=\"([a-zA-Z0-9\_\=\>\<]+)\" %>/i';
        preg_match_all($pattern, $templateContent, $filters);

        $formated = array();
        if(count($filters) > 0){
            foreach($filters[1] as $key => $filterField){
                $formated[$filterField] = $filters[2][$key].'_'.$filters[0][$key];
            }
        }

        return $formated;
    }

    public function getFiltersSql(){
        $formated = $this->getTemplateFilters();

        $sql = array();

        foreach($formated as $field => $condition){
            $parts = explode('_',$condition);

            $filter = FilterFactory::get('Filter', 'FILTER_'.$field);
            $sql[] = str_replace("FILTER_", "", $filter->getSql());
        }

        return $sql;
    }
}

?>
