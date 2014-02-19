<?php
class ValidationException extends Exception{
    const INVALID_FIELD_EXCEPTION = 0;
    const INVALID_DATA_TYPE_EXCEPTION = 1;
}

class MagtoolsException extends Exception{
    const AUTOLOAD_EXCEPTION = 0;
    const NOT_FOUND_ELEMENT_EXCEPTION = 2;
}
?>
