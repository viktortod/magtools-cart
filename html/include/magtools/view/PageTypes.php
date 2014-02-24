<?php
class PageTypes{
    const PAGE_TYPE_VIEW = 0;
    const PAGE_TYPE_CHANGE = 1;
    const PAGE_TYPE_LIST = 2;
    const PAGE_TYPE_CUSTOM = 3;

    static protected  $pageTypesUrlParams = array(
         'create' => self::PAGE_TYPE_VIEW,
         'edit' => self::PAGE_TYPE_CHANGE,
         ''    =>     self::PAGE_TYPE_LIST,
         'dm'  =>   self::PAGE_TYPE_CUSTOM,
        'view' => self::PAGE_TYPE_VIEW
    );

    static protected  $pageTypesTemplateSuffix = array(
        self::PAGE_TYPE_CUSTOM => '',
        self::PAGE_TYPE_CHANGE => '_edit',
        self::PAGE_TYPE_LIST => '_list',
        self::PAGE_TYPE_VIEW => '_create'
    );

    static public function getPageType($pageTypesUrlParam){
        return self::$pageTypesUrlParams[$pageTypesUrlParam];
    }

    static public function getTemplateSuffix($templateId){
        return self::$pageTypesTemplateSuffix[$templateId];
    }
}