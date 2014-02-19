<!-- Center -->
<div id="center_column" class="center_column">
    <!-- MODULE Home Featured Products -->

    <div id="featured-products_block_center" class="block products_block">
        <h4><%CategoryName%></h4>
        <div class="categoryImage" style="height: 200px; overflow: hidden; margin-top: 10px;">
            <img src="userfiles/images/categories/<%CategoryImage%>" width="615" />
        </div>
        <div class="block_content">
            <ul>
                <:iteration name="products">
                <li class="ajax_block_product">
                    <h5>
                        <a class="product_link" href="products.php?ProductID=<:ProductID:>" title="<:ProductName:>">
                            <:ProductName:>
                        </a>
                    </h5>


                    <a class="product_image" href="products.php?ProductID=<:ProductID:>" title="<:ProductName:>">
                        <img src="userfiles/images/products/<:ProductImageFileName:>" alt="Very Sexy" />
                    </a>
                    <p class="product_desc" style="height: 30px; overflow: hidden;">
                        <a class="product_descr" href="products.php?ProductID=<:ProductID:>" title="More about <:ProductName:>">
                            <:ProductShortDescription:>
                        </a>
                    </p>

                    <div>
                        <span class="price"><:ProductGlobalPrice:> лв.</span>
                        <a  href="products.php?ProductID=<:ProductID:>" title="View">View</a></div>



                </li>
                <:enditeration name="products">

            </ul>
        </div>
    </div>
    <!-- /MODULE Home Featured Products -->						</div>

</div>
<div id="columns_bottom"></div>
</div>
