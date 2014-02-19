 <form method="POST" action="<%MAIN_FORM_ACTION%>" enctype="multipart/form-data">
    <article class="module width_full">
       <header><h3>Order customer details</h3></header>
       <div class="module_content">
            <input type="hidden" id="OrderID" name="OrderID" value="<%PAGE_ELEMENT%>" />
            <input type="hidden" id="CustomerID" name="CustomerID" value="<%CUSTOMERID%>" />
            <fieldset>
                <label>Order Creation date:</label>
                <%ORDERDATE%><br />
            </fieldset>
            <fieldset>
                <label>Customer:</label>
                <a target="_blank" href="customers.php?page=edit&CustomerID=<%CUSTOMERID%>">
                    <%CUSTOMERFIRSTNAME%> <%CUSTOMERFIRSTNAME%>
                </a><br />
            </fieldset>
            <fieldset>
                <label>Customer phone number:</label>
                <%CUSTOMERPHONE%><br />
            </fieldset>
            <fieldset>
                <label>Company / Address / UIC / VAT:</label>
                <%CUSTOMERCOMPANY%> / <%CUSTOMERCOMPANYADDRESS%> / <%CUSTOMERUIC%> / <%CUSTOMERVAT%><br />
            </fieldset>
            <fieldset>
                <label>Customer address</label>
                <%CUSTOMERADDRESS%>
            </fieldset>
            <fieldset>
                <label>Shipping module</label>
                <%SHIPPINGMODULENAME%>
            </fieldset>
            <fieldset>
                <label>Payment module</label>
                <%PAYMENTMODULENAME%>
            </fieldset>
            <fieldset>
                <label>Special instructions</label>
                <%ORDERADDITIONALINFO%>
            </fieldset>
        </div>
    </article>
     <article class="module width_full">
       <header><h3>Order details</h3></header>
        <div class="module_content">
            <%ORDERITEMS%>
        </div>
    </article>
     <article class="module width_full">
         <header>
             <h3>Processing</h3>
             <ul class="tabs">
                <li><a href="#tab1">Order status</a></li>
                <li><a href="#tab2">Customer relations</a></li>
                <li><a href="#tab3">Accounting</a></li>
                <li><a href="#tab4">Images</a></li>
            </ul>
         </header>
        <div class="module_content">
            <div id="tab1" class="tab_content">
                <fieldset>
                    <label>Order Status: </label>
                    <%ORDERSTATUS%>
                </fieldset>
                 <br />
                 <input type="submit" style="margin-left: 20px" value="Save Order" class="alt_btn">
                 <br />
                 <br />
            </div>
            <div id="tab2" class="tab_content">
                <fieldset>
                    <table class="custRepMessagesList tablesorter">
                        <caption>Customer messages:</caption>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Message</th>
                        </tr>
                        <tbody id="msgs">
                            <%CUSTREPMSGS%>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset>
                    <label>Email send: </label><br />
                    <%CUSTREP%><br />
                    <input type="button" id="MailSender" value="Send e-mail" />
                </fieldset>
            </div>
            <div id="tab3" class="tab_content">
                <input type="button" id="InvoiceGenerator" name="InvoiceGenerator" value="Generate Invoice" />
                <input type="button" name="CreditNoteGenerator" value="Generate Credit Note" />
            </div>
         </div>
     </acticle>
     
</form>
<script type="text/javascript">
    $(function(){
        $('h3').dblclick(function(){
            $(this).parent().parent().find('.module_content').slideToggle('slow');
        });

        $('#InvoiceGenerator').click(function(){
            if(confirm('Are you sure?')){
                var orderId = $('#OrderID').val();

                window.open('orders.php?page=edit&OrderID=' + orderId + '&action=generateInvoice');
            }
        });

        $('#MailSender').click(function(){
            if(confirm('Are you sure?')){
                var orderId = $('#OrderID').val();
                var customerId = $('#CustomerID').val();
                var message = CKEDITOR.instances.CustRep.getData();

                $.ajax({
                    type: 'POST',
                    url : 'orders.php?page=edit&OrderID=' + orderId + '&action=sendMail',
                    data: 'mail=' + escape(message) + '&CustomerID=' + customerId,
                    success: function(response){
                        $('#msgs').css('display','none');
                        $('#msgs').html(response);
                        $('#msgs').show('slow');
                    }
                });
            }
        });
    });
</script>