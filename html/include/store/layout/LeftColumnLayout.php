<?php
class LeftColumnLayout extends UILayout{
    public function  __construct() {
        $this->registerBlock('CategoriesBlock');
        $this->registerBlock('CartBlock');
        $this->registerBlock('ProfileBlock');
    }
}
?>
