<aside>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
        
        <nav><ul><?php wp_list_pages(); ?></ul></nav>
		
		<nav><ul><?php wp_list_categories('optioncount=1&show_count=1'); ?></ul></nav>
		
		<nav><ul><?php wp_list_bookmarks('title_after=&title_before='); ?></ul></nav>
		
		<section>
			<header>
				<h3>Tags</h3>
			</header>
			<p><?php wp_tag_cloud('smallest=10&largest=20'); ?></p>
		</section>		       
<?php endif; ?>        
</aside>