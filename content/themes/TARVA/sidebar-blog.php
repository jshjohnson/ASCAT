				<div class="sidebar" role="complementary">
					<article class="panel">
						<h2>Categories</h2>
						<ul class="nav-secondary nav-blog">
						<?php wp_list_categories( 'orderby=name&show_count=0&title_li=' ); ?>
						</ul>
					</article>
					<article class="panel">
						<h2>Archives</h2>
						<ul class="nav-secondary nav-blog">
						<?php wp_get_archives( 'type=monthly&limit=6&show_post_count=0' ); ?>
						</ul>
					</article>
				</div>
