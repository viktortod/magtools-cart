<?php
require 'include/magtools/init.php';

class ProductsPage extends SitePage{
    protected $_templatesBase = 'products';
}

class ShowProductAction extends Action{
    public function execute() {
        $productId = getParamDefault('ProductID', 0);

        $productObject = new Product();
        $product = $productObject->getElement($productId);

        foreach($product as $field => $value){
            $this->getController()->setTemplateVariable($field, $value);
        }

        $images = $productObject->getProductImages($productId);
        $templateIteration = new TemplateParserIteration('images', $images);
        $this->getController()->setTemplateVariable('images',$templateIteration);

        return $this->getController();
    }
}

$layouts = array(
    'LeftColumnLayout'
);

$page = new ProductsPage();
$page->getController()->setLayoutArray($layouts);
$page->getController()->dispatchLayouts();
$page->getController()->getDispatcher()->setActionHandler("", 'ShowProduct');
$page->showPage();
?>
