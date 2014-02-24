<?php
class Form {
    protected $_widgets;
    protected $_content;
    protected $_fields;

    /**
     * Adds widget to the form
     * @param Widget $widget
     */
    public function addWidget($widget){
        $this->_widgets[] = $widget;
    }

    /**
     * Form constructor.
     * @param array $fields
     */
    public function  __construct($fields) {
        $this->_content = '';
        foreach($fields as $name => $field){
            $this->_content .= $this->getParsedWidget($name, $field);
        }
    }

    /**
     * Gets the parsed widget content.
     * @access protected
     * @param string $name
     * @param array $field
     * @return string
     */
    protected function getParsedWidget($name,array $field) {
            $type = $field['type'];
            $properties = $field['properties'];
            $widget = WidgetFactory::getWidgetInstance($type, $name, $properties);
            $widget->parseHtml();
            return $widget->getWidgetHtml();
    }

    /**
     * Gets the Content of the form
     * @return string
     */
    public function getContent(){
        return $this->_content;
    }
}
?>
