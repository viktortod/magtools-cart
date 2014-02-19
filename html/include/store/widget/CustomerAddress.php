<?php
class CustomerAddressWidget extends Widget{
    protected $template = 'skin/site/register/customer_address.tpl';

    public function parseHtml($FieldValue) {
        $addresses = $this->getAddresses();

        $iteration = new TemplateParserIteration('ADDRESSES', $addresses);

        $templateParser = new TemplateParser($this->template);

        $templateParser->setIteration($iteration);

        $templateParser->parseTemplate();

        $this->_html = $templateParser->getContent();
        
        return $this;
    }

    protected function getAddresses(){
        $customerId = jsSiteUserAuth::getLoggedUserProperty('CustomerID');
        $customerAddresses = new DBRecordset('CustomerAddress');
        $customerAddresses->addWhereCondition('CustomerID='.$customerId);

        $addresses = $customerAddresses->getAllRecords();

        foreach($addresses as &$address){
            if($address['CustomerAddressIsDefault'] == 1){
                $address['CustomerAddressChecked'] = 'checked';
            }
            else{
                $address['CustomerAddressChecked'] = '';
            }
        }
        
        return $addresses;
    }
}
?>
