<?php
    require_once '../include/magtools/init.php';

    jsUserAuth::checkUserAuth();

    class ThemeEditorPage extends PageAdministration{
         protected $_templatesBase = 'theme_editor';

         protected function showHeader() {
             $this->_controller->setTemplateVariable('SKINS_PATH', $this->_templatesDestination);
         }

         protected function initWebForm(){
             $textDecorationList = new ThemeEditorListSelect('theme_list', array());

             $options = array('none','uppercase','lowercase','capitalize');

             $textDecorationList->setOptions($options);
             $textDecorationList->setSettings('list_id__account_info__a', 'font-weight');

             $this->addWidget('TOP_NAV_TEXT_DECORATION', $textDecorationList);

             parent::initWebForm();
         }

         public function getPageTemplate(){
             $template = parent::getPageTemplate();
             $this->templateId = PageTypes::PAGE_TYPE_VIEW;

             $this->initWebForm();
             return $template;
         }
    }

    class ThemeEditorWidget extends Widget{
        protected $_selector = '';
        protected $_property = '';

        public function setSettings($selector, $property){
            $this->_selector = $selector;
            $this->_property = $property;
        }

        public function parseHtml($FieldValue) {
            parent::parseHtml($FieldValue);

            $this->_html = str_replace(array('<%selector%>','<%property%>'),
                                   array($this->_selector, $this->_property),
                                    $this->_html);
            
            return $this;
        }
    }

    class ThemeEditorSlider extends ThemeEditorWidget{
        protected $_html = '<span class="<%property%>"><%property%></span>
                                <div id="slider_<%selector%>" class="slider"></div>';
    }

    class ThemeEditorColorPicker extends ThemeEditorWidget{
        protected $_html = '<input type="text" name="<%property%>" id="color_<%selector%>" class="colorpick" />';
    }

    class ThemeEditorListSelect extends ThemeEditorWidget{
        protected $_options = '';
        protected $_html = '<span class="<%property%>"><%property%></span>
                        <ul id="list_<%selector%>" class="list">
                            <li>normal</li>
                            <li>bold</li>
                            <li>bolder</li>
                        </ul>';

        public function setOptions($options){
            $this->_options = '<li>'. join('</li><li>',$options) . '</li>';
        }

        public function parseHtml($FieldValue) {
            parent::parseHtml($FieldValue);

            $this->_html = str_replace(array('<%options%>'),
                                   array($this->_options),
                                    $this->_html);

            return $this;
        }
    }

    $page = new ThemeEditorPage();
    $page->showPage(0);

//    $iniFile = '../ini/theme_editor.ini';
//    dump(IniUtil::parse($iniFile, true));
?>
