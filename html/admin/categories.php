<?php
    require_once '../include/magtools/init.php';

    jsUserAuth::checkUserAuth();

    class CategoriesPage extends PageAdministration{
        protected $_templatesBase = 'categories';

        protected $_dataFields = array(
            array(
                'type' => 'InputTextField',
                'name' => 'CategoryName'
            ),
            array(
                'type' => 'TextEditor',
                'name' => 'CategoryDescription'
            ),
            array(
                'type' => 'InputFileField',
                'name' => 'CategoryImage'
            ),
            array(
                'type' => 'YesNoWidget',
                'name' => 'CategoryIsActive'
            ),
            array(
                'type' => 'SelectBox',
                'name' => 'CategoryParentID'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CategoryImage',
                'displayName' => 'HTML_CategoryImage'
            )
        );

        public function  createDomainObject() {
            $this->_domainObject = new Category('Categories');
        }
        
        protected function initWebForm($data = null) {
            parent::initWebForm($data);
            $list = $this->_domainObject->getElementsList();
            
            try {
            	$categoryId = getParam('CategoryID');
            	unset($list[$categoryId]);
            } catch (Exception $e){
            	
            }
            
            $this->getWidget('HTML_CategoryImage')->setTextContent("blqblqblq");
            
            $this->getWidget('CategoryParentID')->setOptions(array('0' => '--- Choose ---') + $list);
        }
    }

    class CategoryInsertAction extends osExecInsertAction{
        public function  prepare() {
            parent::prepare();

            if(!UploadUtil::isUploadedFile("CategoryImage")){
            	return null;	
            }
            
            $_FILES = UploadUtil::prepareFilesStack($_FILES);
            $prefix = time();
            $image = UploadUtil::uploadFile(FileType::FILE_TYPE_IMAGE, $_FILES['CategoryImage'], $prefix, 'images/categories/big');

            $thumbImage = ImageUtil::processThumbnailing($image, $image.'_thumb', array(
                'width' => 615,
                'height' => 310
            ), 'categories/thumbs/');


            $this->_dataMapper->setRequestParam('CategoryImage',$thumbImage);
        }
    }

    class CategoryUpdateAction extends osExecUpdateAction{
        public function  prepare() {
            parent::prepare();
            
            $_FILES = UploadUtil::prepareFilesStack($_FILES);
            if($_FILES['CategoryImage']['error'] != 4){
                $prefix = time();
                $image = UploadUtil::uploadFile(FileType::FILE_TYPE_IMAGE, $_FILES['CategoryImage'], $prefix, 'images/categories/big');
                $thumbImage = ImageUtil::processThumbnailing($image, $image.'_thumb', array(
                    'width' => 615,
                    'height' => 310
                ), 'images/categories/thumbs/');

                $this->_dataMapper->setRequestParam('CategoryImage',$thumbImage);
            }
        }

        public function  postExecute() {
            parent::postExecute();
        }
    }

    class CategoryDeleteAction extends osExecDeleteAction{
        public function prepare(){
            $this->_tableName = 'Categories';
            $this->_editPK = 'CategoryID';
        }
    }

    $page = new CategoriesPage();
    $page->getController()->getDispatcher()->setActionHandler('doEdit', 'CategoryUpdate');
    $page->getController()->getDispatcher()->setActionHandler('doCreate', 'CategoryInsert');
    $page->getController()->getDispatcher()->setActionHandler('doDelete', 'CategoryDelete');
    $page->showPage(getParamDefault('CategoryID', '0'));
?>
