<?php get_header(); ?>
		<div id="content">
			<div id="left">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
            <div class="pages">
                <div class="left"><?php previous_post_link('&laquo; %link') ?></div>
                <div class="right"><?php next_post_link('%link &raquo;') ?></div>
            </div>
		
		<article id="article">
        	<header id="titre">
						<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
                        <pre><time datetime="<?php the_time('j F Y') ?>"><?php the_time('j F Y') ?></time> - by <?php the_author() ?></pre>
			</header>
			<section>
				<?php the_content('<p>Read this article &raquo;</p>'); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</section>
				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> In: <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No comments »', '1 comment &raquo;', '% comments &raquo;', 'comments-link', 'Comments are closed'); ?></p>
		</article>
		<?php comments_template(); ?>
	
	<?php endwhile; else: ?>
			<article id="article">
                <header id="titre">
                    <h1>404 Error</h1>
                </header>
                <section>
                <p>Sorry, no posts matched your criteria.</p>
                <?php get_search_form(); ?>
                </section>
			</article>
			<?php endif; ?>
			<div class="pages">
				<div class="left"><?php previous_post_link('&laquo; %link') ?></div>
                <div class="right"><?php next_post_link('%link &raquo;') ?></div>
			</div>

		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>