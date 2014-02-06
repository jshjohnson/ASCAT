					<form class="search cf" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
						<label for="s"><?php _e('Search:'); ?></label>
						<input type="search" value="<?php echo trim( get_search_query() ); ?>" name="s" id="s" placeholder="Search the site">
						<input class="submit" name="submit" type="submit" value='Search'>	
					</form>