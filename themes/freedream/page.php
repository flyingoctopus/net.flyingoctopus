<?php get_header(); ?>
		<div id="content">
			<div id="left">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
            <article id="article">
        	<header id="titre">
						<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
                        <pre>Modified: <time datetime="<?php the_date('Y-m-d', '', ''); ?>" pubdate><?php the_time('F j, Y'); ?></time></pre>
			</header>
			<section>
				<?php the_content('<p>Read this article &raquo;</p>'); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</section>
            <p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> In: <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No comments »', '1 comment &raquo;', '% comments &raquo;', 'comments-link', 'Comments are closed'); ?></p>
		</article>
		<?php comments_template(); ?>
            </article>
   			</div>
	 <?php endwhile; endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>