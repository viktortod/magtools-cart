<!-- Center -->
<div id="center_column" class="center_column">
    <!-- MODULE Home Featured Products -->
        <br />
<!--    <div id="featured-products_block_center" class="block products_block">-->
        <h1><%CategoryName%></h1>
        <div class="categoryImage" style="overflow: hidden; margin-top: 10px;">
            <img src="userfiles/images/categories/thumbs/<%CategoryImage%>" width="615" />
        </div>
<!--        <div class="block_content">-->
            <ul id="product_list" class="clear">
                <:iteration name="products">
               <li class="ajax_block_product  alternate_item clearfix">
                    <a title="<:ProductName:>" class="product_img_link" href="products.php?ProductID=<:ProductID:>">
                        <img width="195" alt="<:ProductName:>" src="<%SITE_URL%>userfiles/<%PRODUCT_IMAGE_PATH%><:ProductImageFileName:>">
                    </a>
                    <div class="right_block">
                        <div class="products_states">
                            <span class="availability">Available</span>
                        </div>
                        <h3>
                            <a title="<:ProductName:>" href="products.php?ProductID=<:ProductID:>" class="product_link">
                                <:ProductName:>
                            </a>
                        </h3>

<!--                        <p class="product_desc">-->
                            <div class="product_descr">
                                <:ProductShortDescription:>
                            </div>
<!--                        </p>-->
                        <div class="products_prices">
                            <span class="price"><:ProductGlobalPrice:> лв.</span>


                        </div>


                        <a title="Add to cart" href="javascript:shop.UICart.addProduct(<:ProductID:>, 1)" rel="ajax_id_product_23" class="button ajax_add_to_cart_button">Add to cart</a>
                        <a title="View" href="products.php?ProductID=<:ProductID:>" class="view_link">View</a>
                    </div>
                </li>
                <:enditeration name="products">

            </ul>
<!--        </div>-->
    </div>
    <!-- /MODULE Home Featured Products -->						</div>

</div>
<div id="columns_bottom"></div>
</div>
