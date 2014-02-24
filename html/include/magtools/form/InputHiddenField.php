<?php
class InputHiddenField extends Widget{
    protected $_html = '<input type="hidden" name="<%name%>" id="<%name%>" <%properties%> value="<%value%>" />';
}