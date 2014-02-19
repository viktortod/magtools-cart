<?php
require 'include/magtools/init.php';

jsSiteUserAuth::checkUserAuth();

class MessagesPage extends SitePage{
    protected $_templatesBase = 'messages';

    protected $_dataFields = array(
        array(
            'type' => 'InputHiddenField',
            'name' => 'CustomerID',
        ),
        array(
            'type' => 'InputTextField',
            'name' => 'CustomerEmail',
            'validator' => 'NotEmptyValidator',
            'errorMsg' => 'This field is mandatory'
        ),
        array(
            'type' => 'InputTextField',
            'name' => 'CustomerMessageTitle',
            'validator' => 'NotEmptyValidator',
            'errorMsg' => 'This field is mandatory'
        ),
        array(
            'type' => 'InputTextArea',
            'name' => 'CustomerMessageText',
            'validator' => 'NotEmptyValidator',
            'errorMsg' => 'This field is mandatory'
        ),
    );

    public function  createDomainObject() {
        $this->_domainObject = new Message();
    }

}

$layouts = array(
    'LeftColumnLayout'
);

$MessageId = getParamDefault('MessageID', 0);

$page = new MessagesPage();

$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->showPage($MessageId);
?>
