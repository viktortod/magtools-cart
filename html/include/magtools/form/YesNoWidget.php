<?php
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