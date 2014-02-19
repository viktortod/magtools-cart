<?php
    require_once '../include/magtools/init.php';

    jsUserAuth::checkUserAuth();

    class ProductsPage extends PageAdministration{
        protected $_templatesBase = 'products';

        protected $_dataFields = array(
            array(
                'type' => 'InputTextField',
                'name' => 'ProductName'
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'ProductCode'
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'ProductRefererCode'
            ),
            array(
                'type' => 'InputTextField',
                'name' => 'ProductGlobalPrice'
            ),
            array(
                'type' => 'YesNoWidget',
                'name' => 'ProductIsActive'
            ),
            array(
                'type' => 'TextEditor',
                'name' => 'ProductShortDescription'
            ),
            array(
                'type' => 'TextEditor',
                'name' => 'ProductDetailedDescription'
            ),
            array(
                'type' => 'TextEditor',
                'name' => 'ProductAdditionalDescription'
            ),
            array(
                'type' => 'ProductCategoriesWidget',
                'name' => 'ProductCategoriesWidget'
            ),
            array(
                'type' => 'ProductImagesWidget',
                'name' => 'ProductImagesWidget'
            ),
        );

        public function  createDomainObject() {
            $this->_domainObject = new Product();
        }
    }

    class ProductCategoriesWidget extends Widget{
        protected $template = '../skin/admin/products/product_categories_widget.tpl';
        
        public function parseHtml($FieldValue) {
            $productId = getParamDefault('ProductID', 0);
            
            if($productId > 0){
                $recordset = new DBRecordset('Products_Categories');
                $recordset->addJoinCondition('CategoriesML', 'USING(CategoryID)');
                $recordset->addWhereCondition('ProductID='.$productId);


                $recordset->read();
                $productCategories = $recordset->getAllRecords();

                $templateParser = new TemplateParser($this->template);

                $templateParser->setIteration($this->getCategoriesIteration($productId));
                $templateParser->setIteration($this->getResultsetIteration($productCategories));

                $templateParser->parseTemplate();
                   
                $this->_html = $templateParser->getContent();
                
                return $this;
            }
        }

        protected function getCategories($productId){
            $recordset = new Category('Categories');
            $categories = $recordset->getAvailableCategories($productId);

            return $categories;
        }

        protected function getCategoriesIteration($productId){
            $categories = $this->getCategories($productId);

            $iteration = new TemplateParserIteration('categoriesList', $categories);
            
            return $iteration;
        }

        protected function getResultsetIteration($productCategories){
            $iteration = new TemplateParserIteration('productCategories', $productCategories);

            return $iteration;
        }
    }

    class ProductImagesWidget extends Widget{
        protected $template = '../skin/admin/products/product_images_widget.tpl';

        public function parseHtml($FieldValue) {
            $recordset = new DBRecordset("ProductImages");
            $recordset->addWhereCondition('ProductID='.getParamDefault('ProductID','0'));
            $recordset->read();

            $productImages = $recordset->getAllRecords();

            foreach ($productImages as &$image) {
                if ($image['ProductImageIsLeading'] == 1) {
                    $image['ProductImageLeadingText'] = 'Current leading image!';
                }
                else {
                    $image['ProductImageLeadingText'] = '';
                }
            }

            $iteration = new TemplateParserIteration('images',$productImages);
            $templateParser = new TemplateParser($this->template);
            $templateParser->setIteration($iteration);

            $templateParser->parseTemplate();

            $this->_html = $templateParser->getContent();

            return $this;
        }
    }

    class ProductDeleteAction extends osExecDeleteAction{
        public function prepare(){
            $this->_tableName = 'Products';
            $this->_editPK = 'ProductID';
        }
    }

    class ProductImageDeleteAction extends osExecDeleteAction{
        protected $_image;
        
        public function prepare(){
            $this->_tableName = 'ProductImages';
            $this->_editPK = 'ProductImageID';

            $record = new DBRecord($this->_tableName, $this->_editPK);
            $record->readDBRow($this->_editPK, getParam('ProductImageID'));

            $this->_image = $record->get('ProductImageFileName');
        }

        public function  postExecute() {
            @unlink(Paths::PRODUCTS_IMAGE_PATH.$this->_image);
            @unlink(Paths::PRODUCTS_ORIGINAL_IMAGE_PATH.$this->_image);
            @unlink(Paths::PRODUCTS_THICKBOX_IMAGE_PATH.$this->_image);
            @unlink(Paths::PRODUCTS_THUMB_IMAGE_PATH.$this->_image);

            $this->getController()->redirect('products.php?page=edit&ProductID=' . getParam('ProductID'));
        }
    }

    class ProductSetLeadingAction extends Action {
        public function  prepare() {
            $this->_tableName = 'ProductImages';
            $this->_editPK = 'ProductImageID';
        }
        
        public function execute() {
            $record = new DBRecord($this->_tableName, $this->_editPK);
            $record->readDBRow($this->_editPK, getParam('ProductImageID'));

            $record->set('ProductImageIsLeading', 1);

            $query = DBQueryUtil::constructUpdateQuery('ProductImages', array('ProductImageIsLeading'=>0));
            $query .= ' WHERE ProductID='.getParam('ProductID');

            ConnectionInstance::getInstance()->query($query);
            $record->update();
        }

        public function  postExecute() {
            $this->getController()->redirect('products.php?page=edit&ProductID=' . getParam('ProductID'));
        }
    }

    class ProductUpdateAction extends osExecUpdateAction{
        public function execute() {
            $this->saveImages();
            $this->saveCategories();

            parent::execute();
        }

        protected function saveImages(){
            $this->uploadImages();
        }

        protected function uploadImages(){
            $_FILES = UploadUtil::prepareFilesStack($_FILES);
            $prefix = time();
            foreach($_FILES['images'] as $file){
                $imageOriginalFile = UploadUtil::uploadFile(FileType::FILE_TYPE_IMAGE, $file, $prefix, Paths::getPath(Paths::PRODUCTS_ORIGINAL_IMAGE_PATH));
                $thumbImage = ImageUtil::processThumbnailing($imageOriginalFile, $file, array(
                    'width' => 88,
                    'height' => 88
                ), Paths::getPath(Paths::PRODUCTS_THUMB_IMAGE_PATH));

                $mainImage = ImageUtil::processThumbnailing($imageOriginalFile, $file, array(
                    'width' => 288,
                    'height' => 288
                ), Paths::getPath(Paths::PRODUCTS_IMAGE_PATH));

                $thickboxImage = ImageUtil::processThumbnailing($imageOriginalFile, $file, array(
                    'width' => 620,
                    'height' => 620
                ), Paths::getPath(Paths::PRODUCTS_THICKBOX_IMAGE_PATH));

                $record = new DBRecord('ProductImages', 'ProductImageID');
                $record->setDBRow(array(
                    'ProductID' => getParamDefault('ProductID', 0),
                    'ProductImageFileName' => $mainImage,
                    'ProductImageWidth' => 288,
                    'ProductImageHeight' => 288,
                    'ProductImageThumb' => $thumbImage,
                    'ProductImageThumbWidth' => 88,
                    'ProductImageThumbHeight' => 88,
                    'ProductImageThickbox' => $thickboxImage,
                    'ProductImageThickboxWidth' => 620,
                    'ProductImageThickboxHeight' => 620,
                    'ProductImageIsLeading' => 0,
                    'ProductImageOriginalFile' => $imageOriginalFile
                ));

                $record->insert();
            }
        }

        protected function saveCategories(){
            $productCategories = $this->prepareCategories();

            if($productCategories > 0){

                $recordset = new DBRecordset('Products_Categories');
                $recordset->delete('ProductID', getParam('ProductID'));

                foreach($productCategories as $category){
                    $record = new DBRecord('Products_Categories', 'ProductCategoryID');
                    $record->setDBRow(array(
                        'ProductID' => getParam('ProductID'),
                        'CategoryID' => $category,
                        'ProductCategoryIsDefault' => 1
                    ));

                    $record->insert();
                }
             }
        }

        protected function prepareCategories(){
            $categories = getParamDefault('ProductCategories', 0);

            if($categories != 0){
                $categories = explode(',', $categories);
            }

            return $categories;
        }
    }

    $page = new ProductsPage();
    $page->getController()->getDispatcher()->setActionHandler('doEdit', 'ProductUpdate');
    $page->getController()->getDispatcher()->setActionHandler('doSetLeadingImg', 'ProductSetLeading');
    $page->getController()->getDispatcher()->setActionHandler('doDelete', 'ProductDelete');
    $page->getController()->getDispatcher()->setActionHandler('doDeleteImage', 'ProductImageDelete');
    $page->showPage(getParamDefault('ProductID', '0'));
?>
