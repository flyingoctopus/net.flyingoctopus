<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<!-- VERY IMPORTANT : The code below allows MSIE to handle the new HTML5 tags -->
<!--[if IE]>
    <script type="text/javascript">
        document.createElement("header");
        document.createElement("footer");
        document.createElement("nav");
        document.createElement("article");
        document.createElement("section");
        document.createElement("hgroup");
        document.createElement("aside");
    </script>
<![endif]-->
<script type="text/javascript">
<!--
sfHover = function() {
        var sfEls = document.getElementById("navlist").getElementsByTagName("LI");
        for (var i=0; i<sfEls.length; i++) {
                sfEls[i].onmouseover=function() {
                        this.className+=" sfhover";
                }
                sfEls[i].onmouseout=function() {
                        this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
                }
        }
}
if (window.attachEvent) window.attachEvent("onload", sfHover);

-->
</script>
<?php wp_head(); ?>
</head>

<body>
	<div id="container">
		<header> 
			<nav id="pages">
			<ul id="navlist">
			<li><a href="<?php echo get_settings('home'); ?>"><?php _e('Home'); ?></a></li>
			<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
			</ul>
			</nav>
			<hgroup id="logo">
				<h1><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a></h1>
				<h2><?php bloginfo('description'); ?></h2>
			</hgroup>
		</header>
