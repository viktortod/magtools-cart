<?php
class jsUserAuth {
    const LOGIN_SESSION_PARAM = 'loggedUser';

    protected static $user = null;

    protected static function getLogginSessionParam()
    {
        return self::LOGIN_SESSION_PARAM;
    }

    public static function checkUserAuth()
    {
        if(!self::isUserLogged()){
            Controller::redirect('login.php');
        }
    }

    /**
     * @Fixme: Code unreuse!
     * @return boolean
     *
     */
    public static function isUserLogged()
    {
        $user = self::ValueOf();
        if(self::$user == null){
            if($user != null){
                self::$user = $user;

                return true;
            }

            return false;
        }


        return true;
    }

    protected static function ValueOf()
    {
        return jsSession::getSessionParamDefault(self::getLogginSessionParam(), null);
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

    protected static function getUserRecord($username)
    {
        $record = new DBRecord('Admins', 'AdminID');
        $record->readDBRow('AdminUsername', $username);

        return $record->getRecord();
    }

    public static function loginUser($username, $password)
    {
        $userInfo = self::getUserRecord($username);
        
        if(count($userInfo) == 0){
            return false;
        }

        if($userInfo['AdminPassword'] == $password && $userInfo['AdminIsActive'] == 1){
            jsSession::setParam(self::getLogginSessionParam(), $userInfo);

            return true;
        }
        else{
            return false;
        }
    }

    public static function logout()
    {
        jsSession::removeParam(self::getLogginSessionParam());
        self::checkUserAuth();
    }
}
?>
