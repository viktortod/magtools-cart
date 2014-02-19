<?php
    require_once '../include/magtools/init.php';

    jsUserAuth::checkUserAuth();

    class OrdersAdministrationPage extends PageAdministration{
        protected $_templatesBase = 'orders';

        protected $_dataFields = array(
            array(
                'type' => 'StaticTextField',
                'name' => 'CustomerFirstName'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CustomerUIC'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CustomerVAT'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CustomerCompany'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CustomerCompanyAddress'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CustomerLastName'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'OrderDate'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CustomerID'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CustomerPhone'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'CustomerAddress'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'ShippingModuleName'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'PaymentModuleName'
            ),
            array(
                'type' => 'StaticTextField',
                'name' => 'OrderAdditionalInfo'
            ),
            array(
                'type' => 'OrderItemsWidget',
                'name' => 'OrderItems'
            ),
            array(
                'type' => 'SelectBox',
                'name' => 'OrderStatus'
            ),
            array(
                'type' => 'CustRepMessagesWidget',
                'name' => 'CustRepMsgs'
            ),
            array(
                'type' => 'TextEditor',
                'name' => 'CustRep'
            ),
        );

        public function initTableRows(&$rows) {
            foreach($rows as &$row){
                $row['OrderStatus'] = OrderStatus::getOrderStatus($row['OrderStatus']);
                $row['OrderDate'] = date('d/m/Y', $row['OrderDate']);
            }
        }

        public function  initWebForm() {
            parent::initWebForm();

            $this->getWidget('OrderStatus')->setOptions(OrderStatus::getOrderStatusNames());
        }

        public function  createDomainObject() {
            $this->_domainObject = new Order();
        }
    }

    class CustRepMessagesWidget extends Widget {
        public function parseHtml($FieldValue) {
            $this->_html = '';

            $msgsRecordset = new DBRecordset('CustomerMessages');
            $msgsRecordset->addWhereCondition('AccordingOrderID='.getParam('OrderID'));

            $msgs = $msgsRecordset->getAllRecords();

            foreach($msgs as $msg) {
                $this->_html .= '<tr>';
                $this->_html .= '<td>'. date('d/m/Y',$msg['CustomerMessageTimestamp']) . '</td>';
                $this->_html .= '<td>'. $msg['CustomerMessageTitle'] . '</td>';
                $this->_html .= '<td>'. strip_tags($msg['CustomerMessageText']) . '</td>';
                $this->_html .= '</tr>';
            }

            return $this;
        }
    }

    class OrderItemsWidget extends Widget {
        protected $template = '../skin/admin/orders/order_items.tpl';

        public function parseHtml($FieldValue) {

            $orderProductTotal = 0.0;

            foreach($FieldValue as $product) {
                if(isset($product['OrderItemSum']))
                $orderProductTotal += $product['OrderItemSum'];
            }

            $orderShipping = $FieldValue['Shipping'];

            $orderTotal = $orderProductTotal + $orderShipping;
            
            $templateParser = new TemplateParser($this->template);
            $orderItemsIteration = new TemplateParserIteration('ORDERITEMS', $FieldValue);

            $templateParser->setTempalateVariables(OrderItems::calculateTotalLines($FieldValue));

            $templateParser->setIteration($orderItemsIteration);
            $templateParser->parseTemplate();
            $this->_html = $templateParser->getContent();

            return $this;
        }
    }

    class SendMailAction extends Action {
        public function execute() {
            ob_clean();
            $mail = urldecode(getParam('mail'));

            $record = array(
                'CustomerID' => getParam('CustomerID'),
                'CustomerMessageParentID' => 0,
                'CustomerMessageTitle' => '',
                'AccordingOrderID' => getParam('OrderID'),
                'CustomerMessageText' => $mail,
                'CustomerMessageTimestamp'=> time()
            );

            $messageRecord = new DBRecord('CustomerMessages', 'CustomerMessageID');
            $messageRecord->setDBRow($record);

            $messageRecord->insert();

            $widget = new CustRepMessagesWidget('CustomerMessages', array());

            $widget->parseHtml('')->show();

            //@TODO: Send the email.
            exit(); // ajax
        }
    }

    class GenerateInvoiceAction extends Action {
        private $template = '../skin/admin/invoice/invoice.tpl';
        
        public function execute() {
            $this->clearHeaders();

            $orderDomainObject = new Order();
            $order = $orderDomainObject->getElement(getParam('OrderID'));
            $orderItems = $order['OrderItems'];
            unset($order['OrderItems']);

            $orderItemsIteration = new TemplateParserIteration('ORDERITEMS', $orderItems);

            $templateParser = new TemplateParser($this->template);
            $templateParser->setIteration($orderItemsIteration);
            $templateParser->setTempalateVariables(UIUtil::prepareVariables($order));
            $templateParser->assignVariableArray(OrderItems::calculateTotalLines($orderItems));
            $templateParser->parseTemplate();
            $templateParser->showTemplate();
            exit();
        }

        private function clearHeaders() {
            ob_clean();
        }
    }

    class EditOrderAction extends Action {
        public function  execute() {
            $orderId = getParam('OrderID');
            $orderStatus = getParam('OrderStatus');

            $record = new DBRecord('Orders', 'OrderID');
            $record->readDBRow('OrderID', $orderId);
            $record->set('OrderStatus', $orderStatus);

            $record->update($orderId);

            $this->getController()->redirect('?page=');
        }
    }

    $page = new OrdersAdministrationPage();
    $page->getController()->getDispatcher()->setActionHandler('doEdit', 'EditOrder');
    $page->getController()->getDispatcher()->setActionHandler('generateInvoice', 'GenerateInvoice');
    $page->getController()->getDispatcher()->setActionHandler('sendMail', 'SendMail');
//    $page->getController()->getDispatcher()->setActionHandler('doDelete', 'CmsPageDelete');
    $page->showPage(getParamDefault('OrderID', '0'));

?>
