<script type="text/javascript">
$(function(){
    $('#emptyCartBtn').click(function(){
        if(confirm('Are you sure?')){
            document.cartForm.action.value = 'doEmptyCart';
            document.cartForm.submit();
        }
    });

    $('#goBack').click(function(){
        history.back();
        return false;
    });
});
</script>
<div id="center_column" class="center_column">
        <br />
        <h1>Cart</h1>
        <br />
        <div class="cart">
            <form action="" name="cartForm" id="cartForm" method="POST">
            <table class="cart-list">
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Code</th>
                    <th>Quantity</th>
                    <th>Single price</th>
                    <th>Total</th>
                </tr>
                <:condition name="HAS_PRODUCTS":>
                <:iteration name="PRODUCTS">
                <tr>
                    <td><img src="userfiles/images/products/<:ProductImageFileName:>" height="<:ProductImageHeight:>" /></td>
                    <td class="cart-product-names"><:ProductName:></td>
                    <td><:ProductCode:></td>
                    <td><input type="text" name="ProductQuantity[<:ProductID:>]" value="<:quantity:>" /></td>
                    <td><:ProductGlobalPrice:> лв.</td>
                    <td><:EndPrice:> лв.</td>
                </tr>
                <:enditeration name="PRODUCTS">
                <tr>
                    <th colspan="4"></th>
                    <th align="right">Price</th>
                    <th><%TOTALPRICE%> лв.</th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th align="right">Shipping</th>
                    <th ><%SHIPPINGPRICE%> лв.</th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th align="right">Total</th>
                    <th><%ENDPRICE%> лв.</th>
                </tr>
               

            </table>
            <br />
            
            <div class="btn-area">
                
                <input type="hidden" id="action" name="action" value="doUpdateCart" />
                <input style="display: inline;" id="emptyCartBtn" type="button" class="button" value="Empty cart" />
                <input style="display: inline;" type="submit" class="button" value="Update" />
                <input style="display: inline;" id="goBack" type="button" class="button" value="Continue shopping" />
                <a href="checkout.php?page=edit&action=doConfirmCart">
                <input style="display: inline;" id="createOrder" type="button" class="button" value="Order" />
                </a>

            </div>
            
                <br />
                <:else condition="HAS_PRODUCTS":>
                <tr>
                    <td colspan="6" align="center"> Your cart is empty </td>
                </tr>

            </table>
            <br />
                 <div class="btn-area">

                
                <input style="display: inline;" id="goBack" type="button" class="button" value="Continue shopping" />
                

            </div>
                <:endcondition name="HAS_PRODUCTS":>
            </form>
        </div>
        <br />
<br />
</div>

</div>