            <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
  				<div>
					<label for="s">Search:</label><br />
					<input name="s" type="text" class="field" id="s" value="<?php the_search_query(); ?>" size="25" /><br />
					<input type="submit" id="searchsubmit" value="&raquo;" class="button" />
				</div>
			</form>