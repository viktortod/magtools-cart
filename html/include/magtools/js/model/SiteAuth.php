<?php
class jsSiteUserAuth extends jsUserAuth{
    const LOGIN_USER_SESSION_PARAM = 'siteLoggedUser';

    protected static function getLogginSessionParam()
    {
        return self::LOGIN_USER_SESSION_PARAM;
    }

    public static function logout()
    {
        jsSession::removeParam(self::getLogginSessionParam());
        self::checkUserAuth();
    }

    public static function checkUserAuth()
    {
        if(!self::isUserLogged()){
            Controller::redirect('login.php');
        }
    }

    public static function isUserLogged()
    {
        $user = jsSession::getSessionParamDefault(self::getLogginSessionParam(), null);
        if(self::$user == null){
            if($user != null){
                self::$user = $user;

                return true;
            }

            return false;
        }

        return true;
    }

    public static function getLoggedUserProperty($propertyName){
        $userInfo = jsSession::getSessionParam(self::getLogginSessionParam());
//        dump($userInfo);
        if(isset($userInfo[$propertyName])){
            return $userInfo[$propertyName];
        }
        else{
            throw new Exception('User property '.$propertyName. ' not found');
        }
    }

    protected static function getUserRecord($username) {
        $record = new DBRecord('Customers', 'CustomerID');

        $record->readDBRow('CustomerEmail', $username);

        return $record->getRecord();
    }

    public static function isUserExists($username){
        $userInfo = self::getUserRecord($username);
        
        if(!isset($userInfo['CustomerEmail'])){
            return false;
        }

        return true;
    }

    public static function loginUser($username, $password)
    {
        $userInfo = self::getUserRecord($username);

        if(count($userInfo) == 0){
            return false;
        }
        
        if($userInfo['CustomerPassword'] == $password && $userInfo['CustomerIsActive'] == 1){
            jsSession::setParam(self::getLogginSessionParam(), $userInfo);

            return true;
        }
        else{
            return false;
        }
    }
}
?>
