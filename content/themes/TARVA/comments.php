				<?php if ( post_password_required() ) : ?>
				<section id="comments" class="responses">
					<strong class="flash info protected">
						This post is password protected. Enter the password to view any comments.
					</strong>
				</section>
				<?php return; endif; ?>
				
				<?php
				global $post;
				if ( comments_open() || have_comments() ) : ?>
				<section id="comments" class="responses">
					<h2>
						<?php comments_number( 'Leave a comment', '1 comment', '% comments' ); ?>
					</h2>
					<ol class="responses">
						<?php wp_list_comments( array( 'callback' => 'my_comments' ) ); ?>
					</ol>
<?php get_template_part('parts/comment-form'); ?>
				</section>
				<?php /* elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ): ?>
				<section id="comments" class="responses">
					<strong class="flash info closed">
						Comments are closed
					</strong>
				</section> */ ?>	
				<?php endif; ?>
