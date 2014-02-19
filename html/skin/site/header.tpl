<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>Lingerie store</title>
        <meta name="description" content="Shop powered by PrestaShop" />
        <meta name="keywords" content="shop, prestashop" />
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
        <meta name="generator" content="PrestaShop" />
        <meta name="robots" content="index,follow" />
        <link rel="icon" type="image/vnd.microsoft.icon" href="http://livedemo00.template-help.com/prestashop_34910/img/favicon.ico?1309339349" />
        <script src="<%SITE_SKIN_PATH%>/js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <link rel="shortcut icon" type="image/x-icon" href="http://livedemo00.template-help.com/prestashop_34910/img/favicon.ico?1309339349" />
        <script src="<%SITE_SKIN_PATH%>/js/hideshow.js" type="text/javascript"></script>
        <link href="<%SITE_SKIN_PATH%>/css/styles.css" rel="stylesheet" type="text/css" media="all" />
        <script src="<%SITE_SKIN_PATH%>/js/common.js" type="text/javascript"></script>
    </head>
    <body id="index">
        <!--[if lt IE 7]><div style='clear:both;height:59px;padding:0 15px 0 15px;position:relative;z-index:10000;text-align:center;'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div><![endif]-->
        <div id="wrapper1">
            <div id="wrapper2">
                <!-- Header -->
                <div id="header">
                    <a id="header_logo" href="http://livedemo00.template-help.com/prestashop_34910/" title="Lingerie store">

                        <img class="logo" src="http://livedemo00.template-help.com/prestashop_34910/img/logo.jpg?1309339349" alt="Lingerie store" />
                    </a>
                    <div id="header_right">
                        <ul id="header_links">
                            <li><a href="index.php">Начало</a></li>
                            <:iteration name="MAIN_MENU">
                                <li><a href="page.php?PageID=<:PageID:>"><:PageTitle:></a></li>
                            <:enditeration name="MAIN_MENU">
                            
                        </ul>
                        <!-- /Block permanent links module --><!-- Block user information module HEADER -->
                        <div id="header_user">
                            <ul>
                                <li id="account_info">

		Welcome, <%USERNAME%>
                                <:condition name="USER_IDENTITY":>
                                    <a id="your_account" href="register.php?page=edit" title="Your Account">Your Account</a>
                                    &nbsp;<a href="login.php?action=doLogout" id="logout-btn">Log out</a>&nbsp;
                                    <:else condition="USER_IDENTITY":>
                                    &nbsp;<a href="#" id="login-btn">Log in</a>&nbsp;
                                <:endcondition name="USER_IDENTITY":>
                                </li>

                                <li id="shopping_cart">
                                    <a href="view_cart.php" title="Your Shopping Cart">Cart:</a>
                                    <span class="ajax_cart_quantity hidden">0</span>
                                    <span class="ajax_cart_product_txt hidden">product</span>
                                    <span class="ajax_cart_product_txt_s hidden">products</span>
                                    <span class="ajax_cart_no_product">(empty)</span>

                                </li>
                            </ul>
                        </div>
                        <!-- /Block user information module HEADER --><!-- Block search module TOP -->
                        <div id="search_block_top">
                            <form method="get" action="http://livedemo00.template-help.com/prestashop_34910/search.php" id="searchbox">
                                <input class="search_query" type="text" id="search_query_top" name="search_query" value="" />
                                <a href="javascript:document.getElementById('searchbox').submit();">Search</a>
                                <input type="hidden" name="orderby" value="position" />
                                <input type="hidden" name="orderway" value="desc" />

                            </form>
                        </div>
                        <!-- /Block search module TOP --><!-- TM Banner #1 -->
                        <%ADVERTISINGLAYOUT%>
                        <!-- /TM Banner #1 -->
                    </div>
                </div>
                <div id="columns">
                    <div id="columns_inner">

                        <!-- Left -->
                        <div id="left_column" class="column">

                            <!-- Block categories module -->
                            <div id="categories_block_left" class="block">
                                <h4>Categories</h4>
                                <div class="block_content">
                                    
                                    <ul class="tree dhtml">
                                        <%LEFTCOLUMNLAYOUT%>
                                        
                                    </ul>
                                    <script type="text/javascript">
                                    // <![CDATA[
                                            // we hide the tree only if JavaScript is activated
                                            $('div#categories_block_left ul.dhtml li ul').hide();
                                    // ]]>
                                    </script>
                                </div>
                            </div>
                            <!-- /Block categories module -->
                            </div>
