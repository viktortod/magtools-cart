<?php
class UIUtil {
    public static function prepareVariables ($variables) {
        $fmtVariables = array();
        foreach($variables as $key => $variable) {
            $fmtVariables[mb_convert_case($key, MB_CASE_UPPER)] = $variable;
        }

        return $fmtVariables;
    }
}
?>
