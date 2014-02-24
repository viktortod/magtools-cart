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
        
        protected function initBreadCrumb(){
        	$this->_breadCrumb->add("index.php",'Home');
        	$this->_breadCrumb->add("pages.php",'Pages');
        }

//        public function  initTableRows(&$rows) {
//            foreach ($rows as $rowId =>$row){
//                if($row['PageIsActive'] == 1){
//                    $rows[$rowId]['PageIsActive'] = 'Yes';
//                }
//                else{
//                    $rows[$rowId]['PageIsActive'] = 'No';
//                }
//            }
//        }
    }

    class CmsPageDeleteAction extends osExecDeleteAction{
        public function prepare(){
            $this->_tableName = 'Pages';
            $this->_editPK = 'PageID';
        }
    }
    
//    MessageUtil::setMessage(MessageUtil::MESSAGE_TYPE_ERROR, 'test');

    $page = new CmsPagesPage();
    $page->getController()->getDispatcher()->setActionHandler('doDelete', 'CmsPageDelete');
    $page->showPage(getParamDefault('PageID', '0'));
?>
