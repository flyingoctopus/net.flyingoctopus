<?php get_header(); ?>
	<div id="content">
		<div id="left">
	<?php if (have_posts()) : ?>
		<article id="article">
        	<header id="titre">
				<h1>Search Results</h1>
            </header>
        </article>
		<?php while (have_posts()) : the_post(); ?>
		<article id="article">
			<header id="titre">
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<pre><time datetime="<?php the_time('j F Y') ?>"><?php the_time('j F Y') ?></time> - by <?php the_author() ?></pre>
			</header>
			<section>
			<?php the_excerpt('Read this article &raquo;'); ?>
			</section>
			<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> In: <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No comments »', '1 comment &raquo;', '% comments &raquo;', 'comments-link', 'Comments are closed'); ?></p>
		</article>	
		<?php endwhile; ?>
		
		<div class="page">
                <div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
                <div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
        </div>   
        
		
	<?php else : ?>
        <article id="article">
                <header id="titre">
                <h1 class="center">Not Found</h1>
                </header>
                <section>
                    <p class="center">Sorry, but you are looking for something that isn't here.</p>
                </section>
		</article>
	<?php endif; ?>
		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>