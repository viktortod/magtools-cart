<?php
    require_once '../include/magtools/init.php';

    jsUserAuth::checkUserAuth();

    class IndexPage extends PageAdministration{
        protected $_templatesBase = 'index';
    }

    $page = new IndexPage();
    $page->showPage(NULL);
    
?>
