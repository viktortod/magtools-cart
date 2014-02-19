<?php
class Widget{
    protected $_name;
    protected $_html;
    protected $_properties;
    protected $_initValue = '';
    protected $_value = '';

    public function  __construct($name, $properties) {
        $this->_name = $name;
        $this->_properties = $properties;
    }

    protected function setValue($value){
        $this->_value = $value;
    }

    public function parseHtml($FieldValue){
        $propertiesList = '';
        $this->setValue($FieldValue);
        if( count($this->_properties) > 0){
            foreach($this->_properties as $key => $value){
                $propertiesList .= $key . '="' . $value .'"';
            }
        }
        $this->_html = str_replace(array('<%properties%>','<%name%>', '<%value%>'), 
                                   array($propertiesList,$this->_name, $FieldValue),
                                    $this->_html);

        return $this;
    }

    public function onError($error){
        if(!isset($this->_properties['class'])){
            $this->_properties['class'] = '';
        }

        $this->_properties['errorMsg'] = $error;

        $this->_properties['class'] .= ' error';
    }

    public function getWidgetValue(){
        return $this->_value;
    }

    public function show(){
        $content = $this->parseHtml($this->_value);

        echo $content->getWidget();
    }

    public function getWidget(){
        return $this->_html;
    }
}

class InputPasswordField extends Widget{
    protected $_html = '<input type="password" name="<%name%>" id="<%name%>" <%properties%> value="<%value%>" />';
}

class InputHiddenField extends Widget{
    protected $_html = '<input type="hidden" name="<%name%>" id="<%name%>" <%properties%> value="<%value%>" />';
}

class InputTextField extends Widget{
    protected $_html = '<input type="text" name="<%name%>" id="<%name%>" <%properties%> value="<%value%>" />';
}

class StaticTextField extends Widget{
    protected $_html = '<%value%>';
}

class InputFileField extends Widget{
    protected $_html = '<input type="file" name="<%name%>" id="<%name%>" <%properties%> value="<%value%>" />';
}

class InputTextArea extends Widget{
    protected $_html = '<textarea name="<%name%>" id="<%name%>" <%properties%>><%value%></textarea>';
}

class TextEditor extends Widget{
    public function  parseHtml($FieldValue) {
        $ckeditor = new CKEditor();
        $CKEditor->config['width'] = 200;
        $CKEditor->config['height'] = 400;
        $ckeditor->basePath = '../plugins/ckeditor/';
        $ckeditor->config['filebrowserBrowseUrl']      = '../plugins/kcfinder/browse.php?type=files';
        $ckeditor->config['filebrowserImageBrowseUrl'] = '../plugins/kcfinder/browse.php?type=images';
        $ckeditor->config['filebrowserFlashBrowseUrl'] = '../plugins/kcfinder/browse.php?type=flash';
        $ckeditor->config['filebrowserUploadUrl']      = '../plugins/kcfinder/upload.php?type=files';
        $ckeditor->config['filebrowserImageUploadUrl'] = '../plugins/kcfinder/upload.php?type=images';
        $ckeditor->config['filebrowserFlashUploadUrl'] = '../plugins/kcfinder/upload.php?type=flash';
        
        ob_start();
        $ckeditor->editor($this->_name, $FieldValue);

        $this->_html = ob_get_clean();

        return $this;
    }
}

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

class YesNoWidget extends Widget {
    protected $_html = '<br />
                <label class="yes_label" for="<%name%>_1"></label>
                <label class="no_label" for="<%name%>_0"></label> <br /><br />
                <input class="yes_no_radio" <%selected_yes%> type="radio"  name="<%name%>" id="<%name%>_1" value="1">
                
                <input class="yes_no_radio" <%selected_no%> type="radio"  name="<%name%>" id="<%name%>_0" value="0">';

    public function  parseHtml($FieldValue) {
        $replace = array('<%selected_yes%>', '<%selected_no%>');
        if($FieldValue == 1) {
            $replacements = array('checked', '');
        }
        else{
            $replacements = array('', 'checked');
        }

        $this->_html = str_replace($replace, $replacements, $this->_html);

        return parent::parseHtml($FieldValue);
    }
}

class SelectBox extends Widget{
    private $_options = array();
    protected $_html = '<select name="<%name%>" id="<%name%>" <%properties%>><%options%></select>';

    public function setOptions($values){
        $this->_options = $values;
    }

    public function  parseHtml($FieldValue) {
        parent::parseHtml("");

        $optionsHtml = '';

        foreach($this->_options as $optionKey => $optionValue){
            if($FieldValue == $optionKey){
                $optionsHtml .= '<option value="'.$optionKey.'" selected="selected">'.$optionValue.'</option>';
            }
            else{
                $optionsHtml .= '<option value="'.$optionKey.'">'.$optionValue.'</option>';
            }
            
        }
        
        $this->_html = str_replace('<%options%>', $optionsHtml, $this->_html);

        return $this;
    }
}

class WidgetFactory{
    public static function getWidgetInstance($type, $name, $properties){
        if(class_exists($type)){
            return new $type($name, $properties);
        }
    }
}
?>
