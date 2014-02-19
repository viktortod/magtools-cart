<?php
    require_once '../include/magtools/init.php';

    jsUserAuth::checkUserAuth();

    $content = '<:text test:> is translated text.  <:text test:> is pattern test.';
    $test = new TemplateParserTranslate($content);
    dump($test->parse());
?>
