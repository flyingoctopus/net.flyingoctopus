        <nav id="sidebar">		 
            <?php get_search_form(); ?>
            
            <div id="rss-img">
            <a href="<?php bloginfo('rss_url'); ?>" id="zone1" title="Subscribe to our RSS"></a>
            </div>
            <!-- UNCOMMENT THE LINES BELLOW THIS IF YOU WANT TO PROVIDE YOUR TWITTER LINK -->
            <!-- <div id="twitter-img">
            <a href="http://www.twitter.com/YourUrlHere" id="zone2" target="_blank" title="Follow me on Twitter"></a>
            </div> -->
        	<ul>
            <?php   /* Widgetized sidebar, if you have the plugin installed. */ 
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
                <li><h2>Archives</h2>
                <ul>
                    <?php wp_get_archives('type=monthly'); ?>
				</ul>
				</li>
				<?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>
				<?php /* If it's homepage */ if ( is_home() || is_page() ) { ?>
				<?php wp_list_bookmarks(); ?>
				<li><h2>Meta</h2>
				<ul>
                    <?php wp_register(); ?>
                    <li><?php wp_loginout(); ?></li>
                    <li><a href="http://validator.w3.org/check/referer" title="Validate XHTML 1.0 Transitional"><abbr title="eXtensible HyperText Markup Language">XHTML valide</abbr></a></li>
                    <li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
                    <li><a href="http://wordpress.org/" title="Is proudly propulsed by Wordpress">WordPress</a></li>
                    <?php wp_meta(); ?>
                </ul>
                </li>

                <?php } ?>		
                <?php endif; ?>
			</ul>
        </nav>