<?php
    require_once '../include/magtools/init.php';

    jsUserAuth::checkUserAuth();

    class CmsPagesPage extends PageAdministration{
        protected $_templatesBase = 'pages';

        protected $_dataFields = array(
            array(
                'type' => 'InputTextField',
                'name' => 'PageTitle',
                'validator' => 'NotEmptyValidator',
                'errorMsg' => 'This field is mandatory'
            ),
            array(
                'type' => 'TextEditor',
                'name' => 'PageContent',
                'validator' => 'NotEmptyValidator',
                'errorMsg' => 'This field is mandatory'
            ),
        );

        public function  initTableRows(&$rows) {
            foreach ($rows as $rowId =>$row){
                if($row['PageIsActive'] == 1){
                    $rows[$rowId]['PageIsActive'] = 'Да';
                }
                else{
                    $rows[$rowId]['PageIsActive'] = 'Не';
                }
            }
        }
    }

    class CmsPageDeleteAction extends osExecDeleteAction{
        public function prepare(){
            $this->_tableName = 'Pages';
            $this->_editPK = 'PageID';
        }
    }

    $page = new CmsPagesPage();
    $page->getController()->getDispatcher()->setActionHandler('doDelete', 'CmsPageDelete');
    $page->showPage(getParamDefault('PageID', '0'));
?>
