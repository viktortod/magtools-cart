<?php
require_once '../include/magtools/init.php';

class jsLoginActionAction extends Action{
    public function execute() {
        $username = getParam('username');
        $password = getParam('password');

        if(jsUserAuth::loginUser($username, $password)){
            Controller::redirect('index.php');
        }
        else{
            return false;
        }
        
    }
}

$controller = new Controller(new PageAdministration());
$controller->getDispatcher()->setActionHandler('login', 'jsLoginAction');
$template = ADMIN_THEME_DESTINATION.'/login.tpl';
$controller->dispatch();
$controller->showTemplate($template);
