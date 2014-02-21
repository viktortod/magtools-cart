<script type="text/javascript" src="<%SITE_SKIN_PATH%>/js/lightBox.js"></script>
<link rel="stylesheet" href="<%SITE_SKIN_PATH%>/css/jquery.lightbox-0.5.css" type="text/css" />
<script type="text/javascript">
    $(function(){
        $('a.lightbox').lightBox({fixedNavigation:true});
    });
</script>
<!-- Center -->
<div id="center_column" class="center_column">
    <br />
    <div id="primary_block" class="clearfix">
        <h1><%ProductName%></h1>
        <div id="pb-right-column">
            <!-- product img-->
            <div id="image-block">
                <a href="<%SITE_URL%>userfiles/<%PRODUCT_LARGE_PATH%><%ProductImageFileName%>" title="<%ProductName%>" class="lightbox">
                <img src="<%SITE_URL%>userfiles/<%PRODUCT_IMAGE_PATH%><%ProductImageFileName%>"
                     title="<%ProductName%>" alt="<%ProductName%>"  id="bigpic" width="288" height="288" />
                </a>
            </div>
            <!-- thumbnails -->
            <div id="views_block" >
                <div id="thumbs_list">
                    <ul id="thumbs_list">
                        <:iteration name="images">
                        <li id="thumbnail_64">
                             <a href="<%SITE_URL%>userfiles/<%PRODUCT_LARGE_PATH%><:ProductImageFileName:>" title="<%ProductName%>" class="lightbox">
                                <img src="<%SITE_URL%>userfiles/<%PRODUCT_THUMB_PATH%><:ProductImageFileName:>" alt="<%ProductName%>" height="88" width="88" />
                            </a>
                        </li>
                        <:enditeration name="images">
                    </ul>
                </div>
            </div>
            <span id="wrapResetImages" style="display:none;"><div><a id="resetImages" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=22" onclick="$('span#wrapResetImages').hide('slow');return (false);">Display all pictures</a></div></span>		<!-- usefull links-->
            <ul id="usefull_link_block">
                <li><a href="javascript:print();">Print</a></li>
                <li><span id="view_full_size" class="span_link">View full size</span></li>

            </ul>
        </div>
        <div id="pb-left-column">
            <div id="short_description_block">
                <div id="short_description_content" class="rte align_justify">
                    <%ProductShortDescription%>
                </div>
                <div class="product_detailed_description" style="display: none;">
                    <%ProductDetailedDescription%>
                </div>
                <p class="buttons_bottom_block"><a onclick="$('.product_detailed_description').slideToggle('slow')" class="button">More details</a></p>
            </div>

            <!-- add to cart form-->
            <form id="buy_block"  action="http://livedemo00.template-help.com/prestashop_34910/cart.php" method="post">
                <!-- hidden datas -->
                <p class="hidden">
                    <input type="hidden" name="token" value="6e39b3c7b49c5e4f0b3a89154678b07a" />
                    <input type="hidden" name="id_product" value="22" id="product_page_product_id" />
                    <input type="hidden" name="add" value="1" />
                    <input type="hidden" name="id_product_attribute" id="idCombination" value="" />
                </p>

                <!-- prices -->
                <p class="price">
                    <span class="our_price_display">
                        <span id="our_price_display"><%ProductGlobalPrice%> лв.</span>
			tax excl.																	</span>
                </p>
                <div id="other_prices">
                </div>

                
                <!-- quantity wanted -->
                <p id="quantity_wanted_p">
                    <label>Quantity :</label>
                    <input type="text" name="qty" id="quantity_wanted" class="text" value="1" size="2" maxlength="3"  />
                </p>
                <!-- minimal quantity wanted -->
                <p id="minimal_quantity_wanted_p" style="display: none;">You must add <b id="minimal_quantity_label">1</b> as a minimum quantity to buy this product.</p>

                <!-- availability -->
                <p id="availability_statut" style="display:none;">
                    <span id="availability_label">Availability:</span>
                    <span id="availability_value">
                    </span>
                </p>
                <p id="add_to_cart" class="buttons_bottom_block">
                    <a class="button" href="javascript:shop.UICart.addProduct(<%ProductID%>, $('#quantity_wanted').val())">Add to cart</a>
                    <input id="add2cartbtn" type="submit" name="Submit" value="Add to cart" />
                </p>
                <div class="clearblock"></div>
            </form>
        </div>
    </div>

</div>
<div id="columns_bottom"></div>
</div>
