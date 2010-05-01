<?php get_header(); ?>
	<div id="content">
		<div id="left">
            <div class="page">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>
	<?php if (have_posts()) : ?>	
            <article id="article">	
                <header id="titre">
                    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>		
                    <?php /* If this is a category archive */ if (is_category()) { ?>
                        <h1>Category:<?php single_cat_title(); ?>&#8217;</h1>
                    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?> 
                        <h1>Tag: <?php single_tag_title(); ?>&#8217;</h1> 
                    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                        <h1>Day: <?php the_time('F j, Y'); ?></h1>
                    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                        <h1>Month:  <?php the_time('F Y'); ?></h1>
                    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                        <h1>Year: <?php the_time('Y'); ?></h1>
                    <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                        <h1>Author </h1>
                    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                        <h1>Blog's Archives</h1>
                    <?php } ?>
                </header>
                <section>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="article">
                            <header id="titre">
                                <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                                <pre><time datetime="<?php the_date('Y-m-d', '', ''); ?>" pubdate><?php the_time('F j, Y'); ?></time> - by <?php the_author() ?></pre>
                            </header>
                            <section>
                            <?php the_content('Read this article &raquo;'); ?>
                            </section>
                            <p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> In: <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No comments »', '1 comment &raquo;', '% comments &raquo;', 'comments-link', 'Comments are closed'); ?></p>
                    </article>
		
		<?php endwhile; ?>
            <div class="page">
                <div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
                <div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
            </div>    
		<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<article id='article'><header id='titre'><h1>No article in this category %s.</h1></header></article>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<article id='article'><header id='titre'><h1>Sorry, no article for this date.</h1></header></article>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<article id='article'><header id='titre'><h1>Sorry, %s didn't write any article yet.</h1></header></article>", $userdata->display_name);
		} else {
			echo("<article id='article'><header id='titre'><h1>Not found.</h1></header></article>");
		}
		get_search_form();

	endif;
?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>