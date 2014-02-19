<?php
class ValidatorFactory {
    public static function getInstance($validatorClass, $data, $errorMsg){
        if(class_exists($validatorClass)){
            $validator = new $validatorClass($data, $errorMsg);
            if($validator instanceof Validator){
                return $validator;
            }
            else{
                throw new Exception($validatorClass.' is not a Validator');
            }
        }
        else{
            throw new Exception('Invalid validator: '. $validatorClass);
        }
    }
}
?>
