<?php
require 'include/magtools/init.php';


class LoginPage extends SitePage{
    protected $_templatesBase = 'login';
}

class doLoginAction extends Action{
    public function execute() {
        try{
            $username = getParam('CustomerEmail');
            $password = getParam('CustomerPassword');

            if(jsSiteUserAuth::loginUser($username, $password)){
                $this->getController()->redirect('index.php');
            }
            else{
                $this->getController()->setTemplateVariable('LOGIN_MSG','Incorect username/password with: username='.$username.' and password='.$password);
                $this->getController()->setTemplateVariable('CustomerEmail', $username);
            }
        }
        catch(Exception $e){

            $this->getController()->setTemplateVariable('LOGIN_MSG','Incorect username/password');
        }
    }
}

class doLogoutAction extends Action{
    public function  execute() {
        jsSiteUserAuth::logout();

        $this->getController()->redirect('index.php');
    }
}

$layouts = array(
    'LeftColumnLayout'
);

$page = new LoginPage();
$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->getController()->getDispatcher()->setActionHandler("doLogin", 'doLogin');
$page->getController()->getDispatcher()->setActionHandler("doLogout", 'doLogout');
$page->showPage();
?>
