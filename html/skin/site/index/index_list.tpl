<!-- Center -->
<div id="center_column" class="center_column">
    <!-- MODULE Home Featured Products -->

    <div id="featured-products_block_center" class="block products_block">
        <h4>Featured products</h4>
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
                        <img src="<%SITE_URL%>userfiles/images/<%PRODUCT_IMAGE_PATH%><:ProductImageFileName:>" alt="Very Sexy" />
                    </a>
                    <span style="height: 4px; overflow:hidden"><br /></span>
                    <div class="product_desc" style="height: 30px; position:relative;  overflow: hidden; display: block; padding: 0px; vertical-align: bottom ">
                        
                        <a style="padding: 0 !important; " class="product_descr" href="products.php?ProductID=<:ProductID:>" title="More about <:ProductName:>">
                            <:ProductShortDescription:>
                        </a>
                    </div>

                    <div>
                        <span class="price"><:ProductGlobalPrice:> лв.</span>
                        <a  href="products.php?ProductID=<:ProductID:>" title="View">View</a></div>



                </li>
                <:enditeration name="products">
                <!--
                <li class="ajax_block_product">

                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=2" title="Sexy Little Things">Sexy Little Things</a></h5>
                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=2" title="More">Mauris pharetra dictum nibh in...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=2" title="Sexy Little Things"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/4/4-home.jpg" alt="Sexy Little Things" /></a>


                    <div>					<span class="price">$79.00</span>
                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=2" title="View">View</a></div>


                </li>
                <li class="ajax_block_product">
                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=3" title="Body by Victoria">Body by Victoria</a></h5>
                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=3" title="More">Donec ac turpis eget arcu...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=3" title="Body by Victoria"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/7/7-home.jpg" alt="Body by Victoria" /></a>


                    <div>					<span class="price">$11.96</span>

                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=3" title="View">View</a></div>



                </li>
                <li class="ajax_block_product">
                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=4" title="Very Sexy">Very Sexy</a></h5>
                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=4" title="More">Proin vehicula, odio a...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=4" title="Very Sexy"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/1/0/10-home.jpg" alt="Very Sexy" /></a>


                    <div>					<span class="price">$25.00</span>
                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=4" title="View">View</a></div>



                </li>
                <li class="ajax_block_product">
                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=5" title="Sexy Little Things">Sexy Little Things</a></h5>

                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=5" title="More"> Donec fermentum adipiscing...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=5" title="Sexy Little Things"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/1/3/13-home.jpg" alt="Sexy Little Things" /></a>


                    <div>					<span class="price">$39.00</span>
                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=5" title="View">View</a></div>



                </li>
                <li class="ajax_block_product">
                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=6" title="Body by Victoria">Body by Victoria</a></h5>
                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=6" title="More">Phasellus adipiscing lacus in...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=6" title="Body by Victoria"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/1/6/16-home.jpg" alt="Body by Victoria" /></a>


                    <div>					<span class="price">$16.00</span>

                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=6" title="View">View</a></div>



                </li>
                <li class="ajax_block_product">
                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=1" title="Very Sexy">Very Sexy</a></h5>
                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=1" title="More"> Lorem ipsum dolor sit amet,...</a></p>

                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=1" title="Very Sexy"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/1/1-home.jpg" alt="Very Sexy" /></a>


                    <div>					<span class="price">$53.20</span>
                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=1" title="View">View</a></div>



                </li>
                <li class="ajax_block_product">

                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=2" title="Sexy Little Things">Sexy Little Things</a></h5>
                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=2" title="More">Mauris pharetra dictum nibh in...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=2" title="Sexy Little Things"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/4/4-home.jpg" alt="Sexy Little Things" /></a>


                    <div>					<span class="price">$79.00</span>
                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=2" title="View">View</a></div>


                </li>
                <li class="ajax_block_product">
                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=3" title="Body by Victoria">Body by Victoria</a></h5>
                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=3" title="More">Donec ac turpis eget arcu...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=3" title="Body by Victoria"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/7/7-home.jpg" alt="Body by Victoria" /></a>


                    <div>					<span class="price">$11.96</span>

                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=3" title="View">View</a></div>



                </li>
                <li class="ajax_block_product">
                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=4" title="Very Sexy">Very Sexy</a></h5>
                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=4" title="More">Proin vehicula, odio a...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=4" title="Very Sexy"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/1/0/10-home.jpg" alt="Very Sexy" /></a>


                    <div>					<span class="price">$25.00</span>
                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=4" title="View">View</a></div>



                </li>
                <li class="ajax_block_product">
                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=5" title="Sexy Little Things">Sexy Little Things</a></h5>

                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=5" title="More"> Donec fermentum adipiscing...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=5" title="Sexy Little Things"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/1/3/13-home.jpg" alt="Sexy Little Things" /></a>


                    <div>					<span class="price">$39.00</span>
                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=5" title="View">View</a></div>



                </li>
                <li class="ajax_block_product">
                    <h5><a class="product_link" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=6" title="Body by Victoria">Body by Victoria</a></h5>
                    <p class="product_desc"><a class="product_descr" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=6" title="More">Phasellus adipiscing lacus in...</a></p>
                    <a class="product_image" href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=6" title="Body by Victoria"><img src="http://livedemo00.template-help.com/prestashop_34910/img/p/1/6/16-home.jpg" alt="Body by Victoria" /></a>


                    <div>					<span class="price">$16.00</span>

                        <a  href="http://livedemo00.template-help.com/prestashop_34910/product.php?id_product=6" title="View">View</a></div>



                </li>
                -->	
            </ul>
        </div>
    </div>
    <!-- /MODULE Home Featured Products -->						</div>

</div>
<div id="columns_bottom"></div>
</div>
