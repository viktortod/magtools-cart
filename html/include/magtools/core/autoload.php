<?php
function __autoload($class){
    Loader::singleton()->loadClass($class);
}

function dump($mixed){
    echo '<pre>';
    var_dump($mixed);
    echo '</pre><br />';
    echo '<b>Dumped backtrace:<br /></b>';
    debug_print_backtrace();
}
?>
