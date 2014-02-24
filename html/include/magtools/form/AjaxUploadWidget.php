<?php
class AjaxUploadWidget extends Widget{
    protected $_template = '../design/ajaxUploader.php';
    public function  parseHtml($FieldValue) {
        $templateParser = new TemplateParser($this->_template);
        $templateParser->setTempalateVariables(
                array(
                    'NAME' => $this->_name,
                    'VALUE' => $FieldValue
                )
        );

        $templateParser->parseTemplate();
        $this->_html = $templateParser->getContent();

        return $this;
    }
}