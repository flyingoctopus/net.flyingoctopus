<?php get_header(); ?>

<div id="content">
			<div id="left">
            <article id="article">
            <section>
            <p>Unfortunately the content you're looking for isn't here. There may be a misspelling in your web address or you may have clicked a link for content that no longer exists. Perhaps you would be interested in our most recent articles.</p>
            </section>
            </article>
            
            <article id="article">
            <header  id="titre">
            <h2>Recent Articles</h2>
            </header>
            <section>
               <?php query_posts('cat=&showposts=5'); ?>
				<ul id="recentPosts">
			   <?php while (have_posts()) : the_post(); ?>
				<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
                <pre><time datetime="<?php the_date('Y-m-d', '', ''); ?>" pubdate><?php the_time('F j, Y'); ?></time></pre></li>
   				<?php endwhile; ?>
        		</ul>
</div>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>