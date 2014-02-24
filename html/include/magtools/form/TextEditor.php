<?php
class TextEditor extends Widget{
    public function  parseHtml($FieldValue) {
        $ckeditor = new CKEditor();
        $CKEditor->config['width'] = 200;
        $CKEditor->config['height'] = 400;
        $ckeditor->basePath = '../plugins/ckeditor/';
        $ckeditor->config['filebrowserBrowseUrl']      = '../plugins/kcfinder/browse.php?type=files';
        $ckeditor->config['filebrowserImageBrowseUrl'] = '../plugins/kcfinder/browse.php?type=images';
        $ckeditor->config['filebrowserFlashBrowseUrl'] = '../plugins/kcfinder/browse.php?type=flash';
        $ckeditor->config['filebrowserUploadUrl']      = '../plugins/kcfinder/upload.php?type=files';
        $ckeditor->config['filebrowserImageUploadUrl'] = '../plugins/kcfinder/upload.php?type=images';
        $ckeditor->config['filebrowserFlashUploadUrl'] = '../plugins/kcfinder/upload.php?type=flash';
        
        ob_start();
        $ckeditor->editor($this->_name, $FieldValue);

        $this->_html = ob_get_clean();

        return $this;
    }
}