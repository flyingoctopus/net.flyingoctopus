<?php get_header(); ?> 

<section>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article class="blogpost">
		<header>
		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		</header>
		<?php the_content(); ?>
		<p class="whowhen">By <?php the_author_posts_link(); ?> at <time datetime="<?php the_time('Y-m-d'); ?>T<?php the_time('H:i:s'); ?><?php the_time('P'); ?>"><?php the_time('Y-m-d'); ?> <?php the_time('H:i:s'); ?></time></p>
		<p class="catcom">In <?php the_category(', '); ?>, <a href="<?php comments_link(); ?>"><?php comments_number('No comment', '1 comment', '% comments'); ?></a></p>
		
		<?php comments_template(); // Get wp-comments.php template ?>
			
	</article>
	
	<?php endwhile; else: ?>

		<header>
		<h2>Woops...</h2>
		</header>
		<article class="blogpost">
		<p>Sorry, no posts we're found.</p>
		</article>
		
		<?php endif; ?>
		
		<nav class="postnav"><?php posts_nav_link(); ?></nav>
					
</section>

<?php get_sidebar(); ?>  

<?php get_footer(); ?> 
