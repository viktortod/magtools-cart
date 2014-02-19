<!doctype html>
<html>

<head>
	<title>Dashboard I Admin Panel</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<%SKINS_PATH%>css/layout.css" type="text/css" media="screen" />

	<script src="<%SKINS_PATH%>js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="<%SKINS_PATH%>js/hideshow.js" type="text/javascript"></script>
	<script src="<%SKINS_PATH%>js/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script src="<%SKINS_PATH%>js/common.js.js" type="text/javascript"></script>
        <script src="<%SKINS_PATH%>js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<%SKINS_PATH%>js/jquery.MultiFile.js" type="text/javascript"></script>
	<script type="text/javascript" src="<%SKINS_PATH%>js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function()
    	{
      	  $(".tablesorter").tablesorter();
   	 }
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>
<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html">Website Admin</a></h1>
			<h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="http://www.medialoot.com">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->

	<section id="secondary_bar">
		<div class="user">
			<p><%USERNAME%> (<a href="#">3 Messages</a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.php">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->

	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>CMS</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="pages.php">Pages</a></li>
			<li class="icn_edit_article"><a href="pages.php?page=create">Create page</a></li>
			<li class="icn_categories"><a href="blocks.php">Blocks</a></li>
			<li class="icn_tags"><a href="seo.php">Page SEO</a></li>
		</ul>
		<h3>Store</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="categories.php">Categories</a></li>
			<li class="icn_view_users"><a href="products.php">Products</a></li>
			<li class="icn_photo"><a href="orders.php">Orders</a></li>
                        <li class="icn_profile"><a href="customers.php">Customers</a></li>
		</ul>
		<h3>Reports</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="#">Income / profits</a></li>
			<li class="icn_photo"><a href="#">Products report</a></li>
			<li class="icn_audio"><a href="#">Customer report</a></li>
			<li class="icn_video"><a href="#">Refferers report</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Settings</a></li>
                        <li class="icn_settings"><a href="theme_editor.php">Theme settings</a></li>
			<li class="icn_security"><a href="#">Messages</a></li>
			<li class="icn_jump_back"><a href="#">Administrators</a></li>
                        <li class="icn_jump_back"><a href="#">Credits</a></li>
		</ul>

		<footer>
			<hr />
			<p><strong>Copyright &copy; 2011 Website Admin</strong></p>
			<p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
		</footer>
	</aside><!-- end of sidebar -->

	<section id="main" class="column">
		