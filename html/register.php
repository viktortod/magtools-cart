<?php
require 'include/magtools/init.php';


class RegisterPage extends SitePage{
    protected $_templatesBase = 'register';

    protected $_dataFields = array(
        array(
            'type' => 'InputTextField',
            'name' => 'CustomerFirstName',
            'validator' => 'NotEmptyValidator',
            'errorMsg' => 'This field is mandatory'
        ),
        array(
            'type' => 'InputTextField',
            'name' => 'CustomerLastName',
            'validator' => 'NotEmptyValidator',
            'errorMsg' => 'This field is mandatory'
        ),
        array(
            'type' => 'InputTextField',
            'name' => 'CustomerEmail',
            'validator' => 'EmailValidator',
            'errorMsg' => 'Invalid email'
        ),
        array(
            'type' => 'InputPasswordField',
            'name' => 'CustomerPassword',
            'validator' => 'NotEmptyValidator',
            'errorMsg' => 'Please enter valid password'
        ),
        array(
            'type' => 'InputPasswordField',
            'name' => 'CustomerConfirmPassword',
            'validator' => 'ConfirmPasswordValidator',
            'errorMsg' => 'Passwords don\'t match'
        ),
        array(
            'type' => 'InputTextField',
            'name' => 'CustomerPhone',
            'validator' => 'PhoneValidator',
            'errorMsg' => 'Pleace enter valid cell phone'
        ),
        array(
            'type' => 'CustomerAddressWidget',
            'name' => 'ADDRESS'
        ),
        array(
            'type' => 'InputTextField',
            'name' => 'CustomerCompany',
        ),
        array(
            'type' => 'InputTextField',
            'name' => 'CustomerUIC',
        ),
        array(
            'type' => 'InputTextField',
            'name' => 'CustomerVAT',
        ),
    );

    public function createDomainObject() {
        $this->_domainObject =  new Customer();
    }
}

class ConfirmPasswordValidator extends Validator{
    public function validate() {
        if(getParam('page') == 'create'){
            return ($this->data == getParam('CustomerPassword'));
        }
        else{
            return true;
        }
    }
}

class doEditProfileAction extends osExecUpdateAction{
    public function execute(){
        parent::execute();

        $customerAddress = getParam('CustomerAddress');

        if(count($customerAddress) > 0){
            foreach($customerAddress as $addressId => $address){
                $record = new DBRecord('CustomerAddress', 'CustomerAddressID');
                
                if($addressId == 0){
                    if($address != ''){
                        $record->set('CustomerID', jsSiteUserAuth::getLoggedUserProperty('CustomerID'));
                        $record->set('CustomerAddress', $address);

                        if(getParam('CustomerDefault') == 0){
                            $record->set('CustomerAddressIsDefault', 1);
                        }

                        $record->insert();
                    }

                    continue;
                }

                
                $record->readDBRow('CustomerAddressID', $addressId);
                $row = array();
                $record->set('CustomerAddress', $address);

                if(getParam('CustomerDefault') == $addressId){
                        $record->set('CustomerAddressIsDefault', 1);
                    }

                $record->update();
            }
        }
        
    }

    public function postExecute() {
        $this->getController()->redirect($_SERVER['HTTP_REFERER']);
    }
}

class checkRegistrationAction extends Action{
    public function execute() {
        $username = getParamDefault('CustomerEmail', null);

        if($username == null){
            $this->getController()->redirect('index.php');
        }

        $userExists = jsSiteUserAuth::isUserExists($username);
        if($userExists){
            $this->getController()->setTemplateVariable('REGISTER_MSG', 'Cannot register with this email');
            $this->getController()->setTemplateVariable('REGISTER_MSG_TYPE', 'Error');
        }
    }
}

$layouts = array(
    'LeftColumnLayout'
);

$CustomerID = getParamDefault('CustomerID', 0);

if($CustomerID == 0){
    setParamValue('page', 'create');
}

$page = new RegisterPage();
//$page->getPageTemplate();
$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->getController()->getDispatcher()->setActionHandler("doEdit", 'doEditProfile');
$page->getController()->getDispatcher()->setActionHandler("checkRegistration", 'checkRegistration');
$page->getController()->getDispatcher()->setActionHandler("doLogout", 'doLogout');
$page->showPage($CustomerID);
?>
