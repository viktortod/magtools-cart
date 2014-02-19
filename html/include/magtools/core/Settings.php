<?php
class Settings {
    const SETTINGS_ADMIN_THEME = 'adminTheme';
    const SETTINGS_SITE_THEME = 'siteTheme';
    const SETTINGS_SITE_MAIN_UPLOAD_DIR = 'mainUploadDir';
    const SETTINGS_SHIPPING_COST = 'shippingCost';

    protected static $settingList = array();


    public static function getSettingsList(){
        if( count(self::$settingList) > 0){
            $recordset = new DBRecordset('Settings');
            $settings = $recordset->getAllRecords();
            foreach($settings as $setting){
                self::$settingList[$setting['SettingDevKey']] = $setting['SettingValue'];
            }
        }
        
        return self::$settingList;
    }

    public static function getSetting($settingDevName){
        $record = new DBRecord('Settings', 'SettingID');
        $record->readDBRow('SettingDevKey', $settingDevName);
        return $record->get('SettingValue');
    }
}
?>
