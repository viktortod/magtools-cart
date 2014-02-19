<?php
require 'include/magtools/init.php';

class CategoriesPage extends SitePage{
    protected $_templatesBase = 'categories';
}

class ShowCategoryProductsAction extends ShowProductsAction{
    public function execute(){
        $category = new Category();
        $category = $category->getElement($this->_data['id']);

        foreach($category as $field => $value){
            $this->getController()->setTemplateVariable($field, $value);
        }

        return parent::execute();
    }
}

$layouts = array(
    'LeftColumnLayout'
);

$page = new CategoriesPage();
$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->getController()->getDispatcher()->setActionHandler("", 'ShowCategoryProducts');
$page->showPage();
?>
