<?php
class TableCommand {
    const TABLE_COMMAND_EDIT_ACTION = 0;
    const TABLE_COMMAND_DELETE_ACTION = 1;

    protected static $actionsHtml = array(
        self::TABLE_COMMAND_EDIT_ACTION => array(
            'link' => '?page=edit&<%DATA_PKFIELD%>=<%DataID%>',
            'icon' => '../themes/<%THEMES_DESTINATION%>/img/edit-icon.gif'
        ),
        self::TABLE_COMMAND_DELETE_ACTION => array(
            'link' => '?action=doDelete&<%DATA_PKFIELD%>=<%DataID%>',
            'icon' => '../themes/<%THEMES_DESTINATION%>/img/hr.gif'
        ),
    );

    public static function getActionHtml($actionId){
        if(isset(self::$actionsHtml[$actionId]['icon'])){
            self::$actionsHtml[$actionId]['icon'] = str_replace('<%THEMES_DESTINATION%>',
                                                                 ADMIN_THEME_DESTINATION,
                                                                 self::$actionsHtml[$actionId]['icon']);
        }

        return self::constructActionHtml(self::$actionsHtml[$actionId]);
    }

    protected static function constructActionHtml($element){
        $html = '<a href="' . $element['link'] . '"><img src="'.$element['icon'].'" alt="?"></a>';

        return $html;
    }
}
?>
