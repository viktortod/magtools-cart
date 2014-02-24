<?php
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