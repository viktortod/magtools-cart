<?php
class Paths {
    const CATEGORIES_IMAGE_PATH = 0;
    const CATEGORIES_THUMBS_IMAGE_PATH = 1;

    const PRODUCTS_IMAGE_PATH = 2;
    const PRODUCTS_ORIGINAL_IMAGE_PATH = 3;
    const PRODUCTS_THUMB_IMAGE_PATH = 4;
    const PRODUCTS_THICKBOX_IMAGE_PATH = 5;

    const SITE_URL = 6;

    private static $_paths = array(
        self::CATEGORIES_IMAGE_PATH => 'categories/big/',
        self::CATEGORIES_THUMBS_IMAGE_PATH => 'categories/thumbs/',

        self::PRODUCTS_IMAGE_PATH => 'images/products/productimage/',
        self::PRODUCTS_ORIGINAL_IMAGE_PATH => 'images/products/original/',
        self::PRODUCTS_THUMB_IMAGE_PATH => 'images/products/thumbs/',
        self::PRODUCTS_THICKBOX_IMAGE_PATH => 'images/products/thickbox/',
        self::PRODUCTS_THICKBOX_IMAGE_PATH => 'images/products/thickbox/',
    );

    public static function getPath($path) {
        if(strpos($_SERVER['REQUEST_URI'],'.php')){
            $_SERVER['REQUEST_URI'] = dirname($_SERVER['REQUEST_URI']);
        }

        self::$_paths[self::SITE_URL] = 'http://' .$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'].'/';
 //       dump(self::$_paths[self::SITE_URL]); exit();
        return self::$_paths[$path];
    }
}
?>
