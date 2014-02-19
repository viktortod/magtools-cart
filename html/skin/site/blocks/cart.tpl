<script type="text/javascript">
    var CUSTOMIZE_TEXTFIELD = 1;
    var customizationIdMessage = 'Customization #';
    var removingLinkText = 'remove this product from my cart';

    $(function(){
        var UICart = shop.UICart.init();


        
    });
</script>
<!-- MODULE Block cart -->
<div id="cart_block" class="block exclusive">
    <h4>

        <a id="cart_label" href="http://livedemo00.template-help.com/prestashop_34910/order.php">Cart</a>
        <span id="block_cart_expand" class="hidden">&nbsp;</span>
        <span id="block_cart_collapse" >&nbsp;</span>
    </h4>
    <div class="block_content">
        <!-- block summary -->
        <div id="cart_block_summary" class="collapsed">
            <span class="ajax_cart_quantity" style="display:none;">0</span>

            <span class="ajax_cart_product_txt_s" style="display:none">products</span>
            <span class="ajax_cart_product_txt" >product</span>
            <span class="ajax_cart_total" style="display:none">$0.00</span>
            <span class="ajax_cart_no_product" >(empty)</span>
        </div>
        <!-- block list of products -->
        <div id="cart_block_list" class="expanded">

            <div id="cart_block_products">No products</div>
            <div class="cart-prices">
                <div class="cart-prices-block">
                    <span>Shipping</span>
                    <span id="cart_block_shipping_cost" class="price ajax_cart_shipping_cost">$0.00</span>
                </div>
                <div class="cart-prices-block">

                    <span>Total</span>
                    <span id="cart_block_total" class="price ajax_block_cart_total">$0.00</span>
                </div>
            </div>
            <p id="cart-price-precisions">
					Prices are tax excluded
            </p>
            <p id="cart-buttons">

                <a href="view_cart.php" style="width: 86px;" class="exclusive_small" title="Cart">Cart</a>			<a href="http://livedemo00.template-help.com/prestashop_34910/order.php?step=1" id="button_order_cart" style="width: 126px;" class="button" title="Check out">Check out</a>
            </p>
        </div>
    </div>
</div>
<!-- /MODULE Block cart -->