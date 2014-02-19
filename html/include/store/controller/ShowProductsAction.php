<?php
class ShowProductsAction extends Action{
    public function prepare(){
        $this->_data['id'] = getParamDefault('CategoryID', null);
    }

    public function  execute() {
        $products = new Product();

        $iteration  = new TemplateParserIteration('products', $products->getActiveElements($this->_data['id']));
        $this->getController()->setTemplateVariable('products',$iteration);

        return $this->getController();
    }
}?>
