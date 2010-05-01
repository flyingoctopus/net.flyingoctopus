<?php get_header(); ?>
	<div id="content">
		<div id="left">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_search_form(); ?>
            <article id="article">
            <header id="titre">
				<h1>Monthes</h1>
            </header>
            <section>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</section>
			</article>
            <article>
            <header id="titre">
				<h1>Categories</h1>
            </header>
            <section>
				<ul>
					<?php wp_list_categories(); ?>
				</ul>
			</section>
			</article>
            <article>
            <header id="titre">
				<h1>Tags</h1>
            </header>
            <section>
				<ul>
					<?php wp_tag_cloud('format=list'); ?>
				</ul>
			</section>
			</article>    
		</div>
<?php get_footer(); ?>