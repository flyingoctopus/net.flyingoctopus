<!doctype html>
<html lang="en">
<head>
<title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<script >
  document.createElement('header');
  document.createElement('nav');
  document.createElement('section');
  document.createElement('article');
  document.createElement('aside');
  document.createElement('footer');
</script>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,projection" />

<?php wp_head(); ?>



</head>
 
<body <?php body_class(); ?>>

	<header>
		<h1><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h1>
	</header>
	
	<section id="description">
		<p><?php bloginfo('description'); ?> By <a href="<?php echo get_option('home'); ?>/" class="Admin of This Blog"><?php the_author_meta( nickname, 1 ); ?></a></p>
	</section>	