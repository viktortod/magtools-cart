<?php

class ValidatorError {
    public static function init($errors){
        $_SESSION['VALIDATION']['errors'] = $errors;
    }

    public static function getErrors(){
        $errors = $_SESSION['VALIDATION']['errors'];
        unset($_SESSION['VALIDATION']['errors']);
        return $errors;
    }
}
?>
