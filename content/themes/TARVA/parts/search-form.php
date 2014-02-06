					<form class="search cf" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
						<label for="s"><?php _e('Find a centre'); ?></label>
						<input type="hidden" name="post_type" value="centre" />
						<input type="search" value="<?php echo trim( get_search_query() ); ?>" name="s" id="s" placeholder="Search the site" required>
						<input class="submit" name="submit" type="submit" value='Search'>	
					</form>